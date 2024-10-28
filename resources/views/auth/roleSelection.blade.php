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
                    
                    <form action="{{ route('handleRoleSelection') }}" method="POST">
                        @csrf
                        <div>
                            <input type="radio" id="Doswal" name="roles2" value="Dosen Wali" />
                            <label for="Doswal">Dosen Wali</label>
                        </div>
                        <div>
                            <input type="radio" id="Kaprodi" name="roles2" value="Kepala Prodi" />
                            <label for="Kaprodi">Kepala Prodi</label>
                        </div>
                        <div>
                            <input type="radio" id="Dekan" name="roles2" value="Dekan" />
                            <label for="Dekan">Dekan</label>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
