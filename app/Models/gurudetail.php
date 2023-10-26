<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gurudetail extends Model
{
        public $table = "gurudetail";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'guru_id',
            'jabatan_id',
        ];

        public function guru()
        {
            return $this->belongsTo('App\Models\guru');
        }

        public function jabatan()
        {
            return $this->belongsTo('App\Models\jabatan');
        }
}
