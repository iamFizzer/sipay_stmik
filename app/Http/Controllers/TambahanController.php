<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GajiBulananExport;


class TambahanController extends Controller
{
    public function excel() 
    {
        $gaji = new GajiBulananExport();
        return Excel::download($gaji, 'invoices.xlsx');
    }
}
