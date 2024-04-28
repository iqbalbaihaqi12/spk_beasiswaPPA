@extends('layouts.app')
@section('title','Kriteria')
@section('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Kriteria</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                @if(Session::has('msg'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Info</strong>{{Session::get('msg')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <form action="{{ route('kriteria.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Kriteria</label>
                            <input type="text" class="form-control @error ('nama_kriteria') is-invalid @enderror" name="nama_kriteria">

                            @error('nama_kriteria')
                            <div class="invalid-feedback" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="atribut">Atribut Kriteria</label>
                            <select name="atribut" id="" class="form-control" required>
                                <option>Benefit</option>
                                <option>Cost</option>
                            </select>

                            @error('atribut')
                            <div class="invalid-feedback" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bobot">Bobot</label>
                            <input type="text" class="form-control @error ('bobot') is-invalid @enderror" name="bobot">

                            @error('bobot')
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
            <a href="#listkriteria" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">List Kriteria</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="listkriteria">
               <div class="card-body"> 
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="DataTable">
                            <thead>
                             <tr>
                                <th>No</th>
                                <th>Nama Kriteria</th>
                                <th>Atribut</th>
                                <th>Bobot</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($kriteria as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{$row->nama_kriteria}}</td>
                                <td>{{$row->atribut}}</td>
                                <td>{{$row->bobot}}</td>
                                <td class="d-flex">
                                    <a href="{{route('kriteria.show',$row->id)}}" class="btn btn-sm btn-circle
                                                                btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('kriteria.edit',$row->id)}}" class="btn btn-sm btn-circle
                                                                btn-warning"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('kriteria.destroy', $row->id)}}" method="post">
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