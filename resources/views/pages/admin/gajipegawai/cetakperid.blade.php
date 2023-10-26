<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop></x-cetak-kop>

    <div style="margin-bottom: 0;text-align:center" id="judul">
        <h2>RINCIAN HR  BULAN  {{strtoupper(Fungsi::bulanindo($month))}} {{$year}}</h2>
        <p for=""></p>
    </div>

    <div id="judul2">
        <h4></h4>
    </div>

    {{-- <center><h2>@yield('title')</h2></center> --}}


    <br>
    <table style="margin-left:100px;padding:10px">
        <tr>
                <td width="50px">Nama</td>
                <td width="10px">:</td>
                <td width="200px">{{$datas->pegawai?$datas->pegawai->nama:'Data tidak ditemukan'}}</td>
                <td width="100px">No Rekening  </td>
                <td width="10px">:</td>
                <td>{{$datas->no_rekening}}</td>
        </tr>
        <tr>
                <td width="50px">Jabatan</td>
                <td width="10px">:</td>
                <td width="200px">{{$datas->jabatan}}</td>
                <td width="100px">Nama Bank  </td>
                <td width="10px">:</td>
                <td>{{$datas->nm_bank}}</td>
        </tr>

    </table>

    <table width="100%" border="1">
    <tr>
        <td>PERINCIAN</td>
        <td>PENDAPATAN</td>
        <td>POTONGAN</td>
        <td>TOTAL</td>
    </tr>
        <tr>
            <td width="100px">1. Gaji Pokok</td>
            <td width="100px">{{Fungsi::rupiah($datas->gajipokok)}}</td>
            <td width="100px">-</td>
            <td width="100px">{{Fungsi::rupiah($datas->gajipokok)}}</td>
            {{-- <td>{{}}</td> --}}
        </tr>

        <tr>
            <td width="100px" colspan="4">2. Tunjangan  </td>
        </tr>
        <tr>
            <td width="100px">a. Yayasan  </td>
            <td width="100px">{{Fungsi::rupiah($datas->tun_yayasan?$datas->pegawai->yayasan:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px">b. Jabatan  </td>
            <td width="100px">{{Fungsi::rupiah($datas->tunjab?$datas->pegawai->tunjab:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px">c. Keluarga  </td>
            <td width="100px">{{Fungsi::rupiah($datas->tunkel?$datas->pegawai->tunkel:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px">d. Makan  </td>
            <td width="100px">{{Fungsi::rupiah($datas->makan?$datas->pegawai->makan:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px">e. Transport  </td>
            <td width="100px">{{Fungsi::rupiah($datas->transport?$datas->pegawai->transport:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px">f. Lembur  </td>
            <td width="100px">{{Fungsi::rupiah($datas->honor_lembur?$datas->pegawai->honor_lembur:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px">g. Fungsional  </td>
            <td width="100px">{{Fungsi::rupiah($datas->tunfung?$datas->pegawai->tunfung:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px" colspan="3">Jumlah Tunjangan  </td>
            <td width="100px">{{Fungsi::rupiah($datas->tun_yayasan+$datas->transport+$datas->makan+$datas->tunkel+$datas->tunjab+$datas->honor_lembur+$datas->tunfung)}} </td>
        </tr>
        <tr>
            <td width="100px" colspan="4">3. Honor  </td>
        </tr>
        <tr>
            <td width="100px">a. Pengajaran  </td>
            <td width="100px">{{Fungsi::rupiah($datas->honor_pengajaran?$datas->pegawai->honor_pengajaran:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px">b. Dinas Luar  </td>
            <td width="100px">{{Fungsi::rupiah($datas->honor_dinasluar?$datas->pegawai->honor_dinasluar:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px">c. KBB Rutin  </td>
            <td width="100px">{{Fungsi::rupiah($datas->honor_kbbrutin?$datas->pegawai->honor_kbbrutin:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px">d. KBB Luar  </td>
            <td width="100px">{{Fungsi::rupiah($datas->honor_kbbluar?$datas->pegawai->honor_kbbluar:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px">e. KP & Skripsi  </td>
            <td width="100px">{{Fungsi::rupiah($datas->kp_skripsi?$datas->pegawai->kp_skripsi:'0')}}  </td>
            <td width="100px"></td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px" colspan="3">Jumlah Honor  </td>
            <td width="100px">{{Fungsi::rupiah($datas->honor_pengajaran+$datas->honor_dinasluar+$datas->honor_kbbrutin+$datas->honor_kbbluar+$datas->kp_skripsi)}} </td>
        </tr>
        <tr>
            <td width="100px">4. Pendapatan Lain Lain  </td>
            <td width="100px">{{Fungsi::rupiah($datas->lain_lain?$datas->pegawai->lain_lain:'0')}} </td>
            <td width="100px"></td>
            <td width="100px">{{Fungsi::rupiah($datas->lain_lain?$datas->pegawai->lain_lain:'0')}} </td>
        </tr>
        <tr>
            <td width="100px" colspan="4">5. Potongan  </td>
        </tr>
        <tr>
            <td width="100px">a. BPJS  </td>
            <td width="100px"></td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_bpjs)}} </td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_bpjs)}} </td>
        </tr>
        <tr>
            <td width="100px">b. Koperasi  </td>
            <td width="100px"></td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_koperasi)}} </td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_koperasi)}} </td>
        </tr>
        <tr>
            <td width="100px">c. Pinjaman  </td>
            <td width="100px"></td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_pinjaman)}} </td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_pinjaman)}} </td>
        </tr>
        <tr>
            <td width="100px">d. Absensi  </td>
            <td width="100px"></td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_absensi)}} </td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_absensi)}} </td>
        </tr>
        <tr>
            <td width="100px">e. Potongan Lain Lain  </td>
            <td width="100px"></td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_lainlain)}} </td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_lainlain)}} </td>
            
        </tr>
        <tr>
            <td width="100px" colspan="3">Jumlah Potongan  </td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_bpjs+$datas->pot_koperasi+$datas->pot_pinjaman+$datas->pot_absensi+$datas->pot_lainlain)}} </td>
        </tr>
        <tr>
            <td width="100px">Total</td>
            <td width="100px">{{Fungsi::rupiah($datas->gajipokok+$datas->tun_yayasan+$datas->transport+$datas->makan+$datas->tunkel+$datas->tunjab+$datas->honor_lembur+$datas->tunfung+$datas->honor_pengajaran+$datas->kbb_dinasluar+$datas->honor_kbbrutin+$datas->honor_kbbluar+$datas->kp_skripsi)}} </td>
            <td width="100px">{{Fungsi::rupiah($datas->pot_bpjs+$datas->pot_koperasi+$datas->pot_pinjaman+$datas->pot_absensi+$datas->pot_lainlain)}} </td>
            <td width="100px"></td>
        </tr>
        <tr>
            <td width="100px" colspan="3">Gaji Bersih</td>
            <td width="100px">{{Fungsi::rupiah($datas->gajipokok+$datas->tun_yayasan+$datas->transport+$datas->makan+$datas->tunkel+$datas->tunjab+$datas->honor_lembur+$datas->tunfung+$datas->honor_pengajaran+$datas->honor_dinasluar+$datas->honor_kbbrutin+$datas->honor_kbbluar+$datas->kp_skripsi)}} </td>
        </tr>
        <tr>
            <td width="100px">Terbilang</td>
            <td width="100px"  colspan="3">Total</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Dibuat Oleh,</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td><u>Linda Aprianti, S.Kom., M.T</u></td>
        </tr>
        <tr>
            <td>Wakil Ketua 2</td>
        </tr>
    </table>



</body>

</html>
