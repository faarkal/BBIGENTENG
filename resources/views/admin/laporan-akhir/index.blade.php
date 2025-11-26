@extends('layouts.admin')

@section('content')
<div class="container mt-4 px-6">
    <h4 class="text-xl font-semibold mb-4">LAPORAN BULANAN PRODUKSI BENIH IKAN</h4>

    <form method="GET" action="{{ route('admin.laporan-akhir.index') }}" class="mb-4">
        <div class="mb-3 max-w-xs">
            <label class="block font-medium mb-1">Pilih Bulan:</label>
            <select name="bulan" class="border rounded p-2 w-full" onchange="this.form.submit()">
                @foreach($bulanList as $key => $bulan)
                    <option value="{{ $key }}" {{ $bulanDipilih == $key ? 'selected' : '' }}>
                        {{ $bulan }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-center border-collapse">
<thead class="bg-blue-600 text-white">
    <tr>
        <th rowspan="2" class="p-2 border">NO</th>
        <th rowspan="2" class="p-2 border">JENIS IKAN</th>

        <th colspan="2" class="p-2 border">SISA PRODUKSI BULAN LALU</th>
        <th colspan="2" class="p-2 border">PRODUKSI BULAN INI</th>
        <th colspan="2" class="p-2 border">JUMLAH TOTAL</th>

        {{-- PENGURANGAN BENIH BULAN INI total 7 kolom --}}
        <th colspan="3" class="p-2 border">TERJUAL</th>
        <th colspan="2" class="p-2 border">RESTOKING</th>
        <th colspan="2" class="p-2 border">MATI</th>

        {{-- SISA AKHIR BULAN total 2 kolom --}}
        <th colspan="2" class="p-2 border">SISA BENIH AKHIR BULAN INI</th>
    </tr>

    <tr class="bg-blue-700">
        {{-- SISA BULAN LALU --}}
        <th class="p-2 border">Ukuran (cm)</th>
        <th class="p-2 border">Jumlah (ekor)</th>

        {{-- PRODUKSI BULAN INI --}}
        <th class="p-2 border">Ukuran (cm)</th>
        <th class="p-2 border">Jumlah (ekor)</th>

        {{-- JUMLAH TOTAL --}}
        <th class="p-2 border">Ukuran (cm)</th>
        <th class="p-2 border">Jumlah (ekor)</th>

        {{-- TERJUAL --}}
        <th class="p-2 border">Ukuran (cm)</th>
        <th class="p-2 border">Jumlah (ekor)</th>
        <th class="p-2 border">Harga (Rp)</th>

        {{-- RESTOKING --}}
        <th class="p-2 border">Ukuran (cm)</th>
        <th class="p-2 border">Jumlah (ekor)</th>

        {{-- MATI --}}
        <th class="p-2 border">Ukuran (cm)</th>
        <th class="p-2 border">Jumlah (ekor)</th>

        {{-- SISA AKHIR --}}
        <th class="p-2 border">Ukuran (cm)</th>
        <th class="p-2 border">Jumlah (ekor)</th>
    </tr>
</thead>

            <tbody>
                @foreach($produksi as $i => $item)
                <tr class="{{ $i % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                    <td class="p-2 border">{{ $i + 1 }}</td>
                    <td class="p-2 border text-left">{{ $item->jenis_ikan ?? $item->nama ?? '-' }}</td>

                    {{-- Sisa bulan lalu --}}
                    <td class="p-2 border text-right">{{ $item->sisa_ukuran ?? '-' }}</td>
                    <td class="p-2 border text-right">{{ number_format($item->sisa_jumlah ?? 0) }}</td>

                    {{-- Produksi bulan ini --}}
                    <td class="p-2 border text-right">{{ $item->produksi_ukuran ?? '-' }}</td>
                    <td class="p-2 border text-right">{{ number_format($item->produksi_jumlah ?? 0) }}</td>

                    {{-- Total --}}
                    <td class="p-2 border text-right">{{ $item->produksi_ukuran ?? '-' }}</td>
                    <td class="p-2 border text-right">{{ number_format($item->total_jumlah ?? 0) }}</td>

                    {{-- Pengurangan: TERJUAL (3 kolom: ukuran, jumlah, harga) --}}
                    <td class="p-2 border text-right">{{ $item->terjual_ukuran ?? '-' }}</td>
                    <td class="p-2 border text-right">{{ number_format($item->terjual_jumlah ?? 0) }}</td>
                    <td class="p-2 border text-right">Rp {{ number_format($item->terjual_harga ?? 0) }}</td>

                    {{-- RESTOKING (2 kolom: ukuran, jumlah) --}}
                    <td class="p-2 border text-right">{{ $item->restock_ukuran ?? '-' }}</td>
                    <td class="p-2 border text-right">{{ number_format($item->restock_jumlah ?? 0) }}</td>

                    {{-- MATI (2 kolom: ukuran, jumlah) --}}
                    <td class="p-2 border text-right">{{ $item->mati_ukuran ?? '-' }}</td>
                    <td class="p-2 border text-right">{{ number_format($item->mati_jumlah ?? 0) }}</td>

                    {{-- Sisa akhir bulan (2 kolom: ukuran, jumlah) --}}
                    <td class="p-2 border text-right">{{ $item->sisa_akhir_ukuran ?? '-' }}</td>
                    <td class="p-2 border text-right font-bold">{{ number_format(max(0, $item->sisa_akhir_jumlah ?? 0)) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-100">
                <tr>
                    <th colspan="3" class="p-2 border text-left">JUMLAH</th>
                    <th class="p-2 border text-right">-</th>
                    <th class="p-2 border text-right">-</th>
                    <th class="p-2 border text-right">-</th>
                    <th class="p-2 border text-right">-</th>
                    <th class="p-2 border text-right">-</th>
                    <th colspan="3" class="p-2 border text-right">-</th>
                    <th class="p-2 border text-right">-</th>
                    <th colspan="2" class="p-2 border text-right">-</th>
                    <th colspan="2" class="p-2 border text-right">-</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
