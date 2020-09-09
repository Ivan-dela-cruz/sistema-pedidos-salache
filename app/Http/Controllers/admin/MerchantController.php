<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Company;
use App\CompanyType;
use App\Convenio;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMerchantPost;
use App\Http\Requests\StoreMerchantValidatePost;
use App\Merchant;
use App\RequestForm;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Barryvdh\DomPDF\Facade as PDF;


class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $merchants = Merchant::orderBy('created_at', 'ASC')->get();
        $companies = CompanyType::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('admin.merchants.index', compact('merchants', 'companies'));
    }

    public function getRequestMerchants()
    {
        $request_merchants = RequestForm::orderBy('created_at', 'ASC')->get();

        $parameter = '';
        return view('admin.merchants.list_request', compact('request_merchants', 'parameter'));
    }


    public function showRequest($id)
    {
        $request = RequestForm::find($id);
        $companies = CompanyType::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
        $convenios = Convenio::orderBy('name', 'ASC')
            ->pluck('name', 'id');


        return view('admin.merchants.showRequest', compact('request', 'companies', 'convenios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMerchantValidatePost $request, $id)
    {
        $validate = $request->validated();

        $request_merchant = RequestForm::find($id);
        ///CONSULTAMOS SI EL SOLICITANTE YA TIENE UNA CUENTA EN EL SISTEMA
        //SI EXISTE SOLO GUARDAMOS LOS DATOS DE LA EMPRESA
        //CASO CONTRARIO GESTIONAMOS LAS TRES ENTIDADES USERS, MERCHANTS, Y COMPANIES


        if ($request->status == "revision") {

            $request_merchant->status = $request->status;
            $request_merchant->save();
            return redirect()->route('get-request-merchants');
        } else if ($request->status == "aprobado") {
            try {
                $query = Merchant::where('ci', $request->ci)->first();
                if ($query) {
                    DB::beginTransaction();
                    ////CREAR EL REGISTRO DE LA COMPANIA
                    $conpany = $this->comapanyRegister($request, $query->id, $request_merchant->id);
                    ///ACTUALIZAMOS EL ESTADO DE LA PETICON DEL EMPRESARION EN EL ESTADO ELEJIDO

                    $request_merchant->status = $request->status;
                    $request_merchant->save();
                    DB::commit();
                    return redirect()->route('get-merchants');
                } else {
                    DB::beginTransaction();
                    ///CREA LA CUENTA EN LA TABLA USUARIOS
                    $user = $this->userRegister($request);
                    /// CREA EL REGISTRO DEL EMPRESARIO
                    $merchant = $this->merchantRegister($request, $user->id);
                    ////CREAR EL REGISTRO DE LA COMPANIA
                    $company = $this->comapanyRegister($request, $merchant->id, $request_merchant->id);
                    ///ACTUALIZAMOS EL ESTADO DE LA PETICON DEL EMPRESARION EN EL ESTADO ELEJIDO

                    $request_merchant->status = $request->status;
                    $request_merchant->save();
                    DB::commit();
                    return redirect()->route('get-merchants');
                }
            } catch (Exception $e) {
                DB::rollBack();
                return $e;
            }
        } else {
            $this->deleteRequestMerchant($id);
            return redirect()->route('get-request-merchants');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }


    public function generatePassword($password)
    {
        $user_password = Hash::make($password);
        return $user_password;
    }

    public function UploadImage(Request $request)
    {
        $url_file = "img/users/";
        if ($request->file('url_image')) {
            $image = $request->file('url_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path($url_file) . $name);
            return $url_file . $name;
        } else {
            return "#";
        }
    }

    public function UploadImageMerchant(Request $request)
    {
        $url_file = "img/merchants/";
        if ($request->file('url_merchant')) {
            $image = $request->file('url_merchant');
            $name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path($url_file) . $name);
            return $url_file . $name;
        } else {
            return "#";
        }
    }

    public function createProfile($id)
    {
        $categories = Category::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
        $companies = CompanyType::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
        $merchant = Merchant::find($id);

        ///RETIORNAMOS COMPANY VACIA PAR QUE RENDERICE EL FORMULARIO EDICION
        $company = Company::all()->last();

        return view('admin.merchants.create', compact('categories', 'companies', 'merchant', 'company'));
    }

    public function userRegister(Request $request)
    {
        ///CREA LA CUENTA EN LA TABLA USUARIOS
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->name . time();
        $user->email = $request->email;
        $user->password = $this->generatePassword($request->ci);
        $user->url_image = $this->UploadImage($request);
        $user->save();
        ///asignamos el rol el empresario
        $role = Role::findById(3);
        $user->assignRole($role);
        return $user;
    }

    public function merchantRegister(Request $request, $id)
    {

        /// CREA EL REGISTRO DEL EMPRESARIO
        $merchant = new Merchant();
        $merchant->ci = $request->ci;
        $merchant->ruc = $request->company_ruc;
        $merchant->name = $request->name;
        $merchant->address = $request->address;
        $merchant->phone = $request->phone;
        $merchant->last_name = $request->last_name;
        $merchant->email = $request->email;
        $merchant->gender = $request->gender;
        $merchant->birth_date = $request->birth_date;
        $merchant->id_user = $id;
        $merchant->save();
        return $merchant;
    }

    public function comapanyRegister(Request $request, $id, $id_request)
    {
        $request_merchant = RequestForm::find($id_request);
        ////CREAR EL REGISTRO DE LA COMPANIA
        $company = new  Company();
        $company->company_name = $request->company_name;
        $company->company_ruc = $request->company_ruc;
        $company->company_address = $request->company_address;
        $company->company_type = $request->company_type;
        $company->company_phone = $request->company_phone;
        $company->company_description = $request->company_description;
        $company->longitude = $request->longitude;
        $company->latitude = $request->latitude;
        $company->url_merchant = $this->UploadImageMerchant($request);
        $company->url_file = $request_merchant->url_file;
        $company->id_merchant = $id;
        $company->id_convenio = $request->id_convenio;
        $company->save();
        return $company;
    }

    public function deleteRequestMerchant($id)
    {
        $request_merchant = RequestForm::find($id);
        $request_merchant->delete();
    }

    public function loadPDFMerchant(Request $request)
    {
        $ruta_archivo = "#";

        if ($request->file('url_file')) {

            $archivo = $request->file('url_file');
            $nombre_archivo = time() . '.' . $archivo->getClientOriginalExtension();
            $r2 = Storage::disk('documents')->put(utf8_decode($nombre_archivo), File::get($archivo));
            $ruta_archivo = "storage/documents/" . $nombre_archivo;
        } else {
            $ruta_archivo = "#";
        }
        return $ruta_archivo;
    }

    public function destroyFile($path_file)
    {
        if (File::exists(public_path($path_file))) {

            File::delete(public_path($path_file));

        }
    }

    public function getPdfMerchant(){
        $merchants = Merchant::all();
        $pdf = PDF::loadView('pdf.merchants', compact('merchants'));
        //$pdf->setPaper('A4', 'landscape');
        $nombrePdf = 'reporte empresarios-' .time() . '.pdf';
        return $pdf->download($nombrePdf);
    }

    public function getPdfCompanies(){
        $companies = Company::all();
        $pdf = PDF::loadView('pdf.companies', compact('companies'));
        //$pdf->setPaper('A4', 'landscape');
        $nombrePdf = 'reporte empresas-' .time() . '.pdf';
        return $pdf->download($nombrePdf);
    }


}
