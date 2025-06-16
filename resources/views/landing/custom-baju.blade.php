@extends('layouts.layouts-landing')

@section('title', 'Custom Baju')
@section('custom-baju', 'active')

@section('content')
    <div class="pt-16 bg-gray-100">
        <iframe src="{{ route('custom-baju.content') }}" style="width: 100%; height: 110vh; border: none;"
            title="Kustomisasi Desain Baju" id="custom-baju-iframe">
        </iframe>
    </div>
@endsection

@push('scripts')
    {{-- Skrip untuk mengintegrasikan iframe dengan keranjang belanja utama (jika diperlukan nanti) --}}
    <script>
        // Anda bisa menambahkan komunikasi antara halaman utama dan iframe di sini di masa depan.
        // Contoh: window.addEventListener('message', (event) => { ... });
    </script>
@endpush
