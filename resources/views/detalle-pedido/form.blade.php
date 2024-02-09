<div class="box box-info padding-1">
    <div class="box-body">
        Pedido Actual {{ session('pasoNroPed') }}
        <div class="form-group">
            {{ Form::label('id_pedido', 'Seleccionar Pedido') }}
            {{ Form::select('id_pedido', $opciones, null, ['class' => 'form-control' . ($errors->has('id_pedido') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un Pedido']) }}
            {!! $errors->first('id_pedido', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group input-group">
            {{ Form::label('id_producto', 'Id Producto') }}
            <div class="input-group">
                {{ Form::select('id_producto', $producto, $detallePedido->id_producto, ['class' => 'form-control' . ($errors->has('id_producto') ? ' is-invalid' : ''), 'placeholder' => 'Id Producto']) }}
                <div class="input-group-append">
                    <a class="btn btn-outline-secondary" href="{{ route('productos.index') }}">Agregar productos</a>
                    <a class="btn btn-outline-secondary" href="{{ route('carrito') }}">Carrito</a>
                </div>
            </div>
            {!! $errors->first('id_producto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <h3><strong>Total a Pagar: {{ session('precioTotalCarrito') }} Bs.</strong></h3>
        <div class="form-group">
            {{ Form::label('acc', 'A cuenta') }}
            {{ Form::number('acc', null, ['class' => 'form-control' . ($errors->has('acc') ? ' is-invalid' : ''), 'placeholder' => 'Pago']) }}
            {!! $errors->first('acc', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
