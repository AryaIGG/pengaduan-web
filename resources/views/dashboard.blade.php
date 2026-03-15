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
        <div id="aspirasi-datatable"
            class="bg-layer border border-layer-line rounded-xl shadow-2xs overflow-hidden --prevent-on-load-init"
            data-hs-datatable='{"pageLength":10,"lengthMenu":[[5,10,25,-1],[5,10,25,"Semua"]],"order":[],"autoWidth":false,"selecting":true,"rowSelectingOptions":{"selectAllSelector":"#aspirasi-select-all-rows","individualSelector":".aspirasi-select-row"},"layout":{"topStart":null,"topEnd":null,"bottomStart":null,"bottomEnd":null},"columnDefs":[{"targets":[0,5],"orderable":false}]}'>
            <div class="px-5 py-4 flex flex-wrap items-end gap-3 border-b border-table-line bg-muted/20">
                <div class="min-w-0 grow">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-muted-foreground-1">Daftar Aspirasi Terbaru</p>
                    <p class="text-xs text-muted-foreground-2 mt-0.5">Gunakan search atau filter per kolom untuk mempercepat review.</p>
                </div>
                <div class="relative w-full sm:w-64 lg:w-72">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-2.5 pointer-events-none">
                        <svg class="size-3.5 text-muted-foreground-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                        </svg>
                    </div>
                    <input type="text" data-hs-datatable-search placeholder="Search..."
                        class="w-full h-9 ps-8 pe-3 text-xs bg-layer border border-card-line rounded-lg text-foreground placeholder-muted-foreground-2 focus:outline-none focus:border-primary">
                </div>

                <select data-hs-datatable-page-entities
                    class="h-9 py-1.5 px-2.5 text-xs font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground focus:outline-none min-w-20">
                </select>
            </div>

            <div class="max-h-[32rem] overflow-auto">
                <table class="w-full min-w-[860px] table-fixed divide-y divide-table-line">
                    <thead class="bg-muted sticky top-0 z-10">
                        <tr>
                            <th class="px-4 py-3 w-10 --exclude-from-ordering">
                                <input id="aspirasi-select-all-rows" type="checkbox"
                                    class="aspirasi-select-row size-3.5 rounded border-card-line bg-muted cursor-pointer">
                            </th>
                            <th class="px-4 py-3 w-[28%] text-start text-[10px] font-semibold uppercase tracking-wider text-muted-foreground-1">
                                <div class="flex items-center gap-x-1.5">
                                    <span>Pelapor</span>
                                    <div class="hs-dropdown [--auto-close:inside] [--placement:bottom-right] relative inline-flex">
                                        <button type="button" class="hs-dropdown-toggle size-5 inline-flex items-center justify-center rounded border border-transparent text-muted-foreground-1 hover:text-foreground hover:border-line-2">
                                            <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                                        </button>
                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden bg-dropdown border border-dropdown-line shadow-md rounded-lg p-2">
                                            <input id="filter-pelapor" type="text"
                                                class="py-1.5 px-2.5 block w-48 bg-layer border border-layer-line rounded-md text-xs text-foreground placeholder-muted-foreground-1 focus:outline-none"
                                                placeholder="Filter pelapor">
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th class="px-4 py-3 w-[32%] text-start text-[10px] font-semibold uppercase tracking-wider text-muted-foreground-1">
                                <div class="flex items-center gap-x-1.5">
                                    <span>Keterangan</span>
                                    <div class="hs-dropdown [--auto-close:inside] [--placement:bottom-right] relative inline-flex">
                                        <button type="button" class="hs-dropdown-toggle size-5 inline-flex items-center justify-center rounded border border-transparent text-muted-foreground-1 hover:text-foreground hover:border-line-2">
                                            <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                                        </button>
                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden bg-dropdown border border-dropdown-line shadow-md rounded-lg p-2">
                                            <input id="filter-keterangan" type="text"
                                                class="py-1.5 px-2.5 block w-56 bg-layer border border-layer-line rounded-md text-xs text-foreground placeholder-muted-foreground-1 focus:outline-none"
                                                placeholder="Filter keterangan">
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th class="px-4 py-3 w-[14%] text-start text-[10px] font-semibold uppercase tracking-wider text-muted-foreground-1">
                                <div class="flex items-center gap-x-1.5">
                                    <span>Status</span>
                                    <div class="hs-dropdown [--auto-close:inside] [--placement:bottom-right] relative inline-flex">
                                        <button type="button" class="hs-dropdown-toggle size-5 inline-flex items-center justify-center rounded border border-transparent text-muted-foreground-1 hover:text-foreground hover:border-line-2">
                                            <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                                        </button>
                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden bg-dropdown border border-dropdown-line shadow-md rounded-lg p-2">
                                            <select id="filter-status"
                                                class="py-1.5 px-2.5 block w-40 bg-layer border border-layer-line rounded-md text-xs text-foreground focus:outline-none">
                                                <option value="all">Semua</option>
                                                <option value="Menunggu">Menunggu</option>
                                                <option value="Proses">Proses</option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th class="px-4 py-3 w-[16%] text-start text-[10px] font-semibold uppercase tracking-wider text-muted-foreground-1">
                                <div class="flex items-center gap-x-1.5">
                                    <span>Tanggal</span>
                                    <div class="hs-dropdown [--auto-close:inside] [--placement:bottom-right] relative inline-flex">
                                        <button type="button" class="hs-dropdown-toggle size-5 inline-flex items-center justify-center rounded border border-transparent text-muted-foreground-1 hover:text-foreground hover:border-line-2">
                                            <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                                        </button>
                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden bg-dropdown border border-dropdown-line shadow-md rounded-lg p-2">
                                            <input id="filter-tanggal" type="text"
                                                class="py-1.5 px-2.5 block w-44 bg-layer border border-layer-line rounded-md text-xs text-foreground placeholder-muted-foreground-1 focus:outline-none"
                                                placeholder="cth: 06 Feb 2026">
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th class="px-4 py-3 w-16 --exclude-from-ordering"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-table-line">
                        @forelse($aspirasi_terbaru ?? [] as $aspi)
                            @php
                                $cfg = match (strtolower($aspi->status)) {
                                    'selesai' => ['dot' => 'bg-teal-500', 'bg' => 'bg-teal-500/10', 'text' => 'text-teal-400', 'label' => 'Selesai'],
                                    'proses' => ['dot' => 'bg-blue-500', 'bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'label' => 'Proses'],
                                    default => ['dot' => 'bg-yellow-500', 'bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'label' => 'Menunggu'],
                                };
                            @endphp
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-4 py-4 align-top">
                                    <input type="checkbox"
                                        class="aspirasi-select-row size-3.5 rounded border-card-line bg-muted cursor-pointer"
                                        data-hs-datatable-row-selecting-individual>
                                </td>
                                <td class="px-4 py-4 align-top">
                                    <div class="flex items-center gap-x-2.5 min-w-0">
                                        <span class="inline-flex items-center justify-center size-7 rounded-full bg-layer border border-layer-line text-xs font-semibold text-foreground shrink-0">
                                            {{ strtoupper(substr($aspi->siswa->nama ?? 'S', 0, 1)) }}
                                        </span>
                                        <div class="min-w-0">
                                            <span class="block text-[13px] font-semibold text-foreground truncate">{{ $aspi->siswa->nama ?? 'Anonim' }}</span>
                                            <span class="block text-[10px] text-muted-foreground-1 mt-0.5">NIS {{ $aspi->nis }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 max-w-xs align-top">
                                    <span class="text-xs text-muted-foreground-1 italic leading-relaxed line-clamp-2 block">"{{ Str::limit($aspi->ket, 90) }}"</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap align-top">
                                    <span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-[11px] font-semibold {{ $cfg['bg'] }} {{ $cfg['text'] }}">
                                        <span class="size-1.5 rounded-full {{ $cfg['dot'] }}"></span>
                                        {{ $cfg['label'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-xs text-muted-foreground-1 align-top">
                                    {{ $aspi->created_at ? $aspi->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-4 py-4 align-top">
                                    <div class="flex items-center justify-end">
                                        <button type="button"
                                            onclick="setResponse('{{ $aspi->id_pelaporan }}','{{ addslashes($aspi->siswa->nama ?? 'Anonim') }}','{{ addslashes($aspi->ket) }}','{{ strtolower($aspi->status) }}')"
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

            <div class="px-5 py-3.5 flex flex-wrap items-center justify-between gap-3 border-t border-table-line bg-muted/10">
                <span data-hs-datatable-info class="text-xs text-muted-foreground-1"></span>
                <div class="inline-flex items-center gap-x-1">
                    <button type="button" data-hs-datatable-paging-prev
                        class="py-1.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground hover:bg-layer-hover disabled:opacity-40 disabled:pointer-events-none focus:outline-none transition-colors">
                        <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m15 18-6-6 6-6"/></svg>
                        Prev
                    </button>
                    <div data-hs-datatable-paging-pages class="px-1 text-xs text-muted-foreground-1"></div>
                    <button type="button" data-hs-datatable-paging-next
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

    function initializeDashboardDataTable() {
        const pelaporFilterEl = document.getElementById('filter-pelapor');
        const keteranganFilterEl = document.getElementById('filter-keterangan');
        const statusFilterEl = document.getElementById('filter-status');
        const tanggalFilterEl = document.getElementById('filter-tanggal');
        const datatableRoot = document.getElementById('aspirasi-datatable');

        if (!window.HSDataTable || !datatableRoot) {
            return;
        }

        const existingInstance = window.HSDataTable.getInstance('#aspirasi-datatable', true);
        const hsDataTable = existingInstance?.element ?? new window.HSDataTable(datatableRoot);
        const dataTable = hsDataTable.dataTable;
        if (!dataTable) {
            return;
        }

        dataTable.search.fixed('columnFilters', function (_searchStr, data) {
            const normalizeCellText = (value) => {
                return String(value ?? '')
                    .replace(/<[^>]*>/g, ' ')
                    .replace(/\s+/g, ' ')
                    .trim()
                    .toLowerCase();
            };

            const pelaporKeyword = (pelaporFilterEl?.value ?? '').toLowerCase().trim();
            const keteranganKeyword = (keteranganFilterEl?.value ?? '').toLowerCase().trim();
            const selectedStatus = (statusFilterEl?.value ?? 'all').trim();
            const tanggalKeyword = (tanggalFilterEl?.value ?? '').toLowerCase().trim();

            const pelapor = normalizeCellText(data[1]);
            const keterangan = normalizeCellText(data[2]);
            const status = normalizeCellText(data[3]);
            const tanggal = normalizeCellText(data[4]);

            const matchPelapor = pelaporKeyword === '' || pelapor.includes(pelaporKeyword);
            const matchKeterangan = keteranganKeyword === '' || keterangan.includes(keteranganKeyword);
            const matchStatus = selectedStatus === 'all' || status === selectedStatus.toLowerCase();
            const matchTanggal = tanggalKeyword === '' || tanggal.includes(tanggalKeyword);

            return matchPelapor && matchKeterangan && matchStatus && matchTanggal;
        });

        if (pelaporFilterEl) {
            pelaporFilterEl.oninput = () => dataTable.draw();
        }
        if (keteranganFilterEl) {
            keteranganFilterEl.oninput = () => dataTable.draw();
        }
        if (statusFilterEl) {
            statusFilterEl.onchange = () => dataTable.draw();
        }
        if (tanggalFilterEl) {
            tanggalFilterEl.oninput = () => dataTable.draw();
        }

        const adjustColumns = () => {
            dataTable.columns.adjust().draw(false);
        };

        requestAnimationFrame(adjustColumns);
        if (window.__aspirasiTableResizeHandler) {
            window.removeEventListener('resize', window.__aspirasiTableResizeHandler);
        }
        window.__aspirasiTableResizeHandler = adjustColumns;
        window.addEventListener('resize', window.__aspirasiTableResizeHandler);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeDashboardDataTable);
    } else {
        initializeDashboardDataTable();
    }

    window.addEventListener('pageshow', initializeDashboardDataTable);
</script>
@endpush

@endsection
