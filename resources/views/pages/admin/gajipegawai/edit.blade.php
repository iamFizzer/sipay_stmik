@extends('layouts.gentella')

@section('title')
Penggajian Pegawai
@endsection

@push('before-script')
@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}" />
@endif
@endpush


@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                {{-- <h3>@yield('title')</h3> --}}
            </div>
            {{-- <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>@yield('title')</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            {{-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li> --}}
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form  action="{{route('gajipegawai.update',$id->id)}}" method="post" >
                            @method('put')
                            @csrf
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Nama<span
                                        class="required"></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control"
                                        name="nama" id="nama"   value="{{old('nama')?old('nama'):$id->pegawai->nama}}" readonly />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Nomerinduk<span
                                        class="required"></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control  @error('nomerinduk') is-invalid @enderror"
                                    name="nomerinduk" id="nomerinduk"   value="{{old('nomerinduk')?old('nomerinduk'):$id->pegawai->nomerinduk}}" readonly/>
                                        @error('nomerinduk')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                </div>
                            </div>
                         

                        @push('before-script')
                        <script>
                            $(function () {
                                let dinas_luar = document.getElementById('dinas_luar');
                                dinas_luar.addEventListener('keyup', function(e){
                                    dinas_luar.value = babengRupiah(this.value, 'Rp. ');
                                });
                                let honor_pengajaran = document.getElementById('honor_pengajaran');
                                honor_pengajaran.addEventListener('keyup', function(e){
                                    honor_pengajaran.value = babengRupiah(this.value, 'Rp. ');
                                });
                                let kbb_rutin = document.getElementById('kbb_rutin');
                                kbb_rutin.addEventListener('keyup', function(e){
                                    kbb_rutin.value = babengRupiah(this.value, 'Rp. ');
                                });
                                let kbb_luar = document.getElementById('kbb_luar');
                                kbb_luar.addEventListener('keyup', function(e){
                                    kbb_luar.value = babengRupiah(this.value, 'Rp. ');
                                });
                                let kp_skripsi = document.getElementById('kp_skripsi');
                                kp_skripsi.addEventListener('keyup', function(e){
                                    kp_skripsi.value = babengRupiah(this.value, 'Rp. ');
                                });
                            });
                        </script>
                        <script src="{{asset('/assets/js/babeng.js')}}"></script>
                    @endpush
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align"> Pengajaran</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control  @error('honor_pengajaran') is-invalid @enderror"
                            name="honor_pengajaran" id="honor_pengajaran"  required="required" value="{{old('honor_pengajaran')?old('honor_pengajaran'):$id->honor_pengajaran}}" />
                                @error('honor_pengajaran')<div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Dinas Luar</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control"
                            name="dinas_luar" id="dinas_luar"  required="required" value="{{old('dinas_luar')?old('dinas_luar'):Fungsi::rupiahtanpanol($id->honor_dinasluar)}}" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">KBB Rutin</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control"
                            name="kbb_rutin" id="kbb_rutin"  required="required" value="{{old('kbb_rutin')?old('kbb_rutin'):Fungsi::rupiahtanpanol($id->honor_kbbrutin)}}" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">KBB Luar</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control"
                            name="kbb_luar" id="kbb_luar"  required="required" value="{{old('kbb_luar')?old('kbb_luar'):Fungsi::rupiahtanpanol($id->honor_kbbluar)}}" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">KP dan SKRIPSI</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control"
                            name="kp_skripsi" id="kp_skripsi"  required="required" value="{{old('kp_skripsi')?old('kp_skripsi'):Fungsi::rupiahtanpanol($id->kp_skripsi)}}" />
                        </div>
                    </div>
                           
                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type='submit' class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
