<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laravel</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="antialiased bg-gray-50">
  <div class="min-w-xs max-w-screen-xl mx-auto">
    <header class="px-3 xl:px-0">
      <h1 class="text-2xl font-medium pt-2 pb-3">Yaruka Web Assignment</h1>
    </header>
    <div>
      {{ $slot }}
    </div>
  </div>
</body>
</html>