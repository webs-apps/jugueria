<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gasto extends Model
{
    protected $fillable = [
        'producto_id',
        'cantidad',
        'precio_unitario',
        'total',
        'user_id',
        'fecha'
    ];

    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'total' => 'decimal:2',
        'fecha' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gasto) {
            // Validar que la cantidad sea mayor a 0
            if ($gasto->cantidad <= 0) {
                throw new \InvalidArgumentException('La cantidad debe ser mayor a 0');
            }

            // Validar que el total sea mayor a 0
            if ($gasto->total <= 0) {
                throw new \InvalidArgumentException('El total debe ser mayor a 0');
            }

            // Validar que el precio unitario sea mayor a 0
            if ($gasto->precio_unitario <= 0) {
                throw new \InvalidArgumentException('El precio unitario debe ser mayor a 0');
            }
        });
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
