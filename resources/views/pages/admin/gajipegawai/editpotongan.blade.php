@extends('layouts.gentella')

@section('title')
Potongan Penggajian Pegawai
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
                        <form  action="{{route('gajipegawai.potupdate',$id->id)}}" method="post" >
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
                                    let pot_koperasi = document.getElementById('pot_koperasi');
                                    pot_koperasi.addEventListener('keyup', function(e){
                                        pot_koperasi.value = babengRupiah(this.value, 'Rp. ');
                                    });
                                    let pot_bpjs = document.getElementById('pot_bpjs');
                                    pot_bpjs.addEventListener('keyup', function(e){
                                        pot_bpjs.value = babengRupiah(this.value, 'Rp. ');
                                    });
                                    let pot_absensi = document.getElementById('pot_absensi');
                                    pot_absensi.addEventListener('keyup', function(e){
                                        pot_absensi.value = babengRupiah(this.value, 'Rp. ');
                                    });
                                    let pot_lainlain = document.getElementById('pot_lainlain');
                                    pot_lainlain.addEventListener('keyup', function(e){
                                        pot_lainlain.value = babengRupiah(this.value, 'Rp. ');
                                    });
                                    let pot_pinjaman = document.getElementById('pot_pinjaman');
                                    pot_pinjaman.addEventListener('keyup', function(e){
                                        pot_pinjaman.value = babengRupiah(this.value, 'Rp. ');
                                    });
                                });
                            </script>
                            <script src="{{asset('/assets/js/babeng.js')}}"></script>
                        @endpush
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align"> BPJS</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control  @error('pot_bpjs') is-invalid @enderror"
                                    name="pot_bpjs" id="pot_bpjs" value="{{old('pot_bpjs')?old('pot_bpjs'):Fungsi::rupiahtanpanol($id->pot_bpjs)}}" />
                                        @error('pot_bpjs')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                </div>
                            </div>


                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Koperasi</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control"
                            name="pot_koperasi" id="pot_koperasi" value="{{old('pot_koperasi')?old('pot_koperasi'):Fungsi::rupiahtanpanol($id->pot_koperasi)}}" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Absensi</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control"
                            name="pot_absensi" id="pot_absensi" value="{{old('pot_absensi')?old('pot_absensi'):Fungsi::rupiahtanpanol($id->pot_absensi)}}"  />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Pinjaman</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control"
                            name="pot_pinjaman" id="pot_pinjaman" value="{{old('pot_pinjaman')?old('pot_pinjaman'):Fungsi::rupiahtanpanol($id->pot_pinjaman)}}"  />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Lain Lain</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control"
                            name="pot_lainlain" id="pot_lainlain" value="{{old('pot_lainlain')?old('pot_lainlain'):Fungsi::rupiahtanpanol($id->pot_lainlain)}}" />
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

@endsection
