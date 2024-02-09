<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sucursale
 *
 * @property $id
 * @property $nombre
 * @property $direccion
 * @property $telefono
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property AtencionSucursale[] $atencionSucursales
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sucursale extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'direccion' => 'required',
		'telefono' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','direccion','telefono','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function atencionSucursales()
    {
        return $this->hasMany('App\Models\AtencionSucursale', 'id_sucursal', 'id');
    }
    

}
