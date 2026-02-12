@extends('layouts.app')

@section('title', 'Detail Tiket #' . $ticket->id)

@section('content')
<div class="container-fluid px-md-5">
    <div class="row g-0 shadow-lg rounded-4 overflow-hidden border bg-white" style="min-height: 85vh;">
        
        {{-- PANEL KIRI: METADATA & INFO --}}
        <div class="col-md-4 bg-light p-5 d-flex flex-column border-end">
            <div class="mb-4">
                <a href="{{ route('tickets.index') }}" class="btn btn-white shadow-sm rounded-pill px-4 mb-4 text-dark border bg-white">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                <div class="mb-3">
                    <span class="text-muted small fw-bold letter-spacing-1 d-block mb-1">TIKET #{{ $ticket->id }}</span>
                    <h1 class="fw-bold h3 mb-3">{{ $ticket->title }}</h1>
                </div>
            </div>

            <div class="flex-grow-1">
                <div class="mb-4 p-4 rounded-4 bg-white shadow-sm border">
                    <label class="small fw-bold text-muted d-block mb-2 uppercase letter-spacing-1">STATUS & PRIORITAS</label>
                    <div class="d-flex gap-2">
                        <span class="badge {{ $ticket->status_badge }} px-3 py-2 rounded-pill text-capitalize">
                            {{ str_replace('_', ' ', $ticket->status) }}
                        </span>
                        <span class="badge {{ $ticket->priority_badge }} px-3 py-2 rounded-pill text-capitalize">
                            {{ $ticket->priority }} Priority
                        </span>
                    </div>
                </div>

                <div class="mb-4 p-4 rounded-4 bg-white shadow-sm border">
                    <label class="small fw-bold text-muted d-block mb-3 uppercase letter-spacing-1">PENGIRIM</label>
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; background-color: var(--primary-soft) !important;">
                            <i class="bi bi-person-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $ticket->user->name ?? 'Unknown User' }}</h6>
                            <small class="text-muted">{{ $ticket->created_at->format('d M Y, H:i') }}</small>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-4 bg-white shadow-sm border small text-muted">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Dibuat</span>
                        <span class="text-dark">{{ $ticket->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Update Terakhir</span>
                        <span class="text-dark">{{ $ticket->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- PANEL KANAN: DESKRIPSI & AKSI --}}
        <div class="col-md-8 p-5 bg-white d-flex flex-column">
            <div class="mb-4">
                <label class="form-label fw-bold small text-muted uppercase letter-spacing-1 mb-3">DESKRIPSI MASALAH</label>
                <div class="p-4 rounded-4 bg-light border-0 text-dark overflow-auto" style="max-height: 45vh; line-height: 1.6;">
                    {!! nl2br(e($ticket->description)) !!}
                </div>
            </div>

            <div class="mt-auto pt-4 border-top">
                <label class="form-label fw-bold small text-muted uppercase letter-spacing-1 mb-3">KONTROL & AKSI CEPAT</label>
                <div class="d-flex flex-wrap gap-2">
                    
                    <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-primary px-4 py-2 rounded-3 border-0 shadow-sm">
                        <i class="bi bi-pencil-square me-2"></i>Edit Detail
                    </a>

                    @if($ticket->status !== 'in_progress')
                        <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="d-inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="title" value="{{ $ticket->title }}">
                            <input type="hidden" name="description" value="{{ $ticket->description }}">
                            <input type="hidden" name="priority" value="{{ $ticket->priority }}">
                            <input type="hidden" name="status" value="in_progress">
                            <button type="submit" class="btn btn-outline-info px-4 py-2 rounded-3 fw-bold">
                                <i class="bi bi-play-fill me-1"></i>Proses Tiket
                            </button>
                        </form>
                    @endif

                    @if($ticket->status !== 'closed')
                        <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="d-inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="title" value="{{ $ticket->title }}">
                            <input type="hidden" name="description" value="{{ $ticket->description }}">
                            <input type="hidden" name="priority" value="{{ $ticket->priority }}">
                            <input type="hidden" name="status" value="closed">
                            <button type="submit" class="btn btn-outline-success px-4 py-2 rounded-3 fw-bold">
                                <i class="bi bi-check-lg me-1"></i>Selesaikan
                            </button>
                        </form>
                    @endif

                    @if($ticket->status === 'closed')
                        <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="d-inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="title" value="{{ $ticket->title }}">
                            <input type="hidden" name="description" value="{{ $ticket->description }}">
                            <input type="hidden" name="priority" value="{{ $ticket->priority }}">
                            <input type="hidden" name="status" value="open">
                            <button type="submit" class="btn btn-outline-warning px-4 py-2 rounded-3 fw-bold">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Buka Kembali
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="ms-auto" onsubmit="return confirm('Hapus permanen tiket ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger px-4 py-2 rounded-3 border-0">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </form>
                </div>
            </div>
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
            height: calc(100vh - 120px);
        }
    }
    
    .letter-spacing-1 { letter-spacing: 1px; }
    .uppercase { text-transform: uppercase; }
    .bg-light { background-color: #f8fbfb !important; }
</style>
@endsection