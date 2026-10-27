@extends('layouts.app')
@section('title', 'Data Biodata')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Data Biodata</h3>
    <a href="{{ route('biodata.create') }}" class="btn btn-primary">+ Tambah Data</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>Tgl Lahir</th>
                    <th>No. HP</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $i => $row)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $row->nim }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->jenis_kelamin }}</td>
                        <td>{{ $row->tanggal_lahir }}</td>
                        <td>{{ $row->no_hp }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->alamat }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('biodata.show', $row) }}" class="btn btn-sm btn-info">Lihat CV</a>
                            <a href="{{ route('biodata.edit', $row) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('biodata.destroy', $row) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
