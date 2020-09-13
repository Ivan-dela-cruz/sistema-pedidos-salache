<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequestProduct;
use App\Merchant;
use App\DetailRequestProduct;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class RequestProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       
        $merchant = Merchant::where('ci',$request->ci)->first();
      
        return view('forms.products',compact('merchant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request_products = RequestProduct::orderBy('created_at','DESC')->where('status','activo')->get();
        return view('admin.requestproducts.index',compact('request_products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         try {
            DB::beginTransaction();

            $request_product = new RequestProduct();
            $request_product->topic = $request->topic;
            $request_product->description = $request->topic;
            $request_product->id_merchant = $request->id;
            $request_product->save();

            $detalles = $request->data;
            $contador = $request->contador;

        
            $i = 0;
            foreach ($detalles as $ep => $det) {
                for ($j = 0; $j < $contador; $j++) {
                    $price =  (double) $det[$i]['price']; 
                 
                    $detail = new DetailRequestProduct();
                    $detail->id_request = $request_product->id;
                    $detail->name = $det[$i]['name'];
                    $detail->description = $det[$i]['description'];
                    $detail->price = $price; 
                    $detail->stock = $det[$i]['stock'];
                    $detail->category = $det[$i]['category'];

                    $detail->url_image =$this->UploadImageProduct($det[$i]['url_image']);
                    $detail->save();
                    $i++;
                }
            }
            DB::commit();
                return response()->json([
                    'success'=>true,
                ],200);
             return redirect()->route('solicitud-productos')->with('status', '¡Tú solicitud se ha enviado satisfactoriamente!');
        } catch (\Exception $e) {
                DB::rollBack();
                 return response()->json([
                    'success'=>false,
                ],422);
                return redirect()->route('empresa')->with('status', 'error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request_product = RequestProduct::find($id);
        return view('admin.requestproducts.show',compact('request_product'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    public function downloadImage( $id){
        $detail = DetailRequestProduct::find($id);
        $name ="";
        if($detail->url_image!="#"){
            $url_file = $detail->url_image;
            $name = Str::after($url_file, 'img/products/');
            return response()->download($url_file, $name);
         }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyRequest($id)
    {
        $request = RequestProduct::find($id);
        foreach ($request->details as $detail) {
            $this->destroyFile($detail->url_image);
            $detail->delete();
        }
        $request->delete();
        return redirect()->route('get-request-products')->with('success', 'Eliminado.');
        
    }
    public function deleteItem($id)
    {
        $detail = DetailRequestProduct::find($id);
        $this->destroyFile($detail->url_image);
        $detail->delete();
        return redirect()->back()->with('success', 'Eliminado.');

        
    }
    public function UploadImageProduct($url_image)
    {

        $url_file = "img/products/";
        if ($url_image != '#') {

            $image = $url_image;
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($image)->save(public_path($url_file) . $name);
            return $url_file . $name;
        } else {
            return "#";
        }

    }

     public function destroyFile($path_file)
    {
        if (\File::exists(public_path($path_file))) {

            \File::delete(public_path($path_file));

        }
    }
}
