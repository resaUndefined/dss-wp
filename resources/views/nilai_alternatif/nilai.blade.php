@extends('layouts.base')

@section('title', 'Hasil Penilaian')

@section('content')
<script src="https://raw.githubusercontent.com/nnnick/Chart.js/master/dist/Chart.bundle.js"></script>
<script>
    var year = <?php echo $label; ?>;
    console.log(year);
    var data_click = <?php echo $dataset; ?>;

    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Alternatif',
            color: "rgb(255, 99, 132)",
            backgroundColor: "rgb(255, 99, 132)",
            data: data_click
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Grafik Hasil Penilaian'
                }
            }
        });
    };
</script>
    <div class="right_col" role="main">
      <!-- top tiles -->
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel" style="height: 100px;">
              <div class="x_title">
                  <h2>HASIL PENILAIAN</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <i class="fa fa-edit"> HASIL PENILAIAN</i>
              </div>
          </div>
      </div>
      <!-- /top tiles -->
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            {{-- content 1 --}}
            <div class="x_panel">
              <div class="x_title">
                <h2>Hasil Penilaian Periode ke - {{ $periodeData->periode }} <small>Manajemen Hasil Penilaian</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_title">
                <h2>Data Kriteria</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered" id="item_table">
                      <tr>
                        <th style="vertical-align: middle;text-align: center;">Kode</th>
                        <th style="vertical-align: middle;text-align: center;">Kriteria</th>
                        <th style="vertical-align: middle;text-align: center;">Bobot Kriteria</th>
                        <th style="vertical-align: middle;text-align: center;">Jenis Kriteria</th>
                        {{-- @foreach ($kriteria as $k)
                          <th style="vertical-align: middle;text-align: center;">{{ $k->nama }}</th>
                        @endforeach
                        <th style="vertical-align: middle;text-align: center;">Aksi</th> --}}
                      </tr>
                      @foreach ($kriteria as $key => $s)
                        <tr>
                          <td style="text-align: center;">{{ $s->kode }}</td>
                          <td>{{ $s->nama }}</td>
                          <td style="text-align: center;">{{ $s->bobot }}</td>
                          @if ($s->jenis == 1)
                            <td style="text-align: center;">Benefit</td>
                          @else
                            <td style="text-align: center;">Cost</td>
                          @endif
                        </tr>
                      @endforeach
                    </table>
                  </div>
              </div>
            </div>
            {{-- end content 1 --}}
            {{-- content 2 --}}
            <div class="x_panel">
              <div class="x_title">
                <h2>Data Rating Kecocokan</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered" id="item_table">
                      <tr>
                        <th style="vertical-align: middle;text-align: center;">Alternatif</th>
                        @foreach ($kriteria as $key => $k)
                          <th style="vertical-align: middle;text-align: center;">{{ $k->nama }} ({{ $k->kode }})</th>
                        @endforeach
                      </tr>
                      @foreach ($step2 as $key => $s)
                        <tr>
                          <td style="text-align: center;">{{ $s->alternatif_nama }}</td>
                          @for ($i = 0; $i <count($kriteria) ; $i++)
                            <td style="text-align: center;">{{ $s->sub_bobot[$i] }}</td>
                          @endfor
                        </tr>
                      @endforeach
                    </table>
                  </div>
              </div>
            </div>
            {{-- end content 2 --}}
            {{-- content 3 --}}
            <div class="x_panel">
              <div class="x_title">
                <h2>Normalisasi bobot kriteria</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered" id="item_table">
                      <tr>
                        <th style="vertical-align: middle;text-align: center;">No</th>
                        <th style="vertical-align: middle;text-align: center;">Kode Kriteria</th>
                        <th style="vertical-align: middle;text-align: center;">Bobot Kriteria</th>
                        <th style="vertical-align: middle;text-align: center;">Normalisasi Bobot</th>
                        <th style="vertical-align: middle;text-align: center;">Bobot Ternormalisasi</th>
                      </tr>
                      @foreach ($kriteria as $key => $k)
                        <tr>
                          <td style="text-align: center;">{{ $key+1 }}</td>
                          <td style="text-align: center;">{{ $k->kode }}</td>
                          <td style="text-align: center;">{{ $k->bobot }}</td>
                          <td style="text-align: center;">{{ $k->bobot }} / {{ $jumBobot }}</td>
                          <td style="text-align: center;">{{ $step1[$k->kode] }}</td>
                        </tr>
                      @endforeach
                      <tr>
                        <td style="text-align: center;" colspan="2"><b>Total</b></td>
                        <td style="text-align: center;"><b>{{ $jumBobot }}</b></td>
                        <td style="text-align: center;"></td>
                        <td style="text-align: center;"></td>
                      </tr>
                    </table>
                  </div>
              </div>
            </div>
            {{-- end content 3 --}}
            {{-- content 4 --}}
            <div class="x_panel">
              <div class="x_title">
                <h2>Nilai Vector S pada setiap alternatif</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered" id="item_table">
                      <tr>
                        <th style="vertical-align: middle;text-align: center;">No</th>
                        <th style="vertical-align: middle;text-align: center;">Alternatif</th>
                        <th style="vertical-align: middle;text-align: center;">Perhitungan</th>
                        <th style="vertical-align: middle;text-align: center;">Nilai Preferensi</th>
                      </tr>
                      @foreach ($step3 as $key => $k)
                        <tr>
                          <td style="text-align: center;">{{ $key+1 }}</td>
                          <td style="text-align: center;">{{ $k->alternatif }}</td>
                          <td style="text-align: center;">{{ $k->perhitungan }}</td>
                          <td style="text-align: center;">{{ $k->nilai }}</td>
                        </tr>
                      @endforeach
                      <tr>
                        <td style="text-align: center;" colspan="3"><b>Total</b></td>
                        <td style="text-align: center;"><b>{{ $jumVectorS }}</b></td>
                      </tr>
                    </table>
                  </div>
              </div>
            </div>
            {{-- end content 4 --}}
            {{-- content 5 --}}
            <div class="x_panel">
              <div class="x_title">
                <h2>Nilai Vector V pada setiap alternatif</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered" id="item_table">
                      <tr>
                        <th style="vertical-align: middle;text-align: center;">No</th>
                        <th style="vertical-align: middle;text-align: center;">Alternatif</th>
                        <th style="vertical-align: middle;text-align: center;">Perhitungan</th>
                        <th style="vertical-align: middle;text-align: center;">Nilai Preferensi</th>
                      </tr>
                      @foreach ($step4 as $key => $k)
                        <tr>
                          <td style="text-align: center;">{{ $key+1 }}</td>
                          <td style="text-align: center;">{{ $k->alternatif }}</td>
                          <td style="text-align: center;">{{ $k->perhitungan }}</td>
                          <td style="text-align: center;">{{ $k->nilai }}</td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
              </div>
            </div>
            {{-- end content 5 --}}
            {{-- content 6 --}}
            <div class="x_panel">
              <div class="x_title">
                <h2>Perangkingan dan menurutkan nilai Vector V dari yang terbesar ke terkecil</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered" id="item_table">
                      <tr>
                        <th style="vertical-align: middle;text-align: center;">No</th>
                        <th style="vertical-align: middle;text-align: center;">Alternatif</th>
                        <th style="vertical-align: middle;text-align: center;">Nilai Preferensi</th>
                      </tr>
                      @foreach ($ranking as $key => $k)
                        <tr>
                          <td style="text-align: center;">{{ $key+1 }}</td>
                          <td style="text-align: center;">{{ $k->alternatif }}</td>
                          <td style="text-align: center;">{{ $k->nilai }}</td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
              </div>
            </div>
            {{-- end content 6 --}}
            {{-- content 7 --}}
            <div class="x_panel">
              <div class="x_title">
                <h2>Grafik Hasil Penilaian</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="table-responsive">
                  <canvas id="canvas" height="280" width="600"></canvas>
                  </div>
              </div>
            </div>
            {{-- end content 7 --}}
          </div>
        </div>
      </div>
@endsection
