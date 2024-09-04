<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
