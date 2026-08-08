@if($record->description)

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
            margin:0 0 20px;
            font-size:26px;
            color:#111827;
        ">

        Property Description

    </h2>

    <div
        style="
            width:60px;
            height:4px;
            background:#F97316;
            border-radius:50px;
            margin-bottom:22px;
        ">

    </div>

    <div
        style="
            color:#374151;
            font-size:15px;
            line-height:2;
            text-align:justify;
            white-space:pre-line;
        ">

        {{ trim($record->description) }}

    </div>

</div>

@endif