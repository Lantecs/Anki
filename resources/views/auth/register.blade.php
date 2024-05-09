@extends('layouts.default')
@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col col1">
                <img src="{{ asset('images/logo.png') }}" class="imgcon img-fluid" alt="Logo" />
            </div>
            <div class="col col2 ">
                <div class="login--form">
                    <form action="{{ route('register.post') }}" id="registrationForm" method="post" autocomplete="off">
                        @csrf
                        <h3>Register an Account</h3>
                        <div class="input--form">
                            <input type="email"
                                placeholder="{{ $errors->has('email') ? $errors->first('email') : 'Email' }}" name="email"
                                value="@if (!$errors->first('email')) {{ old('email') }} @endif">
                        </div>
                        <div class="input--form">
                            <input type="text"
                                placeholder="{{ $errors->has('first_name') ? $errors->first('first_name') : 'First Name' }}"
                                name="first_name">
                        </div>
                        <div class="input--form">
                            <input type="text"
                                placeholder="{{ $errors->has('last_name') ? $errors->first('last_name') : 'Last Name' }}"
                                name="last_name">
                        </div>
                        <div class="input--form">
                            <input type="password"
                                placeholder="{{ $errors->has('password') ? $errors->first('password') : 'Password' }}"
                                name="password">
                        </div>
                        <div class="input--form">
                            <input type="password"
                                placeholder="{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : 'Repeat Password' }}"
                                name="password_confirmation">
                        </div>
                        <button class="btn--form" type="submit">
                            <h4>Register</h4>
                        </button>
                    </form>
                    <a href="{{ route('login') }}" class="reg pb-2">Already got an Account?</a>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
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
        display: flex;
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
        padding: 20px 175px;
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

    .sidebar li:hover {
        background: linear-gradient(to right, rgb(140, 239, 132), rgb(207, 236, 205), #fff2d3);
        border: 1px solid #FEE19D;
    }

    .sidebar li.active {
        background: linear-gradient(to right, rgb(140, 239, 132), rgb(207, 236, 205), #fff2d3);
        border: 1px solid #FEE19D;
    }

    .sidebar li a {
        color: #000;
    }

    .sidebar li a:hover {
        text-decoration: none;
    }
</style>

<script>
    $(document).ready(function() {
        // Show modal if there are validation errors
        @if (session('showModal'))
            $('.error-modal').modal('show');
        @endif


    });
</script>
