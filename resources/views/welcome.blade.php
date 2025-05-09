<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="pt-6">
            <x-card>
                <x-slot:header>
                    <flux:heading level="1" size="xl">はてなブックマーク全削除</flux:heading>
                </x-slot:header>

                <div>
                    全削除機能が使えなかった時期に作ったけどもう不要なので個人的に使うだけのツールにリニューアル。
                </div>

                <div class="mt-3">
                    <flux:button href="{{ route('login') }}" size="sm">ログイン</flux:button>
                </div>
            </x-card>
        </div>
    </main>
</div>

</body>
</html>
