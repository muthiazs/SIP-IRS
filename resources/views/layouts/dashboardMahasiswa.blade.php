@extends('layouts.sideBar')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>Selamat Datang Draco 👋</h2>
            <p>Semester Akademik Sekarang 2024/2025 Ganjil</p>
        </div>
    </div>

    <!-- IRS Period Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Periode Pengisian IRS</h5>
                    <p class="card-text">19 Jan - 30 Mar</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="info-card">
                <h5>Semester Studi</h5>
                <h2>5</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-card">
                <h5>IPK</h5>
                <h2>3.6/4.0</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-card">
                <h5>SKSk</h5>
                <h2>86</h2>
            </div>
        </div>
    </div>

    <!-- Additional Cards -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="info-card">
                <h5>Kalender Akademik</h5>
                <i class="fas fa-calendar fa-3x mb-3 text-info"></i>
                <!-- Add calendar content here -->
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="info-card">
                <h5>Status IRS</h5>
                <p>Anda Belum mengisi IRS</p>
                <button class="btn btn-danger">Isi IRS</button>
            </div>
        </div>
    </div>

    <!-- Registration Section -->
    <div class="row">
        <div class="col-12">
            <div class="info-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Registrasi</h5>
                        <p class="mb-0">Harap melakukan registrasi sebelum 20 Januari 2024</p>
                    </div>
                    <div>
                        <span class="text-danger me-2">
                            <i class="fas fa-times-circle"></i> Belum Registrasi
                        </span>
                        <button class="btn btn-danger">Registrasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection