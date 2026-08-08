<div
    class="pdf-section"
    style="
        margin-top:50px;
        border-top:2px solid #E5E7EB;
        padding-top:24px;
    ">

    <table
        width="100%"
        cellpadding="0"
        cellspacing="0">

        <tr>

            {{-- Left --}}
            <td
                valign="top"
                align="left">

                <div
                    style="
                        font-size:20px;
                        font-weight:bold;
                        color:#111827;
                    ">

                    RealtyOS

                </div>

                <div
                    style="
                        margin-top:6px;
                        font-size:13px;
                        color:#6B7280;
                    ">

                    Real Estate CRM Platform

                </div>

            </td>

            {{-- Center --}}
            <td
                valign="top"
                align="center">

                <div
                    style="
                        font-size:13px;
                        color:#6B7280;
                    ">

                    Generated

                </div>

                <div
                    style="
                        margin-top:6px;
                        font-size:14px;
                        font-weight:bold;
                        color:#111827;
                    ">

                    {{ now()->format('d M Y') }}

                </div>

            </td>

            {{-- Right --}}
            <td
                valign="top"
                align="right">

                <div
                    style="
                        font-size:13px;
                        color:#6B7280;
                    ">

                    Property Reference

                </div>

                <div
                    style="
                        margin-top:6px;
                        font-size:14px;
                        font-weight:bold;
                        color:#111827;
                    ">

                    {{ $record->reference_number }}

                </div>

            </td>

        </tr>

    </table>

</div>