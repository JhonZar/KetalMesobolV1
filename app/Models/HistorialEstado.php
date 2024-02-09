<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HistorialEstado
 *
 * @property $id
 * @property $id_estado
 * @property $id_pedido
 * @property $id_usuarios
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @property Estado $estado
 * @property Pedido $pedido
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class HistorialEstado extends Model
{
    
    static $rules = [
		'id_estado' => 'required',
		'id_pedido' => 'required',
		'id_usuarios' => 'required',
		'fecha' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_estado','id_pedido','id_usuarios','fecha'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estado()
    {
        return $this->hasOne('App\Models\Estado', 'id', 'id_estado');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pedido()
    {
        return $this->hasOne('App\Models\Pedido', 'id', 'id_pedido');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuario()
    {
        return $this->hasOne('App\Models\Usuario', 'id', 'id_usuarios');
    }
    

}
