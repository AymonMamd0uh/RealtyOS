<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;

class LeadExportController extends Controller
{
    public function download(Request $request)
    {
        abort_unless(auth()->check(), 403);

        $user = auth()->user();

        /*
         * Security:
         * Every export is restricted to the logged-in user's company.
         */
        $query = Lead::query()
            ->where('company_id', $user->company_id)
            ->with([
                'assignedTo',
                'property',
            ]);

        /*
         * Agents can export ONLY their own leads.
         */
        if ($user->hasRole('Agent')) {
            $query->where('assigned_to', $user->id);
        } else {
            /*
             * Owner / Company users:
             * They can export all leads belonging to their company.
             *
             * Optional Agent filter can still be applied.
             */
            if ($agentId = $request->input('agent_id')) {
                $query->where('assigned_to', $agentId);
            }
        }

        /*
         * Search
         */
        if ($search = $request->input('search')) {
            $query->where(function ($query) use ($search) {
                $query
                    ->where('name', 'ilike', "%{$search}%")
                    ->orWhere('phone', 'ilike', "%{$search}%")
                    ->orWhere('source', 'ilike', "%{$search}%");
            });
        }

        /*
         * Status filter
         */
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        /*
         * Source filter
         */
        if ($source = $request->input('source')) {
            $query->where('source', $source);
        }

        $writer = new Writer();

        $writer->openToBrowser('leads.xlsx');

        /*
         * Excel Header
         */
        $writer->addRow(Row::fromValues([
            'Name',
            'Phone',
            'Agent',
            'Property',
            'Status',
        ]));

        /*
         * Export in chunks to keep memory usage low.
         */
        $query
            ->orderBy('id')
            ->chunk(500, function ($leads) use ($writer) {
                foreach ($leads as $lead) {
                    $writer->addRow(Row::fromValues([
                        $lead->name ?? '',
                        $lead->phone ?? '',
                        $lead->assignedTo?->name ?? '',
                        $lead->property?->title ?? '',
                        $lead->status?->value ?? '',
                    ]));
                }
            });

        $writer->close();

        exit;
    }
}