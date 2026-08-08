<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;

class PropertyExportController extends Controller
{
    public function download(Request $request)
    {
        abort_unless(auth()->check(), 403);

        $user = auth()->user();

        /*
         * Security:
         * Every export is restricted to the logged-in user's company.
         */
        $query = Property::query()
            ->where('company_id', $user->company_id)
            ->with([
                'user',
                'city',
                'area',
                'compound',
            ]);

        /*
         * Agents can export ONLY their own properties.
         */
        if ($user->hasRole('Agent')) {
            $query->where('user_id', $user->id);
        } else {
            /*
             * Company users can export properties
             * filtered by agent if an agent filter is selected.
             */
            if ($agentId = $request->input('user_id')) {
                $query->where('user_id', $agentId);
            }
        }

        /*
         * Search
         */
        if ($search = $request->input('search')) {
            $query->where(function ($query) use ($search) {
                $query
                    ->where('reference_number', 'ilike', "%{$search}%")
                    ->orWhere('title', 'ilike', "%{$search}%");
            });
        }

        /*
         * City
         */
        if ($cityId = $request->input('city_id')) {
            $query->where('city_id', $cityId);
        }

        /*
         * Area
         */
        if ($areaId = $request->input('area_id')) {
            $query->where('area_id', $areaId);
        }

        /*
         * Compound
         */
        if ($compoundId = $request->input('compound_id')) {
            $query->where('compound_id', $compoundId);
        }

        /*
         * Property Type
         */
        if ($propertyType = $request->input('property_type')) {
            $query->where('property_type', $propertyType);
        }

        /*
         * Listing Type
         */
        if ($listingType = $request->input('listing_type')) {
            $query->where('listing_type', $listingType);
        }

        /*
         * Status
         */
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $writer = new Writer();

        $writer->openToBrowser('properties.xlsx');

        /*
         * Excel Header
         */
        $writer->addRow(Row::fromValues([
            'Reference Number',
            'Title',
            'Price',
            'Agent',
            'City',
            'Area',
            'Compound',
            'Property Type',
            'Listing Type',
            'Status',
        ]));

        /*
         * Export in chunks to keep memory usage low.
         */
        $query
            ->orderBy('id')
            ->chunk(500, function ($properties) use ($writer) {
                foreach ($properties as $property) {
                    $writer->addRow(Row::fromValues([
                        $property->reference_number ?? '',
                        $property->title ?? '',
                        $property->price ?? '',
                        $property->user?->name ?? '',
                        $property->city?->name ?? '',
                        $property->area?->name ?? '',
                        $property->compound?->name ?? '',
                        $property->property_type?->value ?? '',
                        $property->listing_type?->value ?? '',
                        $property->status?->value ?? '',
                    ]));
                }
            });

        $writer->close();

        exit;
    }
}