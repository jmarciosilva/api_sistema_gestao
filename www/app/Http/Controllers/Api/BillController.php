<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillRequest;
use App\Models\Bill;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index(): JsonResponse
    {
        $bills = Bill::orderBy('id', 'DESC')->get();

        return response()->json([
            'status' => true,
            'bills' => $bills,
        ], 200);
    }

    public function show(Bill $bill): JsonResponse
    {
        return response()->json([
            'status' => true,
            'bill' => $bill,
        ], 200);
    }

    public function store(BillRequest $request): JsonResponse
    {
        // Iniciar a Transação
        DB::beginTransaction();
            
        try{
            // Cadastrando no banco de dados
            $bill = Bill::create([
                "name" => $request->name,
                "bill_value" => $request->bill_value,
                "due_date" => $request->due_date,
            ]);

            // Operação com Sucesso
            DB::commit();

            // Retornando os dados em formato json com status 201
            return response()->json([
                'status' => true,
                'bill' => $bill,
                'message' => 'Conta cadastrada com sucesso.'
            ], 201);

        }catch(Exception $e){
            // Operação não foi concluída com êxito
            DB::rollBack();

            // Retornando os dados em formato jso com status 400
            return response()->json([
                'status' => true,
                'message' => 'Conta não cadastrada!'
            ], 400);
        }
    }

    public function update(BillRequest $request, Bill $bill): JsonResponse
    {
        // Iniciar a Transação
        DB::beginTransaction();


        try{
            // editar o registro no banco de dados
            $bill->update([
                'name' => $request->name,
                "bill_value"=>  $request->bill_value,
		        "due_date" => $request->due_date
            ]);

             // Operação com Sucesso
             DB::commit();

             // Retornando os dados em formato json com status 201
             return response()->json([
                 'status' => true,
                 'bill' => $bill,
                 'message' => 'Conta editada com sucesso.'
             ], 201);

        }catch(Exception $e){
          // Operação não foi concluída com êxito
          DB::rollBack();

          // Retornando os dados em formato jso com status 400
          return response()->json([
              'status' => true,
              'message' => 'Conta não editada!'
          ], 400);  
        }
    }

}
