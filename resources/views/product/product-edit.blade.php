@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品編集</div>
                    <form action="{{ route('product.update',['id'=>$products->id]) }}" method="POST">
                        @method('PUT')
                        {{ csrf_field() }}
                        <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ID:{{ $products->id }}</label>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">商品名:{{ $products->product_name }}</label>
                                    <input type="text" class="form-control" name="product_name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">価格:{{ $products->price }}</label>
                                    <input type="number" class="form-control" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">在庫:{{ $products->stock }}</label>
                                    <input type="number" class="form-control" name="stock">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">会社名:{{ $products->company_name }}</label>
                                    <select class="form-select" name="company_id">
                                        <option value="">--未選択--</option>
                                    @foreach($companies as $value)
                                        <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">コメント{{ $products->comment }}</label>
                                    <input type="text" class="form-control" name="comment">
                                </div>
                                <a href="{{ route('product.show',['id'=>$products->id]) }}" class="btn btn-primary">戻る</a>
                                <button type="submit" class="btn btn-primary">登録</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
