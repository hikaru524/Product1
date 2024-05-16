@extends('layouts.app')

@section('content')
<div class="container-row">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header top">商品新規登録</div>
            
            <div class="card border border-2 border-subtle">
                <div class="card-body">
                    <form action="{{ route('create') }}" method="POST">
                        @csrf
                        <div class="form-gr">
                            <label for="exampleInputEmail1">商品名<span>*</span></label>
                            <input type="text" class="form-con" name="product_name">
                        </div>
                        <div class="form-gr">
                            <label for="exampleInputPassword1">価格<span>*</span></label>
                            <input type="number" class="form-con" name="price">
                        </div>
                        <div class="form-gr">
                            <label for="exampleInputPassword1">在庫<span>*</span></label>
                            <input type="number" class="form-con" name="stock">
                        </div>
                        <div class="form-gr">
                            <label for="exampleInputPassword1">会社名<span>*</span></label>
                            <select class="form-con" name="company_id">
                                @foreach($companies as $value)
                                <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-gr">
                            <label for="exampleInputPassword1">コメント<span>*</span></label>
                            <input type="text" class="form-con" name="comment">
                        </div>
                        <div class="form-gr">
                            <label for="exampleInputEmail1">商品画像</label>
                            <input type="file" class="form-con" name="img_path" accept="image/jpeg">
                        </div>

                        <div class="btn-position">
                            <button type="submit" class="btn btn-warning btn1">新規登録</button>
                            <a href="{{ route('list') }}" class="btn btn-info btn1">戻る</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
