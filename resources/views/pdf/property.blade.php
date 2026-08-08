<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>{{ $record->title }}</title>

    @vite([
        'resources/css/app.css',
        'resources/css/filament/admin/theme.css'
    ])

    <style>

        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            padding:0;
            background:#fff;
            font-family:Arial, Helvetica, sans-serif;
            color:#111827;
        }
.page{
    padding:40px;
    position:relative;
}

        .page-break{
            page-break-after:always;
        }

        img{
            max-width:100%;
            height:auto;
        }

        .pdf-section{

            page-break-inside:avoid;

            break-inside:avoid;

            margin-bottom:28px;

        }

    </style>

</head>

<body>

    {{-- ================= PAGE 1 ================= --}}
    <div class="page">

        @include('pdf.components.cover')

        @include('pdf.components.summary')

    </div>

    <div class="page-break"></div>


    {{-- ================= PAGE 2 ================= --}}
    <div class="page">

        @include('pdf.components.details')

        @include('pdf.components.features')

        @include('pdf.components.location')

    </div>

    <div class="page-break"></div>


    {{-- ================= PAGE 3 ================= --}}
    <div class="page">

        @include('pdf.components.gallery')

    </div>

    <div class="page-break"></div>


{{-- ================= PAGE 4 ================= --}}
<div class="page">

    @include('pdf.components.description')

    @include('pdf.components.internal-information')

    @include('pdf.components.agent')

    @include('pdf.components.footer')

</div>

</body>

</html>