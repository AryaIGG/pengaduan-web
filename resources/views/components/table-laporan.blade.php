<div class="overflow-x-auto">
    <table class="w-full text-left">
        <thead
            class="bg-white/5 text-[11px] uppercase tracking-wider text-white/40 font-semibold border-b border-white/10">
            <tr>
                <th class="px-6 py-4">Pelapor</th>
                <th class="px-6 py-4">Isi Aspirasi</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach ($aspirasi_terbaru as $aspi)
                <tr class="hover:bg-white/[0.02] transition">
                    <td class="px-6 py-4 text-sm font-medium text-white">
                        {{ $aspi->siswa->nama ?? $aspi->nis }}
                    </td>
                    <td class="px-6 py-4 text-sm text-white/60">
                        {{ Str::limit($aspi->ket, 50) }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span
                            class="px-2 py-1 text-[10px] font-bold uppercase rounded-md 
                {{ strtolower($aspi->status) == 'selesai' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' }}\">
                            {{ $aspi->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="/aspirasi/{{ $aspi->id }}"
                            class="text-xs font-bold text-blue-400 hover:text-blue-300">DETAIL</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
