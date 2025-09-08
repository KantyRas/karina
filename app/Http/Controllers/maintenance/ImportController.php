<?php

namespace App\Http\Controllers\maintenance;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportArticleRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ArticleImport;

class ImportController extends Controller
{
    public function importAction(ImportArticleRequest $request) {

        Excel::import(new ArticleImport, $request->file('file'));

        return back()->with('success', 'Importation réussie !');
    }
}
