@extends('layouts.app')
@section('title','Alternatif')
@section('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#tambahalternatif" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Alternatif</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="{{ route('alternatif.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama">NIM</label>
                            <input type="text" class="form-control @error ('NIM') is-invalid @enderror" name="NIM" value="{{ old('NIM')}}">
                             <br>
                             <label for="nama">Nama Alternatif</label>
                            <input type="text" class="form-control @error ('nama_alternatif') is-invalid @enderror" name="nama_alternatif" value="{{ old('nama_alternatif ')}}">

                            @error('nama_alternatif')
                            <div class="invalid-feedback" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#listalternatif" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">List Alternatif</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="listalternatif">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="DataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama Alternatif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($alternatif as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{$row->NIM}}</td>
                                    <td>{{$row->nama_alternatif}}</td>
                                    <td class="d-flex">
                                        <a href="{{route('alternatif.edit',$row->id)}}" class="btn btn-sm btn-circle
                                                                btn-warning"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('alternatif.destroy', $row->id)}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-circle btn-danger hapus"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@stop
@section('js')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('js/sweetalert.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#DataTable').DataTable();

        $('table').on('click', '.hapus', function(e) {
            e.preventDefault();
            var form = $(this).parent();

            swal({
                    title: "Apa Kamu Yakin?",
                    text: "Setelah dihapus data tidak dapat dikembalikan",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });

            return false;
        })

    })
</script>
@stop