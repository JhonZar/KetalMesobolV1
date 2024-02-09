<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info padding-1">
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('Categoria') }}
                        {{ Form::select('id_categoria', $categoria, $producto->id_categoria, ['class' => 'form-control' . ($errors->has('id_categoria') ? ' is-invalid' : ''), 'placeholder' => 'Categoria']) }}
                        {!! $errors->first('id_categoria', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Material') }}
                        {{ Form::select('idMaterial', $material, $producto->idMaterial, ['class' => 'form-control' . ($errors->has('idMaterial') ? ' is-invalid' : ''), 'placeholder' => 'Material']) }}
                        {!! $errors->first('idMaterial', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Color') }}
                        {{ Form::select('idColor', $color, $producto->idColor, ['class' => 'form-control' . ($errors->has('idColor') ? ' is-invalid' : ''), 'placeholder' => 'Color']) }}
                        {!! $errors->first('idColor', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label('nombre') }}
                        {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('precio') }}
                        {{ Form::number('precio', $producto->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                        {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('descripcion') }}
                        {{ Form::textArea('descripcion', $producto->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                        {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="box-footer mt20">
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-info padding-1">
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('cantidad') }}
                        {{ Form::number('cantidad', $producto->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
                        {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('imagen', 'Imagen') }}
                        @if ($producto->imagen)
                            <img src="{{ asset('imagen/' . $producto->imagen) }}" alt="Imagen actual" height="60px">
                            {{ Form::hidden('imagen_actual', $producto->imagen) }}
                        @endif
                        {{ Form::file('imagen', ['class' => 'form-control-file' . ($errors->has('imagen') ? ' is-invalid' : ''), 'accept' => 'image/*']) }}
                        {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('publico', '¿Público?') }}
                        <div class="form-check">
                            @foreach ($pub as $option)
                                <label class="form-check-label">
                                    {{ Form::radio('publico', $option, $producto->publico === $option, ['class' => 'form-check-input' . ($errors->has('publico') ? ' is-invalid' : '')]) }}
                                    {{ ucfirst($option) }}
                                </label><br>
                            @endforeach
                        </div>
                        {!! $errors->first('publico', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label('tafilete') }}
                        {{ Form::select('tafilete', $miArregloT, $producto->tafilete, ['class' => 'form-control' . ($errors->has('tafilete') ? ' is-invalid' : ''), 'placeholder' => 'Tafilete']) }}
                        {!! $errors->first('tafilete', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('talla') }}
                        {{ Form::select('talla', $miArreglo, $producto->talla, ['class' => 'form-control' . ($errors->has('talla') ? ' is-invalid' : ''), 'placeholder' => 'Talla']) }}
                        {!! $errors->first('talla', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
