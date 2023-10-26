<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Bulanan </title>
</head>
<body>
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
                <th>Tunjagan Jabatan</th>
                <th>Tunjangan Makan</th>
                <th>Tunjangan Transport</th>
                <th>Tunjangan Lembur</th>
                <th>Tunjangan Fungsional</th>
                <th>Potongan Bpjs</th>
                <th>Potongan Koperasi</th>
                <th>Potongan Pinjaman</th>
                <th>Potongan Absensi</th>
                <th>Potongan Lain Lain</th>


                <th data-toggle="tooltip" data-placement="top"
                    title="Total Pendapatan">Jumlah Diterima</th>
             
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
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    
</body>
</html>