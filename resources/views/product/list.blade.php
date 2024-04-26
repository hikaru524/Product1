@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">商品一覧画面</div>
            
            <div class="row">
                <form action="{{ route('search') }}" method="GET">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="検索キーワード" name="keyword">
                    </div>
                    <div class="col">
                        <select class="form-select" name="company_id">
                            <option value="">--未選択--</option>
                            @foreach($companies as $value)
                            <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-warning">検索</button>
                    </div>
                </form>
            </div>

                <div class="card">
                    <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-light">
                        <tr>
                            <th>id</th>
                            <th>商品画像</th>
                            <th>名前</th>
                            <th>価格</th>
                            <th>在庫</th>
                            <th>会社名</th>
                            <th><a href="{{ route('create.show') }}" class="btn btn-warning">新規登録</a></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->img_path }}</td>
                            <td>{{ $value->product_name }}</td>
                            <td>{{ $value->price }}</td>
                            <td>{{ $value->stock }}</td>
                            <td>{{ $value->company_name }}</td>
                            <td>
                                <a href="{{ route('product.show', ['id'=>$value->id] ) }}" class="btn btn-primary">詳細</a>
                            </td>
                            <td>
                                <form action="{{ route('product.delete', ['id'=>$value->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">削除</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                {{ $products->links('vendor.pagination.bootstrap-4') }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
