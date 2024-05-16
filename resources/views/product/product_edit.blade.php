@extends('layouts.app')

@section('content')
<div class="container-row">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header top">商品編集</div>
                <div class="card">
                        <form action="{{ route('product.update',['id'=>$products->id]) }}" method="POST">
                            @method('PUT')
                            {{ csrf_field() }}
                            <div class="card-body">
                                    <div class="form-gr">
                                        <label for="exampleInputEmail1">ID:{{ $products->id }}</label>
                                    </div>
                                    <div class="form-gr">
                                        <label for="exampleInputEmail1">商品名:{{ $products->product_name }}</label>
                                        <input type="text" class="form-con" name="product_name">
                                    </div>
                                    <div class="form-gr">
                                        <label for="exampleInputPassword1">価格:{{ $products->price }}</label>
                                        <input type="number" class="form-con" name="price">
                                    </div>
                                    <div class="form-gr">
                                        <label for="exampleInputPassword1">在庫:{{ $products->stock }}</label>
                                        <input type="number" class="form-con" name="stock">
                                    </div>
                                    <div class="form-gr">
                                        <label for="exampleInputPassword1">会社名:{{ $products->company_name }}</label>
                                        <select class="form-con" name="company_id">
                                            <option value="">--未選択--</option>
                                        @foreach($companies as $value)
                                            <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-gr">
                                        <label for="exampleInputPassword1">コメント{{ $products->comment }}</label>
                                        <input type="text" class="form-con" name="comment">
                                    </div>
                                    <div class="btn-position">
                                        <button type="submit" class="btn btn-warning btn1">登録</button>
                                        <a href="{{ route('product.show',['id'=>$products->id]) }}" class="btn btn-info btn1">戻る</a>
                                    </div>
                            </div>
                        </form>
                </div>
        </div>
    </div>
</div>
@endsection
