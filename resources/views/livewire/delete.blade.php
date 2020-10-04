<div class="card border-primary">
    <div class="card-body">
        <button wire:click="delete()" class="btn btn-primary">最近の20件を削除</button>

        <small class="text-muted">（{{ config('hatena.delete_days') }}日以内のブックマークは除く）</small>
    </div>
</div>
