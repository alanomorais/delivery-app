<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'status',
    ];

    public function Pedidos(){
        return $this->hasMany(Pedido::class);
    }

    public function entregas()
    {
        return $this->hasManyThrough(
            Entrega::class,
            ItemEntrega::class,
            'cliente_id',
            'id',
            'id',
            'pedido_id'
        );
    }
}
