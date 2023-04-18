<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'data_emissao',
        'observacao',
        'entregador_id',        
        'status',
    ];

    
    public function entregador()
    {
        return $this->belongsTo(Entrega::class);
    }

    public function itens(){
        return $this->hasMany(ItemEntrega::class);
    }

}
