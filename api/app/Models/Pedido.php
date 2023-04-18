<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        'pedido',
        'data_pedido',
        'data_saida',
        'data_entrega',
        'observacao',
        'cliente_id',
        'entregador_id',
        'entrega_id',
        'status'
    ];

    public function itens()
    {
        return $this->hasMany(Item::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
