@extends('layouts.default_auth')
@section('title', "Login")
@section('content')
<div class="container mt-5">
    <div class="row justify-content-end"> <!-- Ubah justify-content-center menjadi justify-content-end -->
        <div class="col-md-6"> <!-- Responsif kolom -->
            <div class="card">
                <div class="card-header text-center">Login</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Email:</label>
                            <input type="text" placeholder="email@gmail.com" 
                                   id="email" class="form-control" name="email"
                                   required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">
                                    {{$errors->first('email')}}
                                </span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password"
                                   placeholder="****" name="password" required>
                            @if ($errors->has('password'))
                                <span class="text-danger">
                                    {{$errors->first('password')}}
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
