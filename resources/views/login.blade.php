@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    body,
    html {
        height: 100%;
        margin: 0;
        padding: 0;
        background: #23243a;
    }

    .login-bg-bokeh {
        min-height: 100vh;
        width: 100vw;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 0;
        background: radial-gradient(circle at 20% 20%, #a259ff33 0, #23243a 40%),
            radial-gradient(circle at 80% 80%, #e040fb33 0, #23243a 40%),
            radial-gradient(circle at 80% 20%, #7f7fd533 0, #23243a 40%),
            #23243a;
        overflow: hidden;
    }

    .login-center {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
    }

    .login-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(30, 36, 49, 0.13);
        padding: 2.5rem 2.5rem 2rem 2.5rem;
        max-width: 370px;
        width: 100%;
        text-align: center;
        position: relative;
    }

    .login-title {
        font-size: 2rem;
        font-weight: 700;
        color: #23243a;
        margin-bottom: 1.5rem;
    }

    .login-form-label {
        font-weight: 500;
        color: #23243a;
        margin-bottom: 0.3rem;
        font-size: 1rem;
    }

    .login-input {
        width: 100%;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        padding: 0.5rem 1rem;
        margin-bottom: 1.1rem;
        font-size: 1rem;
        background: #fafafa;
        transition: border 0.2s;
    }

    .login-input:focus {
        border: 1.5px solid #a259ff;
        outline: none;
        background: #fff;
    }

    .login-btn {
        width: 100%;
        background: #d1cfd0;
        color: #23243a;
        border: none;
        border-radius: 12px;
        padding: 0.7rem 0;
        font-size: 1.1rem;
        font-weight: 600;
        margin-top: 0.2rem;
        margin-bottom: 0.5rem;
        transition: background 0.2s;
    }

    .login-btn:hover {
        background: #a259ff;
        color: #fff;
    }

    .login-link {
        font-size: 0.95rem;
        color: #23243a;
        text-decoration: none;
        display: block;
        position: static;
        margin: 0 auto;
        text-align: center;
        margin-top: 0.5rem;
    }

    .login-link:hover {
        color: #a259ff;
        text-decoration: underline;
    }

    <blade media|%20(max-width%3A%20600px)%20%7B%0D>.login-card {
        padding: 1.2rem 0.5rem 1.2rem 0.5rem;
    }

    .login-title {
        font-size: 1.3rem;
    }

    .login-link {
        right: 1rem;
    }
    }

</style>
<div class="login-bg-bokeh"></div>
<div class="login-center">
    <div class="login-card">
        <div class="login-title">Log in</div>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-2 text-start">
                <label class="login-form-label">Email atau no Hp</label>
                <input type="text" name="username" class="login-input" required autofocus>
            </div>
            <div class="mb-2 text-start">
                <label class="login-form-label">Password</label>
                <input type="password" name="password" class="login-input" required>
            </div>
            <button type="submit" class="login-btn">Log in</button>
            <a href="#" class="login-link">Lupa Password</a>
        </form>
    </div>
</div>
@endsection
