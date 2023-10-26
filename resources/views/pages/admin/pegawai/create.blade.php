@extends('layouts.gentella')

@section('title')
Pegawai
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
                        <form  action="{{route('pegawai.store')}}" method="post" >
                            @csrf
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">NIK / NIDN<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control  @error('nomerinduk') is-invalid @enderror"
                                        name="nomerinduk" id="nomerinduk"  required="required" value="{{old('nomerinduk')}}"  />
                                        @error('nomerinduk')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Nama<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control  @error('nama') is-invalid @enderror"
                                        name="nama" id="nama"  required="required" value="{{old('nama')}}"  />
                                        @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    console.log('test');
                                    // In your Javascript (external .js resource or <script> tag)
                                        $(document).ready(function() {
                                            $('.js-example-basic-single').select2({
                                                // theme: "classic",
                                                // allowClear: true,
                                                width: "resolve"
                                            });
                                        });
                                });
                               </script>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Jabatan<span
                                                class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <select class="js-example-basic-single form-control-sm @error('jabatan')
                                                is-invalid
                                            @enderror" name="jabatan[]"  style="width: 100%" multiple="multiple" required>
                                                <option disabled  value=""> Pilih Jabatan</option>
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->nama }}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                            
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Tanggal Masuk<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control  @error('tgl_msk') is-invalid @enderror"
                                        name="tgl_msk" id="tgl_msk"  type="date" required="required" value="{{old('tgl_msk')}}"  />
                                        @error('tgl_msk')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Pendidikan Terakhir<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select id="heard" class="form-control @error('jk') is-invalid @enderror" required name="pendidikan">
                                        <option value="" selected disabled>Pilih  ...</option>
                                        <option >SD</option>
                                        <option >SMP</option>
                                        <option >SMA</option>
                                        <option >D1/D2</option>
                                        <option >D3</option>
                                        <option >Sarjana</option>
                                        <option >Magister</option>
                                        <option >Doktor</option>
                                        <option >Profesor</option>
                                    </select>
                                    @error('jk')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Golongan<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select id="heard" class="form-control @error('jk') is-invalid @enderror" required name="gol">
                                        <option value="" selected disabled>Pilih  ...</option>
                                        @foreach ($golongan as $item)
                                            <option value="{{$item->id_golongan}}">{{$item->jenis}}</option>
                                        @endforeach
                                    </select>
                                    @error('jk')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Jadwal Kehadiran<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control  @error('hadir') is-invalid @enderror"
                                        name="hadir" id="hadir"  type="number" min="0" required="required" value="{{old('hadir')}}"  />
                                        @error('hadir')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Maks SKS<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control  @error('hadir') is-invalid @enderror"
                                        name="maks_sks" id="maks_sks"  type="number" min="0" required="required" value="{{old('hadir')}}"  />
                                        @error('hadir')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">No Rekening<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control  @error('hadir') is-invalid @enderror"
                                        name="no_rek" id="no_rek"  type="text" required="required" value="{{old('hadir')}}"  />
                                        @error('hadir')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Bank<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select id="heard" class="form-control @error('bank') is-invalid @enderror" required name="bank">
                                        <option value="" selected disabled>Pilih  ...</option>
                                        <option >Bank Mandiri</option>
                                        <option >Bank BRI</option>
                                        <option >Bank BCA</option>
                                        <option >Bank Muamalat</option>
                                        <option >Bank Nagari</option>
                                        <option >Non Bank</option>
                                    </select>
                                    @error('bank')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Status<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select id="heard" class="form-control @error('sts') is-invalid @enderror" required name="status">
                                        <option value="" selected disabled>Pilih  ...</option>
                                        <option >Menikah</option>
                                        <option >Belum Menikah</option>
                                    </select>
                                    @error('sts')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            @push('before-script')
                            <script>
                                $(function () {
                                    let gajipokok = document.getElementById('gajipokok');
                                    gajipokok.addEventListener('keyup', function(e){
                                        gajipokok.value = babengRupiah(this.value, 'Rp. ');
                                    });
                                    // let tunjangankerja = document.getElementById('tunjangankerja');
                                    // tunjangankerja.addEventListener('keyup', function(e){
                                    //     tunjangankerja.value = babengRupiah(this.value, 'Rp. ');
                                    // });
                                    let kbbrutin = document.getElementById('kbb_rutin');
                                    kbbrutin.addEventListener('keyup', function(e){
                                        kbbrutin.value = babengRupiah(this.value, 'Rp. ');
                                    });
                                    let honorpengajaran = document.getElementById('honor_pengajar');
                                    honorpengajaran.addEventListener('keyup', function(e){
                                        honorpengajaran.value = babengRupiah(this.value, 'Rp. ');
                                    });
                                    let dinasluar = document.getElementById('dinas_luar');
                                    dinasluar.addEventListener('keyup', function(e){
                                        dinasluar.value = babengRupiah(this.value, 'Rp. ');
                                    });
                                    let yayasan = document.getElementById('tun_yayasan');
                                    yayasan.addEventListener('keyup', function(e){
                                        yayasan.value = babengRupiah(this.value, 'Rp. ');
                                    });
                                    let tunfung = document.getElementById('tun_fung');
                                    tunfung.addEventListener('keyup', function(e){
                                        tunfung.value = babengRupiah(this.value, 'Rp. ');
                                    });
                                });
                            </script>
                            <script src="{{asset('/assets/js/babeng.js')}}"></script>
                        @endpush
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Honor Pengajaran<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                        <input class="form-control"
                                            name="honor_pengajar" id="honor_pengajar"  required="required" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Honor KBB Rutin<span
                                        class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control"
                                                name="kbb_rutin" id="kbb_rutin"  required="required" />
                                        </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Honor Dinas Luar<span
                                        class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control"
                                                name="dinas_luar" id="dinas_luar"  required="required" />
                                        </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Tunjangan Yayasan<span
                                        class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control"
                                                name="tun_yayasan" id="tun_yayasan"  required="required" />
                                        </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Tunjangan Fungsional<span
                                        class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control"
                                                name="tun_fung" id="tun_fung"  required="required" />
                                        </div>
                            </div>
<br><br>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Gaji Khusus<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control"
                                        name="gajipokok" id="gajipokok"  required="required" />
                                </div>
                            </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Tunjangan Jabatan<span
                                class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select id="heard" class="form-control @error('tunjangan_jabatan') is-invalid @enderror" required name="tunjangan_jabatan">
                                <option value="" selected disabled>Pilih  ...</option>
                                <option >Ya</option>
                                <option >Tidak</option>
                            </select>
                            @error('simkoperasi')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Tunjangan Makan<span
                                class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select id="heard" class="form-control @error('makan') is-invalid @enderror" required name="makan">
                                <option value="" selected disabled>Pilih  ...</option>
                                <option >Ya</option>
                                <option >Tidak</option>
                            </select>
                            @error('makan')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Tunjangan Keluarga<span
                                class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select id="heard" class="form-control @error('keluarga') is-invalid @enderror" required name="keluarga">
                                <option value="" selected disabled>Pilih  ...</option>
                                <option >Ya</option>
                                <option >Tidak</option>
                            </select>
                            @error('keluarga')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">transport<span
                                class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select id="heard" class="form-control @error('transport') is-invalid @enderror" required name="transport">
                                <option value="" selected disabled>Pilih  ...</option>
                                <option >Ya</option>
                                <option >Tidak</option>
                            </select>
                            @error('transport')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
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
