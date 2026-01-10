<div class="my-4">
    <flux:button wire:click="delete()" size="sm">
        最近の20件を削除
    </flux:button>

    <small class="text-gray-500">（{{ config('hatena.delete_days') }}日以内のブックマークは除く）</small>
</div>
