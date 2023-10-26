@extends('layouts.gentella')

@section('title')
    Penggajian Pegawai
@endsection

@push('before-script')
    @if (session('status'))
        <x-sweetalertsession tipe="{{ session('tipe') }}" status="{{ session('status') }}" />
    @endif
@endpush


@section('content')
    @push('after-style')
        <link href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <!-- Datatables -->
        <link href="{{ asset('assets/gentella/vendors/') }}/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('assets/gentella/vendors/') }}/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"
            rel="stylesheet">
        <link href="{{ asset('assets/gentella/vendors/') }}/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css"
            rel="stylesheet">
        <link href="{{ asset('assets/gentella/vendors/') }}/datatables.net-responsive-bs/css/responsive.bootstrap.min.css"
            rel="stylesheet">
        <link href="{{ asset('assets/gentella/vendors/') }}/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"
            rel="stylesheet">
    @endpush

    @push('after-script')
        <!-- Datatables -->
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js">
        </script>
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net-responsive/js/dataTables.responsive.min.js">
        </script>
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/jszip/dist/jszip.min.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/pdfmake/build/pdfmake.min.js"></script>
        <script src="{{ asset('assets/gentella/vendors/') }}/pdfmake/build/vfs_fonts.js"></script>
    @endpush
    <!-- page content -->
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>@yield('title')
                </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <form action="{{ route('gajipegawai') }}" method="get" class="d-inline">

                            <input type="month" class="babeng babeng-select  ml-0" name="cari"
                                value="{{ $cari !== null ? $cari : date('Y-m') }}">
                            <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                value="Pilih Bulan">

                            <ul class="nav navbar-right panel_toolbox ">
                        </form>
                        @if ($datas->count() > 0)
                            <form action="{{ route('gajipegawai.generate') }}" method="post" class="d-inline">
                                @csrf
                                <input type="hidden" name="cari" value="{{ $cari }}">
                                <input data-toggle="tooltip" data-placement="top"
                                    title="Data yang sudah di generate akan di skip!" class="btn btn-info ml-1 mt-2 mt-sm-0"
                                    type="submit" id="babeng-submit"
                                    onclick="return  confirm('Anda yakin generate data bulan ini? Y/N')"
                                    data-toggle="tooltip" data-placement="top" value="Generate Gaji">
                            </form>
                            <form action="{{ route('gajipegawai.cetak') }}" method="get" class="d-inline">
                                @csrf
                                <input type="hidden" name="cari" value="{{ $cari }}">
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    onclick="return  confirm('Anda yakin mencetak data bulan ini? Y/N')"
                                    data-toggle="tooltip" data-placement="top" value="Cetak">
                            </form>
                            <a href="{{route('gajipegawai.excel')}}" class="btn btn-info ml-1 mt-2 mt-sm-0">Excel</a>
                        @else
                            <form action="{{ route('gajipegawai.generate') }}" method="post" class="d-inline">
                                @csrf
                                <input type="hidden" name="cari" value="{{ $cari }}">
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    onclick="return  confirm('Anda yakin generate data bulan ini? Y/N')"
                                    data-toggle="tooltip" data-placement="top" value="Generate Gaji">
                            </form>
                        @endif
                        {{-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li> --}}
                        {{-- <li><a class="close-link"><i class="fa fa-close"></i></a> --}}
                        </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">

                                    {{-- <p class="text-muted font-13 m-b-30">
                DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
              </p> --}}
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="babeng-min-row">No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Gaji Pokok</th>
                                                <th data-toggle="tooltip" data-placement="top" title="Kehadiran">Hadir</th>
                                                <th>Honor Pengajaran</th>
                                                <th>Honor Dinas Luar</th>
                                                <th>Honor KBB Rutin</th>
                                                <th>Honor KBB Luar</th>
                                                <th>Honor KP Dan Skripsi</th>
                                                <th>Tunjangan Yayasan</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top"
                                                title="{{ Fungsi::rupiah($getsettingsgaji->tunjab) }}">Tunjagan Jabatan</th>
                                                <th class="text-center" data-toggle="tooltip" data-placement="top"
                                                title="{{ Fungsi::rupiah($getsettingsgaji->makan) }}">Tunjangan Makan</th>
                                                <th data-toggle="tooltip" data-placement="top"
                                                    title="transport * {{ Fungsi::rupiah($getsettingsgaji->transport) }}">
                                                   Tunjangan Transport</th>
                                                <th>Tunjangan Lembur</th>
                                                <th>Tunjangan Fungsional</th>
                                                <th>Potongan Bpjs</th>
                                                <th>Potongan Koperasi</th>
                                                <th>Potongan Pinjaman</th>
                                                <th>Potongan Absensi</th>
                                                <th>Potongan Lain Lain</th>


                                                <th data-toggle="tooltip" data-placement="top"
                                                    title="Total Pendapatan">Jumlah Diterima</th>
                                             
                                                <th class="text-center">Tambahan</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @forelse ($datas as $data)
                                                <tr>
                                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                                    <td>{{ $data->pegawai ? $data->pegawai->nama : 'Data Pegawai tidak ditemukan' }}
                                                    </td>
                                                    <td>
                                                        @if ($data->pegawai)
                                                            @forelse ($data->pegawai->pegawaidetail as $item)
                                                                <button
                                                                    class="btn btn-sm btn-primary">{{ $item->jabatan ? $item->jabatan->nama : '' }}</button>
                                                            @empty
                                                            @endforelse
                                                        @endif
                                                    </td>
                                                    <td>{{ Fungsi::rupiah($data->gajipokok) }}</td>
                                                    {{-- <td>{{ Fungsi::rupiah($data->tunjangankerja) }}</td> --}}
                                                    <td>{{ $data->hadir }}</td>
                                                    <td>{{ Fungsi::rupiah($data->honor_pengajaran) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->honor_dinasluar) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->honor_kbbrutin) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->honor_kbbluar) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->kp_skripsi) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->tun_yayasan) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->tunjab) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->makan * $data->hadir) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->transport * $data->hadir) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->honor_lembur) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->tunfung) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->pot_bpjs) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->pot_koperasi) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->pot_pinjaman) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->pot_absensi) }}</td>
                                                    <td>{{ Fungsi::rupiah($data->pot_lainlain) }}</td>
                                                    @php
                                                        $jumlah = 0;
                                                        $jumlah = $data->gajipokok + $data->tunjab + $data->transport + $data->makan + $data->keluarga * $data->hadir;
                                                    @endphp
                                                    <td>{{ Fungsi::rupiah($jumlah) }}</td>
                                                    {{-- <td class="text-center">
                                                        @php
                                                            $jumlah_diterima = '-';
                                                            $jml_diterima = 0;
                                                            $jml_diterima += +$data->tunjangankerja + $data->transport * $data->hadir + $data->gajipokok * $data->jam;
                                                        @endphp
                                                        {{ Fungsi::rupiah($jml_diterima) }}
                                                    </td> --}}
                                                    <td class="babeng-min-row">
                                                      
                                                        <a href="{{ route('gajipegawai.edit', $data->id) }}"
                                                            class="btn btn-warning btn-sm"data-toggle="tooltip"
                                                            data-placement="top" title="Masukan Honor"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('gajipegawai.potongan', $data->id) }}"
                                                            class="btn btn-secondary btn-sm"data-toggle="tooltip"
                                                            data-placement="top" title="Masukan Potongan"><i class="fas fa-coins"></i></a>
                                                        <a href="{{ route('gajipegawai.absen', $data->id) }}"
                                                            class="btn btn-success btn-sm"data-toggle="tooltip"
                                                            data-placement="top" title="Masukan absen"><i class="fas fa-user"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('gajipegawai.cetakperid', $data->id) }}"
                                                            class="btn btn-info btn-sm"data-toggle="tooltip"
                                                            data-placement="top" title="Cetak PDF"><i
                                                                class="far fa-file-pdf"></i></a>
                                                        <x-button-delete
                                                        link="{{ route('gajipegawai.destroy', $data->id) }}" />
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
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
    </div>
    </div>
    </div>
    </div>
    <!-- /page content -->
@endsection
