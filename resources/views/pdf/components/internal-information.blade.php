@if($record->canViewInternalInformation(auth()->user()))

<div
    class="pdf-section"
    style="
        border:1px solid #E5E7EB;
        border-radius:18px;
        padding:28px;
        background:#FFFFFF;
        margin-bottom:30px;
    ">

    <h2
        style="
            margin:0;
            font-size:26px;
            color:#111827;
        ">

        Internal Information

    </h2>

    <div
        style="
            width:60px;
            height:4px;
            background:#F97316;
            border-radius:50px;
            margin:18px 0 24px;
        ">
    </div>

    <table
        width="100%"
        cellpadding="12"
        cellspacing="0"
        style="
            border-collapse:collapse;
            font-size:15px;
        ">

        <tr style="background:#F9FAFB;">
            <td width="30%"><strong>Owner Name</strong></td>
            <td>{{ $record->owner_name ?: '-' }}</td>
        </tr>

        <tr>
            <td><strong>Owner Phone</strong></td>
            <td>{{ $record->owner_phone ?: '-' }}</td>
        </tr>

        <tr style="background:#F9FAFB;">
            <td><strong>Owner Email</strong></td>
            <td>{{ $record->owner_email ?: '-' }}</td>
        </tr>

        <tr>
            <td><strong>Group</strong></td>
            <td>{{ $record->group_name ?: '-' }}</td>
        </tr>

        <tr style="background:#F9FAFB;">
            <td><strong>Building</strong></td>
            <td>{{ $record->building_number ?: '-' }}</td>
        </tr>

        <tr>
            <td><strong>Unit</strong></td>
            <td>{{ $record->unit_number ?: '-' }}</td>
        </tr>

        @if($record->internal_notes)

            <tr style="background:#F9FAFB;">
                <td valign="top">
                    <strong>Internal Notes</strong>
                </td>

                <td style="white-space:pre-line;">
                    {{ $record->internal_notes }}
                </td>
            </tr>

        @endif

    </table>

</div>

@endif