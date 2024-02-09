<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="id_cliente">Selecciona un cliente:</label>
                    <select class="form-control{{ $errors->has('id_cliente') ? ' is-invalid' : '' }}" name="id_cliente"
                        id="id_cliente">
                        <option value="" disabled selected>Selecciona un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option
                                value="{{ $cliente->id }}"{{ $pedido->id_cliente == $cliente->id ? ' selected' : '' }}>
                                {{ $cliente->nombre }} {{ $cliente->apellido }}
                                ({{ $cliente->ci }})
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('id_cliente', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('id_usuario', 'Id Usuario') }}
                    {{ Form::text('id_usuario', session('usuario_id'), [
                        'class' => 'form-control' . ($errors->has('id_usuario') ? ' is-invalid' : ''),
                        'placeholder' => 'Id Usuario',
                        'readonly' => 'readonly', // Agregar el atributo readonly
                    ]) }}
                    {!! $errors->first('id_usuario', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('fecha', 'Fecha') }}
                    {{ Form::text('fecha', now()->format('Y-m-d'), [
                        'class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''),
                        'placeholder' => 'Fecha',
                        'readonly' => 'readonly', // Agregar el atributo readonly
                    ]) }}
                    {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('estado', 'Estado') }}
                    {{ Form::select('estado', ['VENTA' => 'VENTA', 'PEDIDO' => 'PEDIDO',$pedido->estado=>$pedido->estado], $pedido->estado, ['class' => 'form-control']) }}
                    {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
                </div>
               
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
