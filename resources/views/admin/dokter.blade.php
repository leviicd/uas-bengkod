{{-- resources/views/admin/dokter.blade.php --}}
@include('layout.header', ['title' => 'Kelola Dokter'])
@include('layout.sidebar_admin')

  <div class="content-header">
    <h1 class="poli-page-title">Kelola Dokter</h1>
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
      <!-- Form Tambah/Edit Dokter -->
      <div class="col-md-4">
        <div class="card {{ isset($editMode) && $editMode ? 'card-warning' : 'card-primary' }}">
          <div class="card-header">
            <h3 class="card-title">{{ isset($editMode) && $editMode ? 'Edit Dokter' : 'Tambah Dokter' }}</h3>
          </div>
          <form action="{{ isset($editMode) && $editMode ? route('admin.dokter.update', $dokter->id) : route('admin.dokter.store') }}" method="POST">
            @csrf
            @if(isset($editMode) && $editMode)
              @method('PUT')
            @endif
            <div class="card-body">
              <div class="form-group">
                <label>Nama Dokter</label>
                <input type="text" name="nama" class="form-control" required value="{{ old('nama', $editMode ? $dokter->nama : '') }}">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email', $editMode ? $dokter->user->email : '') }}">
              </div>
              <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" required value="{{ old('no_hp', $editMode ? $dokter->user->no_hp : '') }}">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $editMode ? $dokter->user->alamat : '') }}</textarea>
              </div>
              <div class="form-group">
                <label>Password {{ $editMode ? '(Kosongkan jika tidak ingin mengubah)' : '' }}</label>
                <input type="password" name="password" class="form-control" {{ $editMode ? '' : 'required' }} placeholder="{{ $editMode ? 'Kosongkan jika tidak ingin mengubah' : '' }}">
              </div>
              <div class="form-group">
                <label>Pilih Poli</label>
                <select name="poli_id" class="form-control" required>
                  <option value="" disabled {{ !$editMode ? 'selected' : '' }}>-- Pilih Poli --</option>
                  @foreach ($polis as $poli)
                    <option value="{{ $poli->id }}"
                      {{ old('poli_id', $editMode ? $dokter->poli_id : '') == $poli->id ? 'selected' : '' }}>
                      {{ $poli->nama }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn {{ $editMode ? 'btn-warning' : 'btn-primary' }} btn-block">
                {{ $editMode ? 'Update' : 'Simpan' }}
              </button>
              @if($editMode)
                <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary btn-block mt-2">Batal Edit</a>
              @endif
            </div>
          </form>
        </div>
      </div>

      <!-- Tabel Dokter -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user-md mr-2" style="color:#3b5bdb;"></i>Daftar Dokter</h3>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Poli</th>
                  <th>No HP</th>
                  <th>Email</th>
                  <th style="text-align:right;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($dokters as $dokter)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="font-weight-bold">{{ $dokter->nama }}</td>
                    <td>{{ $dokter->poli->nama ?? '-' }}</td>
                    <td>{{ $dokter->user->no_hp }}</td>
                    <td style="color:#3b5bdb;">{{ $dokter->user->email }}</td>
                    <td style="text-align:right;">
                      <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="btn btn-warning btn-sm" title="Edit" style="width:32px;height:32px;padding:0;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                      </a>
                      <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus dokter ini?')" title="Hapus" style="width:32px;height:32px;padding:0;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;">
                          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada data dokter.</td>
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