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
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);

        $files = $disk->files(config('laravel-backup.backup.name'));
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        return view("respaldo.index")->with(compact('backups'));
    }

    public function create()
    {
        try {
            // start the backup process
            //Artisan::call('backup:run', ['--only-db' => 'true']);
            Artisan::call('backup:run');
            $output = Artisan::output();
            dd($output);
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

    public function backupdb(){
        $variable = \Spatie\DbDumper\Databases\PostgreSql::create()
            ->setDbName(env('DB_DATABASE', 'asistencia'))
            //->setDumpBinaryPath('/opt/lampp/bin')
            ->setDumpBinaryPath('C:/Program Files/PostgreSQL/10/bin')
            ->setUserName(env('DB_USERNAME', 'asistencia'))
            ->setPassword(env('DB_PASSWORD', 'asistencia'))
            ->dumpToFile('storage/app/backups/db-' . date('d-m-Y') . '.sql');
            dd($variable);
    }

    public function respaldoporcomando(){
        exec(Storage::disk('local')->get("\\storage\\respaldo\\respaldo.bat"), $output);
        // $output is an array of lines now 

        //system("cmd /c cd C:\\tis2\\controlDS\\ ");
        //system("cmd /c php artisan backup:run --only-db");
        //dd($output);
    }

    public function our_backup_database(){

    
            /*
            Needed in SQL File:
        
            SET GLOBAL sql_mode = '';
            SET SESSION sql_mode = '';
            */
            $get_all_table_query = "select * from information_schema.tables where table_schema='public'";
            $result = DB::select(DB::raw($get_all_table_query));
        
            $tables = [
                'users',
                'migrations',
            ];
        
            $structure = '';
            $data = '';
            foreach ($tables as $table) {
                $show_table_query = "SHOW CREATE TABLE " . $table . "";
        
                $show_table_result = DB::select(DB::raw($show_table_query));
        
                foreach ($show_table_result as $show_table_row) {
                    $show_table_row = (array)$show_table_row;
                    $structure .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
                }
                $select_query = "SELECT * FROM " . $table;
                $records = DB::select(DB::raw($select_query));
        
                foreach ($records as $record) {
                    $record = (array)$record;
                    $table_column_array = array_keys($record);
                    foreach ($table_column_array as $key => $name) {
                        $table_column_array[$key] = '`' . $table_column_array[$key] . '`';
                    }
        
                    $table_value_array = array_values($record);
                    $data .= "\nINSERT INTO $table (";
        
                    $data .= "" . implode(", ", $table_column_array) . ") VALUES \n";
        
                    foreach($table_value_array as $key => $record_column)
                        $table_value_array[$key] = addslashes($record_column);
        
                    $data .= "('" . implode("','", $table_value_array) . "');\n";
                }
            }
            $file_name = __DIR__ . '/../database/database_backup_on_' . date('y_m_d') . '.sql';
            $file_handle = fopen($file_name, 'w + ');
        
            $output = $structure . $data;
            fwrite($file_handle, $output);
            fclose($file_handle);
            echo "DB backup ready";
        }


    

   

}
