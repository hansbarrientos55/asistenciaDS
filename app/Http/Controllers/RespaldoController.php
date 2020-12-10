<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Alert;
use Artisan;
use Carbon\Carbon;
use Log;
use Spatie\Backup\Helpers\Format;
use Storage;


class RespaldoController extends Controller
{
    
    public function index()
    {
        return view("respaldo.index");
    }

    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run', ['--only-files' => 'true']);
            //Artisan::call('backup:run');
            $output = Artisan::output();
            //dd($output);
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            //Alert::success('New backup created');
            return redirect()->back();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

 

}
