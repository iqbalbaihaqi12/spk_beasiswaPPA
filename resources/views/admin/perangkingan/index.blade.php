@extends('layouts.app')
@section('title','Perangkingan')
@section('content')
<div class="card shadow mb-4">

     <!-- Card Header - Accordion -->
            <a href="#listkriteria" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tahap Analisa</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="listkriteria">
               <div class="card-body">
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Alternatif</th> 
                                        <th>NIM</th> 

                                        @foreach($kriteria as $key => $value)
                                            <th>{{ $value ->nama_kriteria}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                               <tbody>
                                @forelse($alternatif as $alt => $valt)
                                    <tr>
                                        <!-- <input type="hidden" value="{{ $valt->id }}" name="alternatif_id[]"> -->
                                        <td>{{ $valt->nama_alternatif}}</td>
                                        <td>{{ $valt->NIM}}</td>
                                        @if(count($valt->penilaian) > 0)
                                                @foreach($valt->penilaian as $key => $value)
                                                <td>
                                                    {{$value->crips->nama_crips}}
                                                </td>
                                                @endforeach
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Tidak Ada Data</td>
                                    </tr>
                                @endforelse    
                               </tbody>
                            </table>
                    </div>
               </div>
            </div>
        </div>

<div class="card shadow mb-4">

     <!-- Card Header - Accordion -->
            <a href="#listkriteria" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tahap Analisa Pembobotan</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="listkriteria">
               <div class="card-body">
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Alternatif</th> 
                                        <th>NIM</th> 

                                        @foreach($kriteria as $key => $value)
                                            <th>{{ $value ->nama_kriteria}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                               <tbody>
                                @forelse($alternatif as $alt => $valt)
                                    <tr>
                                        <!-- <input type="hidden" value="{{ $valt->id }}" name="alternatif_id[]"> -->
                                        <td>{{ $valt->nama_alternatif}}</td>
                                        <td>{{ $valt->NIM}}</td>
                                        @if(count($valt->penilaian) > 0)
                                                @foreach($valt->penilaian as $key => $value)
                                                <td>
                                                    {{$value->crips->bobot}}
                                                </td>
                                                @endforeach
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Tidak Ada Data</td>
                                    </tr>
                                @endforelse    
                               </tbody>
                            </table>
                    </div>
               </div>
            </div>
        </div>

<div class="card shadow mb-4">

     <!-- Card Header - Accordion -->
            <a href="#normalisasi" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tahap Normalisasi</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="normalisasi">
               <div class="card-body">
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Alternatif / Kriteria</th> 
                                        <th>NIM</th> 

                                        @foreach($kriteria as $key => $value)
                                            <th>{{ $value->nama_kriteria}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                               <tbody>
                                @foreach($normalisasi as $key => $value)
                                    <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $valt->NIM}}</td>
                                            @foreach($value as $key_1 => $value_1)
                                                <td>
                                                @foreach($value_1 as $v) 
                                                @php
                                                echo $v;
                                                @endphp
                                                @endforeach

                                                </td>
                                            @endforeach
                                    </tr>
                                @endforeach    
                               </tbody>
                            </table>
                    </div>
               </div>
            </div>
        </div>

<div class="card shadow mb-4">


        <!-- Card Header - Accordion -->
       <a href="#rank" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
           <h6 class="m-0 font-weight-bold text-primary">Tahap Perangkingan</h6>
       </a>
       <!-- Card Content - Collapse -->
       <div class="collapse show" id="rank">
          <div class="card-body">
               <div class="table-responsive">
                       <table class="table">
                           <thead>
                               <tr>
                                   <th>Alternatif / Kriteria</th> 
                                   <th>NIM</th> 

                                   @foreach($kriteria as $key => $value)
                                       <th>{{ $value->nama_kriteria}}</th>
                                   @endforeach
                                        <th rowspan="2" style="text-align:center; padding: bottom 45px;">Total</th>
                                        <th rowspan="2" style="text-align:center; padding: bottom 45px;">Rank</th>

                               </tr>
                           </thead>
                          <tbody>
                            @php
                            $no = 1;
                            @endphp
                           @foreach($rangking as $key => $value)
                               <tr>
                                       <td>{{ $key }}</td>
                                       <td>{{ $valt->NIM}}</td>
                                       @foreach($value as  $key_1 => $value_1)
                                           <td>
                                            @if (!is_array($value_1))
                                            {{ $value_1 }}
                                            @else
                                            @foreach($value_1 as $v)
                                            {{ $v }}
                                            @endforeach
                                            @endif
                                           </td>
                                           
                                       @endforeach
                                       <td>{{$no++}}</td>
                               </tr>
                           @endforeach    
                          </tbody>
                       </table>
               </div>
          </div>
       </div>
   </div>


        @stop