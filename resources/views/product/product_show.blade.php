@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header top">商品詳細</div>
            
            <div class="card border border-2 border-subtle">
                    <div class="card-body">
                        <div class="form-gr">
                            <label for="exampleInputEmail1">ID</label>
                            <label for="exampleInputEmail1">{{ $products->id }}</label>
                        </div>
                        <div class="form-gr">
                            <label for="exampleInputEmail1">商品画像 </label>
                            <img src="{{ asset($products->img_path) }}" >
                            <!--<label for="exampleInputEmail1">{{ $products->img_path }}</label>-->
                        </div>  
                        <div class="form-gr">
                            <label for="exampleInputEmail1">商品名</label>
                            <label for="exampleInputEmail1">{{ $products->product_name }}</label>
                        </div>
                        <div class="form-gr">
                            <label for="exampleInputPassword1">価格</label>
                            <label for="exampleInputPassword1">{{ $products->price }}</label>
                        </div>
                        <div class="form-gr">
                            <label for="exampleInputPassword1">在庫</label>
                            <label for="exampleInputPassword1">{{ $products->stock }}</label>
                        </div>
                        <div class="form-gr">
                            <label for="exampleInputPassword1">会社名</label>
                            <label for="exampleInputPassword1">{{ $products->company_name }}</label>
                        </div>
                        <div class="form-gr">
                            <label for="exampleInputPassword1">コメント</label>
                            <label for="exampleInputPassword1">{{ $products->comment }}</label>
                        </div>
                        <div class="btn-position">
                            <a href="{{ route('product.edit',['id'=>$products->id]) }}" class="btn btn-warning btn1">編集</a>
                            <a href="{{ route('list') }}" class="btn btn-info btn1">戻る</a>
                        </div>
                     </div>
            </div>
        </div>
    </div>
</div>
@endsection
