<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  <!-- Styles -->
</head>

<body class="antialiased">
  @for ($i = 1; $i <= 3; $i++)
    @php
      $data = Arr::where($datum, fn($e) => $e->number === $i);
    @endphp

    <div class="container d-flex flex-row">
      <h1>{{ Arr::get($data, 0)?->number }}</h1>
      <h1>{{ Arr::get($data, 0)?->rawBirthDatePlace }}</h1>

      <h1>{{ Arr::get($data, 1)?->number }}</h1>
      <h1>{{ Arr::get($data, 1)?->rawBirthDatePlace }}</h1>
    </div>
  @endfor
</body>

</html>
