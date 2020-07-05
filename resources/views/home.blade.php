@extends('layouts.base')

@section('title', 'Dashboard')

@section('content')
    <div class="right_col" role="main">
    <!-- top tiles -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="height: 100px;">
            <div class="x_title">
                <h2>HOME</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <i class="fa fa-home"> HOME</i>
            </div>
        </div>
    </div>
    <!-- /top tiles -->

    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel fixed_height_320">
          <div class="x_title">
            <a href="{{ route('kriteria.index') }}"><h2>Kriteria</h2></a>
            <ul class="nav navbar-right panel_toolbox">
              <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <table class="" style="width:100%">
            <tbody><tr>
              <th style="width:37%;">
              </th>
              <th>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <p class="pull-left"> </p>
                </div>
              </th>
            </tr>
            <tr>
              <td>
                <a href="#"><img src="https://w7.pngwing.com/pngs/745/105/png-transparent-pencil-and-paper-illustration-ssc-mts-exam-test-computer-icons-educational-entrance-examination-test-paper-miscellaneous-angle-text-thumbnail.png" width="80%"></a>
              </td>
              <td>
                <table class="tile_info">
                  <tbody>
                    @foreach ($kriteria as $key => $k)
                      <tr>
                          <td>
                            <a href="{{ route('kriteria.edit', $k->id) }}"><p>{{ $k->nama }}</p></a>
                          </td>
                      </tr>
                    @endforeach
                </tbody></table>
              </td>
            </tr>
          </tbody></table>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <a href="{{ route('alternatif.index') }}"><h2>Alternatif</h2></a>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table class="" style="width:100%">
                    <tbody><tr>
                      <th style="width:37%;">
                      </th>
                      <th>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                          <p class="">Jenis Kelamin</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm- col-xs-12">
                          <p class="">Jumlah</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <a href="#"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1Rwp5n5Gm33Ec5nna5f4bprvsyCRX5R9EbdWoHGNvW-okYclk" width="80%"></a>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tbody>
                            <tr>
                                <td>
                                  <p>Laki-Laki </p>
                                </td>
                                <td>{{ $laki }}</td>
                            </tr>
                            <tr>
                                <td>
                                  <p>Perempuan</p>
                                </td>
                                <td>{{ $perempuan }}</td>
                            </tr>
                        </tbody></table>
                      </td>
                    </tr>
                  </tbody></table>
                  </div>
                </div>
      </div>
    </div>

    {{-- tabel nilai alternatif --}}
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <a href="{{ route('nilai-alternatif.index') }}"><h2>Data Periode <small>Penilaian WFH</small></h2></a>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($nilaiAlternatif as $key => $na)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>Periode ke-{{ $na->periode }}</td>
                            <td>{{ date('d F Y', strtotime($na->waktu)) }}</td>
                            <td><a href="{{ route('penilaian.proses', $na->id) }}" type="button" class="btn btn-round btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a></td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>

  </div>
@endsection
