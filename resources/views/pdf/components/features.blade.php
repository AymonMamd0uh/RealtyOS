@if($record->features->count())

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

        Property Features

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
        cellpadding="10"
        cellspacing="0"
        style="border-collapse:separate;">

        @foreach($record->features->chunk(3) as $row)

            <tr>

                @foreach($row as $feature)

                    <td width="33.33%">

                        <div
                            style="
                                border:1px solid #E5E7EB;
                                border-radius:12px;
                                padding:14px 16px;
                                background:#F9FAFB;
                                font-size:15px;
                                color:#374151;
                            ">

                            <span
                                style="
                                    color:#10B981;
                                    font-weight:bold;
                                    margin-right:8px;
                                ">

                                ✓

                            </span>

                            {{ $feature->name }}

                        </div>

                    </td>

                @endforeach

                @for($i = $row->count(); $i < 3; $i++)

                    <td width="33.33%"></td>

                @endfor

            </tr>

        @endforeach

    </table>

</div>

@endif