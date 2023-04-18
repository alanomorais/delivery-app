<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemEntrega extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_entrega',
        'observacao',
        'status',
        'entrega_id',
        'pedido_id'
    ];

    public function entrega()
    {
        return $this->belongsTo(Entrega::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
