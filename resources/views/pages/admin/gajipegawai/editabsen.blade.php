@extends('layouts.gentella')

@section('title')
Absen Penggajian Pegawai
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
                        <form  action="{{route('gajipegawai.absenupdate',$id->id)}}" method="post" >
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
                     
                        <script src="{{asset('/assets/js/babeng.js')}}"></script>
                    @endpush
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align"> Kehadiran</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control  @error('kehadiran') is-invalid @enderror"
                            name="kehadiran" id="kehadiran"  required="required" value="{{old('kehadiran')?old('kehadiran'):$id->hadir}}" />
                                @error('kehadiran')<div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Lembur</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control"
                            name="lembur" id="lembur"  required="required" value="{{old('lembur')?old('lembur'):$id->lembur}}" />
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
