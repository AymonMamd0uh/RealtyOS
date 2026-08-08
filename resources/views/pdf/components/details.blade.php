<div
    class="pdf-section"
    style="
        border:1px solid #E5E7EB;
        border-radius:16px;
        padding:28px;
        margin-bottom:30px;
        background:#FFFFFF;
    ">

    <h2
        style="
            margin:0 0 24px;
            font-size:26px;
            color:#111827;
        ">

        Property Details

    </h2>

    <table
        width="100%"
        cellpadding="14"
        cellspacing="0"
        style="
            border-collapse:collapse;
            font-size:15px;
        ">

        <tr style="background:#F9FAFB;">

            <td width="22%">
                <strong>Property Type</strong>
            </td>

            <td width="28%">
                {{ ucfirst($record->property_type->value) }}
            </td>

            <td width="22%">
                <strong>Listing Type</strong>
            </td>

            <td width="28%">
                {{ ucfirst($record->listing_type->value) }}
            </td>

        </tr>

        <tr>

            <td>
                <strong>Status</strong>
            </td>

            <td>
                {{ ucfirst($record->status->value) }}
            </td>

            <td>
                <strong>Floor</strong>
            </td>

            <td>
                {{ $record->floor_number }}
            </td>

        </tr>

        <tr style="background:#F9FAFB;">

            <td>
                <strong>City</strong>
            </td>

            <td>
                {{ $record->city?->name ?? '-' }}
            </td>

            <td>
                <strong>Area</strong>
            </td>

            <td>
                {{ $record->area?->name ?? '-' }}
            </td>

        </tr>

        <tr>

            <td>
                <strong>Compound</strong>
            </td>

            <td>
                {{ $record->compound?->name ?? '-' }}
            </td>

            <td>
                <strong>Stage</strong>
            </td>

            <td>
                {{ $record->stage?->name ?? '-' }}
            </td>

        </tr>

    </table>

</div>