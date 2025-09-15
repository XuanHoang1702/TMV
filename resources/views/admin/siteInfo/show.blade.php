@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Chi tiết Site Info</h1>

    <p><strong>ID:</strong> {{ $siteInfo->id }}</p>
    <p><strong>Slogan:</strong> {{ $siteInfo->slogan }}</p>
    <p><strong>Logo:</strong></p>
    <img src="{{ asset('storage/' . $siteInfo->logo) }}" width="120">

    <br><br>
    <a href="{{ route('admin.siteInfo.index') }}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection
