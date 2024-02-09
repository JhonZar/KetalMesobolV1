<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Inventario
 *
 * @property $id
 * @property $id_producto
 * @property $id_usuario
 * @property $fecha
 * @property $cantidad
 * @property $tipo_Transaccion
 * @property $created_at
 * @property $updated_at
 *
 * @property Producto $producto
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Inventario extends Model
{
    
    static $rules = [
		'id_producto' => 'required',
		'id_usuario' => 'required',
		'fecha' => 'required',
		'cantidad' => 'required',
		'tipo_Transaccion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_producto','id_usuario','fecha','cantidad','tipo_Transaccion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'id_producto');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuario()
    {
        return $this->hasOne('App\Models\Usuario', 'id', 'id_usuario');
    }
    

}
