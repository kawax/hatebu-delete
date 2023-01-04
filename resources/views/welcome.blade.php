@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="card border-primary">
                    <div class="card-body">
                        <h1>はてなブックマーク全削除</h1>
                        <p class="lead">全削除機能がいつまでも使えないままなので代わりに削除するツール。躊躇なく削除されるので注意。</p>
                        <p>
                            <a href="https://bookmark.hatenastaff.com/entry/2017/11/24/173417" target="_blank"
                               rel="noreferrer noopener">ブックマークの全削除が行えない不具合が発生しています -
                                はてなブックマーク開発ブログ</a>
                        </p>
                    </div>
                </div>

                <div class="card border-primary mt-3">
                    <div class="card-body">
                        <h2>お知らせ</h2>
                        <p>意外とユーザーがいるのでお知らせ欄。</p>
                        <hr>
                        <p>
                            2020/01/22 やっと全削除機能が再開された。
                            <a href="https://bookmark.hatenastaff.com/entry/2020/01/22/165413" target="_blank">ブックマークの全削除機能の提供を再開しました
                                - はてなブックマーク開発ブログ</a>
                        </p>
                        <hr>
                        <p>
                            2019/08/29 <a href="https://bookmark.hatenastaff.com/entry/2019/08/26/111011"
                                          target="_blank">HTTPS切り替え対応済</a>。
                        </p>
                        <hr>
                        <p>
                            2019/08/08 はてな側でエラー発生中かも。様子見。→翌日<a
                                href="https://bookmark.hatenastaff.com/entry/2019/08/08/192634"
                                target="_blank">修正された</a>。
                        </p>
                        <hr>
                        <p>
                            AtomAPIが終了したので非公開ブックマークでは使えなくなった。
                            <a href="https://bookmark.hatenastaff.com/entry/2018/09/19/181818" target="_blank"
                               rel="noreferrer noopener">はてなブックマークAtom
                                APIのサポートを終了します - はてなブックマーク開発ブログ</a>
                        </p>
                        <hr>
                        <p>
                            AtomAPI終了後はRSSから取得してるけどはてな側がなにかおかしい。削除済の古いブックマークが出てくる場合ははてな側の不具合なので無視。
                        </p>
                        <hr>
                        <p>
                            自動削除の特典キーはユーザーが入れ替わったら変更するけど今の状態では頻繁に変えることはないので一ヶ月だけ申し込めば当分使える。
                            <a href="https://www.pixiv.net/fanbox/creator/762638/post/79560" target="_blank"
                               rel="noreferrer noopener">特典キー</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-primary">
                    <div class="card-body">
                        <h2>使い方</h2>

                        <h3 class="border-bottom">ユーザー登録</h3>
                        <p>
                            <a href="{{ route('login') }}" class="btn btn-primary">はてなアカウントでログイン（OAuth認証）</a>
                        </p>
                        <p>
                            削除まで行うのでscopeは全部（read_public, write_public, read_private, write_private）
                        </p>
                        <p>
                            許可するのが心配なら自分で動かそう。（サポートは一切なし）
                            <a href="https://github.com/kawax/hatebu-delete"
                               target="_blank"
                               rel="noopener">GitHub</a>
                        </p>

                        <h3 class="border-bottom">手動削除</h3>
                        <p>
                            <button class="btn btn-primary">最近の20件を削除</button>
                            で20件分削除。
                            {{ config('hatena.delete_days') }}日以内のブックマークは除くので毎日のブックマークが多すぎる場合は削除されない。そういう人は使わない想定。
                        </p>
                        <p>
                            <button class="btn btn-outline-dark btn-sm">個別削除</button>
                            なら関係なく即削除。ブクマ整理にちょうどいい。
                        </p>

                        <h3 class="border-bottom">自動削除</h3>
                        <p>
                            受付終了。
                        </p>

                        <h3 class="border-bottom">通知</h3>
                        <p>削除されたURLは通知に一時的に残る。これも{{ config('hatena.delete_days') }}日後には削除される。</p>

                        <h3 class="border-bottom">連携解除</h3>
                        <p><a href="https://www.hatena.ne.jp/my/config/auth/provider"
                              target="_blank"
                              rel="noreferrer noopener">はてな側の設定画面</a>で解除。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
