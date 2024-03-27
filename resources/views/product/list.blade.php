@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品一覧画面</div>

                <div class="card-body">
                    <table>
                        <tr>
                        <th>id</th>
                        <th>名前</th>
                        <th>価格</th>
                        <th>在庫</th>
                        <th>会社名</th>
                    </tr>
                    @foreach($products as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->product_name }}</td>
                        <td>{{ $value->price }}</td>
                        <td>{{ $value->stock }}</td>
                        <td>{{ $value->company_name }}</td>
                        <td>
                            <a href="{{ route('product.show') }}" class="btn btn-primary">詳細</a>
                            <button type="submit" class="btn btn-primary">削除</button>
                        </td>
                    </tr>
                    @endforeach
                    <a href="{{ route('create.show') }}" class="btn btn-primary">新規登録</a>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
