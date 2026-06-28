@include('layout.header', ['title' => 'Detail Pemeriksaan'])
@include('layout.sidebar_pasien')

  <div class="content-header">
    <h1 class="poli-page-title">Detail Pemeriksaan</h1>
  </div>

  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-file-medical mr-2" style="color:#3b5bdb;"></i>Informasi Pemeriksaan</h3>
      </div>
      <div class="card-body">
        <dl class="row">
          <dt class="col-sm-4">Poli</dt>
          <dd class="col-sm-8">{{ $periksa->jadwal->dokter->poli->nama ?? '-' }}</dd>

          <dt class="col-sm-4">Dokter</dt>
          <dd class="col-sm-8">{{ $periksa->jadwal->dokter->user->nama ?? '-' }}</dd>

          <dt class="col-sm-4">Hari</dt>
          <dd class="col-sm-8">{{ $periksa->jadwal->hari ?? '-' }}</dd>

          <dt class="col-sm-4">Jam Mulai</dt>
          <dd class="col-sm-8">{{ $periksa->jadwal->jam_mulai ?? '-' }}</dd>

          <dt class="col-sm-4">Jam Selesai</dt>
          <dd class="col-sm-8">{{ $periksa->jadwal->jam_selesai ?? '-' }}</dd>

          <dt class="col-sm-4">Nomor Antrian</dt>
          <dd class="col-sm-8">
            <span class="badge badge-success" style="font-size: 1.2rem;">{{ $periksa->nomor_antrian }}</span>
          </dd>

          <dt class="col-sm-4">Keluhan</dt>
          <dd class="col-sm-8">{{ $periksa->keluhan ?? '-' }}</dd>

          <dt class="col-sm-4">Catatan Dokter</dt>
          <dd class="col-sm-8">
            @if($periksa->status === 'selesai')
              {{ $periksa->catatan_dokter ?? '-' }}
            @else
              <span class="text-muted">Belum diperiksa</span>
            @endif
          </dd>

          <dt class="col-sm-4">Obat</dt>
          <dd class="col-sm-8">
            @if($periksa->status === 'selesai' && $periksa->obats->count())
              <ul>
                @foreach($periksa->obats as $obat)
                  <li>{{ $obat->nama_obat }} - {{ $obat->kemasan }} (Rp. {{ number_format($obat->harga, 0, ',', '.') }})</li>
                @endforeach
              </ul>
            @else
              <span class="text-muted">-</span>
            @endif
          </dd>

          <dt class="col-sm-4">Biaya Pemeriksaan</dt>
          <dd class="col-sm-8">
            @if($periksa->status === 'selesai')
              Rp. {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}
            @else
              <span class="text-muted">Belum dihitung</span>
            @endif
          </dd>
        </dl>

        <a href="{{ route('periksaPasien') }}" class="btn btn-secondary" style="display:inline-flex;align-items:center;border-radius:8px;padding:6px 12px;font-weight:600;">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right:6px;"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
          Kembali
        </a>
      </div>
    </div>
  </section>

@include('layout.footer')
