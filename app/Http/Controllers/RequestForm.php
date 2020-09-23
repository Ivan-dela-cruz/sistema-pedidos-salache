<?php

namespace App\Http\Controllers;

use App\CompanyType;
use App\Convenio;
use App\Http\Requests\StoreDeliveryManPost;
use App\Http\Requests\StoreMerchantPost;
use App\RequestForm as AppRequestForm;
use App\RequestFormDeliveryMan;
use App\VehicleType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RequestForm extends Controller
{

    //create solicitud del empresario

    public function createMerchant()
    {
        $companies = CompanyType::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
        $convenios = Convenio::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->get(['id','name']);

        return view('forms.merchant', compact('companies', 'convenios'));
    }

    //store solicitud del repartidor

    public function createdeliveryMan()
    {
        $vehicles = VehicleType::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
        $convenios = Convenio::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->get(['id','name']);
        return view('forms.deliveryman', compact('vehicles', 'convenios'));
    }

    //create solicitud del repartidor

    public function storeMarchant(StoreMerchantPost $request)
    {
        /*name,last_name,ci,address,phone,email,company_name,company_ruc,company_address,company_type, company_description*/

        $validate = $request->validated();


        try {
            DB::beginTransaction();

            $request_merchant = new AppRequestForm();
            $request_merchant->name = $request->name;
            $request_merchant->last_name = $request->last_name;
            $request_merchant->ci = $request->ci;
            $request_merchant->address = $request->address;
            $request_merchant->phone = $request->phone;
            $request_merchant->email = $request->email;
            $request_merchant->company_name = $request->company_name;
            $request_merchant->company_ruc = $request->company_ruc;
            $request_merchant->company_address = $request->company_address;
            $request_merchant->company_type = $request->company_type;
            $request_merchant->company_description = $request->company_description;
            $request_merchant->url_file = $this->loadPDFMerchant($request);
            if ($request->convenio) {
                $request_merchant->id_convenio = 1;
            } else {
                $request_merchant->id_convenio = $request->id_convenio;
            }
            $request_merchant->save();
            DB::commit();
            //retornamoas a la ruta del formulario principal
            return redirect()->route('empresa')->with('status', '¡Tú solicitud se ha enviado satisfactoriamente!');
        } catch (Exception $e) {
            //retornamoas a la ruta del formulario principal con el error y hacemos u rol back de la trasanccions
            DB::rollback();
            return redirect()->route('empresa')->with('status', 'error');
        }
    }

    //store solicitud del repartidor
    public function storeDeliveryMan(StoreDeliveryManPost $request)
    {
        /*name,last_name,ci,address,phone,email,vehicle_type,vehicle_plate,vehicle_year,vehicle_make, vehicle_description*/
        $validate = $request->validated();

        try {
            DB::beginTransaction();
            $request_delivery = new RequestFormDeliveryMan();
            $request_delivery->name = $request->name;
            $request_delivery->last_name = $request->last_name;
            $request_delivery->ci = $request->ci;
            $request_delivery->address = $request->address;
            $request_delivery->phone = $request->phone;
            $request_delivery->email = $request->email;
            $request_delivery->vehicle_type = $request->vehicle_type;
            $request_delivery->vehicle_plate = $request->vehicle_plate;
            $request_delivery->vehicle_year = $request->vehicle_year;
            $request_delivery->vehicle_make = $request->vehicle_make;
            $request_delivery->vehicle_description = $request->vehicle_description;
            $request_delivery->url_file = $this->loadPDFMerchant($request);
            if ($request->convenio) {
                $request_delivery->id_convenio =1;
            } else {
                $request_delivery->id_convenio = $request->id_convenio;
            }

            $request_delivery->save();
            DB::commit();
            //retornamoas a la ruta del formulario principal
            return redirect()->route('repartidor')->with('status', '¡Tú solicitud se ha enviado satisfactoriamente!');
        } catch (Exception $e) {
            //retornamoas a la ruta del formulario principal con el error y hacemos u rol back de la trasanccions
            DB::rollback();
            return redirect()->route('repartidor')->with('status', 'error');
        }
    }

    public function loadPDFMerchant(Request $request)
    {
        $ruta_archivo = "#";

        if ($request->file('url_file')) {

            $archivo = $request->file('url_file');
            $nombre_archivo = time() . '.' . $archivo->getClientOriginalExtension();
           //$r2 = Storage::disk('documents')->put(utf8_decode($nombre_archivo), File::get($archivo));
            $archivo->move(public_path('documents/documents/'), $nombre_archivo);
            $ruta_archivo = "documents/documents/" . $nombre_archivo;
        } else {
            $ruta_archivo = "#";
        }
        return $ruta_archivo;
    }

    public function downloadpdf($id)
    {
        $request = AppRequestForm::find($id);
        $rutaPdf = $request->url_file;
        $name_pdf = "documento-adjunto-" . $request->company_name . '-' . time();
        return response()->download($rutaPdf, $name_pdf . ".pdf");
    }
    public function downloadpdfReuestDelivery($id)
    {
        $request = RequestFormDeliveryMan::find($id);
        $rutaPdf = $request->url_file;
        $name_pdf = "documento-adjunto-" . $request->name . '-' . time();
        return response()->download($rutaPdf, $name_pdf . ".pdf");
    }
}
