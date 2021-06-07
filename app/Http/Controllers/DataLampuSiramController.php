<?php

namespace App\Http\Controllers;

use App\Models\Statistik;
use App\Models\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataLampuSiramController extends Controller
{
    /**
     * LAMPU
     */
    public function lampu()
    {
        try {
            $response = response()->json([
                'action' => 'update',
                'status' => 200,
                'msg' => 'success',
                'data' => Web::where('key','lampu')->first()->value,
            ], 200);

        } catch(\Exception $e) {
            $response = response()->json([
                'action' => 'update',
                'status' => 422,
                'msg' => 'fail',
                'errors' => $e->getMessage(),
            ], 422);
        }

        return $response;
    }
    /**
     * ON LAMPU
     */
    public function onLampu()
    {
        try {
            $web=Web::where('key','lampu')->first();
            $web->value=1;
            $web->save();
            $response = response()->json([
                'action' => 'update',
                'status' => 200,
                'msg' => 'success',
                'data' => $web->value,
            ], 200);

        } catch(\Exception $e) {
            $response = response()->json([
                'action' => 'update',
                'status' => 422,
                'msg' => 'fail',
                'errors' => $e->getMessage(),
            ], 422);
        }

        return $response;
    }
    /**
     * OFF LAMPU
     */
    public function offLampu()
    {
        try {
            $web=Web::where('key','lampu')->first();
            $web->value=0;
            $web->save();
            $response = response()->json([
                'action' => 'update',
                'status' => 200,
                'msg' => 'success',
                'data' => $web->value,
            ], 200);

        } catch(\Exception $e) {
            $response = response()->json([
                'action' => 'update',
                'status' => 422,
                'msg' => 'fail',
                'errors' => $e->getMessage(),
            ], 422);
        }

        return $response;
    }
    /**
     * SIRAM
     */
    public function siram()
    {
        try {
            $response = response()->json([
                'action' => 'update',
                'status' => 200,
                'msg' => 'success',
                'data' => Web::where('key','siram')->first()->value,
            ], 200);

        } catch(\Exception $e) {
            $response = response()->json([
                'action' => 'update',
                'status' => 422,
                'msg' => 'fail',
                'errors' => $e->getMessage(),
            ], 422);
        }

        return $response;
    }
    /**
     * ON SIRAM
     */
    public function onSiram()
    {
        try {
            $web=Web::where('key','siram')->first();
            $web->value=1;
            $web->save();
            $response = response()->json([
                'action' => 'update',
                'status' => 200,
                'msg' => 'success',
                'data' => $web->value,
            ], 200);

        } catch(\Exception $e) {
            $response = response()->json([
                'action' => 'update',
                'status' => 422,
                'msg' => 'fail',
                'errors' => $e->getMessage(),
            ], 422);
        }

        return $response;
    }
    /**
     * OFF SIRAM
     */
    public function offSiram()
    {
        try {
            $web=Web::where('key','siram')->first();
            $web->value=0;
            $web->save();
            $response = response()->json([
                'action' => 'update',
                'status' => 200,
                'msg' => 'success',
                'data' => $web->value,
            ], 200);

        } catch(\Exception $e) {
            $response = response()->json([
                'action' => 'update',
                'status' => 422,
                'msg' => 'fail',
                'errors' => $e->getMessage(),
            ], 422);
        }

        return $response;
    }
}
