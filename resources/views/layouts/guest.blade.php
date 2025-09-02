<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'CosMemo') }}</title>
    <link rel="icon" href="{{ asset('rougeicon-brown.svg') }}" type="image/svg+xml" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="antialiased">
    <div class="min-h-[100svh] bg-auth bg-cover bg-center" style="background-image: url('{{ asset('images/bg-auth.png') }}')">
      <x-ui.navbar />
      <main class="flex flex-col">
        {{ $slot }}
      </main>
    </div>
  </body>
</html>
