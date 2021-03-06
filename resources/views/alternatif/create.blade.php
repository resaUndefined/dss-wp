@extends('layouts.base')

@section('title', 'Tambah Alternatif')

@section('content')
    <div class="right_col" role="main">
      <!-- top tiles -->
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel" style="height: 100px;">
              <div class="x_title">
                  <h2>ALTERNATIF</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <i class="fa fa-group"> ALTERNATIF</i>
              </div>
          </div>
      </div>
      <!-- /top tiles -->
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Tambah Alternatif <small>Manajemen Altenatif</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                @if ($errors->has('nama'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('nama') }}</strong>
                  </div>
                @endif
                @if ($errors->has('jabatan'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('jabatan') }}</strong>
                  </div>
                @endif
                @if ($errors->has('alamat'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('alamat') }}</strong>
                  </div>
                @endif
                @if ($errors->has('gender'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('gender') }}</strong>
                  </div>
                @endif
                @if ($errors->has('ttl'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('ttl') }}</strong>
                  </div>
                @endif
                <form id="add-role" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('alternatif.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nama" name="nama" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="gender" required="">
                          <option value="">-- Pilih jenis kelamin --</option>
                          <option value="1">Laki-Laki</option>
                          <option value="0">Perempuan</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">TTL <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" id="single_cal3" aria-describedby="inputSuccess2Status3" name="ttl">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                    </div>
                  </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="jabatan" required="">
                          <option value="">-- Pilih jabatan --</option>
                          <option value="1">DIV TI</option>
                          <option value="2">Marketing</option>
                          <option value="3">HRD</option>
                          <option value="4">Petugas Kebersihan</option>
                          <option value="5">Petugas Keamanan</option>
                          <option value="6">Quality Assurance</option>
                          <option value="7">Manajer</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea id="alamat" required="required" name="alamat" class="form-control col-md-7 col-xs-12"></textarea>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <a href="{{ route('alternatif.index') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
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
