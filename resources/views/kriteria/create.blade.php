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
                @if ($errors->has('nama'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('nama') }}</strong>
                  </div>
                @endif
                @if ($errors->has('kode'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('kode') }}</strong>
                  </div>
                @endif
                @if ($errors->has('jenis'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('jenis') }}</strong>
                  </div>
                @endif
                @if ($errors->has('bobot'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('bobot') }}</strong>
                  </div>
                @endif
                @if ($errors->has('keterangan'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('keterangan') }}</strong>
                  </div>
                @endif
                @if ($errors->has('bobot_sub'))
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ $errors->first('bobot_sub') }}</strong>
                  </div>
                @endif
                <form id="form1" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('kriteria.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="kode" name="kode" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kriteria <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nama" name="nama" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="jenis" required="">
                          <option value="">-- Pilih jenis kriteria --</option>
                          <option value="1">Benefit</option>
                          <option value="0">Cost</option>
                        </select>
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
                  <div class="table-responsive">
                    <div class="x_title">
                        <h2>Tambah Sub Kriteria <small>Manajemen Sub Kriteria</small></h2>
                        <div class="clearfix"></div>
                      </div>
                      <table class="table table-bordered" id="item_table">
                        <tr>
                          <th style="vertical-align: middle;">Keterangan sub kriteria</th>
                          <th style="vertical-align: middle;">Bobot</th>
                          <th style="vertical-align: middle;"><button type="button" name="add" class="add btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
                        </tr>
                        <tr>
                          <td><input type="text" name="sub_kriteria[]" class="form-control item_nominal" required=""></td>
                          <td><input type="number" name="sub_bobot[]" class="form-control item_ket" required=""></td>
                          <td></td>
                        </tr>
                      </table>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{ route('kriteria.index') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      {{-- <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Tambah Sub Kriteria <small>Manajemen Sub Kriteria</small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            {{-- <form id="form1" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('kriteria.store') }}">
                              {{ csrf_field() }}
                               --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
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
