{{-- resources/views/admin/pasien.blade.php --}}
@include('layout.header', ['title' => 'Kelola Pasien'])
@include('layout.sidebar_admin')

  <div class="content-header">
    <h1 class="poli-page-title">Kelola Pasien</h1>
  </div>

  <section class="content">

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
      <!-- Form Tambah Pasien -->
      <div class="col-md-4">
        <div class="card card-primary">
          <div class="card-header"><h3 class="card-title">Tambah Pasien</h3></div>
          <form action="{{ route('admin.pasien.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="form-group">
                <label>No KTP</label>
                <input type="text" name="no_ktp" class="form-control" required>
              </div>
              <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Tabel Pasien -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-users mr-2" style="color:#3b5bdb;"></i>Daftar Pasien</h3>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No RM</th>
                  <th>Nama</th>
                  <th>No KTP</th>
                  <th>No HP</th>
                  <th>Alamat</th>
                  <th style="text-align:right;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($pasiens as $pasien)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pasien->no_rm }}</td>
                    <td class="font-weight-bold">{{ $pasien->nama }}</td>
                    <td>{{ $pasien->no_ktp }}</td>
                    <td>{{ $pasien->no_hp }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td style="text-align:right;">
                      <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="btn btn-warning btn-sm" title="Edit" style="width:32px;height:32px;padding:0;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                      </a>
                      <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pasien ini?')" title="Hapus" style="width:32px;height:32px;padding:0;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;">
                          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data pasien.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>

@include('layout.footer')
