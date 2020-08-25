<?php

namespace App\Http\Controllers\admin;

use App\Company;
use App\CompanyType;
use App\Http\Controllers\Controller;
use App\Merchant;
use App\User;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getApiCompanies($id)
    {
        $companies = Company::where('status', 'activo')->where('company_type', $id)->get(['id', 'company_name', 'company_address', 'company_phone', 'company_description', 'latitude', 'longitude', 'url_merchant']);
        return response()->json([
            'success' => true,
            'companies' => $companies
        ], 200);

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        $companies = CompanyType::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('admin.merchants.partials.formCompany', compact('company', 'companies'))->render();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->company_name = $request->company_name;
        $company->company_ruc = $request->company_ruc;
        $company->company_address = $request->company_address;
        $company->company_type = $request->company_type;
        $company->company_phone = $request->company_phone;
        $company->company_description = $request->company_description;
        $company->longitude = $request->longitude;
        $company->latitude = $request->latitude;
        $company->status = $request->status;
        if ($request->file('url_merchant')) {
            $company->url_merchant = $this->UploadImageMerchant($request);
        }
        $company->save();
        return redirect()->route('create-merchant-profile', $company->merchant->id)
            ->with('status', '¡Los datos se actualizarón satisfactoriamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCompanies($id)
    {
        $merchant = Merchant::find($id);
        return view('admin.merchants.tableCompany', compact('merchant'))->render();
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

    public function deactivate(Request $request)
    {
        $company = Company::find($request->id);
        if ($company->status == 'inactivo') {
            $company->status = 'activo';
        } else {
            $company->status = 'inactivo';
        }
        $company->save();
        return $company;
    }

    public function downloadpdf($id)
    {
        $company = Company::find($id);
        $rutaPdf = $company->url_file;
        $name_pdf = "documento-adjunto-" . $company->company_name;
        return response()->download($rutaPdf, $name_pdf . ".pdf");
    }

    public function getCompaniesUser(){
        try{
            $user = User::find(Auth::user()->id);
            $merchant = Merchant::where('id_user',$user->id)->first();
            $companies = Company::where('id_merchant',$merchant->id)->where('status','activo')->get();

            return response()->json([
                'success'=>true,
                'companies'=>$companies
            ],200);
        }catch (Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'auth fail' . $e
            ]);
        }

    }
}
