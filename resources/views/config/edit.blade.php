@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h1>設定</h1>

                <div class="alert alert-primary" role="alert">
                    {{ session('success') ?? '特典キーを入力すると自動削除が有効になります' }}
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('config.update') }}" method="POST">
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    @csrf
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"
                                       for="key">
                                    特典キー
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" name="key" id="key" class="form-control"
                                           value="{{ auth()->user()->key ?? '' }}">
                                    <small class="form-text text-muted">特典キーの受付は終了しました。</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
