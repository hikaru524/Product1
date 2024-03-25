@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品新規登録</div>

                <div class="card-body">
                    <form action="{{ route('create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">商品名</label>
                            <input type="text" class="form-control" name="product_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">価格</label>
                            <input type="number" class="form-control" name="price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">在庫</label>
                            <input type="number" class="form-control" name="stock">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">会社名</label>
                            <select class="form-select" name="company_id">
                                @foreach($companies as $value)
                                <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">コメント</label>
                            <input type="text" class="form-control" name="comment">
                        </div>

                        <button type="submit" class="btn btn-primary">登録</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
