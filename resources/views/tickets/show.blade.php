@extends('layouts.app')

@section('title', 'Detail Tiket #' . $ticket->id)

@push('styles')
    <style>
        .letter-spacing-1 { letter-spacing: 1px; }
        .uppercase { text-transform: uppercase; }
        .bg-light { background-color: #f8fbfb !important; }
        
        .comment-card { transition: background-color 0.2s ease; }
        .comment-card:hover { background-color: #f8f9fa; }
        
        /* Sticky Sidebar untuk desktop */
        @media (min-width: 768px) {
            .sticky-sidebar {
                position: sticky;
                top: 2rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-md-5 py-4">
        <div class="row g-0 shadow-lg rounded-4 overflow-hidden border bg-white" style="min-height: 85vh;">

            {{-- PANEL KIRI: METADATA & INFO --}}
            <div class="col-md-4 bg-light p-5 border-end">
                <div class="sticky-sidebar">
                    <div class="mb-4">
                        <a href="{{ route('tickets.index') }}"
                            class="btn btn-white shadow-sm rounded-pill px-4 mb-4 text-dark border bg-white">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                        <div class="mb-3">
                            <span class="text-muted small fw-bold letter-spacing-1 d-block mb-1">TIKET #{{ $ticket->id }}</span>
                            <h1 class="fw-bold h3 mb-3">{{ $ticket->title }}</h1>
                        </div>
                    </div>

                    <div class="mb-4 p-4 rounded-4 bg-white shadow-sm border">
                        <label class="small fw-bold text-muted d-block mb-2 uppercase letter-spacing-1">STATUS & PRIORITAS</label>
                        <div class="d-flex gap-2">
                            <span class="badge {{ $ticket->status_badge ?? 'bg-primary' }} px-3 py-2 rounded-pill text-capitalize">
                                {{ str_replace('_', ' ', $ticket->status) }}
                            </span>
                            <span class="badge {{ $ticket->priority_badge ?? 'bg-secondary' }} px-3 py-2 rounded-pill text-capitalize">
                                {{ $ticket->priority }} Priority
                            </span>
                        </div>
                    </div>

                    <div class="mb-4 p-4 rounded-4 bg-white shadow-sm border">
                        <label class="small fw-bold text-muted d-block mb-3 uppercase letter-spacing-1">PENGIRIM</label>
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 45px; height: 45px;">
                                <i class="bi bi-person-fill fs-5"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $ticket->user->name ?? 'Unknown User' }}</h6>
                                <small class="text-muted">{{ $ticket->created_at->format('d M Y, H:i') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 p-4 rounded-4 bg-white shadow-sm border small text-muted">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Dibuat</span>
                            <span class="text-dark">{{ $ticket->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Update Terakhir</span>
                            <span class="text-dark">{{ $ticket->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Jumlah Komentar</span>
                            <span class="badge bg-secondary rounded-pill">{{ $ticket->comments->count() }}</span>
                        </div>
                    </div>

                    {{-- Security Info Card --}}
                    <div class="p-4 rounded-4 bg-success bg-opacity-10 border border-success small">
                        <label class="fw-bold text-success d-block mb-2 uppercase letter-spacing-1">
                            <i class="bi bi-shield-check me-1"></i> Security Features
                        </label>
                        <ul class="list-unstyled mb-0 text-dark">
                            <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> CSRF Protection aktif</li>
                            <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> XSS Prevention (auto-escape)</li>
                            <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> Input Validation</li>
                            <li><i class="bi bi-check2 text-success me-1"></i> Authorization Check</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- PANEL KANAN: DESKRIPSI, AKSI & KOMENTAR --}}
            <div class="col-md-8 p-5 bg-white d-flex flex-column">

                {{-- DESKRIPSI MASALAH --}}
                <div class="mb-4">
                    <label class="form-label fw-bold small text-muted uppercase letter-spacing-1 mb-3">DESKRIPSI MASALAH</label>
                    <div class="p-4 rounded-4 bg-light border-0 text-dark" style="line-height: 1.6;">
                        {!! nl2br(e($ticket->description)) !!}
                    </div>
                </div>

                {{-- KONTROL & AKSI CEPAT --}}
                <div class="mb-5 pb-4 border-bottom">
                    <label class="form-label fw-bold small text-muted uppercase letter-spacing-1 mb-3">KONTROL & AKSI CEPAT</label>
                    <div class="d-flex flex-wrap gap-2">
                        @if ($ticket->user_id === auth()->id() || (auth()->user()->is_admin ?? false))
                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-primary px-4 py-2 rounded-3 border-0 shadow-sm">
                                <i class="bi bi-pencil-square me-2"></i>Edit Detail
                            </a>
                        @endif

                        @if ($ticket->status !== 'in_progress')
                            <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="in_progress">
                                <button type="submit" class="btn btn-outline-info px-4 py-2 rounded-3 fw-bold">
                                    <i class="bi bi-play-fill me-1"></i>Proses Tiket
                                </button>
                            </form>
                        @endif

                        @if ($ticket->status !== 'closed')
                            <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="closed">
                                <button type="submit" class="btn btn-outline-success px-4 py-2 rounded-3 fw-bold">
                                    <i class="bi bi-check-lg me-1"></i>Selesaikan
                                </button>
                            </form>
                        @endif

                        @if ($ticket->status === 'closed')
                            <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="open">
                                <button type="submit" class="btn btn-outline-warning px-4 py-2 rounded-3 fw-bold">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i>Buka Kembali
                                </button>
                            </form>
                        @endif

                        @if ($ticket->user_id === auth()->id() || (auth()->user()->is_admin ?? false))
                            <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="ms-auto"
                                onsubmit="return confirm('Hapus permanen tiket ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger px-4 py-2 rounded-3 border-0">
                                    <i class="bi bi-trash3 me-1"></i> Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                {{-- KOMENTAR SECTION --}}
                <div class="mt-2">
                    <label class="form-label fw-bold small text-muted uppercase letter-spacing-1 mb-3">
                        <i class="bi bi-chat-square-text me-2"></i>KOMENTAR ({{ $ticket->comments->count() }})
                    </label>

                    {{-- Form Tambah Komentar --}}
                    <div class="mb-4 p-4 rounded-4 bg-light border-0">
                        <form action="{{ route('comments.store', $ticket) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="content" id="content" rows="3"
                                    class="form-control rounded-3 border-0 shadow-sm @error('content') is-invalid @enderror"
                                    placeholder="Tulis komentar Anda di sini..." required minlength="3" maxlength="2000">{{ old('content') }}</textarea>

                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="form-text mt-2 d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-shield-lock text-success me-1"></i> Input disanitasi dengan aman</span>
                                    <span id="charCounter" class="text-muted">2000 karakter tersisa</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-dark px-4 rounded-3">
                                    <i class="bi bi-send me-1"></i> Kirim Komentar
                                </button>
                                <button type="button" class="btn btn-link text-info text-decoration-none btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#securityModal">
                                    <i class="bi bi-info-circle me-1"></i>Info Security
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Daftar Komentar --}}
                    <div class="d-flex flex-column gap-3">
                        @forelse($ticket->comments as $comment)
                            <div class="comment-card p-4 rounded-4 border bg-white shadow-sm">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 40px; height: 40px; background-color: var(--primary-soft) !important;">
                                            <span class="fw-bold">{{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">
                                                {{ $comment->user->name ?? 'Unknown User' }}
                                                @if ($comment->user_id === $ticket->user_id)
                                                    <span class="badge bg-info text-dark ms-2 rounded-pill" style="font-size: 0.65rem;">Author</span>
                                                @endif
                                            </h6>
                                            <small class="text-muted">
                                                {{ $comment->created_at->diffForHumans() }} &bull;
                                                {{ $comment->created_at->format('d M Y, H:i') }}
                                            </small>
                                        </div>
                                    </div>

                                    {{-- Tombol Delete Komentar --}}
                                    @if (auth()->id() === $comment->user_id || (auth()->user()->is_admin ?? false))
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                            onsubmit="return confirm('Hapus komentar ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger btn-link p-0 text-decoration-none" title="Hapus komentar">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                {{-- Isi Komentar --}}
                                <div class="ps-5 text-dark" style="line-height: 1.5;">
                                    {!! nl2br(e($comment->content)) !!}
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-5 bg-light rounded-4 border-dashed border">
                                <i class="bi bi-chat-square display-4 text-secondary opacity-50"></i>
                                <p class="mt-3 mb-1 fw-bold">Belum ada komentar.</p>
                                <p class="small">Jadilah yang pertama merespons tiket ini!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Include Security Modal --}}
    @include('partials.security-popup')
@endsection

@push('scripts')
    <script>
        // Character counter untuk textarea komentar
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('content');
            const counter = document.getElementById('charCounter');
            const maxLength = 2000;

            if (textarea && counter) {
                function updateCounter() {
                    const remaining = maxLength - textarea.value.length;
                    counter.textContent = `${remaining} karakter tersisa`;

                    if (remaining < 100) {
                        counter.classList.remove('text-muted');
                        counter.classList.add('text-danger', 'fw-bold');
                    } else {
                        counter.classList.add('text-muted');
                        counter.classList.remove('text-danger', 'fw-bold');
                    }
                }

                textarea.addEventListener('input', updateCounter);
                updateCounter(); 
            }
        });
    </script>
@endpush