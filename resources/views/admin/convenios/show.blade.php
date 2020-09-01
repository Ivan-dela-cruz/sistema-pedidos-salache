@extends('admin.base.index')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="ibox">
                <div class="ibox-head badge-info">
                    <div class="ibox-title">Descripción</div>
                    <div class="ibox-tools">
                        <a class="text-white " href="{{route('index-convenios')}}">
                            <i class="fa fa-arrow-left"></i>
                            Atras</a>
                    </div>
                </div>
                <div class="ibox-body">
                    <h5 class="card-title">{{$convenio->name}}</h5>
                    <p class="card-text">{{$convenio->legal_representative}}</p>
                    <p class="card-text">
                        {{ \Carbon\Carbon::setLocale('America/Guayaquil') }}
                        <small>Inicio <span class="text-muted">{{$convenio->start}}</span>
                        </small>

                        <small> hasta  <span class="text-muted">{{$convenio->end}}</span>
                        </small>
                    </p>
                    <p class="card-text">
                        <small
                            class="text-muted"> Ultima actualización  {{\Carbon\Carbon::parse($convenio->updated_at)->diffForHumans()}}</small>

                        @if ($convenio->status==='activo')
                            <a data-toggle="tooltip"
                               title="El convenio se encuentra visible"
                                class="pull-right text-muted ml-3 btn-change-slider"><i
                                    class="fa  fa-eye"></i></a>
                        @else
                            <a data-toggle="tooltip"
                               title="El convenio no se encuentra visible"
                                class="pull-right text-muted ml-3 btn-change-slider"><i
                                    class="fa  fa-eye-slash"></i></a>
                        @endif

                        <a data-toggle="tooltip"
                           title="Modificar Slider" class="pull-right text-muted ml-2"
                           href="{{route('edit-convenio',$convenio->id)}}"><i
                                class="fa  fa-edit"></i></a>


                    </p>

                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="ibox">
                <div class="ibox-head badge-info">
                    <div class="ibox-title">Documento</div>
                    <div class="ibox-tools">
                        <a class="text-white " href="{{route('download-pdf-convenio',$convenio->id)}}">
                            <i class="fa fa-download"></i>
                            PDF</a>
                            <a class="text-white " href="{{route('download-word-convenio',$convenio->id)}}">
                            <i class="fa fa-download"></i>
                            Word</a>
                    </div>
                </div>
                <div class="ibox-body text-center">
                        @if ($convenio->url_document!='#')
                           <embed src="{{asset($convenio->url_document)}}"
                               type="application/pdf"
                               width="680px"
                               height="450px">
                        @endif
                        @if ($convenio->url_word!='#')
                            <iframe src="https://view.officeapps.live.com/op/view.aspx?src={{asset($convenio->url_word)}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                        @endif    
                </div>
            </div>

        </div>
    </div>
@endsection
