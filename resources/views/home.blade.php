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
            <a href="#"><h2>Kriteria</h2></a>
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
                  <p class="">Kriteria</p>
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
                    <tr>
                        <td>
                          <p>Laki-Laki </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          <p>Laki-Laki </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          <p>Laki-Laki </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          <p>Laki-Laki </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          <p>Laki-Laki </p>
                        </td>
                    </tr>
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
                    <a href="#"><h2>Alternatif</h2></a>
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
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>
                                  <p>Perempuan</p>
                                </td>
                                <td>5</td>
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
                <h2>Data Periode <small>Penilaian WFH</small></h2>
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
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>

  </div>
@endsection
