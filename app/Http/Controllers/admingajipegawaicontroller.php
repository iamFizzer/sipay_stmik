<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\gajipegawai;
use App\Models\jabatan;
use App\Models\pegawai;
use App\Models\pegawaidetail;
use App\Models\settingsgaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use PDF;

class admingajipegawaicontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='pegawai';
        $month = date("m");
        $year = date("Y");
        $cari=$request->cari;
        if($cari){
        $month = date("m",strtotime($cari));
        $year = date("Y",strtotime($cari));
        }
        $datas=gajipegawai::whereMonth('tahunbulan',$month)->whereYear('tahunbulan',$year)->get();

        $getsettingsgaji=settingsgaji::first();
        return view('pages.admin.gajipegawai.index',compact('datas','request','pages','cari','getsettingsgaji'));
    }
    public function generate(Request $request)
    {
        // dd($request);
        $month = date("m");
        $year = date("Y");
        $cari=$request->cari;
        if($cari){
        $month = date("m",strtotime($cari));
        $year = date("Y",strtotime($cari));
        }
        // dd($month);

        // 1.get data from settingsgaji
        $getsettingsgaji=settingsgaji::first();
        // 2.get data from pegawai where id
        $getpegawai=pegawai::get();
        foreach($getpegawai as $pegawai){
            $periksa=gajipegawai::where('pegawai_id',$pegawai->id)
            ->whereMonth('tahunbulan',$month)
            ->whereYear('tahunbulan',$year)
            ->count();
            // dd($periksa,date('m'),date('Y'),$pegawai->id);
            if($periksa<1){
                if($pegawai->transport =='Ya'){
                    $transport=$getsettingsgaji->transport;
                }else{
                    $transport=0;
                }
                if($pegawai->tunjab =='Ya'){
                    $tunjab=$getsettingsgaji->tunjab;
                }else{
                    $tunjab=0;
                }
                if($pegawai->tunmak =='Ya'){
                    $makan=$getsettingsgaji->makan;
                }else{
                    $makan=0;
                }
                if($pegawai->tunkel =='Ya'){
                    $tunkel=$getsettingsgaji->keluarga;
                }else{
                    $tunkel=0;
                }
                if($pegawai->honor_pengajaran > 0){
                    $honorpengajaran=$pegawai->maks_sks * $pegawai->honor_pengajaran ;
                }else{
                    $tunkel=0;
                }
                // if(($pegawai->hadir)>0){
                //     $hadir=$pegawai->hadir;
                //     $transport=$pegawai->hadir*$getsettingsgaji->transport;
                // }else{
                //     $hadir=0;
                //     $transport=0;
                // }


                //insert gajipegawai
                gajipegawai::insert([
                    'pegawai_id'=>$pegawai->id,
                    'tahunbulan'=>$year.'-'.$month.'-01',
                    'gajipokok'=>$pegawai->gapok,
                    'honor_pengajaran'=>0,
                    // 'tunjangankerja'=>$pegawai->tunjangankerja,
                    'hadir'=>$pegawai->hadir,
                    'status'=>'belum',
                    'transport'=>$transport,
                    'makan'=>$makan,
                    'tunjab'=>$tunjab,
                    'tunkel'=>$tunkel,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
            }
        }

        // dd($getsettingsgaji,$getpegawai);

            // $id=DB::table('pegawai')->insertGetId(
            //     array(
            //            'nama'     =>   $request->nama,
            //            'jk'     =>   $request->jk,
            //            'alamat'     =>   $request->alamat,
            //            'nomerinduk'     =>   $request->nomerinduk,
            //            'simkoperasi'     =>   $request->simkoperasi,
            //            'telp'     =>   $request->telp,
            //            'dansos'     =>   $request->dansos,
            //            'gajipokok'     =>   Fungsi::angka($request->gajipokok),
            //            'tunjangankerja'     =>   Fungsi::angka($request->tunjangankerja),
            //            'created_at'=>date("Y-m-d H:i:s"),
            //            'updated_at'=>date("Y-m-d H:i:s")
            //     ));


    return redirect()->back()->with('status','Proses generate gaji berhasil!')->with('tipe','success')->with('icon','fas fa-feather');

    }


    public function cetak(Request $request){
        $month = date("m");
        $year = date("Y");
        $cari=$request->cari;
        if($cari){
        $month = date("m",strtotime($cari));
        $year = date("Y",strtotime($cari));
        }
        $datas=gajipegawai::whereMonth('tahunbulan',$month)->whereYear('tahunbulan',$year)->get();

        $getsettingsgaji=settingsgaji::first();
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.admin.gajipegawai.cetak',compact('datas','getsettingsgaji','tgl','year','month'))->setPaper('a4', 'landscape');
        return $pdf->stream('hrpegawai'.$tgl.'-pdf');
    }

    public function cetakperid(gajipegawai $id,Request $request){
        $month = date("m");
        $year = date("Y");
        $cari=$request->cari;
        if($cari){
        $month = date("m",strtotime($cari));
        $year = date("Y",strtotime($cari));
        }
        $datas=gajipegawai::with('pegawai')
        ->where('id',$id->id)
        // whereMonth('tahunbulan',$month)->whereYear('tahunbulan',$year)
        ->first();
        // dd($datas);
        $getsettingsgaji=settingsgaji::first();
        $tgl=date("YmdHis");
        $pdf = PDF::loadview('pages.admin.gajipegawai.cetakperid',compact('datas','getsettingsgaji','tgl','year','month'))->setPaper('a4', 'landscape');
        return $pdf->stream('hrpegawai'.$tgl.'-pdf');
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='pegawai';
        $datas=pegawai::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.pegawai.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='pegawai';
        $items=jabatan::get();
        return view('pages.admin.pegawai.create',compact('pages','items'));
    }

    public function store(Request $request)
    {
        // dd($request,$request->jabatan[0]);
            $request->validate([
                'nama'=>'required',

            ],
            [
                'nama.require'=>'Nama harus diisi',
            ]);

            $id=DB::table('pegawai')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                       'jk'     =>   $request->jk,
                       'alamat'     =>   $request->alamat,
                       'nomerinduk'     =>   $request->nomerinduk,
                       'simkoperasi'     =>   $request->simkoperasi,
                       'telp'     =>   $request->telp,
                       'dansos'     =>   $request->dansos,
                       'gajipokok'     =>   Fungsi::angka($request->gajipokok),
                       'tunjangankerja'     =>   Fungsi::angka($request->tunjangankerja),
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

            for($i=0;$i<count($request->jabatan);$i++){
                DB::table('pegawaidetail')->insert(
                    array(
                           'pegawai_id'     =>   $id,
                           'jabatan_id'     =>   $request->jabatan[$i],
                           'created_at'=>date("Y-m-d H:i:s"),
                           'updated_at'=>date("Y-m-d H:i:s")
                    ));
            }

    return redirect()->route('pegawai')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(gajipegawai $id)
    {
        $pages='gajipegawai';
        $items=jabatan::get();

        return view('pages.admin.gajipegawai.edit',compact('pages','id','items'));
    }
    public function update(gajipegawai $id,Request $request)
    {

        // dd($request);
        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'name harus diisi',
        ]);

            gajipegawai::where('id',$id->id)
            ->update([
                'honor_pengajaran'     =>   Fungsi::angka($request->honor_pengajaran),
                'honor_dinasluar'     =>   Fungsi::angka($request->dinas_luar),
                'honor_kbbrutin'     =>   Fungsi::angka($request->kbb_rutin),
                'honor_kbbluar'     =>   Fungsi::angka($request->kbb_luar),
                'kp_skripsi'     =>   Fungsi::angka($request->kp_skripsi),
               'updated_at'=>date("Y-m-d H:i:s")
            ]);




    return redirect()->route('gajipegawai')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(gajipegawai $id){

        gajipegawai::destroy($id->id);
        return redirect()->back()->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
    function potongan(gajipegawai $id) {
        $pages='gajipegawai';
        $items=jabatan::get();
        // dd($id);
        return view('pages.admin.gajipegawai.editpotongan',compact('pages','id','items'));
    }
    public function potupdate(gajipegawai $id,Request $request)
    {

        // dd($request);
        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'name harus diisi',
        ]);

            gajipegawai::where('id',$id->id)
            ->update([
                'pot_koperasi'     =>   Fungsi::angka($request->pot_koperasi),
                'pot_bpjs'     =>   Fungsi::angka($request->pot_bpjs),
                'pot_pinjaman'     =>   Fungsi::angka($request->pot_pinjaman),
                'pot_absensi'     =>   Fungsi::angka($request->pot_absensi),
                'pot_lainlain'     =>   Fungsi::angka($request->pot_lainlain),
               'updated_at'=>date("Y-m-d H:i:s")
            ]);

    return redirect()->route('gajipegawai')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    function absen(gajipegawai $id) {
        $pages='gajipegawai';
        $items=jabatan::get();
        // dd($id);
        return view('pages.admin.gajipegawai.editabsen',compact('pages','id','items'));
    }
    public function absenupdate(gajipegawai $id,Request $request)
    {

        // dd($request);
        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'name harus diisi',
        ]);
        $lembur=20000;
            gajipegawai::where('id',$id->id)
            ->update([
                'hadir'     =>   $request->kehadiran,
                'lembur'     =>   $request->lembur,
                'honor_lembur'     =>   Fungsi::angka($request->lembur * $lembur),
               'updated_at'=>date("Y-m-d H:i:s")
            ]);

    return redirect()->route('gajipegawai')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }

    
}
