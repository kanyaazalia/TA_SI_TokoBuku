<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <style>
        
    </style>
</head>

@extends('layouts.main')

@section('style')
    <style>
        .wrapper{ 
            width: 360px; 
            padding: 20px; 
            margin: 0;
            position: absolute;
            border-radius: 30px;
            background: white;
            border-style: solid;
            border-color:black;
            color: black;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
    </style>
@endsection

@section('container')
    {{-- Form untuk login --}}
    <main class="wrapper">
        <div class="text-center wrapper">
            <h2 class="mb-3 fw-bold">Login</h2>
            <p>Masukkan username dan password untuk login.</p>

            {{-- Jika login gagal maka akan ditampilkan pesan username atau password salah  --}}
            @if (session()->has('gagalLogin'))
                <div class="alert alert-danger">
                    {{ session('gagalLogin') }}
                </div>
            @endif 

            <form action="/login" method="post">
                {{-- Agar terhindar dari Cross Site Scripting --}}
                @csrf

                {{-- memasukkan username, bila gagal validasi maka akan ditampilkan kesalahannya --}}
                <div class="form-group mb-2">
                    <label for="username">Username:</label><br>
                    <input class="col-lg-10" type="text" name="username" id="username" placeholder="Username" value="{{ old('username') }}" autofocus required>
                </div>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="password">Password:</label><br>
                    <input class="col-lg-10" type="password" name="password" id="password" placeholder="Password" required>
                </div>
                
                {{-- Button untuk login --}}
                <div class="form-group">
                    <button class="btn btn-primary mt-3" type="submit">Login</button>
                    {{-- <input type="submit" name="login" id="login" value="LOGIN"> --}}
                </div>
            </form>
        </div>
    </main>
@endsection