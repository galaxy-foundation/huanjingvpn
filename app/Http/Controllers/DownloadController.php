<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
class DownloadController extends Controller
{

    public function index(Request $request) {
        $files = File::files(storage_path('app/download'));
        return view('download.index',['files'=>$files]);
    }
    public function file(Request $request, $name) { 
        $name=str_replace("..","",$name);
        $file=storage_path('app/download')."/".$name;
        $file=str_replace("/",DIRECTORY_SEPARATOR, $file);
        if(file_exists($file)) {
            $headers = array(
                //'Content-Disposition:attachment; filename="'.$name.'"',
                'Content-Transfer-Encoding:binary',
                'Content-Length:'.filesize($file),
            );
            return \Response::download($file,$name, $headers);
        }
        return "not found";
    }
}
