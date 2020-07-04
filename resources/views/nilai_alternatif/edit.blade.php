@extends('layouts.base')

@section('title', 'Edit Penilaian')

@section('content')
    <div class="right_col" role="main">
      <!-- top tiles -->
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel" style="height: 100px;">
              <div class="x_title">
                  <h2>PENILAIAN</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <i class="fa fa-edit"> PENILAIAN</i>
              </div>
          </div>
      </div>
      <!-- /top tiles -->
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Edit Penilaian <small>Manajemen Penilaian</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_title">
                <h2>Penilaian terhadap : <b>{{ $alternatif->nama }}</b></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                {{-- @if ($errors->has('periode'))
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
                @endif --}}
                <form id="form1" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('penilaian.update', [$periode, $alternatif->id]) }}">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    @foreach ($penilaian as $key => $p)
                      <input type="hidden" name="kriteria[]" value="{{ $p->kriteria_id }}">
                      <input type="hidden" name="penilaian[]" value="{{ $p->id }}">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ $p->nama }} <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="sub_kriteria[]" required="">
                            <option value="">-- Pilih jenis kriteria --</option>
                            @for ($i = 0; $i <count($data[$key]->id) ; $i++)
                              <option value="{{ $data[$key]->id[$i] }}" @if ($p->sub_kriteria_id == $data[$key]->id[$i])
                                selected="" 
                              @endif>{{ $data[$key]->keterangan[$i] }}</option>
                            @endfor
                          </select>
                        </div>
                      </div>
                    @endforeach
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{ route('nilai-alternatif.edit', $periode) }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                    </div>
                  </form>
                </div></div></div></div>
          </div>
@endsection
