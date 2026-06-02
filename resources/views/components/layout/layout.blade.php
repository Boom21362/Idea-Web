<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body class="bg-background text-foreground">
    <x-layout.nav/>
    <main class="max-w-7xl mx-auto px-6 pb-10">
        {{$slot}}
    </main>

    <div
        x-data="{show: true}"
        x-init="setTimeout(()->show = false,3000)"
        x-show="show"
        x-transition.opacity.duration.1000ms
        class="fixed bg-primary px-4 py-3 absolute bottom-4 right-4 rounded-lg "
    >
        Test for now :)
    </div>

    @session('success')
        <div class="fixed bg-primary px-4 py-3 absolute bottom-4 right-4 rounded-lg">{{ $value }}</div>
    @endsession

</body>
</html>
