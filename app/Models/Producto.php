<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $id_categoria
 * @property $nombre
 * @property $precio
 * @property $cantidad
 * @property $descripcion
 * @property $imagen
 * @property $publico
 * @property $created_at
 * @property $updated_at
 * @property $talla
 * @property $idMaterial
 *
 * @property Categoria $categoria
 * @property Destinatario[] $destinatarios
 * @property DetallePedido[] $detallePedidos
 * @property Inventario[] $inventarios
 * @property Materiale $materiale
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    
    static $rules = [
		'id_categoria' => 'required',
        'idMaterial' => 'required',
        'idColor' => 'required',
		'nombre' => 'required',
		'precio' => 'required',
		'cantidad' => 'required',
		'descripcion' => 'required',
		'imagen' => 'required|image',
		'publico' => 'required',
		'idMaterial' => 'required',
    ];
    protected $attributes = [
        'descripcion'=>"Borde:\nRaso:\nTafilete:\nForro:\nToquillo:\nPlumas:\nLogo:\nCordon:\nOtros:"
    ];
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_categoria','idMaterial','idColor','nombre','precio','cantidad','descripcion','imagen','publico','talla'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'id_categoria');
    }
    public function material()
    {
        return $this->hasOne('App\Models\Materiale', 'id', 'idMaterial');
    }
    public function color()
    {
        return $this->hasOne('App\Models\Colore', 'id', 'idColor');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinatarios()
    {
        return $this->hasMany('App\Models\Destinatario', 'id_producto', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallePedidos()
    {
        return $this->hasMany('App\Models\DetallePedido', 'id_producto', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany('App\Models\Inventario', 'id_producto', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function materiale()
    {
        return $this->hasOne('App\Models\Materiale', 'id', 'idMaterial');
    }
}
