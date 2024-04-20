<div class="my-4">
    <x-ts-button wire:click="delete()" wire:loading.attr="disabled" sm>
        最近の20件を削除
    </x-ts-button>

    <small class="text-gray-500">（{{ config('hatena.delete_days') }}日以内のブックマークは除く）</small>
</div>
