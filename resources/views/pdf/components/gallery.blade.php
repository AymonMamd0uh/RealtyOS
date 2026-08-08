@if($record->images->count())

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

        Property Gallery

    </h2>

    <div
        style="
            width:60px;
            height:4px;
            background:#F97316;
            border-radius:50px;
            margin:18px 0 25px;
        ">
    </div>

    {{-- Cover Image --}}
    @if($record->coverImage)

        <div
            style="
                border:1px solid #E5E7EB;
                border-radius:16px;
                overflow:hidden;
                margin-bottom:24px;
                text-align:center;
            ">

            <img
                src="{{ public_path('storage/'.$record->coverImage->image) }}"
                style="
                    width:100%;
                    max-height:420px;
                    object-fit:cover;
                    display:block;
                ">

        </div>

    @endif

    @php
        $images = $record->images
            ->where('is_cover', false)
            ->take(4)
            ->values();
    @endphp

    @if($images->count())

        <table
            width="100%"
            cellpadding="8"
            cellspacing="0">

            @foreach($images->chunk(2) as $row)

                <tr>

                    @foreach($row as $image)

                        <td
                            width="50%"
                            valign="top">

                            <div
                                style="
                                    border:1px solid #E5E7EB;
                                    border-radius:14px;
                                    overflow:hidden;
                                ">

                                <img
                                    src="{{ public_path('storage/'.$image->image) }}"
                                    style="
                                        width:100%;
                                        height:220px;
                                        object-fit:cover;
                                        display:block;
                                    ">

                            </div>

                        </td>

                    @endforeach

                    @if($row->count() == 1)
                        <td width="50%"></td>
                    @endif

                </tr>

            @endforeach

        </table>

    @endif

</div>

@endif