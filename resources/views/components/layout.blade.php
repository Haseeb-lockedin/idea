<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>idea</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body data-theme="abyss">
    <x-navbar />
    <main class="max-w-7xl mx-auto px-6 py-6">
        {{ $slot }}
    </main>

    @session('success')
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity.duration.300ms
            class="fixed bottom-4 right-4 z-50 flex items-center max-w-[calc(100%-2rem)] gap-4 px-4 py-3 overflow-hidden font-bold text-md rounded shadow-sm w-80 bg-emerald-50 text-emerald-500 shadow-emerald-100 ring-1 ring-inset ring-emerald-100"
            role="status">
            {{ $value }}
        </div>
    @endsession
</body>

</html>
