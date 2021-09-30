<?php
namespace App\Http\Controllers\App;
use App\Http\Controllers\Controller;

use Symfony\Component\HttpFoundation\Request;

class AppController extends Controller {
    public function captcha(Request $request) {
        if(session()->has('captcha')) {
            $id="captcha/".session()->getId();
            $file=storage_path('app')."/".$id;
            if(file_exists($file)) {
                return $this->image($request, $id,'image/png');
            }
        }
        $permitted_chars = '0123456789';
    
        $image = imagecreatetruecolor(200, 50);
        
        imageantialias($image, true);
        
        $colors = [];
        
        $red = rand(125, 175);
        $green = rand(125, 175);
        $blue = rand(125, 175);
        
        for($i = 0; $i < 5; $i++) {
            $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
        }
        
        imagefill($image, 0, 0, $colors[0]);
        
        for($i = 0; $i < 10; $i++) {
            imagesetthickness($image, rand(2, 10));
            $line_color = $colors[rand(1, 4)];
            imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $line_color);
        }
        
        $black = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        $textcolors = [$black, $white];
        
        $fontpath=realpath(__DIR__."/../../../../public/fonts/captcha");
        $fonts = [$fontpath.'/Acme-Regular.ttf', $fontpath.'/Ubuntu-B.ttf', $fontpath.'/Merriweather-Black.otf', $fontpath.'/PlayfairDisplay-Black.otf'];
        
        $string_length = 6;
        $captcha_string = $this->generate_string($permitted_chars, $string_length);
        session(['captcha'=>$captcha_string]);
        for($i = 0; $i < $string_length; $i++) {
            $letter_space = 170/$string_length;
            $initial = 15;
            imagettftext($image, 24, rand(-15, 15), $initial + $i*$letter_space, rand(25, 45), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);
        }
        header('Content-type: image/png');
        imagepng($image);
        $dir=storage_path('app')."/captcha";
        
        if(!file_exists($dir)) mkdir($dir,0777);
        $attach_name = $dir."/".session()->getId();
        imagepng($image,$attach_name);
        imagedestroy($image);
    }
    
    private function generate_string($input, $strength = 10) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
    
        return $random_string;
    }

    public function image(Request $request, $name, $type) {
        $name=str_replace("..","", $name);
        $file=storage_path('app')."/".$name;
        $file=str_replace("/",DIRECTORY_SEPARATOR, $file);
        
        if(file_exists($file)) {
            header('Pragma: public');
            header('Cache-Control: max-age=86400');
            header('Content-Type: '.$type);
            $fp=fopen($file,'r');
            while($b=fread($fp,4096)) echo $b;
            fclose($fp);
            exit;
        }
        return "not found";
    }
    public function qrcode(Request $request) {
        $name="";$etag="";
        if($request->has('name')) $name=$request->name;
        if($request->has('etag')) $etag=$request->etag;
        $name=str_replace("..","", $name);
        if($etag!=\App\Helper::hash($name)) return \App\Helper::error(403,'Invalid parameters');
        $dir=storage_path('app')."/qrcode";
        $file=str_replace("/",DIRECTORY_SEPARATOR, $dir."/".$name);
        if(!file_exists($file)) {
            $path=realpath(__DIR__.'/../../../Helpers/phpqrcode/qrlib.php');
            include($path); 
            if(!file_exists($dir)) mkdir($dir,0777);
            \QRcode::png($name,$file,QR_ECLEVEL_H,8,0);
        }
        header('Pragma: public');
        header('Cache-Control: max-age=86400');
        header('Content-Type: image/png');
        $fp=fopen($file,'r');
        while($b=fread($fp,4096)) echo $b;
        fclose($fp);
    }
    
}