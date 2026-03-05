@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

{{-- ===== PAGE HEADER ===== --}}
<div class="flex flex-wrap items-center justify-between gap-3">
    <div>
        <h2 class="text-lg font-bold text-foreground">Overview</h2>
        <p class="text-xs text-muted-foreground-1 mt-0.5">Pantau laporan aspirasi siswa secara real-time.</p>
    </div>
    <div class="flex items-center gap-x-2">
        <span class="flex items-center gap-x-1.5 text-xs text-muted-foreground-1">
            <span class="size-2 rounded-full bg-teal-500 animate-pulse"></span>
            Live
        </span>
        <span class="text-xs text-muted-foreground-1 bg-muted px-2.5 py-1 rounded-lg border border-card-line">
            {{ now()->format('d M Y, H:i') }} WIB
        </span>
    </div>
</div>

{{-- ===== STAT CARDS ===== --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

    <div class="flex flex-col bg-card border border-card-line rounded-xl p-4 md:p-5 gap-y-3">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-black uppercase tracking-widest text-muted-foreground-1">Total Inbound</span>
            <div class="size-8 rounded-lg bg-primary/10 flex items-center justify-center">
                <svg class="size-4 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
        </div>
        <div>
            <h3 class="text-2xl sm:text-3xl font-bold text-foreground">{{ $total_aspirasi ?? 0 }}</h3>
            <p class="text-[10px] text-muted-foreground-1 mt-0.5">Total laporan masuk</p>
        </div>
    </div>

    <div class="flex flex-col bg-card border border-card-line rounded-xl p-4 md:p-5 gap-y-3">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-black uppercase tracking-widest text-muted-foreground-1">Students</span>
            <div class="size-8 rounded-lg bg-violet-500/10 flex items-center justify-center">
                <svg class="size-4 text-violet-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
        </div>
        <div>
            <h3 class="text-2xl sm:text-3xl font-bold text-foreground">{{ $total_siswa ?? 0 }}</h3>
            <p class="text-[10px] text-muted-foreground-1 mt-0.5">Siswa terdaftar</p>
        </div>
    </div>

    <div class="flex flex-col bg-card border border-card-line border-b-2 border-b-blue-500 rounded-xl p-4 md:p-5 gap-y-3">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-black uppercase tracking-widest text-muted-foreground-1">On Progress</span>
            <div class="size-8 rounded-lg bg-blue-500/10 flex items-center justify-center">
                <svg class="size-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            </div>
        </div>
        <div>
            <div class="flex items-center gap-x-2">
                <h3 class="text-2xl sm:text-3xl font-bold text-foreground">{{ $aspirasi_proses ?? 0 }}</h3>
                <span class="size-2 rounded-full bg-blue-500 animate-pulse"></span>
            </div>
            <p class="text-[10px] text-muted-foreground-1 mt-0.5">Sedang diproses</p>
        </div>
    </div>

    <div class="flex flex-col bg-card border border-card-line border-b-2 border-b-teal-500 rounded-xl p-4 md:p-5 gap-y-3">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-black uppercase tracking-widest text-muted-foreground-1">Resolved</span>
            <div class="size-8 rounded-lg bg-teal-500/10 flex items-center justify-center">
                <svg class="size-4 text-teal-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
        </div>
        <div>
            <h3 class="text-2xl sm:text-3xl font-bold text-foreground">{{ $aspirasi_selesai ?? 0 }}</h3>
            <p class="text-[10px] text-muted-foreground-1 mt-0.5">Berhasil diselesaikan</p>
        </div>
    </div>

</div>

{{-- ===== PROGRESS BAR ===== --}}
@php
    $total    = $total_aspirasi ?? 0;
    $selesai  = $aspirasi_selesai ?? 0;
    $proses   = $aspirasi_proses ?? 0;
    $menunggu = max(0, $total - $selesai - $proses);
    $pctSelesai  = $total > 0 ? round(($selesai / $total) * 100) : 0;
    $pctProses   = $total > 0 ? round(($proses / $total) * 100) : 0;
    $pctMenunggu = $total > 0 ? round(($menunggu / $total) * 100) : 0;
@endphp
<div class="bg-card border border-card-line rounded-xl p-4 sm:p-5">
    <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
        <span class="text-xs font-bold text-foreground">Completion Rate</span>
        <span class="text-xs font-black text-teal-500">{{ $pctSelesai }}% Resolved</span>
    </div>
    <div class="flex h-2 rounded-full overflow-hidden bg-muted gap-x-0.5">
        <div class="bg-teal-500 rounded-full transition-all duration-500" style="width: {{ $pctSelesai }}%"></div>
        <div class="bg-blue-500 rounded-full transition-all duration-500" style="width: {{ $pctProses }}%"></div>
        <div class="bg-yellow-500 rounded-full transition-all duration-500" style="width: {{ $pctMenunggu }}%"></div>
    </div>
    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2.5">
        <span class="flex items-center gap-x-1.5 text-[10px] text-muted-foreground-1"><span class="size-2 rounded-full bg-teal-500"></span>Selesai ({{ $selesai }})</span>
        <span class="flex items-center gap-x-1.5 text-[10px] text-muted-foreground-1"><span class="size-2 rounded-full bg-blue-500"></span>Proses ({{ $proses }})</span>
        <span class="flex items-center gap-x-1.5 text-[10px] text-muted-foreground-1"><span class="size-2 rounded-full bg-yellow-500"></span>Menunggu ({{ $menunggu }})</span>
    </div>
</div>

{{-- ===== MAIN GRID ===== --}}
<div class="grid lg:grid-cols-3 gap-4 sm:gap-6">

    {{-- ===== TABLE (Preline visitors style) ===== --}}
    <div class="lg:col-span-2 flex flex-col">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-layer border border-layer-line rounded-xl shadow-2xs overflow-hidden">

                        {{-- Header --}}
                        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-table-line">
                            <div>
                                <h2 class="text-xl font-semibold text-foreground">Aspirasi Masuk</h2>
                                <p class="text-sm text-muted-foreground-2">Laporan terbaru dari aplikasi siswa.</p>
                            </div>
                            <div class="inline-flex gap-x-2">
                                <select id="filter-status" onchange="filterTable(this.value)"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground shadow-2xs hover:bg-layer-hover focus:outline-none">
                                    <option value="all">Semua Status</option>
                                    <option value="menunggu">Menunggu</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                        </div>

                        {{-- Table --}}
                        <table class="min-w-full divide-y divide-table-line">
                            <thead class="bg-muted divide-y divide-table-line">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start border-s border-table-line">
                                        <span class="text-xs font-semibold uppercase text-foreground">Pelapor</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start hidden md:table-cell">
                                        <span class="text-xs font-semibold uppercase text-foreground">Keterangan</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-foreground">Status</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start hidden sm:table-cell">
                                        <span class="text-xs font-semibold uppercase text-foreground">Tanggal</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-end"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-table-line" id="table-body">

                                @forelse($aspirasi_terbaru ?? [] as $i => $aspi)
                                <tr class="aspirasi-row" data-status="{{ $aspi->status }}">

                                    {{-- Pelapor --}}
                                    <td class="h-px w-auto whitespace-nowrap">
                                        <div class="px-6 py-2 flex items-center gap-x-3">
                                            <span class="text-sm text-muted-foreground-2">{{ $i + 1 }}.</span>
                                            <div class="flex items-center gap-x-2">
                                                <span class="inline-flex items-center justify-center size-8 rounded-full bg-layer border border-layer-line">
                                                    <span class="font-medium text-sm text-foreground leading-none">
                                                        {{ strtoupper(substr($aspi->siswa->nama ?? 'S', 0, 1)) }}
                                                    </span>
                                                </span>
                                                <div>
                                                    <span class="block text-sm font-semibold text-foreground">{{ $aspi->siswa->nama ?? 'Anonim' }}</span>
                                                    <span class="block text-xs text-muted-foreground-1">NIS: {{ $aspi->nis }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Keterangan --}}
                                    <td class="h-px w-72 hidden md:table-cell">
                                        <div class="px-6 py-2">
                                            <span class="text-sm text-muted-foreground-1 italic">"{{ Str::limit($aspi->ket, 55) }}"</span>
                                        </div>
                                    </td>

                                    {{-- Status --}}
                                    <td class="h-px w-auto whitespace-nowrap">
                                        <div class="px-6 py-2">
                                            @php
                                                $statusCfg = match($aspi->status) {
                                                    'selesai' => [
                                                        'class' => 'bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500',
                                                        'icon'  => 'M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z',
                                                        'label' => 'Selesai',
                                                    ],
                                                    'proses'  => [
                                                        'class' => 'bg-blue-100 text-blue-800 dark:bg-blue-500/10 dark:text-blue-500',
                                                        'icon'  => 'M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z',
                                                        'label' => 'Proses',
                                                    ],
                                                    default   => [
                                                        'class' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/10 dark:text-yellow-500',
                                                        'icon'  => 'M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z',
                                                        'label' => 'Menunggu',
                                                    ],
                                                };
                                            @endphp
                                            <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-full {{ $statusCfg['class'] }}">
                                                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="{{ $statusCfg['icon'] }}"/>
                                                </svg>
                                                {{ $statusCfg['label'] }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Tanggal --}}
                                    <td class="h-px w-auto whitespace-nowrap hidden sm:table-cell">
                                        <div class="px-6 py-2">
                                            <span class="text-sm text-muted-foreground-1">
                                                {{ $aspi->created_at ? $aspi->created_at->format('d M, H:i') : '-' }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="h-px w-auto whitespace-nowrap">
                                        <div class="px-6 py-1.5">
                                            <button onclick="setResponse(
                                                '{{ $aspi->id_pelaporan }}',
                                                '{{ addslashes($aspi->siswa->nama ?? 'Anonim') }}',
                                                '{{ addslashes($aspi->ket) }}',
                                                '{{ $aspi->status }}'
                                            )" class="inline-flex items-center gap-x-1 text-sm text-primary decoration-2 hover:underline focus:outline-none focus:underline font-medium">
                                                Respond
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-y-2">
                                            <svg class="size-8 text-muted-foreground-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                            <p class="text-sm text-muted-foreground-1">Belum ada laporan masuk.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>

                        {{-- Footer --}}
                        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-table-line">
                            <div>
                                <p class="text-sm text-muted-foreground-2">
                                    <span class="font-semibold text-foreground" id="row-count">{{ count($aspirasi_terbaru ?? []) }}</span> results
                                </p>
                            </div>
                            <div class="inline-flex gap-x-2">
                                <a href="{{ route('dashboard') }}"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground shadow-2xs hover:bg-layer-hover focus:outline-none focus:bg-layer-focus">
                                    <svg class="shrink-0 size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/></svg>
                                    Refresh
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== RESPONSE PANEL ===== --}}
    <div class="lg:col-span-1">
        <div class="bg-card border border-card-line shadow-2xs rounded-xl overflow-hidden sticky top-6">

            <div class="px-6 py-4 border-b border-card-line">
                <h2 class="text-xl font-semibold text-foreground">Resolution Center</h2>
                <p class="text-sm text-muted-foreground-2">Balas aspirasi untuk dikirim ke siswa.</p>
            </div>

            <div class="p-5">
                <form action="{{ route('admin.update-status') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_pelaporan" id="input_id_pelaporan">

                    {{-- Placeholder --}}
                    <div id="selection_placeholder" class="py-10 flex flex-col items-center gap-y-3 text-center">
                        <div class="size-12 rounded-full bg-muted flex items-center justify-center">
                            <svg class="size-6 text-muted-foreground-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-foreground">Pilih laporan</p>
                            <p class="text-xs text-muted-foreground-2 mt-0.5">Klik "Respond" pada baris tabel</p>
                        </div>
                    </div>

                    {{-- Form --}}
                    <div id="response_form_fields" class="hidden space-y-4">

                        <div class="p-3 bg-muted/30 rounded-lg border border-card-line">
                            <div class="flex items-center gap-x-2.5 mb-2">
                                <span class="inline-flex items-center justify-center size-8 rounded-full bg-layer border border-layer-line font-medium text-sm text-foreground" id="display_avatar">A</span>
                                <span class="text-sm font-semibold text-foreground" id="display_nama"></span>
                            </div>
                            <p id="display_ket" class="text-xs text-muted-foreground-1 italic leading-relaxed"></p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-foreground mb-1.5">Tanggapan Resmi</label>
                            <textarea name="feedback" required rows="4"
                                class="py-2.5 px-3 block w-full bg-muted border border-card-line rounded-lg text-sm text-foreground placeholder-muted-foreground-2 focus:outline-none focus:border-primary resize-none"
                                placeholder="Tuliskan solusi atau progres laporan..."></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-foreground mb-1.5">Update Status</label>
                            <select name="status" id="select_status"
                                class="py-2 px-3 block w-full bg-muted border border-card-line rounded-lg text-sm font-medium text-foreground focus:outline-none focus:border-primary">
                                <option value="proses">🔵 Dalam Proses</option>
                                <option value="selesai">🟢 Selesai / Resolved</option>
                            </select>
                        </div>

                        <div class="flex flex-col gap-y-2">
                            <button type="submit"
                                class="w-full py-2.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-none transition-all active:scale-[0.98]">
                                <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 2 11 13"/><path d="M22 2 15 22 11 13 2 9l20-7z"/></svg>
                                Kirim Tanggapan
                            </button>
                            <button type="button" onclick="clearResponse()"
                                class="w-full py-2 text-xs text-muted-foreground-1 hover:text-foreground transition-colors focus:outline-none">
                                Batal
                            </button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

@push('scripts')
<script>
    function filterTable(status) {
        let count = 0;
        document.querySelectorAll('.aspirasi-row').forEach(row => {
            const show = status === 'all' || row.dataset.status === status;
            row.style.display = show ? '' : 'none';
            if (show) count++;
        });
        document.getElementById('row-count').innerText = count;
    }

    function setResponse(id, nama, ket, status) {
        document.getElementById('response_form_fields').classList.remove('hidden');
        document.getElementById('selection_placeholder').classList.add('hidden');
        document.getElementById('input_id_pelaporan').value = id;
        document.getElementById('display_nama').innerText = nama;
        document.getElementById('display_avatar').innerText = nama.charAt(0).toUpperCase();
        document.getElementById('display_ket').innerText = '"' + ket + '"';
        document.getElementById('select_status').value = status === 'selesai' ? 'selesai' : 'proses';
        if (window.innerWidth < 1024) {
            document.getElementById('response_form_fields').scrollIntoView({ behavior: 'smooth' });
        }
    }

    function clearResponse() {
        document.getElementById('response_form_fields').classList.add('hidden');
        document.getElementById('selection_placeholder').classList.remove('hidden');
    }
</script>
@endpush

@endsection