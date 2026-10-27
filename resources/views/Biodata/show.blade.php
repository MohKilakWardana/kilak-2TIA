@extends('layouts.app')
@section('title', 'CV - ' . $biodata->nama)

@section('content')
@php
    $lines = fn ($t) => collect(preg_split('/\r\n|\r|\n/', (string) $t))
        ->map(fn ($l) => trim($l))->filter()->values();
    $pendidikan = $lines($biodata->pendidikan);
    $pengalaman = $lines($biodata->pengalaman);

    $tgl = \Carbon\Carbon::parse($biodata->tanggal_lahir)->locale('id')->translatedFormat('d F Y');
    $ttl = ($biodata->tempat_lahir ? $biodata->tempat_lahir . ', ' : '') . $tgl;

    $profil = [
        'Nama'                  => $biodata->nama,
        'NIM'                   => $biodata->nim,
        'Tempat, Tanggal Lahir' => $ttl,
        'Alamat'                => $biodata->alamat,
        'Nomor Telepon'         => $biodata->no_hp,
        'Jenis Kelamin'         => $biodata->jenis_kelamin,
        'Agama'                 => $biodata->agama,
        'Kewarganegaraan'       => $biodata->kewarganegaraan,
        'Email'                 => $biodata->email,
        'Status'                => $biodata->status,
    ];
@endphp

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .cvx { max-width: 860px; margin: 0 auto; background: #f8f4f0; border-radius: 12px; overflow: hidden;
           box-shadow: 0 4px 20px rgba(0,0,0,.15); position: relative;
           font-family: 'Poppins', 'Segoe UI', sans-serif; color: #3b2a22; }
    .cvx-bar { height: 28px; background: #96695a; }
    .cvx-band { background: #b09080; height: 150px; padding: 0 30px 0 290px; display: flex; align-items: center; }
    .cvx-band h1 { color: #fff; font-weight: 700; font-size: 2.6rem; line-height: 1.1; margin: 0;
                   text-shadow: 3px 3px 0 rgba(0,0,0,.08); word-break: break-word; }
    .cvx-sub { padding: 16px 30px 0 290px; min-height: 90px; color: #b09080; font-weight: 600;
               letter-spacing: 3px; text-transform: uppercase; font-size: 1.15rem; }
    .cvx-photo { position: absolute; left: 44px; top: 50px; width: 200px; height: 200px; border-radius: 50%;
                 border: 3px solid #a0522d; overflow: hidden; background: #d9c3b5; display: flex;
                 align-items: center; justify-content: center; font-size: 5rem; font-weight: 700; color: #fff; }
    .cvx-photo img { width: 100%; height: 100%; object-fit: cover; }

    .tl { position: relative; padding: 10px 30px 40px 90px; }
    .tl::before { content: ''; position: absolute; left: 52px; top: 40px; bottom: 50px; width: 2px; background: #a0522d; }
    .tl-item { position: relative; background: #fff; border: 2px solid #a0522d; border-radius: 22px;
               padding: 22px 28px; margin-bottom: 22px; }
    .tl-item::before { content: ''; position: absolute; left: -52px; top: 22px; width: 30px; height: 30px;
                       border-radius: 50%; background: radial-gradient(circle, #fff 0 6px, #a0522d 7px); }
    .tl-item h2 { font-size: 1.7rem; font-weight: 600; text-transform: uppercase; margin: 0 0 14px; }
    .tl-item ul { list-style: none; padding: 0; margin: 0; }
    .tl-item li { display: flex; gap: 8px; padding: 3px 0; }
    .tl-item li::before { content: '\2022'; color: #3b2a22; }
    .tl-item .k { width: 230px; flex-shrink: 0; }
    .tl-item .v { flex: 1; word-break: break-word; }

    .exp-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 22px; }
    .exp-grid h6 { font-weight: 600; font-size: 1.05rem; margin-bottom: 2px; }
    .exp-grid .org { font-size: .9rem; margin-bottom: 6px; }
    .exp-grid .desc { font-size: .9rem; display: flex; gap: 8px; }
    .exp-grid .desc::before { content: '\2022'; }

    @media (max-width: 720px) {
        .cvx-band { height: auto; padding: 24px 20px; justify-content: center; text-align: center; }
        .cvx-band h1 { font-size: 2rem; }
        .cvx-photo { position: static; margin: -10px auto 0; transform: translateY(-20px); }
        .cvx-sub { padding: 0 20px; min-height: 0; text-align: center; margin-top: -4px; }
        .tl { padding: 20px 16px 30px 50px; }
        .tl::before { left: 22px; }
        .tl-item::before { left: -42px; }
        .tl-item .k { width: 130px; }
        .exp-grid { grid-template-columns: 1fr; }
    }
    @media print {
        body { background: #fff !important; }
        .no-print { display: none !important; }
        .cvx { box-shadow: none; }
        .cvx, .cvx * { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    }
</style>

<div class="cvx">
    <div class="cvx-bar"></div>

    <div class="cvx-photo">
        @if ($biodata->foto)
            <img src="{{ asset('storage/' . $biodata->foto) }}" alt="Foto {{ $biodata->nama }}">
        @else
            {{ strtoupper(substr($biodata->nama, 0, 1)) }}
        @endif
    </div>

    <div class="cvx-band"><h1>{{ $biodata->nama }}</h1></div>
    <div class="cvx-sub">{{ $biodata->profesi }}</div>

    <div class="tl">
        <div class="tl-item">
            <h2>Profil Pribadi</h2>
            <ul>
                @foreach ($profil as $label => $nilai)
                    <li><span class="k">{{ $label }}:</span><span class="v">{{ $nilai ?: '-' }}</span></li>
                @endforeach
            </ul>
        </div>

        <div class="tl-item">
            <h2>Pendidikan</h2>
            @if ($pendidikan->isEmpty())
                <p class="mb-0">-</p>
            @else
                <ul>
                    @foreach ($pendidikan as $line)
                        @php [$kiri, $kanan] = array_pad(explode('|', $line, 2), 2, ''); @endphp
                        <li>
                            <span class="k">{{ trim($kiri) }}</span>
                            <span class="v">{{ trim($kanan) !== '' ? ': ' . trim($kanan) : '' }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="tl-item">
            <h2>Pengalaman</h2>
            @if ($pengalaman->isEmpty())
                <p class="mb-0">-</p>
            @else
                <div class="exp-grid">
                    @foreach ($pengalaman as $line)
                        @php [$posisi, $instansi, $desc] = array_pad(explode('|', $line, 3), 3, ''); @endphp
                        <div>
                            <h6>{{ trim($posisi) }}</h6>
                            <div class="org">{{ trim($instansi) }}</div>
                            @if (trim($desc) !== '')
                                <div class="desc">{{ trim($desc) }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<div class="text-center mt-4 no-print">
    <a href="{{ route('biodata.index') }}" class="btn btn-secondary">&larr; Kembali</a>
    <a href="{{ route('biodata.edit', $biodata) }}" class="btn btn-warning">Edit</a>
    <button onclick="window.print()" class="btn btn-primary">Cetak / Simpan PDF</button>
</div>
@endsection
