@extends('layouts.app')
@section('title','Edit', $alternatif->nama_alternatif)
@section('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@section('content') 
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
             <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Alternatif {{$alternatif->nama_alternatif}}</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                        <form action="{{ route('alternatif.update', $alternatif->id)}}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="nama">NIM</label>
                                                <input type="text" class="form-control @error ('NIM') is-invalid @enderror"
                                                name="NIM" value="{{ $alternatif->NIM }}">

                                                <label for="nama">Nama alternatif</label>
                                                <input type="text" class="form-control @error ('nama_alternatif') is-invalid @enderror"
                                                name="nama_alternatif" value="{{ $alternatif->nama_alternatif }}">

                                                @error('nama_alternatif')
                                                <div class="invalid-feedback" role="alert">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <button class="btn btn-sm btn-primary">Simpan</button>
                                            <a href="{{ route('alternatif.index')}}" class="btn btn-sm btn-success">Kembali</a>
                                        </form>
                                    </div>
                                </div>
                            </div>

        </div>
    </div>
@stop