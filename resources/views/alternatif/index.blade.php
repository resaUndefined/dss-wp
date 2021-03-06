@extends('layouts.base')

@section('title', 'Alternatif')

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
              <!-- <h2>Hover rows <small>Try hovering over the rows</small></h2> -->
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <a href="{{ route('alternatif.create') }}" type="button" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Alternatif</a>
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
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="th-table">No</th>
                    <th class="th-table">Nama</th>
                    <th class="th-table">Jenis Kelamin</th>
                    <th class="th-table">Jabatan</th>
                    <th class="th-table">Umur</th>
                    <th class="th-table">Action</th>
                  </tr>
                </thead>
                @if (count($alternatif) > 0)
                  <tbody>
                    @foreach ($alternatif as $key => $al)
                      <tr>
                        <th scope="row" class="col-md-1">{{ $alternatif->firstItem() + $key }}</th>
                        <td>{{ $al->nama }}</td>
                        <td>{{ $al->gender }}</td>
                        <td>{{ $al->jabatan }}</td>
                        <td>{{ $al->ttl }} tahun</td>
                        <td class="col-md-2">
                          <a href="{{ route('alternatif.edit', $al->id) }}" type="button" class="btn btn-round btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                          <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$al->id}})" 
                              data-target="#DeleteModal" class="btn btn-round btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                @endif
              </table>

              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div>Menampilkan {{ $alternatif->firstItem() }} sampai {{ $alternatif->lastItem() }} dari total {{ $alternatif->total() }} data</div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 pull-right">
                  <div style="margin-top: -25px; margin-bottom: -15px;" class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                      {{ $alternatif->links() }}
                    </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
  </div>
  <div id="DeleteModal" class="modal fade text-danger" role="dialog">
   <div class="modal-dialog ">
     <!-- Modal content-->
     <form action="" id="deleteForm" method="post">
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
             </div>
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{ method_field('DELETE') }}
                 <p class="text-center">Apa kamu yakin ingin menghapus alternatif ini ?</p>
             </div>
             <div class="modal-footer">
                 <center>
                     <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                     <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Ya, Hapus</button>
                 </center>
             </div>
         </div>
     </form>
   </div>
  </div>
<script>
  function deleteData(id){
       var id = id;
       var url = '{{ route("alternatif.destroy", ":id") }}';
       url = url.replace(':id', id);
       $("#deleteForm").attr('action', url);
     }
    function formSubmit(){
         $("#deleteForm").submit();
    }
  </script>
@endsection
