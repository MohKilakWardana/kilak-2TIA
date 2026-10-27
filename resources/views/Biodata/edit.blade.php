@extends('layouts.app')
@section('title', 'Edit Biodata')

@section('content')
<h3 class="mb-3">Edit Biodata</h3>
<div class="card"><div class="card-body">
    <form action="{{ route('biodata.update', $biodata) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('biodata.form', ['biodata' => $biodata])
    </form>
</div></div>
@endsection
