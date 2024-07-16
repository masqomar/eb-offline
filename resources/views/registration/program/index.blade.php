@extends('layouts.register')
@section('content')

<!-- Registration 7 - Bootstrap Brain Component -->
<section class="bg-light p-3 p-md-4 p-xl-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                <div class="card border border-light-subtle rounded-4">
                    <div class="card-body p-3 p-md-4 p-xl-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <div class="text-center mb-4">
                                        <a href="#!">
                                            <img src="./assets/img/bsb-logo.svg" alt="BootstrapBrain Logo" width="175" height="57">
                                        </a>
                                    </div>
                                    <h2 class="h4 text-center">Registration</h2>
                                    <h3 class="fs-6 fw-normal text-secondary text-center m-0">Enter your details to register</h3>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('registration.program.prosesDaftar') }}" method="POST">
                        @csrf

                            <div class="row gy-3 overflow-hidden">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap" required>
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                                        <label for="email" class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="No HP" required>
                                        <label for="phone_number" class="form-label">Nomor WA Aktif</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="">-</option>
                                            <option value="M">Laki-laki</option>
                                            <option value="F">Perempuan</option>
                                        </select>
                                        <label for="gender" class="form-label">Jenis Kelamin</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control form-control-lg" name="address" value="{{ old('address') }}" required></textarea>
                                        <label for="address" class="form-label">Alamat</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="hidden" class="form-control" name="program_id" id="program_id" value="{{ $program->id }}" required readonly>
                                        <input type="text" class="form-control" id="program_name" value="{{ $program->name }}" required readonly>
                                        <label for="program_name" class="form-label">Program</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="program_price" value="Rp. {{ number_format($program->price) }}" required readonly>
                                        <label for="program_price" class="form-label">Biaya Program</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="hidden" class="form-control" name="period_id" id="period_id" value="{{ $program->period->id }}" required readonly>
                                        <input type="text" class="form-control" id="period_name" value="{{ $program->period->period_date }}" required readonly>
                                        <label for="period_name" class="form-label">Periode</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control form-control-lg" name="note" value="{{ old('note') }}"></textarea>
                                        <label for="note" class="form-label">Catatan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                                        <label class="form-check-label text-secondary" for="iAgree">
                                            Pastikan <a href="#!" class="link-primary text-decoration-none">data yang kamu masukkan sudah benar!</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary" type="submit">Proses Pendaftaran</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection