
{{-- resources/views/admin/poli.blade.php --}}
@include('layout.header', ['title' => 'Kelola Poli'])
@include('layout.sidebar_admin')

  <div class="content-header">
    <h1 class="poli-page-title">Kelola Poli</h1>
  </div>

  <section class="content">

    {{-- Notifikasi --}}
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="row">
      <!-- Form Tambah/Edit Poli -->
      <div class="col-md-4">
        <div class="card {{ isset($editMode) ? 'card-warning' : 'card-primary' }}">
          <div class="card-header">
            <h3 class="card-title">{{ isset($editMode) ? 'Edit Poli' : 'Tambah Poli' }}</h3>
          </div>
          <form action="{{ isset($editMode) ? route('admin.poli.update', $poli->id) : route('admin.poli.store') }}" method="POST">
            @csrf
            @if(isset($editMode))
              @method('PUT')
            @endif
            <div class="card-body">
              <div class="form-group">
                <label>Nama Poli</label>
                <input type="text" name="nama" class="form-control" required
                  value="{{ old('nama', isset($editMode) ? $poli->nama : '') }}">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ old('keterangan', isset($editMode) ? $poli->keterangan : '') }}</textarea>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn {{ isset($editMode) ? 'btn-warning' : 'btn-primary' }} btn-block">
                {{ isset($editMode) ? 'Update' : 'Simpan' }}
              </button>
              @if(isset($editMode))
                <a href="{{ route('admin.poli.index') }}" class="btn btn-secondary btn-block mt-2">Batal Edit</a>
              @endif
            </div>
          </form>
        </div>
      </div>

      <!-- Tabel Daftar Poli -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-hospital-alt mr-2" style="color:#3b5bdb;"></i>Daftar Poli</h3>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Poli</th>
                  <th>Keterangan</th>
                  <th style="text-align:right;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($polis as $poli)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="font-weight-bold">{{ $poli->nama }}</td>
                    <td>{{ $poli->keterangan ?? '-' }}</td>
                    <td style="text-align:right;">
                      <a href="{{ route('admin.poli.edit', $poli->id) }}" class="btn btn-warning btn-sm" title="Edit" style="width:32px;height:32px;padding:0;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                      </a>
                      <form action="{{ route('admin.poli.destroy', $poli->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus poli ini?')" title="Hapus" style="width:32px;height:32px;padding:0;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;">
                          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center text-muted py-4">Belum ada data poli.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>

@include('layout.footer')
