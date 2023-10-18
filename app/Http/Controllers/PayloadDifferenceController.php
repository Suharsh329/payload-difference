<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PayloadDifferenceController extends Controller
{
    /**
     * Store request and return difference
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $data = $request->all();

        // Fetch the old request body if it exists ([] if it doesn't exist)
        $oldPayload = $request->old();

        $result = comparePayloads(firstPayload: $oldPayload, secondPayload: $data);

        // Store the current request in session (file)
        // Can add condition to prevent comparison of successive requests
        $request->flash();

        return response()->json($result);
    }
}
