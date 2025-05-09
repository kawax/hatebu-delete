<x-app-layout>
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
</x-app-layout>
