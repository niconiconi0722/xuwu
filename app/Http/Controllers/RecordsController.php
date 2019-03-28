<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;

class RecordsController extends Controller
{
    public function index()
    {
        $record = new Record();
        $records = $record->paginate(22);

        return view('records.index', compact('records'));
    }
}