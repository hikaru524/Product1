@extends('layouts.app')

@section('content')
        <div id="addpage">
        {{ $products->links('vendor.pagination.bootstrap-4') }}
        </div>
@endsection
