@extends('layouts.default')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col col1">
                <img src="{{ asset('images/logo.png') }}" class="imgcon img-fluid" alt="Logo" />
            </div>
            <div class="col col2 d-flex ">
                <div class="login--form">
                    <form action="{{ route('login.post') }}" method="POST" autocomplete="off">
                        @csrf
                        <h3>Login an Account</h3>
                        <div class="input--form">
                            <img src="{{ asset('images/user.png') }}" alt="" />
                            <input class="" type="email"
                                placeholder="{{ $errors->has('email') ? $errors->first('email') : 'Email' }}"
                                name="email">
                        </div>
                        <div class="input--form">
                            <img src="{{ asset('images/lock.png') }}" alt="" />
                            <input type="password"
                                placeholder="{{ $errors->has('password') ? $errors->first('password') : 'Password' }}"
                                name="password">
                        </div>
                        <button class="btn--form" type="submit">
                            <h4>Login</h4>
                        </button>
                    </form>
                    <a href="{{ route('register') }}" class="reg pb-2">Register an Account</a>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <p><strong>Opps Something went wrong</strong></p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
@endsection

<style>
    .reg {
        color: #F8F1F1;
        font-size: 18px;
    }

    .col1 {
        height: 100vh;
        display: flex;
        background: #F8F1F1;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    .col2 {
        height: 100vh;
        background: #4A8AEA;
        justify-content: center;
        align-content: center;
        align-items: center;
    }

    .imgcon {
        height: 500px;
        width: 500px;
    }

    .login--form {
        width: 60%;
        display: flex;
        flex-direction: column;
        text-align: center;
        color: white;
    }

    .login--form h3 {
        background-color: #2F4AD7;
        padding: 20px;
        margin: 0;
    }

    .login--form button {
        margin-top: 10%;
        padding: 20px 187px;
        border: none;
        outline: none;
        background-color: #202D6E;
        color: white;
        font-weight: 700;
    }

    .input--form {
        display: flex;
        flex-direction: row;
        background-color: #f0f0f0;
        padding: 20px;
        border-bottom: #9e9e9e solid 1px;
    }

    .input--form img {
        width: 10%;
        cursor: pointer;
        width: 8%;
        object-fit: contain;
    }

    .input--form input {
        width: 100%;
        border: none;
        background-color: #f0f0f0;
        outline: none;
        padding: 0 10px;
        font-size: large;
    }
</style>
