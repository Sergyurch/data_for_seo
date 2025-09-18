<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Перевірка позиції сайту DataForSEO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>
    <body>
        <div class="max-w-6xl mx-auto p-6">
            <h1 class="text-3xl font-bold text-center pb-8">Перевірка позиції сайту в Google (DataForSEO)</h1>

            <div id="errors" class="text-red-600 mb-8">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <form method="post" action="{{ route('search') }}">
                <div class="grid grid-cols-2 gap-4 mb-8">
                    @csrf
                    <input type="text" name="keyword" class="text-xl p-2 border rounded-xl" placeholder="Ключове слово" value="" required>
                    <input type="text" name="site" class="text-xl p-2 border rounded-xl" placeholder="Приклад: example.com" value="" required>
                    <input type="text" name="location" class="text-xl p-2 border rounded-xl" placeholder="Приклад: Ukraine або Kyiv, Ukraine" value="" required>
                    <div class="w-full relative">
                        <select name="language" class="w-full appearance-none text-xl p-2 border rounded-xl" required>
                            <option value="">Оберіть мову</option>
                            @foreach ($languages as $lang)
                                <option value="{{ $lang->language_code }}">
                                    {{ $lang->language_name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-8">
                    <button id="submit" type="submit" class="text-xl px-6 py-2 bg-blue-600 text-white font-semibold rounded-xl shadow hover:bg-blue-700 cursor-pointer" @if ($errors->any()) disabled @endif>Пошук</button>
                </div>
            </form>

            <div id="result" class="text-xl bg-gray-100 p-4 rounded-xl">
                <p>Введіть дані та натисніть «Пошук».</p>
            </div>
        </div>

        @vite('resources/js/app.js')
    </body>
</html>