<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pegawai extends Model
{
        public $table = "pegawai";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nomerinduk',
            'nama',
            'tgl_msk',
            'pendidikan',
            'golongan',
            'maks_sks',
            'no_rekening',
            'nm_bank',
            'sts',
            'honor_pengajaran',
            'kbb_rutin',
            'dinas_luar',
            'yayasan',
            'tun_fung',
            'gapok',
            'tunjab',
            'tunmak',
            'tunkel',
            'transport',
            'hadir', //harus hadir /jadwal kehadiran
        ];

        function pegawaidetail()
        {
            return $this->hasMany('App\Models\pegawaidetail');
        }

}
