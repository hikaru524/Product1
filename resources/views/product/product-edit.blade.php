@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品編集</div>
                
                <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">商品名</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">価格</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">在庫</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">会社名</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">コメント</label>
                        </div>
                        <a href="{{ route('product.show') }}" class="btn btn-primary">戻る</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
