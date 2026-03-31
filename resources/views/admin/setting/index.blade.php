@extends('layouts.admin')

@section('title','Setting')

@section('content')

<div class="page-header">
    <div class="page-title">Pengaturan Pembayaran</div>
</div>

<div class="table-card">

    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data"
          action="{{ route('admin.setting.update') }}">
        @csrf

        {{-- REKENING --}}
        <div style="margin-bottom:15px;">
            <label>No Rekening</label><br>
            <input type="text" name="rekening"
                   value="{{ $setting->rekening ?? '' }}"
                   style="width:300px;">
        </div>

        {{-- QRIS --}}
        <div style="margin-bottom:15px;">
            <label>Upload QRIS</label><br>
            <input type="file" name="qris">
        </div>

        {{-- PREVIEW --}}
        @if($setting && $setting->qris)
            <img src="{{ asset('storage/'.$setting->qris) }}"
                 width="150">
        @endif

        <br><br>

        <button type="submit">Simpan</button>

    </form>

</div>

@endsection