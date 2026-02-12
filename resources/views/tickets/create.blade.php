@extends('layouts.app')

@section('title', 'Buat Tiket Baru')

@section('content')
<div class="container-fluid px-md-5">
    <div class="row g-0 shadow-lg rounded-4 overflow-hidden border bg-white" style="min-height: 80vh;">
        
        <div class="col-md-5 bg-light p-5 d-flex flex-column justify-content-center border-end">
            <div class="mb-4">
                <a href="{{ route('tickets.index') }}" class="btn btn-white shadow-sm rounded-pill px-4 mb-4 text-dark border">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                <h1 class="fw-bold display-6 mb-3">Sampaikan <span class="text-primary" style="color: var(--primary-soft) !important;">Kendala</span> Anda</h1>
                <p class="text-muted lead">Tim support kami siap membantu menyelesaikan masalah Anda secepat mungkin.</p>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3 text-uppercase small text-muted letter-spacing-1">Petunjuk Pengisian:</h6>
                <div class="d-flex mb-3">
                    <div class="me-3"><i class="bi bi-1-circle-fill text-primary" style="color: var(--primary-soft) !important;"></i></div>
                    <p class="small mb-0 text-muted">Gunakan judul yang spesifik agar tim kami cepat memahami masalah.</p>
                </div>
                <div class="d-flex mb-3">
                    <div class="me-3"><i class="bi bi-2-circle-fill text-primary" style="color: var(--primary-soft) !important;"></i></div>
                    <p class="small mb-0 text-muted">Pilih prioritas yang sesuai dengan tingkat urgensi masalah Anda.</p>
                </div>
                <div class="d-flex">
                    <div class="me-3"><i class="bi bi-3-circle-fill text-primary" style="color: var(--primary-soft) !important;"></i></div>
                    <p class="small mb-0 text-muted">Lampirkan detail atau pesan error untuk mempercepat investigasi.</p>
                </div>
            </div>
        </div>

        <div class="col-md-7 p-5 bg-white d-flex align-items-center">
            <form action="{{ route('tickets.store') }}" method="POST" class="w-100">
                @csrf
                <div class="row g-4">
                    <div class="col-12">
                        <label for="title" class="form-label fw-bold small text-muted">JUDUL TIKET</label>
                        <input type="text" name="title" id="title" class="form-control form-control-lg border-0 bg-light px-4 py-3" 
                               value="{{ old('title') }}" placeholder="Apa kendala Anda?" required>
                        @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="priority" class="form-label fw-bold small text-muted">TINGKAT PRIORITAS</label>
                        <div class="d-flex gap-2">
                            <input type="radio" class="btn-check" name="priority" id="low" value="low" required>
                            <label class="btn btn-outline-light border text-muted flex-grow-1 py-3 rounded-3" for="low">Low</label>

                            <input type="radio" class="btn-check" name="priority" id="medium" value="medium" checked>
                            <label class="btn btn-outline-light border text-muted flex-grow-1 py-3 rounded-3" for="medium">Medium</label>

                            <input type="radio" class="btn-check" name="priority" id="high" value="high">
                            <label class="btn btn-outline-light border text-muted flex-grow-1 py-3 rounded-3" for="high">High</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-bold small text-muted">DESKRIPSI MASALAH</label>
                        <textarea name="description" id="description" class="form-control border-0 bg-light px-4 py-3" 
                                  rows="4" placeholder="Ceritakan detail masalahnya di sini..." required>{{ old('description') }}</textarea>
                        @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mt-4 text-end">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3 shadow-lg border-0 w-100 w-md-auto">
                            Kirim Tiket Sekarang <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @media (min-width: 992px) {
        body {
            overflow: hidden;
            height: 100vh;
        }
        main.container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: calc(100vh - 160px); /* Menyesuaikan navbar & footer */
        }
    }

    .form-control:focus {
        background-color: #f1f3f5 !important;
        box-shadow: none;
        border: 1px solid var(--primary-soft) !important;
    }

    .btn-check:checked + .btn-outline-light {
        background-color: var(--primary-soft) !important;
        color: white !important;
        border-color: var(--primary-soft) !important;
    }

    .letter-spacing-1 { letter-spacing: 1px; }
</style>
@endsection