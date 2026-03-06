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

    {{-- ===== TABLE ===== --}}
    <div class="lg:col-span-2">
        <div class="bg-layer border border-layer-line rounded-xl shadow-2xs overflow-hidden">

            {{-- Toolbar --}}
            <div class="px-4 py-3 flex flex-wrap items-center gap-2 border-b border-table-line">
                {{-- Search --}}
                <div class="relative flex-1 min-w-[140px]">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-2.5 pointer-events-none">
                        <svg class="size-3.5 text-muted-foreground-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                        </svg>
                    </div>
                    <input type="text" id="search-input" oninput="searchTable(this.value)"
                        placeholder="Search..."
                        class="w-full py-1.5 ps-8 pe-3 text-xs bg-muted border border-card-line rounded-lg text-foreground placeholder-muted-foreground-2 focus:outline-none focus:border-primary">
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-x-1.5 ms-auto">
                    <button type="button" onclick="exportCSV()"
                        class="py-1.5 px-2.5 inline-flex items-center gap-x-1.5 text-xs font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground hover:bg-layer-hover focus:outline-none transition-colors">
                        <svg class="size-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Export
                    </button>

                    <div class="relative" id="filter-dropdown-wrapper">
                        <button type="button" onclick="toggleFilter()"
                            class="py-1.5 px-2.5 inline-flex items-center gap-x-1.5 text-xs font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground hover:bg-layer-hover focus:outline-none transition-colors">
                            <svg class="size-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                            </svg>
                            Filter
                            <span id="filter-badge" class="hidden ms-0.5 size-4 inline-flex items-center justify-center rounded-full bg-primary text-primary-foreground text-[10px] font-bold">1</span>
                        </button>
                        <div id="filter-dropdown"     
                            class="hidden absolute end-0 top-full mt-1.5 z-20 w-44 bg-dropdown border border-dropdown-line rounded-xl shadow-xl p-1.5 space-y-0.5">
                            <button onclick="setFilter('all')" class="w-full text-start px-3 py-1.5 text-xs rounded-lg text-foreground hover:bg-layer-hover transition-colors font-medium">Semua Status</button>
                            <button onclick="setFilter('menunggu')" class="w-full text-start px-3 py-1.5 text-xs rounded-lg text-foreground hover:bg-layer-hover transition-colors">
                                <span class="inline-flex items-center gap-x-1.5"><span class="size-1.5 rounded-full bg-yellow-500"></span>Menunggu</span>
                            </button>
                            <button onclick="setFilter('proses')" class="w-full text-start px-3 py-1.5 text-xs rounded-lg text-foreground hover:bg-layer-hover transition-colors">
                                <span class="inline-flex items-center gap-x-1.5"><span class="size-1.5 rounded-full bg-blue-500"></span>Proses</span>
                            </button>
                            <button onclick="setFilter('selesai')" class="w-full text-start px-3 py-1.5 text-xs rounded-lg text-foreground hover:bg-layer-hover transition-colors">
                                <span class="inline-flex items-center gap-x-1.5"><span class="size-1.5 rounded-full bg-teal-500"></span>Selesai</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── DESKTOP TABLE (md+) ── --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full divide-y divide-table-line">
                    <thead class="bg-muted">
                        <tr>
                            <th class="w-10 px-4 py-3">
                                <input type="checkbox" id="check-all" onchange="toggleAll(this)"
                                    class="size-3.5 rounded border-card-line bg-muted cursor-pointer">
                            </th>
                            <th class="px-4 py-3 text-start">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-muted-foreground-1">Pelapor</span>
                            </th>
                            <th class="px-4 py-3 text-start">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-muted-foreground-1">Keterangan</span>
                            </th>
                            <th class="px-4 py-3 text-start">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-muted-foreground-1">Status</span>
                            </th>
                            <th class="px-4 py-3 text-start">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-muted-foreground-1">Tanggal</span>
                            </th>
                            <th class="px-4 py-3 w-16"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-table-line" id="table-body-desktop">

                        @forelse($aspirasi_terbaru ?? [] as $i => $aspi)
                        @php
                            $cfg = match(strtolower($aspi->status)) {
                                'selesai' => ['dot'=>'bg-teal-500',   'bg'=>'bg-teal-500/10',   'text'=>'text-teal-400',   'label'=>'Selesai'],
                                'proses'  => ['dot'=>'bg-blue-500',   'bg'=>'bg-blue-500/10',   'text'=>'text-blue-400',   'label'=>'Proses'],
                                default   => ['dot'=>'bg-yellow-500', 'bg'=>'bg-yellow-500/10', 'text'=>'text-yellow-400', 'label'=>'Menunggu'],
                            };
                        @endphp
                        <tr class="aspirasi-row hover:bg-muted/30 transition-colors"
                            data-status="{{ strtolower($aspi->status) }}"
                            data-search="{{ strtolower(($aspi->siswa->nama ?? '') . ' ' . $aspi->nis . ' ' . $aspi->ket) }}">

                            <td class="px-4 py-3">
                                <input type="checkbox" class="row-check size-3.5 rounded border-card-line bg-muted cursor-pointer">
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center gap-x-2.5 min-w-0">
                                    <span class="inline-flex items-center justify-center size-7 rounded-full bg-layer border border-layer-line text-xs font-semibold text-foreground shrink-0">
                                        {{ strtoupper(substr($aspi->siswa->nama ?? 'S', 0, 1)) }}
                                    </span>
                                    <div class="min-w-0">
                                        <span class="block text-sm font-medium text-foreground truncate">{{ $aspi->siswa->nama ?? 'Anonim' }}</span>
                                        <span class="block text-[11px] text-muted-foreground-1">{{ $aspi->nis }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3" style="max-width:0; width:35%">
                                <span class="text-xs text-muted-foreground-1 italic truncate block">"{{ Str::limit($aspi->ket, 50) }}"</span>
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-medium {{ $cfg['bg'] }} {{ $cfg['text'] }}">
                                    <span class="size-1.5 rounded-full {{ $cfg['dot'] }}"></span>
                                    {{ $cfg['label'] }}
                                </span>
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="text-xs text-muted-foreground-1">
                                    {{ $aspi->created_at ? $aspi->created_at->format('d M Y, H:i') : '-' }}
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-x-1">
                                    <button onclick="setResponse('{{ $aspi->id_pelaporan }}','{{ addslashes($aspi->siswa->nama ?? 'Anonim') }}','{{ addslashes($aspi->ket) }}','{{ strtolower($aspi->status) }}')"
                                        title="Respond"
                                        class="size-7 inline-flex items-center justify-center rounded-lg text-muted-foreground-1 hover:text-primary hover:bg-primary/10 transition-colors">
                                        <svg class="size-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-14 text-center">
                                <div class="flex flex-col items-center gap-y-2">
                                    <svg class="size-8 text-muted-foreground-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                    <p class="text-sm text-muted-foreground-1">Belum ada laporan masuk.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- ── MOBILE CARD LIST (< md) ── --}}
            <div class="md:hidden divide-y divide-table-line" id="table-body-mobile">
                @forelse($aspirasi_terbaru ?? [] as $i => $aspi)
                @php
                    $cfg = match(strtolower($aspi->status)) {
                        'selesai' => ['dot'=>'bg-teal-500',   'bg'=>'bg-teal-500/10',   'text'=>'text-teal-400',   'label'=>'Selesai'],
                        'proses'  => ['dot'=>'bg-blue-500',   'bg'=>'bg-blue-500/10',   'text'=>'text-blue-400',   'label'=>'Proses'],
                        default   => ['dot'=>'bg-yellow-500', 'bg'=>'bg-yellow-500/10', 'text'=>'text-yellow-400', 'label'=>'Menunggu'],
                    };
                @endphp
                <div class="aspirasi-row px-4 py-3 hover:bg-muted/30 transition-colors"
                    data-status="{{ strtolower($aspi->status) }}"
                    data-search="{{ strtolower(($aspi->siswa->nama ?? '') . ' ' . $aspi->nis . ' ' . $aspi->ket) }}">
                    <div class="flex items-start justify-between gap-x-3">
                        {{-- Left: avatar + info --}}
                        <div class="flex items-start gap-x-3 min-w-0 flex-1">
                            <span class="inline-flex items-center justify-center size-8 rounded-full bg-layer border border-layer-line text-xs font-semibold text-foreground shrink-0 mt-0.5">
                                {{ strtoupper(substr($aspi->siswa->nama ?? 'S', 0, 1)) }}
                            </span>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-x-2 flex-wrap">
                                    <span class="text-sm font-medium text-foreground">{{ $aspi->siswa->nama ?? 'Anonim' }}</span>
                                    <span class="text-[11px] text-muted-foreground-1">{{ $aspi->nis }}</span>
                                </div>
                                <p class="text-xs text-muted-foreground-1 italic mt-0.5 line-clamp-2">"{{ Str::limit($aspi->ket, 80) }}"</p>
                                <div class="flex items-center gap-x-3 mt-1.5">
                                    <span class="inline-flex items-center gap-x-1.5 py-0.5 px-2 rounded-full text-[11px] font-medium {{ $cfg['bg'] }} {{ $cfg['text'] }}">
                                        <span class="size-1.5 rounded-full {{ $cfg['dot'] }}"></span>
                                        {{ $cfg['label'] }}
                                    </span>
                                    <span class="text-[11px] text-muted-foreground-1">
                                        {{ $aspi->created_at ? $aspi->created_at->format('d M, H:i') : '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        {{-- Right: action --}}
                        <button onclick="setResponse('{{ $aspi->id_pelaporan }}','{{ addslashes($aspi->siswa->nama ?? 'Anonim') }}','{{ addslashes($aspi->ket) }}','{{ strtolower($aspi->status) }}')"
                            class="shrink-0 size-8 inline-flex items-center justify-center rounded-lg text-muted-foreground-1 hover:text-primary hover:bg-primary/10 transition-colors">
                            <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </button>
                    </div>
                </div>
                @empty
                <div class="px-6 py-14 text-center">
                    <div class="flex flex-col items-center gap-y-2">
                        <svg class="size-8 text-muted-foreground-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <p class="text-sm text-muted-foreground-1">Belum ada laporan masuk.</p>
                    </div>
                </div>
                @endforelse
            </div>

            {{-- Footer --}}
            <div class="px-4 py-3 flex items-center justify-between border-t border-table-line">
                <div class="flex items-center gap-x-3">
                    <div class="flex items-center gap-x-1.5">
                        <select id="per-page" onchange="changePerPage(this.value)"
                            class="py-1 px-2 text-xs font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground focus:outline-none">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                        </select>
                        <span class="text-xs text-muted-foreground-1">per page</span>
                    </div>
                    <span class="text-xs text-muted-foreground-1">
                        <span id="row-count" class="font-semibold text-foreground">{{ count($aspirasi_terbaru ?? []) }}</span> results
                    </span>
                </div>

                <div class="inline-flex items-center gap-x-1">
                    <button id="btn-prev" onclick="changePage(-1)" disabled
                        class="py-1.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground hover:bg-layer-hover disabled:opacity-40 disabled:pointer-events-none focus:outline-none transition-colors">
                        <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m15 18-6-6 6-6"/></svg>
                        Prev
                    </button>
                    <button id="btn-next" onclick="changePage(1)"
                        class="py-1.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground hover:bg-layer-hover disabled:opacity-40 disabled:pointer-events-none focus:outline-none transition-colors">
                        Next
                        <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- ===== RESPONSE PANEL ===== --}}
    <div class="lg:col-span-1">
        <div class="bg-card border border-card-line shadow-2xs rounded-xl overflow-hidden sticky top-6">
            <div class="px-5 py-4 border-b border-card-line">
                <h2 class="text-base font-semibold text-foreground">Resolution Center</h2>
                <p class="text-xs text-muted-foreground-2 mt-0.5">Balas aspirasi untuk dikirim ke siswa.</p>
            </div>
            <div class="p-5">
                <form action="{{ route('admin.update-status') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_pelaporan" id="input_id_pelaporan">

                    <div id="selection_placeholder" class="py-10 flex flex-col items-center gap-y-3 text-center">
                        <div class="size-12 rounded-full bg-muted flex items-center justify-center">
                            <svg class="size-5 text-muted-foreground-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-foreground">Pilih laporan</p>
                            <p class="text-xs text-muted-foreground-2 mt-0.5">Klik icon respond pada baris tabel</p>
                        </div>
                    </div>

                    <div id="response_form_fields" class="hidden space-y-4">
                        <div class="p-3 bg-muted/30 rounded-lg border border-card-line">
                            <div class="flex items-center gap-x-2.5 mb-2">
                                <span class="inline-flex items-center justify-center size-7 rounded-full bg-layer border border-layer-line text-xs font-semibold text-foreground" id="display_avatar">A</span>
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
                                <option value="proses">Dalam Proses</option>
                                <option value="selesai">Selesai / Resolved</option>
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
    let currentFilter = 'all';
    let currentSearch = '';
    let currentPage   = 1;
    let perPage       = 10;

    // Select ALL .aspirasi-row — works for both <tr> and <div>
    const allRows = () => Array.from(document.querySelectorAll('.aspirasi-row'));

    // Deduplicate by data-search (desktop+mobile both exist in DOM, same data)
    // We pair them: desktop rows live in table-body-desktop, mobile in table-body-mobile
    const desktopRows = () => Array.from(document.querySelectorAll('#table-body-desktop .aspirasi-row'));
    const mobileRows  = () => Array.from(document.querySelectorAll('#table-body-mobile .aspirasi-row'));

    function getFilteredIndices() {
        // Use desktop rows as source of truth for indices
        const rows = desktopRows();
        const indices = [];
        rows.forEach((row, i) => {
            const matchFilter = currentFilter === 'all' || row.dataset.status === currentFilter;
            const matchSearch = !currentSearch || (row.dataset.search || '').includes(currentSearch.toLowerCase());
            if (matchFilter && matchSearch) indices.push(i);
        });
        return indices;
    }

    function renderTable() {
        const dRows  = desktopRows();
        const mRows  = mobileRows();
        const indices = getFilteredIndices();
        const start   = (currentPage - 1) * perPage;
        const end     = start + perPage;
        const pageIdx = indices.slice(start, end);

        // Hide all
        dRows.forEach(r => r.style.display = 'none');
        mRows.forEach(r => r.style.display = 'none');

        // Show page slice
        pageIdx.forEach(i => {
            if (dRows[i]) dRows[i].style.display = '';
            if (mRows[i]) mRows[i].style.display = '';
        });

        // Update count & pagination
        const rc = document.getElementById('row-count');
        if (rc) rc.innerText = indices.length;

        const prev = document.getElementById('btn-prev');
        const next = document.getElementById('btn-next');
        if (prev) prev.disabled = currentPage <= 1;
        if (next) next.disabled = end >= indices.length;

        const ca = document.getElementById('check-all');
        if (ca) ca.checked = false;
    }

    function searchTable(val) { currentSearch = val; currentPage = 1; renderTable(); }

    function toggleFilter() { document.getElementById('filter-dropdown').classList.toggle('hidden'); }

    function setFilter(status) {
        currentFilter = status; currentPage = 1;
        document.getElementById('filter-dropdown').classList.add('hidden');
        document.getElementById('filter-badge').classList.toggle('hidden', status === 'all');
        renderTable();
    }

    document.addEventListener('click', e => {
        const w = document.getElementById('filter-dropdown-wrapper');
        if (w && !w.contains(e.target)) document.getElementById('filter-dropdown').classList.add('hidden');
    });

    function changePage(dir) { currentPage += dir; renderTable(); }
    function changePerPage(val) { perPage = parseInt(val); currentPage = 1; renderTable(); }

    function toggleAll(el) {
        const dRows   = desktopRows();
        const indices = getFilteredIndices().slice((currentPage-1)*perPage, currentPage*perPage);
        indices.forEach(i => {
            const cb = dRows[i]?.querySelector('.row-check');
            if (cb) cb.checked = el.checked;
        });
    }

    function exportCSV() {
        const dRows   = desktopRows();
        const indices = getFilteredIndices();
        const lines   = [['Nama','NIS','Status','Tanggal']];
        indices.forEach(i => {
            const row  = dRows[i];
            const nama = row?.querySelector('.text-sm.font-medium')?.innerText ?? '';
            const nis  = row?.querySelectorAll('td')[1]?.querySelector('.text-\\[11px\\]')?.innerText ?? '';
            const stat = row?.dataset.status ?? '';
            const tgl  = row?.querySelectorAll('td')[4]?.innerText?.trim() ?? '';
            lines.push([nama, nis, stat, tgl]);
        });
        const csv  = lines.map(r => r.map(c => `"${c}"`).join(',')).join('\n');
        const blob = new Blob([csv], {type:'text/csv'});
        const url  = URL.createObjectURL(blob);
        const a    = document.createElement('a');
        a.href = url; a.download = 'aspirasi.csv'; a.click();
        URL.revokeObjectURL(url);
    }

    function setResponse(id, nama, ket, status) {
        document.getElementById('response_form_fields').classList.remove('hidden');
        document.getElementById('selection_placeholder').classList.add('hidden');
        document.getElementById('input_id_pelaporan').value = id;
        document.getElementById('display_nama').innerText   = nama;
        document.getElementById('display_avatar').innerText = nama.charAt(0).toUpperCase();
        document.getElementById('display_ket').innerText    = '"' + ket + '"';
        document.getElementById('select_status').value      = status === 'selesai' ? 'selesai' : 'proses';
        if (window.innerWidth < 1024) {
            document.getElementById('response_form_fields').scrollIntoView({ behavior: 'smooth' });
        }
    }

    function clearResponse() {
        document.getElementById('response_form_fields').classList.add('hidden');
        document.getElementById('selection_placeholder').classList.remove('hidden');
    }

    renderTable();
</script>
@endpush

@endsection