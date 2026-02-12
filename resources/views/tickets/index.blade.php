@extends('layouts.app')

@section('content')
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card p-3 border-bottom border-warning border-5 h-100">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                    <i class="bi bi-envelope-open text-warning fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small fw-bold">OPEN</div>
                    <div class="h3 mb-0 fw-bold">{{ \App\Models\Ticket::where('status', 'open')->count() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 border-bottom border-info border-5 h-100">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                    <i class="bi bi-gear-wide-connected text-info fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small fw-bold text-uppercase">In Progress</div>
                    <div class="h3 mb-0 fw-bold">{{ \App\Models\Ticket::where('status', 'in_progress')->count() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 border-bottom border-success border-5 h-100">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                    <i class="bi bi-check2-circle text-success fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small fw-bold">CLOSED</div>
                    <div class="h3 mb-0 fw-bold">{{ \App\Models\Ticket::where('status', 'closed')->count() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h2 class="fw-bold h4 mb-1">Daftar Tiket Support</h2>
        <p class="text-muted small mb-0">Kelola permintaan bantuan pelanggan secara real-time.</p>
    </div>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg me-2"></i>Buat Tiket Baru
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 border-0 text-muted small">JUDUL TIKET</th>
                        <th class="py-3 border-0 text-muted small text-center">STATUS</th>
                        <th class="py-3 border-0 text-muted small text-center">PRIORITAS</th>
                        <th class="py-3 border-0 text-muted small">PENGIRIM</th>
                        <th class="px-4 py-3 border-0 text-muted small text-end">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                    <tr>
                        <td class="px-4 py-4">
                            <a href="{{ route('tickets.show', $ticket) }}" class="text-decoration-none fw-bold text-dark d-block">
                                {{ $ticket->title }}
                            </a>
                            <span class="text-muted x-small">{{ Str::limit($ticket->description, 50) }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $ticket->status_badge }} rounded-pill px-3 py-2 fw-medium text-capitalize">
                                {{ str_replace('_', ' ', $ticket->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex flex-column align-items-center">
                                <span class="small fw-semibold text-secondary">{{ ucfirst($ticket->priority) }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="small fw-medium">{{ $ticket->user->name ?? 'Guest' }}</div>
                            </div>
                        </td>
                        <td class="px-4 text-end">
                            <div class="btn-group shadow-sm rounded-3 overflow-hidden">
                                <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-light btn-sm px-3">
                                    <i class="bi bi-pencil text-primary"></i>
                                </a>
                                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus tiket?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-light btn-sm px-3">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="opacity-25 mb-3">
                            <p class="text-muted">Tidak ada tiket ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $tickets->links() }}
</div>

<style>
    .table thead th { font-weight: 700; letter-spacing: 0.5px; }
    .table tbody tr { transition: 0.2s; }
    .table tbody tr:hover { background-color: #fcfdfd !important; }
    .x-small { font-size: 0.75rem; }
    .badge { font-size: 0.7rem; letter-spacing: 0.3px; }
</style>
@endsection