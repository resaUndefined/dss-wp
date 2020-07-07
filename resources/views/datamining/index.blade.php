@extends('layouts.base')

@section('title', 'Data Mining')

@section('content')
    <div class="right_col" role="main">
    <!-- top tiles -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="height: 100px;">
            <div class="x_title">
                <h2>DATA MINING</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <i class="fa fa-bar-flask"> DATA MINING</i>
            </div>
        </div>
    </div>
    <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <!-- <h2>Hover rows <small>Try hovering over the rows</small></h2> -->
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <a href="#" type="button" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data Mining</a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  @if(Session::has('sukses'))
                    <div class="alert alert-success alert-dismissible fade in">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Success!</strong> {{ Session::get('sukses') }}
                    </div>
                  @endif
                  @if(Session::has('gagal'))
                    <div class="alert alert-warning alert-dismissible fade in">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Gagal!</strong> {{ Session::get('gagal') }}
                    </div>
                  @endif
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="col-lg-4 col-md-4 col-sm-12 pull-left">
                  <a href="{{ route('datamining.usia', ['type'=>'xls']) }}" type="button" class="btn btn-round btn-success btn-sm pull-right"><i class="fa fa-download"></i> Export Data Umur as xls</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <a href="{{ route('datamining.usia', ['type'=>'xlsx']) }}" type="button" class="btn btn-round btn-success btn-sm pull-right"><i class="fa fa-download"></i> Export Data Umur as xlsx</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <a href="{{ route('datamining.usia', ['type'=>'csv']) }}" type="button" class="btn btn-round btn-success btn-sm pull-right"><i class="fa fa-download"></i> Export Data Umur as csv</a>
                </div>
              </div>
              <hr/><br/>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="th-table" style="width: 5%;text-align: center;">No</th>
                    <th class="th-table" style="width: 20%;text-align: center;">Jenis Kelamin</th>
                    <th class="th-table" style="width: 25%;text-align: center;">Usia</th>
                  </tr>
                </thead>
                @if (count($datamining) > 0)
                  <tbody>
                    @foreach ($datamining as $key => $na)
                      <tr>
                        <th scope="row" class="col-md-1" style="text-align: center;">{{ $datamining->firstItem() + $key }}</th>
                        <td style="text-align: center;">{{ $na->gender }}</td>
                        <td style="text-align: center;">{{ $na->umur }} tahun</td>
                      </tr>
                    @endforeach
                  </tbody>
                @endif
              </table>

              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div>Menampilkan {{ $datamining->firstItem() }} sampai {{ $datamining->lastItem() }} dari total {{ $datamining->total() }} data</div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 pull-right">
                  <div style="margin-top: -25px; margin-bottom: -15px;" class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                      {{ $datamining->links() }}
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="clearfix"></div>
                <br><hr>
              </div>
              {{-- batas umur --}}
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="col-lg-4 col-md-4 col-sm-12 pull-left">
                  <a href="{{ route('datamining.riwayat', ['type'=>'xls']) }}" type="button" class="btn btn-round btn-success btn-sm pull-right"><i class="fa fa-download"></i> Export Riwayat Penyakit as xls</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <a href="{{ route('datamining.riwayat', ['type'=>'xlsx']) }}" type="button" class="btn btn-round btn-success btn-sm pull-right"><i class="fa fa-download"></i> Export Riwayat Penyakit as xlsx</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <a href="{{ route('datamining.riwayat', ['type'=>'csv']) }}" type="button" class="btn btn-round btn-success btn-sm pull-right"><i class="fa fa-download"></i> Export Riwayat Penyakit as csv</a>
                </div>
              </div>
              <hr><br>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="th-table" style="width: 5%;text-align: center;">No</th>
                    <th class="th-table" style="width: 20%;text-align: center;">Riwayat Penyakit</th>
                    <th class="th-table" style="width: 25%;text-align: center;">kasus</th>
                  </tr>
                </thead>
                @if (count($riwayat) > 0)
                  <tbody>
                    @foreach ($riwayat as $key => $r)
                      <tr>
                        <th scope="row" class="col-md-1" style="text-align: center;">{{ $riwayat->firstItem() + $key }}</th>
                        <td style="text-align: center;">{{ $r->penyakit }}</td>
                        <td style="text-align: center;">{{ $r->kasus }} pasien</td>
                      </tr>
                    @endforeach
                  </tbody>
                @endif
              </table>

              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div>Menampilkan {{ $riwayat->firstItem() }} sampai {{ $riwayat->lastItem() }} dari total {{ $riwayat->total() }} data</div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 pull-right">
                  <div style="margin-top: -25px; margin-bottom: -15px;" class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                      {{ $riwayat->links() }}
                    </div>
                </div>
              </div>
              {{-- batas riwayat penyakit --}}
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection