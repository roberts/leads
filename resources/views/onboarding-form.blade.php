<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Onboarding</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <link href="{{ asset('vendor/leads/css/app.css') }}" rel="stylesheet">

    <livewire:styles />
</head>
<body>
    @livewire('onboarding-form')

    <livewire:scripts />
</body>
</html>
