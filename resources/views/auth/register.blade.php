@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">   
        
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                <div class="row login-top top">ユーザー新規登録画面</div>
                @csrf

                <div class="row login-in">
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="パスワード">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row login-in">
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"placeholder="アドレス">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="login-btn">
                        <button type="submit" class="btn btn-warning btn2 rounded-pill">
                            新規登録
                        </button>
                        <a class="btn btn-info btn2 rounded-pill" href="{{ route('login') }}">
                            戻る
                        </a>
                    </div>
                </div>
            </form>
        </div>
            
        
    </div>
</div>
@endsection
