<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequestProduct;
use App\Merchant;
use App\DetailRequestProduct;
use Intervention\Image\Facades\Image;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
                $detail = new DetailRequestProduct();
                $detail->id_request = $request_product->id;
                $detail->name = $det[$i]['name'];
                $detail->description = $det[$i]['description'];
                $detail->price = $det[$i]['price'];
                $detail->stock = $det[$i]['stock'];
                $detail->category = $det[$i]['category'];
                //$detail->url_image =$this->UploadImageProduct($det[$i]['url_image']);
                $detail->save();
                $i++;
            }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
    public function UploadImageProduct($url_image)
    {

        $url_file = "img/products/";
        if ($request->url_image && $request->url_image != '#') {

            $image = $request->get('url_image');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('url_image'))->save(public_path($url_file) . $name);
            return $url_file . $name;
        } else {
            return "#";
        }

    }
}
