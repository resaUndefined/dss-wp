@extends('layouts.base')

@section('title', 'Lihat Nilai Alternatif')

@section('content')
    <div class="right_col" role="main">
      <!-- top tiles -->
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel" style="height: 100px;">
              <div class="x_title">
                  <h2>NILAI ALTERNATIF</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <i class="fa fa-edit"> NILAI ALTERNATIF</i>
              </div>
          </div>
      </div>
      <!-- /top tiles -->
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Lihat/Edit Nilai Alternatif <small>Manajemen Nilai Alternatif</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                @if ($errors->has('periode'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('periode') }}</strong>
                  </div>
                @endif
                @if ($errors->has('waktu'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('waktu') }}</strong>
                  </div>
                @endif
                <form id="form1" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('nilai-alternatif.update', $nilaiAlternatif->id) }}">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Periode <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="periode" name="periode" required="required" class="form-control col-md-7 col-xs-12" value="{{ $nilaiAlternatif->periode }}">
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status3" name="waktu" value="{{ $nilaiAlternatif->waktu }}">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{ route('nilai-alternatif.index') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                    </div>
                  </form>
                </div></div></div></div>
                <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>List Penilaian <small>Manajemen Penilaian</small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="item_table">
                                  <tr>
                                    <th style="vertical-align: middle;text-align: center;">Alternatif</th>
                                    @foreach ($kriteria as $k)
                                      <th style="vertical-align: middle;text-align: center;">{{ $k->nama }}</th>
                                    @endforeach
                                    <th style="vertical-align: middle;text-align: center;">Aksi</th>
                                  </tr>
                                  @foreach ($data as $key => $sk)
                                    <tr>
                                      <td style="text-align: center;">{{ $sk->nama }}</td>
                                      @foreach ($kriteria as $key2 =>$k)
                                        <td style="text-align: center;">{{ $data[$key]->sub_kriteria[$key2] }}</td>
                                      @endforeach
                                      <td style="vertical-align: middle;text-align: center;">
                                          <a href="{{ route('penilaian.edit', [$nilaiAlternatif->id, $sk->id]) }}" type="button" class="btn btn-round btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                      </td>
                                    </tr>
                                  @endforeach
                                </table>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  <script>
      // $('.add').on('click', add);
      // $('.remove').on('click', remove);
      
      $(document).ready(function(){
        $(document).on('click', '.add', function() {
          var html = '';
          html += '<tr>';
          html += '<td><input type="text" name="sub_kriteria[]" class="form-control item_nominal" required=""></td>';
          html += '<td><input type="number" name="sub_bobot[]" class="form-control item_ket" required=""></td>';
          html += '<td><button type="button" name="remove" class="remove btn btn-round btn-danger btn-sm"><i class="fa fa-minus"></i></button></td></tr>';
          $('#item_table').append(html);
        });

        $(document).on('click', '.remove', function(){
          $(this).closest('tr').remove();
        });
      });
    </script>
@endsection
