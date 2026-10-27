@php $b = $biodata ?? null; @endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" value="{{ old('nim', $b->nim ?? '') }}" required>
    </div>
    <div class="col-md-8">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $b->nama ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Profesi / Jabatan <small class="text-muted">(tampil di bawah nama)</small></label>
        <input type="text" name="profesi" class="form-control" placeholder="contoh: Mahasiswa Teknik Informatika"
               value="{{ old('profesi', $b->profesi ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Foto</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
        @if (!empty($b?->foto))
            <small class="text-muted">Foto saat ini ada. Pilih file baru hanya jika ingin menggantinya.</small>
        @endif
    </div>

    <div class="col-md-4">
        <label class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-select" required>
            @foreach (['Laki-laki', 'Perempuan'] as $jk)
                <option value="{{ $jk }}" @selected(old('jenis_kelamin', $b->jenis_kelamin ?? '') === $jk)>{{ $jk }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $b->tempat_lahir ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control"
               value="{{ old('tanggal_lahir', $b->tanggal_lahir ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Agama</label>
        <select name="agama" class="form-select">
            <option value="">-- Pilih --</option>
            @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $ag)
                <option value="{{ $ag }}" @selected(old('agama', $b->agama ?? '') === $ag)>{{ $ag }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Kewarganegaraan</label>
        <input type="text" name="kewarganegaraan" class="form-control"
               value="{{ old('kewarganegaraan', $b->kewarganegaraan ?? 'Indonesia') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="">-- Pilih --</option>
            @foreach (['Belum Menikah', 'Menikah'] as $st)
                <option value="{{ $st }}" @selected(old('status', $b->status ?? '') === $st)>{{ $st }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">No. HP</label>
        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $b->no_hp ?? '') }}">
    </div>
    <div class="col-md-8">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $b->email ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $b->alamat ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label">Pendidikan</label>
        <textarea name="pendidikan" class="form-control" rows="4"
                  placeholder="S1 Teknik Informatika | Politeknik Caltex Riau, 2026&#10;SMA Negeri 1 Pekanbaru | Lulus Tahun 2022">{{ old('pendidikan', $b->pendidikan ?? '') }}</textarea>
        <small class="text-muted">Satu baris satu data. Format: <code>Jenjang | Institusi, Tahun</code></small>
    </div>
    <div class="col-md-6">
        <label class="form-label">Pengalaman</label>
        <textarea name="pengalaman" class="form-control" rows="4"
                  placeholder="Asisten Dosen | Politeknik Caltex Riau (2025) | Membantu praktikum pemrograman web&#10;Magang Web Developer | PT Contoh (2025) | Membuat fitur CRUD dengan Laravel">{{ old('pengalaman', $b->pengalaman ?? '') }}</textarea>
        <small class="text-muted">Satu baris satu data. Format: <code>Posisi | Instansi (Tahun) | Deskripsi singkat</code></small>
    </div>

    <div class="col-12">
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('biodata.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</div>
