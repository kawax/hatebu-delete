<x-app-layout>
    <div class="pt-6">
        <x-ts-card>
            <x-slot:header>
                <h1 class="text-3xl">はてなブックマーク全削除</h1>
            </x-slot:header>

            <div>
                全削除機能が使えなかった時期に作ったけどもう不要なので個人的に使うだけのツールにリニューアル。
            </div>

            <div class="mt-3">
                <x-ts-button text="ログイン" href="{{ route('login') }}" sm/>
            </div>
        </x-ts-card>
    </div>
</x-app-layout>
