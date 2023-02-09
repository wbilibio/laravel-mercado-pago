@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container">
        <main>
            <div class="py-5 text-center justify-content-center align-content-center d-flex flex-wrap">
                <a href="https://www.perfectpay.com.br" class="logo d-block w-100">
                    <img class="d-block mx-auto mb-5" src="{{ asset('images/logo-original.png') }}" alt="">
                </a>
                <h2>Parabéns! Sua compra foi realizada com sucesso.</h2>
            </div>
        </main>


    </div>
@endsection

@push('scripts')
@endpush
