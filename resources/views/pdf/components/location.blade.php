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

        Property Location

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

            <td width="30%">
                <strong>City</strong>
            </td>

            <td>
                {{ $record->city?->name ?? '-' }}
            </td>

        </tr>

        <tr>

            <td>
                <strong>Area</strong>
            </td>

            <td>
                {{ $record->area?->name ?? '-' }}
            </td>

        </tr>

        <tr style="background:#F9FAFB;">

            <td>
                <strong>Compound</strong>
            </td>

            <td>
                {{ $record->compound?->name ?? '-' }}
            </td>

        </tr>

        <tr>

            <td>
                <strong>Stage</strong>
            </td>

            <td>
                {{ $record->stage?->name ?? '-' }}
            </td>

        </tr>

    </table>

</div>