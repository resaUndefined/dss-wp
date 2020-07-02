@extends('layouts.base')

@section('title', 'Tambah Sub Kriteria')

@section('content')
    <div class="right_col" role="main">
      <!-- top tiles -->
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel" style="height: 100px;">
              <div class="x_title">
                  <h2>SUB KRITERIA</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <i class="fa fa-edit"> SUB KRITERIA</i>
              </div>
          </div>
      </div>
      <!-- /top tiles -->
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Tambah Sub Kriteria <small>Manajemen Sub Kriteria</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                @if ($errors->has('keterangan'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('keterangan') }}</strong>
                  </div>
                @endif
                @if ($errors->has('bobot'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('bobot') }}</strong>
                  </div>
                @endif
                <form id="form1" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('subkriteria.save') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="kriteria_id" value="{{ $idKriteria }}">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="keterangan" name="keterangan" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Bobot <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="bobot" name="bobot" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{ route('kriteria.edit', $idKriteria) }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
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
                            <h2>List Sub Kriteria yang sudah ditambahkan</h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="item_table">
                                  <tr>
                                    <th style="vertical-align: middle;width: 5%;text-align: center;">No</th>
                                    <th style="vertical-align: middle;width: 45%;text-align: center;">Keterangan</th>
                                    <th style="vertical-align: middle;width: 20%;text-align: center;">Bobot</th>
                                  </tr>
                                  @foreach ($subKriteria as $key => $sk)
                                    <tr>
                                      <td style="text-align: center;">{{ $key + 1 }}</td>
                                      <td style="text-align: center;">{{ $sk->keterangan }}</td>
                                      <td style="text-align: center;">{{ $sk->bobot }}</td>
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
@endsection
