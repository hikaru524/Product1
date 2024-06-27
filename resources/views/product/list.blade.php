@extends('layouts.app')

@section('content')
<!--<script src="https://cdn.tailwindcss.com"></script>-->

<div class="container-row">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header top">商品一覧画面</div>
            
                    <!--<div class="row">-->
                        <form class="search-form" action="{{ route('search') }}" method="GET">
                            <div class="col">
                                <input type="text" id="keyword" class="form-control" placeholder="検索キーワード" name="keyword">
                            </div>
                            <div class="col">
                                <select id="company_id" class="form-select" name="company_id">
                                    <option value="">--未選択--</option>
                                    @foreach($companies as $value)
                                        <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" id="btn" class="btn btn-outline-secondary">検索</button>
                            </div>
                        </form>
                    <!--</div>-->

                    <div class="card border border-2 border-subtle">
                        <div class="car-body">
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
                            <tbody id="addArea">
                            @foreach($products as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td><img src="{{ asset($value->img_path) }}" class="img_list"></td>
                                <td>{{ $value->product_name }}</td>
                                <td>¥{{ $value->price }}</td>
                                <td>{{ $value->stock }}</td>
                                <td>{{ $value->company_name }}</td>

                                    <td class="btn-show-del">
                                        <a href="{{ route('product.show', ['id'=>$value->id] ) }}" class="btn btn-info">詳細</a>
                                        <form action="{{ route('product.delete', ['id'=>$value->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">削除</button>
                                        </form>
                                    </td>
                                
                            </tr>
                            @endforeach
                            </tbody>
                        </table> 
                    </div>
        </div>
         {{ $products->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
