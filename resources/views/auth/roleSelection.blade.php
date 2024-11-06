@extends('layouts.default_auth')
@section('title', "Login")
@section('content')
<div class="container mt-5">
    <div class="row justify-content-end">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">Pilih Role Dosen</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('handleRoleSelection') }}">
                        @csrf
                        <div>
                            <label>
                                <input type="radio" name="role" value="dekan" required>
                                Dekan
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="radio" name="role" value="kaprodi" required>
                                Kaprodi
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="radio" name="role" value="dosen_wali" required>
                                Dosen Wali
                            </label>
                        </div>
                        <button class='btn-primary text-white' type="submit">Pilih Role</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
