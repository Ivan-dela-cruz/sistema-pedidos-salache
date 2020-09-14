<?php

namespace App\Http\Controllers;

use App\Message;
use App\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'activo')->orderBy('order', 'ASC')->get();

        return view('web.index', compact('sliders'));
    }
    public function categories()
    {


        return view('web.categories');
    }
    public function contact()
    {


        return view('web.contacts');
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

    public function downloadapk(){
        $fileName = basename('tiendavirtualutc.apk');
        $filePath = 'apk/'.$fileName;
        if(!empty($fileName) && file_exists($filePath)){
            // Define headers
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");
            
            // Read the file
            readfile($filePath);
            exit;
        }else{
            echo 'The file does not exist.';
        }
    }

/*
     public function downloadapk()
    {
       $url_apk= "apk/tiendavirtualutc.apk";
       $name_pdf = "tiendavirtualutc";
        return response()->download($url_apk, $name_pdf . ".apk");
        
       
    }
    */
}
