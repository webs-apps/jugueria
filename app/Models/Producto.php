<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'tipo',
        'precio',
        'foto'
    ];

    protected $casts = [
        'precio' => 'decimal:2'
    ];

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class);
    }

    public function gastos(): HasMany
    {
        return $this->hasMany(Gasto::class);
    }
}
