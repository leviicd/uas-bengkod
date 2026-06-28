@include('layout.header', ['title' => 'Manajemen Obat'])
@include('layout.sidebar_dokter')

  <div class="content-header">
    <h1 class="poli-page-title">Manajemen Obat</h1>
  </div>

  <section class="content">
    @if(session('success'))
      <div class="alert alert-success"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</div>
    @endif

    {{-- Indikator stok menipis / habis --}}
    @php
      $stokHabis   = $obats->filter(fn($o) => $o->stok <= 0);
      $stokMenipis = $obats->filter(fn($o) => $o->stok > 0 && $o->stok <= $o->stok_minimum);
    @endphp

    @if($stokHabis->count() > 0)
      <div class="alert" style="background:#fee2e2;color:#991b1b;border-left:4px solid #ef4444;">
        <i class="fas fa-times-circle mr-2"></i>
        <strong>Stok Habis!</strong> {{ $stokHabis->pluck('nama_obat')->join(', ') }} — Hubungi admin untuk penambahan stok.
      </div>
    @endif

    @if($stokMenipis->count() > 0)
      <div class="alert" style="background:#fef3c7;color:#92400e;border-left:4px solid #f59e0b;">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <strong>Stok Menipis!</strong> {{ $stokMenipis->pluck('nama_obat')->join(', ') }} — Segera laporkan ke admin.
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-pills mr-2" style="color:#3b5bdb;"></i>Daftar Obat & Stok</h3>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Obat</th>
              <th>Kemasan</th>
              <th>Harga</th>
              <th>Stok</th>
              <th style="text-align:right;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($obats as $obat)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="font-weight-bold">{{ $obat->nama_obat }}</td>
                <td>{{ $obat->kemasan }}</td>
                <td>Rp. {{ number_format($obat->harga, 0, ',', '.') }}</td>
                <td>
                  @if($obat->stok <= 0)
                    <span class="badge" style="background:#fee2e2;color:#991b1b;font-size:12px;padding:5px 10px;">
                      <i class="fas fa-times-circle mr-1"></i>HABIS
                    </span>
                  @elseif($obat->stok <= $obat->stok_minimum)
                    <span class="badge" style="background:#fef3c7;color:#92400e;font-size:12px;padding:5px 10px;">
                      <i class="fas fa-exclamation-triangle mr-1"></i>{{ $obat->stok }} (Menipis)
                    </span>
                  @else
                    <span class="badge" style="background:#dcfce7;color:#166534;font-size:12px;padding:5px 10px;">
                      <i class="fas fa-check-circle mr-1"></i>{{ $obat->stok }}
                    </span>
                  @endif
                </td>
                <td style="text-align:right;">
                  <button
                    class="btn btn-warning btn-sm"
                    data-toggle="modal"
                    data-target="#editModal"
                    data-id="{{ $obat->id }}"
                    data-nama="{{ $obat->nama_obat }}"
                    data-kemasan="{{ $obat->kemasan }}"
                    data-harga="{{ $obat->harga }}"
                    title="Edit"
                    style="width:32px;height:32px;padding:0;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  </button>
                  <button
                    class="btn btn-danger btn-sm btn-delete"
                    data-id="{{ $obat->id }}"
                    data-nama="{{ $obat->nama_obat }}"
                    title="Hapus"
                    style="width:32px;height:32px;padding:0;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 6 5 6 21 6"/>
                      <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                      <path d="M10 11v6"/><path d="M14 11v6"/>
                      <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                    </svg>
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>

{{-- Modal Edit Obat --}}
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="" id="formEditObat">
      @csrf
      @method('PUT')
      <div class="modal-content" style="border-radius:14px;overflow:hidden;">
        <div class="modal-header" style="background:#f8fafc;border-bottom:1px solid #f0f3f8;">
          <h5 class="modal-title font-weight-bold" style="color:#1e293b;">Edit Obat</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Obat</label>
            <input type="text" id="edit_nama" name="nama_obat" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Kemasan</label>
            <input type="text" id="edit_kemasan" name="kemasan" class="form-control" required>
          </div>
          <div class="form-group mb-0">
            <label>Harga</label>
            <input type="number" id="edit_harga" name="harga" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer" style="background:#f8fafc;border-top:1px solid #f0f3f8;">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

@include('layout.footer')

<script>
  $(document).ready(function() {
    $('#editModal').on('show.bs.modal', function(event) {
      const btn = $(event.relatedTarget);
      $('#edit_nama').val(btn.data('nama'));
      $('#edit_kemasan').val(btn.data('kemasan'));
      $('#edit_harga').val(btn.data('harga'));
      $('#formEditObat').attr('action', '/dokter/obat/' + btn.data('id'));
    });

    $(document).on('click', '.btn-delete', function() {
      const btn = $(this);
      const nama = btn.data('nama');
      const id = btn.data('id');

      Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Yakin ingin menghapus obat ' + nama + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        customClass: {
          popup: 'swal2-premium-popup'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          const form = $('<form>', { method: 'POST', action: '/dokter/obat/' + id });
          form.append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
          form.append('<input type="hidden" name="_method" value="DELETE">');
          $('body').append(form);
          form.submit();
        }
      });
    });
  });
</script>