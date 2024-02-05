<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ (new Carbon\Carbon())->format('Y') }} Temperature Blanket</title>
        
        <link rel="icon" href="favicon.svg">
        <link rel="mask-icon" href="favicon.svg" color="#fff">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body class="antialiased bg-stone-800">
        <div class="fixed top-0 left-0 right-0 bg-stone-900 p-8 flex flex-row h-24">
            <h1 class="text-orange-800 text-center text-2xl font-bold w-1/3"><a href="/">{{ (new Carbon\Carbon())->format('Y') }} Temperature Blanket</a></h1>
            <h2 class="text-orange-300 text-center text-xl w-2/3">
                <a href="/?date={{ $info['rows']['current']['date']->clone()->subday()->format('m/d/Y') }}" class="text-orange-700 hover:text-stone-900 hover:bg-orange-700 p-1"> &lt; </a>
                <a href="/?date={{ $info['rows']['current']['date']->format('m/d/Y') }}" class="hover:text-stone-900 hover:bg-orange-300 p-1"> {{ $info['rows']['current']['date']->format('m/d/Y') }}  </a>
                <a href="/?date={{ $info['rows']['current']['date']->clone()->addday()->format('m/d/Y') }}" class="text-orange-700 hover:text-stone-900 hover:bg-orange-700 p-1"> &gt; </a>
            </h2>
        </div>

        @include('c2c-blanket::grid');

        <div class="text-stone-500 fixed bottom-4 left-0 right-0 text-sm text-center">Data cached on {{ $info['meta']['cachedDate'] }}</div>
    </body>
</html>
