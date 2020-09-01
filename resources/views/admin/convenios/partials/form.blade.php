<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('name', 'Nombre del convenio') !!}
            {!! Form::text('name',null, ['class'=>'form-control']) !!}
            @error('name')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}.
                        </div>
             @enderror
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('legal_representative', 'Representante legal') !!}
            {!! Form::text('legal_representative',null, ['class'=>'form-control']) !!}
            @error('legal_representative')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}.
            </div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('url_document', 'Documento (PDF)') !!}
            {!! Form::file('url_document', ['id'=>'url_document','class'=>'form-control']) !!}
            @error('url_document')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}.
            </div>
            @enderror
        </div>
    </div>
     <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('url_document', 'Documento (WORD)') !!}
            {!! Form::file('url_word', ['id'=>'url_word','class'=>'form-control']) !!}
            @error('url_word')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}.
            </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('start', 'Fecha de inicio') !!}
            {!! Form::date('start',null, ['class'=>'form-control']) !!}
            @error('start')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}.
                </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('end', 'Fecha de finalización') !!}
            {!! Form::date('end',null, ['class'=>'form-control']) !!}
            @error('end')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}.
            </div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('status', 'Estado') !!}
            <div class="form-control">
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('status', 'activo') }} Activo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('status', 'inactivo') }} Inactivo
                    </label>
                </div>
            </div>

            @error('status')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}.
                </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
           {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
        </div>
    </div>
</div>


