<input type="hidden" name="id_pedido" value="{{ $pedido->id }}">

<div class="mb-3">
    <label for="id_estado" class="form-label">Seleccionar Estado</label>
    <select class="form-control" id="id_estado" name="id_estado">
        @foreach ($estados as $estado)
            <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Seleccionar Usuario</label>
    <div class="form-check">
        @foreach ($usuarios as $usuario)
            <input class="form-check-input" type="radio" name="id_usuario" id="usuario{{ $usuario->id }}"
                value="{{ $usuario->id }}">
            <label class="form-check-label" for="usuario{{ $usuario->id }}">
                {{ $usuario->nombre }}
            </label>
            <br>
        @endforeach
    </div>
</div>

<button type="submit" class="btn btn-primary">Crear HistorialEstado</button>
