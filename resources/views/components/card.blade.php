<div {{ $attributes->merge(['class' => 'bg-white dark:bg-zinc-800 shadow-sm sm:rounded-lg p-6']) }}>
    @if (isset($header))
        <div class="mb-4">
            {{ $header }}
        </div>
    @endif

    {{ $slot }}
</div>
