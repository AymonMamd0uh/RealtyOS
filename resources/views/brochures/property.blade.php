<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/app.css',
        'resources/css/filament/admin/theme.css'
    ])

    <style>

        body{
            background:#f5f5f5;
            padding:40px;
        }

    </style>

</head>

<body>

@include('filament.resources.properties.components.hero')

@include('filament.resources.properties.components.stats')

@include('filament.resources.properties.components.gallery')

@include('filament.resources.properties.components.details')

@include('filament.resources.properties.components.description')

@include('filament.resources.properties.components.features')

@include('filament.resources.properties.components.location')

@include('filament.resources.properties.components.agent')

</body>

</html>