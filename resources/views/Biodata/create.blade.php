@extends('layouts.app')
@section('title', 'Tambah Biodata')

@section('content')
<h3 class="mb-3">Tambah Biodata</h3>
<div class="card"><div class="card-body">
    <form action="{{ route('biodata.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('biodata.form')
    </form>
</div></div>
@endsection
