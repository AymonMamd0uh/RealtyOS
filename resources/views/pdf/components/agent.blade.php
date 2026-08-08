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
            margin:0 0 24px;
            font-size:26px;
            color:#111827;
        ">

        Agent Information

    </h2>

    <table
        width="100%"
        cellpadding="0"
        cellspacing="0">

        <tr>

            {{-- Agent Avatar --}}
            <td
                width="90"
                valign="top">

                <div
                    style="
                        width:70px;
                        height:70px;
                        border-radius:50%;
                        background:#F3F4F6;
                        text-align:center;
                        line-height:70px;
                        font-size:28px;
                        font-weight:bold;
                        color:#6B7280;
                    ">

                    {{ strtoupper(substr($record->user?->name ?? 'A',0,1)) }}

                </div>

            </td>

            {{-- Agent Info --}}
            <td valign="top">

                <div
                    style="
                        font-size:24px;
                        font-weight:bold;
                        color:#111827;
                    ">

                    {{ $record->user?->name ?? '-' }}

                </div>

                <div
                    style="
                        margin-top:6px;
                        color:#6B7280;
                        font-size:15px;
                    ">

                    {{ $record->company?->name ?? '-' }}

                </div>

                <div
                    style="
                        margin-top:18px;
                    ">

                    <table
                        width="100%"
                        cellpadding="8"
                        cellspacing="0"
                        style="
                            border-collapse:collapse;
                            font-size:14px;
                        ">

                        <tr style="background:#F9FAFB;">

                            <td width="35%">
                                <strong>Created</strong>
                            </td>

                            <td>

                                {{ $record->created_at->format('d M Y') }}

                            </td>

                        </tr>

                        <tr>

                            <td>
                                <strong>Reference</strong>
                            </td>

                            <td>

                                {{ $record->reference_number }}

                            </td>

                        </tr>

                        <tr style="background:#F9FAFB;">

                            <td>
                                <strong>Status</strong>
                            </td>

                            <td>

                                {{ ucfirst($record->status->value) }}

                            </td>

                        </tr>

                    </table>

                </div>

            </td>

        </tr>

    </table>

</div>