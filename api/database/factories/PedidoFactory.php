<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $clientes = Cliente::all(); 
        $statusArray = ['pendente','cancelado'];
        $status = $statusArray[array_rand($statusArray)];

        

        foreach ($clientes as $cliente) {            
            return [                   
                'pedido' => rand(1, 1000),
                'data_pedido' => now(),  
                'valor' => round(rand(50,500)/100,2),
                'cliente_id' => rand(1, 50),                
                'status' => $status,
            ];
        }        
    }
}
