<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::with('pedidos')->paginate(10);


        if (!$clientes) return response()->json(['error' => 'Registro não encontrado'], 404);

        return response()->json($clientes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $data = $request->all();
            $cliente = Cliente::create($data);

            return response()->json([
                'data' => [
                    'msg' => 'cliente registrado com sucesso',
                    'cliente' => $cliente
                ]
            ], 200);

        }catch (\Exception $e){
            
            return response()->json([$e->getMessage(), 401]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {

        $cliente = Cliente::find($cliente);

        if (!$cliente) return response()->json(['error' => 'Registro não encontrado'], 404);

        return response()->json($cliente, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente = Cliente::find($cliente)->first();

        if (!$cliente) return response()->json(['error' => 'Registro não encontrado'], 404);


        $data_request = $request->all();

        $cliente->nome = $data_request['nome'];
        $cliente->telefone = $data_request['telefone'];
        $cliente->email = $data_request['email'];
        $cliente->status = $data_request['status'];

        try {
            if ($cliente->save()) {                
                return response()->json([' cadastro do cliente  atualizado com sucesso'], 200);
            }else{
                return response()->json(['error' => 'Não Foi possível atualizar o cadastro do cliente'], 404);
            }
        } catch (\Exception $ex) {
            return response()->json(['error' => "Não Foi possível atualizar o cadastro do cliente. " . $ex->getMessage()], 404);
        }

        return response()->json([' cadastro do cliente  atualizado com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($cliente)
    {
        try {
            $cliente = Cliente::findOrFail($cliente);
            $pedidos = $cliente->pedidos()->first();

            if (!$cliente) return response()->json('Registro não encontrado', 404);

            if (!empty($pedidos)) {
                
                return response()->json("O cliente possui movimentação e não pode ser removido", 401);
            } else {

                $cliente->delete();

                return response()->json([
                    'data' => [
                        'msg' => 'cliente removido com sucesso'
                    ]
                ], 200);
            }
        } catch (\Exception $e) {
            
            return response()->json(["cliente informando não localidado", 401]);
        }
    }
}
