<?php

namespace App\Http\Controllers\admin;

use App\Convenio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConvenioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convenios = Convenio::orderBy('created_at', 'ASC')->get();
        return view('admin.convenios.index', compact('convenios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.convenios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|string',
            'url_word' => 'mimes:docx,doc,txt,xps,xml',
            'url_document' => 'mimes:pdf',
            'legal_representative' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'status' => 'required'

        ],
        [
            //MENSAJES CUANDO NO SE CUMPLE LA VALIDACION
            'name.string' => 'El dato ingresado no es válido',
            'name.required' => 'Este campo es obligatorio',
            'url_word.mimes' => 'El documento no es válido',
            'url_document.mimes' => 'El documento no es válido',
            'legal_representative.required' => 'Este campo es obligatorio',
            'legal_representative.string' => 'El dato ingresado no es válido',
            'start.required' => 'Este campo es obligatorio',
            'start.date' => 'No es una fecha válida',
            'end.required' => 'Este campo es obligatorio',
            'end.date' => 'No es una fecha válida',
            'status.required' => 'Este campo es obligatorio',
        ]);


        $convenio = new Convenio();
        $convenio->name = $request->name;
        $convenio->legal_representative = $request->legal_representative;
        $convenio->start = $request->start;
        $convenio->end = $request->end;
        $convenio->url_document = $this->loadPDFConvenio($request);
        $convenio->url_word = $this->loadWordConvenio($request);
        $convenio->status = $request->status;
        $convenio->save();

        return redirect()->route('index-convenios');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $convenio = Convenio::find($id);
        return view('admin.convenios.show', compact('convenio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $convenio = Convenio::find($id);
        return view('admin.convenios.edit', compact('convenio'));
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

         $this->validate($request, [
            'name' => 'required|string',
            'url_word' => 'mimes:docx,doc,txt,xps,xml',
            'url_document' => 'mimes:pdf',
            'legal_representative' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'status' => 'required'

        ],
        [
            //MENSAJES CUANDO NO SE CUMPLE LA VALIDACION
            'name.string' => 'El dato ingresado no es válido',
            'name.required' => 'Este campo es obligatorio',
            'url_word.mimes' => 'El documento no es válido',
            'url_document.mimes' => 'El documento no es válido',
            'legal_representative.required' => 'Este campo es obligatorio',
            'legal_representative.string' => 'El dato ingresado no es válido',
            'start.required' => 'Este campo es obligatorio',
            'start.date' => 'No es una fecha válida',
            'end.required' => 'Este campo es obligatorio',
            'end.date' => 'No es una fecha válida',
            'status.required' => 'Este campo es obligatorio',
        ]);

        $convenio = Convenio::find($id);
        $convenio->name = $request->name;
        $convenio->legal_representative = $request->legal_representative;
        $convenio->start = $request->start;
        $convenio->end = $request->end;
        if ($request->file('url_document')) {
            $this->destroyFile($convenio->url_document);
            $convenio->url_document = $this->loadPDFConvenio($request);
        }
        if ($request->file('url_word')) {
            $this->destroyFile($convenio->url_word);
            $convenio->url_word = $this->loadWordConvenio($request);
        }

        $convenio->status = $request->status;
        $convenio->save();

        return redirect()->route('index-convenios');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $convenio = Convenio::find($request->id);
        $this->destroyFile($convenio->url_document);
        $convenio->delete();
        return redirect()->route('index-convenios');
    }

    public function loadPDFConvenio(Request $request)
    {
        $ruta_archivo = "#";

        if ($request->file('url_document')) {

            $archivo = $request->file('url_document');
            $nombre_archivo = "convenio-" . time() . '.' . $archivo->getClientOriginalExtension();
            $r2 = Storage::disk('documents')->put(utf8_decode($nombre_archivo), File::get($archivo));
            $ruta_archivo = "documents/documents/" . $nombre_archivo;
        } else {
            $ruta_archivo = "#";
        }
        return $ruta_archivo;
    }

    public function loadWordConvenio(Request $request)
    {
        $ruta_archivo = "#";

        if ($request->file('url_word')) {

            $archivo = $request->file('url_word');
            $nombre_archivo = "convenio-" . time() . '.' . $archivo->getClientOriginalExtension();
            $r2 = Storage::disk('word')->put(utf8_decode($nombre_archivo), File::get($archivo));
            $ruta_archivo = "documents/word/" . $nombre_archivo;
        } else {
            $ruta_archivo = "#";
        }
        return $ruta_archivo;
    }

    public function destroyFile($path_file)
    {
        if (\File::exists(public_path($path_file))) {

            \File::delete(public_path($path_file));

        }
    }

    public function getConvenio()
    {
        $convenios = Convenio::orderBy('created_at', 'ASC')->get();
        return view('admin.convenios.table', compact('convenios'))->render();
    }
    public function downloadpdf($id)
    {

        $convenio = Convenio::find($id);
        if($convenio->url_document!="#"){
            $rutaPdf = $convenio->url_document;
            $name_pdf = $convenio->name;
            return response()->download($rutaPdf, $name_pdf . ".pdf");
        }
        return redirect()->back();
       
    }
    public function downloadword($id)
    {
        $convenio = Convenio::find($id);
         if($convenio->url_word!="#"){
            $rutaWord = $convenio->url_word;
            $name_word = $convenio->name;
            return response()->download($rutaWord, $name_word . ".doc");
         }
        
        return redirect()->back();
    }
}
