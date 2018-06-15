@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h1>設定</h1>

                <div class="alert alert-primary" role="alert">
                    {{ session('success') ?? 'pixivFANBOXの特典キーを入力すると自動削除が有効になります' }}
                </div>

                <div class="card">
                    <div class="card-body">
                        {{ $form->render('bootstrap4horizon') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
