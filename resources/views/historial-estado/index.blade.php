@extends('layouts.app')

@section('template_title')
    Historial Estado
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Historial Estado') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('historial-estados.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Id Estado</th>
										<th>Id Pedido</th>
										<th>Id Usuarios</th>
										<th>Fecha</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historialEstados as $historialEstado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $historialEstado->estado->nombre }}</td>
											<td>{{ $historialEstado->id_pedido }}</td>
											@if ($historialEstado->id_usuarios == null)
                                            <td class="text-danger">SIN ASIGNAR</td>
                                            @else
                                            <td>{{ optional($historialEstado->usuario)->nombre }}</td>
                                            @endif
                                        
											<td>{{ $historialEstado->fecha }}</td>

                                            <td>
                                                <form action="{{ route('historial-estados.destroy',$historialEstado->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('historial-estados.show',$historialEstado->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('historial-estados.edit',$historialEstado->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $historialEstados->links() !!}
            </div>
        </div>
    </div>


    
@endsection
