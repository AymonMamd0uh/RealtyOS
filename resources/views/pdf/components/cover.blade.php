<div
    class="pdf-section"
    style="
        border:1px solid #E5E7EB;
        border-radius:18px;
        overflow:hidden;
        margin-bottom:30px;
        background:#FFFFFF;
    ">

    {{-- Cover Image --}}
    @if($record->coverImage)

        <img
            src="{{ public_path('storage/'.$record->coverImage->image) }}"
            style="
                width:100%;
                height:420px;
                object-fit:cover;
                display:block;
            ">

    @endif

    <div style="padding:28px;">

        <table width="100%" cellpadding="0" cellspacing="0">

            <tr>

                {{-- Left Side --}}
                <td valign="top">

                    <table cellpadding="0" cellspacing="0">

                        <tr>

                            <td>

                                <span
                                    style="
                                        display:inline-block;
                                        background:#EEF2FF;
                                        color:#4338CA;
                                        padding:7px 16px;
                                        border-radius:20px;
                                        font-size:12px;
                                        font-weight:bold;
                                    ">

                                    {{ strtoupper($record->property_type->value) }}

                                </span>

                            </td>

                            <td width="10"></td>

                            <td>

                                <span
                                    style="
                                        display:inline-block;
                                        background:#ECFDF5;
                                        color:#059669;
                                        padding:7px 16px;
                                        border-radius:20px;
                                        font-size:12px;
                                        font-weight:bold;
                                    ">

                                    {{ strtoupper($record->listing_type->value) }}

                                </span>

                            </td>

                        </tr>

                    </table>

                    <div style="height:20px;"></div>

                    <h1
                        style="
                            margin:0;
                            font-size:34px;
                            line-height:1.3;
                            color:#111827;
                        ">

                        {{ $record->title }}

                    </h1>

                    <div style="height:18px;"></div>

                    <div
                        style="
                            font-size:15px;
                            color:#6B7280;
                        ">

                        Reference No.

                        <strong>

                            {{ $record->reference_number }}

                        </strong>

                    </div>

                </td>

                {{-- Right Side --}}
                <td
                    width="240"
                    align="right"
                    valign="top">

                    <div
                        style="
                            font-size:18px;
                            color:#6B7280;
                        ">

                        Price

                    </div>

                    <div
                        style="
                            margin-top:10px;
                            font-size:46px;
                            font-weight:800;
                            color:#EA580C;
                            line-height:1;
                        ">

                        {{ number_format($record->price) }}

                    </div>

                    <div
                        style="
                            margin-top:8px;
                            font-size:18px;
                            color:#6B7280;
                            letter-spacing:2px;
                        ">

                        EGP

                    </div>

                    <div style="height:35px;"></div>

                    <table
                        align="right"
                        cellpadding="6">

                        <tr>

                            <td
                                style="
                                    background:#F3F4F6;
                                    border-radius:8px;
                                    font-size:13px;
                                ">

                                {{ ucfirst($record->status->value) }}

                            </td>

                        </tr>

                    </table>

                </td>

            </tr>

        </table>

    </div>

</div>