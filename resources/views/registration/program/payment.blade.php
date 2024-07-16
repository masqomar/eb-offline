@extends('layouts.register')

@section('content')
<section class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Detail Pendaftaran</h3>
                    <h6 class="text-center"><small>#{{ $transaction->code }}</small></h6>
                    <hr>
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <th>{{ $transaction->user->name }}</th>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <th>{{ $transaction->user->email }}</th>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <th>{{ $transaction->user->student->gender }}</th>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td>:</td>
                            <th>{{ $transaction->user->student->phone_number }}</th>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <th>{{ $transaction->user->student->address }}</th>
                        </tr>
                    </table>
                    <hr class="my-4">
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Program</p>
                        <p class="mb-2">{{ $transaction->program->name }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Periode</p>
                        <p class="mb-2">{{ $transaction->program_date }}</p>
                    </div>

                    <div class="d-flex justify-content-between text-black">
                        <p class="mb-2">Biaya Program</p>
                        <p class="mb-2">Rp. {{ number_format($transaction->total_purchases) }}</p>
                    </div>
                    
                    <hr class="mb-4">
                    <div class="d-flex justify-content-between">
                        <p class="text-black"><strong>Diskon</strong></p>
                        @if ($transaction->discount !== NULL)
                        <p class="text-danger"><strong>Rp. {{ number_format($transaction->discount) }}</strong></p>
                        @else
                        <p class="text-black"><strong>Rp. 0</strong></p>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-black"><strong>Biaya Admin</strong></p>
                        <p class="text-black"><strong>Rp. 179.000</strong></p>
                    </div>
                    <div class="d-flex justify-content-between text-black mb-4">
                        <p class="mb-2"><strong>Total Pembayaran</strong></p>
                        <p class="mb-2"><strong>Rp. {{ number_format($transaction->total_purchases - $transaction->discount + 179000) }}</strong></p>
                    </div>
                    @if ($transaction->transaction_status == 'paid')
                    <button type="button" class="btn btn-success mb-3">Tagihan sudah dibayar</button>
                    @elseif ($transaction->transaction_status == 'done')
                    <button type="button" class="btn btn-secondary mb-3">Pembayaran Terverifikasi</button>
                    @elseif ($transaction->transaction_status == 'failed')
                    <button type="button" class="btn btn-danger mb-3">Tagihan gagal dibayar</button>
                    @else                   
                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-3" id="pay-button">
                        <span>Bayar Sekarang</span>
                    </button>
                    @endif
                    <p class="bg-danger text-white"><small><sup>* Pembayaran maksimal pada tanggal {{ $transaction->maximum_payment_time }}</sup></small></p>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection

