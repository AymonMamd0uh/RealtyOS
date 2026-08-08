<div class="pdf-section">

    <table width="100%" cellpadding="10" cellspacing="0">

        {{-- Row 1 --}}
        <tr>

            <td width="33.33%">

                <div style="border:1px solid #E5E7EB;border-radius:14px;padding:22px;text-align:center;">

                    <div style="font-size:14px;color:#6B7280;">
                        Bedrooms
                    </div>

                    <div style="margin-top:12px;font-size:34px;font-weight:bold;color:#111827;">
                        {{ $record->bedrooms }}
                    </div>

                </div>

            </td>

            <td width="33.33%">

                <div style="border:1px solid #E5E7EB;border-radius:14px;padding:22px;text-align:center;">

                    <div style="font-size:14px;color:#6B7280;">
                        Bathrooms
                    </div>

                    <div style="margin-top:12px;font-size:34px;font-weight:bold;color:#111827;">
                        {{ $record->bathrooms }}
                    </div>

                </div>

            </td>

            <td width="33.33%">

                <div style="border:1px solid #E5E7EB;border-radius:14px;padding:22px;text-align:center;">

                    <div style="font-size:14px;color:#6B7280;">
                        Floor
                    </div>

                    <div style="margin-top:12px;font-size:34px;font-weight:bold;color:#111827;">
                        {{ $record->floor_number }}
                    </div>

                </div>

            </td>

        </tr>

        {{-- Row 2 --}}
        <tr>

            <td>

                <div style="border:1px solid #E5E7EB;border-radius:14px;padding:22px;text-align:center;">

                    <div style="font-size:14px;color:#6B7280;">
                        Built Area
                    </div>

                    <div style="margin-top:12px;font-size:26px;font-weight:bold;color:#111827;">
                        {{ number_format($record->built_area) }}
                    </div>

                    <div style="font-size:13px;color:#6B7280;">
                        m²
                    </div>

                </div>

            </td>

            <td>

                <div style="border:1px solid #E5E7EB;border-radius:14px;padding:22px;text-align:center;">

                    <div style="font-size:14px;color:#6B7280;">
                        Land Area
                    </div>

                    <div style="margin-top:12px;font-size:26px;font-weight:bold;color:#111827;">
                        {{ number_format($record->land_area) }}
                    </div>

                    <div style="font-size:13px;color:#6B7280;">
                        m²
                    </div>

                </div>

            </td>

            <td>

                <div style="border:1px solid #E5E7EB;border-radius:14px;padding:22px;text-align:center;">

                    <div style="font-size:14px;color:#6B7280;">
                        Furnished
                    </div>

                    <div style="margin-top:12px;font-size:28px;font-weight:bold;color:#111827;">
                        {{ $record->is_furnished ? 'Yes' : 'No' }}
                    </div>

                </div>

            </td>

        </tr>

    </table>

</div>