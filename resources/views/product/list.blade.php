@extends('layouts.app')

@section('content')
<!--<script src="https://cdn.tailwindcss.com"></script>-->

<div class="container-row">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="get-page" class="card-header top" data-name="1" data-sort="" data-parm="">商品一覧画面</div>
                <form class="search-form" action="{{ route('search') }}" method="GET">
                    <!--検索ーワード-->
                        <div class="search">
                        <div class="col">
                            <input type="text" id="keyword" class="form-control" placeholder="検索キーワード" name="keyword">
                        </div>
                    <!--検索ー会社-->
                        <div class="col">
                            <select id="company_id" class="form-select" name="company_id">
                                <option value="">--未選択--</option>
                                @foreach($companies as $value)
                                    <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                    <!--検索ー価格-->
                    <div class="search">
                        <div class="col price_stock">
                            <label class="stock_peice_label" for="exampleInputEmail1">価格</label>
                            <input type="text" id="price_min" class="form-control" placeholder="下限" name="price_min">
                            <label class="stock_peice_label" for="exampleInputEmail1">～</label>
                            <input type="text" id="price_max" class="form-control" placeholder="上限" name="price_max">
                        </div>
                    <!--検索ー在庫数-->    
                        <div class="col price_stock">
                            <label class="stock_peice_label" for="exampleInputEmail1">在庫数</label>
                            <input type="text" id="stock_min" class="form-control" placeholder="下限" name="price_min">
                            <label class="stock_peice_label" for="exampleInputEmail1">～</label>
                            <input type="text" id="stock_max" class="form-control" placeholder="上限" name="price_max">
                        </div>
                        </div>
                    <!--ソート プルダウン-->
                    <div class="option">
                        <!--検索ーボタン-->
                        <div class="col col1">
                            <button type="submit" id="btn-search" class="btn btn-outline-secondary">検索</button>
                            <a id="btn-clear" class="btn btn-outline-secondary">クリア</a>
                        </div>
                    </div>
                </form>

                <!--テーブル一覧-->
                <div class="card border border-2 border-subtle">
                    <div class="car-body">
                    <table class="table table-striped">
                        <thead class="table-light">
                        <tr>
                            <th><a id="sort_trg" class="fa fa-sort" data-name="id" href="">ID</a></th>
                            <th>商品画像</th>
                            <th><a id="sort_trg" class="fa fa-sort" data-name="product_name"  href="">名前</a></th>
                            <th><a id="sort_trg" class="fa fa-sort" data-name="price"  href="">価格</a></th>
                            <th><a id="sort_trg" class="fa fa-sort" data-name="stock"  href="">在庫</a></th>
                            <th ><a id="sort_trg" class="fa fa-sort" data-name="company_name"  href="">会社名</a></th>
                            <th><a href="{{ route('create.show') }}" class="btn btn-warning">新規登録</a></th>
                        </tr>
                        </thead>
                        <tbody id="addlist">
                        @foreach($products as $value)
                        <tr  id="{{ $value->id }}">
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
                                    <input data-user_id="{{$value->id}}" type="submit" class="btn btn-danger btn-del" value="削除">
                                </form>
                            </td>       
                        </tr>
                        @endforeach
                        </tbody>
                    </table> 
                </div>
        </div>
        <div id="addpage">
            {{ $products->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
