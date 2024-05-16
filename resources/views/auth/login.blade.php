@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                <div class="row top login-top">ユーザーログイン画面</div>
                @csrf
                
                <div class="row login-in ">
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="パスワード">
                        
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                

                <div class="row login-in">
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="アドレス">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="login-btn">
                        <a class="btn btn-warning btn2 rounded-pill" href="{{ route('register') }}">
                            新規登録
                        </a>
                        <button type="submit" class="btn btn-info btn2 rounded-pill">
                            ログイン
                        </button>                                                                    
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
