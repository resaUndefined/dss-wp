@extends('layouts.base')

@section('title', 'Tambah Kriteria')

@section('content')
    <div class="right_col" role="main">
      <!-- top tiles -->
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel" style="height: 100px;">
              <div class="x_title">
                  <h2>KRITERIA</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <i class="fa fa-edit"> KRITERIA</i>
              </div>
          </div>
      </div>
      <!-- /top tiles -->
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Tambah Kriteria <small>Manajemen Kriteria</small></h2>
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
                <form id="form1" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('nilai-alternatif.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Periode <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="periode" name="periode" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" id="single_cal3" aria-describedby="inputSuccess2Status3" name="tanggal">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                      </div>
                    </div>
                  <div class="ln_solid"></div>
                  <div class="table-responsive">
                    <div class="x_title">
                        <h2>Tambah Penilaian <small>Manajemen Penilaian</small></h2>
                        <div class="clearfix"></div>
                      </div>
                      <table class="table table-bordered" id="item_table">
                        <tr>
                          <th style="vertical-align: middle;text-align: center;">Alternatif</th>
                          @foreach ($kriteria as $k)
                            <th style="vertical-align: middle;text-align: center;">{{ $k->nama }}</th>
                          @endforeach
                        </tr>
                        @foreach ($alternatif as $key => $al)
                            <tr>
                              <td><input type="hidden" name="alternatif[]" value="{{ $al->id }}"><input type="text" name="nama_alternatif[]" class="form-control item_nominal" required="" value="{{ $al->nama }}" disabled=""></td>
                              @foreach ($dataSubKriteria as $kunci => $data)
                              <input type="hidden" name="{{ $data->kode }}[]" value="{{ $data->id }}">
                                <td>
                                  <select class="form-control" name="sub_{{ $data->kode }}[]" required="">
                                    <option value="">-- Pilih jenis kriteria --</option>
                                    @for ($i = 0; $i <count($data->keterangan) ; $i++)
                                      <option value="{{ $data->sub_id[$i] }}">{{ $data->keterangan[$i] }}</option>
                                    @endfor
                                  </select></td>
                              @endforeach
                            </tr>
                        @endforeach
                      </table>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12 pull-right">
                        <a href="{{ route('nilai-alternatif.index') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection