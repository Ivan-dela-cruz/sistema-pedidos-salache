<?php

namespace App\Http\Controllers\admin;

use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductPost;
use App\Http\Requests\UpdateProductPut;
use App\Merchant;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade as PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','DESC')->get();
        return view('admin.products.index', compact('products'));
    }

    public function getProducts($id)
    {
        $products = Product::where('id_company', $id)->get();
        return view('admin.products.tableProductsMerchant', compact('products'))->render();
    }

    public function getApiProducts($id)
    {
        $category = Category::find($id);
        $products = Product::where('status', 'activo')->where('id_category', $category->id)->where('id_company',$category->id_company)->get();

        return response()->json([
            'success'=>true,
            'products' => $products,
            'categories'=>$category
        ], 200);
    }

    /*
    class Venta(){
        id_cliente;
        fecha;
        direccion;
        telefono;
        productos arrayList<DetalleVenta>;
        valor_total;

}
class DetalleVenta(){
        id_venta;
        id_producto;
        descripcion;
        nombre_producto;
        cantdad;
        precio unitario;
        precio total;

}
*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = SubCategory::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('admin.products.create', compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //id_sub_category,code,name,purchase_price,sale_price,stock,descripcion,status
        // $validate = $request->validated();
        $product = new Product();
        $product->name = $request->name;
        $product->sale_price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        //$product->status = $request->status;
        $product->id_category = $request->id_category;
        $product->id_company = $request->id;
        $product->url_image = $this->UploadImageProduct($request);
        $product->save();
        return $product;
        // return redirect()->route('get-product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $company = Company::find($product->id_company)->first();
        $id_company = $product->id_company;
        $categories = Category::find($company->id_merchant)
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');


        return view('admin.products.edit', compact('product', 'id_company', 'categories'));
    }

    public function getForm($id)
    {
        $categories = Category::where('status', 'activo')
            ->where('id_company', $id)
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
        $id_company = $id;

        return view('admin.products.partials.form', compact('categories', 'id_company'))->render();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductPut $request, $id)
    {

       // $validate = $request->validated();
        $product = Product::find($id);
        $product->name = $request->name;
        $product->sale_price = $request->sale_price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->id_category = $request->id_category;
        if ($request->file('url_image')) {
            $product->url_image = $this->UploadImage($request);
        }
        $product->save();
        return redirect()->route('get-product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('get-product');
    }

    public function deactivate(Request $request)
    {
        $product = Product::find($request->id);
        if ($product->status == 'inactivo') {
            $product->status = 'activo';
        } else {
            $product->status = 'inactivo';
        }
        $product->save();

        return $product;
    }

    public function UploadImage(Request $request)
    {
        $url_file = "img/products/";
        if ($request->file('url_image')) {
            $image = $request->file('url_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path($url_file) . $name);
            return $url_file . $name;
        } else {
            return "#";
        }
    }
    public function UploadImageProduct(Request $request)
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

   public function getPdfCompaniesProducts(){
        $companies = Company::all();
        $pdf = PDF::loadView('pdf.products', compact('companies'));
        //$pdf->setPaper('A4', 'landscape');
        $nombrePdf = 'reporte productos de empresas-' .time() . '.pdf';
        return $pdf->download($nombrePdf);
    }
}
