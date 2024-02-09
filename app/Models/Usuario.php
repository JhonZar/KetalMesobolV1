<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Usuario
 *
 * @property $id
 * @property $id_empleado
 * @property $nombre
 * @property $contra
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property AtencionSucursale[] $atencionSucursales
 * @property Empleado $empleado
 * @property Inventario[] $inventarios
 * @property Pedido[] $pedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Usuario extends Model
{
    use Notifiable;
    
    static $rules = [
		'id_empleado' => 'required',
		'nombre' => 'required',
		'contra' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_empleado','nombre','contra','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function atencionSucursales()
    {
        return $this->hasMany('App\Models\AtencionSucursale', 'id_usuario', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empleado()
    {
        // return $this->hasOne('App\Models\Empleado', 'id', 'id_empleado');
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany('App\Models\Inventario', 'id_usuario', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany('App\Models\Pedido', 'id_usuario', 'id');
    }
    

}
