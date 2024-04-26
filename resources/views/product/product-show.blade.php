@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">商品詳細</div>
            
            <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID  {{ $products->id }}</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">商品画像  {{ $products->img_path }}</label>
                        </div>  
                        <div class="form-group">
                            <label for="exampleInputEmail1">商品名  {{ $products->product_name }}</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">価格  {{ $products->price }}</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">在庫  {{ $products->stock }}</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">会社名  {{ $products->company_name }}</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">コメント  {{ $products->comment }}</label>
                        </div>
                        <a href="{{ route('list') }}" class="btn btn-primary">戻る</a>
                        <a href="{{ route('product.edit',['id'=>$products->id]) }}" class="btn btn-primary">編集</a>
                     </div>
            </div>
        </div>
    </div>
</div>
@endsection
