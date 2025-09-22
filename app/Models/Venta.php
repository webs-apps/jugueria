<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venta extends Model
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

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
