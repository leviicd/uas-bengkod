@include('layout.header', ['title' => 'Riwayat Pasien'])
@include('layout.sidebar_dokter')

  <div class="content-header">
    <h1 class="poli-page-title">Riwayat Pasien</h1>
  </div>

  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Riwayat Pasien</h3>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No Antrian</th>
              <th>Nama Pasien</th>
              <th>Keluhan</th>
              <th>Tanggal Periksa</th>
              <th>Biaya</th>
              <th style="text-align:right;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($riwayat->groupBy('pasien.id') as $index => $grouped)
              @php $pasien = $grouped->first()->pasien; $firstPeriksa = $grouped->first(); @endphp
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="font-weight-bold">{{ $pasien->nama }}</td>
                <td style="color:#3b5bdb;">{{ $firstPeriksa->keluhan ?? '-' }}</td>
                <td>{{ $firstPeriksa->tgl_periksa ? \Carbon\Carbon::parse($firstPeriksa->tgl_periksa)->format('d/m/Y') : '-' }}</td>
                <td>Rp {{ number_format($firstPeriksa->biaya_periksa ?? 0, 0, ',', '.') }}</td>
                <td style="text-align:right;">
                  <a href="{{ route('dokter.riwayat.detail', $pasien->id) }}" class="btn btn-info btn-sm" style="display:inline-flex;align-items:center;border-radius:8px;padding:6px 12px;font-weight:600;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right:6px;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    Detail
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-muted py-4">Tidak ada data riwayat pasien.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </section>

@include('layout.footer')