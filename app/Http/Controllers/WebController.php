<?php

namespace App\Http\Controllers;

use App\Message;
use App\Slider;
use App\Tracker;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    {
        Tracker::hit();
        $hits = Tracker::orderBy('date')->sum('hits');
        $visits = $this->contador($hits);
        $sliders = Slider::where('status', 'activo')->orderBy('order', 'ASC')->get();
        

        return view('web.index', compact('sliders','visits'));
    }
    public function categories()
    {


        return view('web.categories');
    }
    public function contact()
    {


        return view('web.contacts');
    }
    public function contador($contador){
        if($contador<10){
            return "000000000".$contador;
        }
        if($contador<100){
            return "00000000".$contador;
        }
        if($contador<1000){
            return "0000000 ".$contador;
        }
        if($contador<10000){
            return "000000".$contador;
        }
        if($contador<100000){
            return "00000".$contador;
        }
        if($contador<1000000){
            return "0000".$contador;
        }
        if($contador<10000000){
            return "000".$contador;
        }
        if($contador<100000000){
            return "00".$contador;
        }
        if($contador<1000000000){
            return "0".$contador;
        }else{
            return "".$contador;
        }
    }


    public function senMessage(Request $request){
        try{
             DB::beginTransaction();
            $message = new  Message();
            $message->name = $request->name;
            $message->email = $request->email;
            $message->subject = $request->subject;
            $message->message = $request->message;
            $message->save();
            DB::commit();
            return 'OK';
            //return redirect()->route('contactos')->with('status', '¡Tú mensaje se ha enviado satisfactoriamente!');

        }catch(Exception $e){
            DB::rollback();
            return 'Error al enviar';
           // return redirect()->route('contactos')->with('status', 'error');
        }
    }

     public function getMessages()
    {
        $messages = Message::orderBy('created_at','ASC')->paginate(10);

        return view('admin.messages.index',compact('messages'));
    }

/*
    public function downloadapk(){
        $fileName = basename('tiendavirtualutc.apk');
        $filePath = 'apk/'.$fileName;
        if(!empty($fileName) && file_exists($filePath)){
            // Define headers
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            //header("Content-type: application/jar");
            //header("Content-type: application/apk");


            header("Content-type: application/vnd.android.package-archive");
            header("Content-type: application/java-archive");

            header("Content-Transfer-Encoding: binary");
            
            // Read the file
            readfile($filePath);
            exit;
        }else{
            echo 'The file does not exist.';
        }
    }
*/
     public function downloadapk()
    {
        $url_apk= "apk/tiendavirtualutc.apk";
        $name_pdf = "tiendavirtualutc.apk";
        return response()->download($url_apk,$name_pdf ,[
            'Content-Type'=>'application/vnd.android.package-archive',
            'apk' => 'application/vnd.android.package-archive',
            'jar' => 'application/java-archive'
        ]) ;
        
       
    }
    
}
