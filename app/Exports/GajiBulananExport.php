<?php

namespace App\Exports;

use App\Models\gajipegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GajiBulananExport implements FromView
{
    public function view(): View
    {
        return view('pages.admin.gajipegawai.exportexcell', [
            'datas' => gajipegawai::all()
        ]);
    }
}
