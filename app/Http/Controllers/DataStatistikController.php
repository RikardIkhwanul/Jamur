<?php

namespace App\Http\Controllers;

use App\Models\Statistik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataStatistikController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @param  string $method (default: C)
     * @param  int $id (default: null)
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, string $method = 'C', int $id = null)
    {
        $rules = [
            'C' => [
                'temperatur' => 'regex:/^\d+(\.\d{1,2})?$/|required',
                'kelembaban' => 'regex:/^\d+(\.\d{1,2})?$/|required',
                // 'foto' => 'mimes:jpg|max:2000|required',
            ],
            'U' => [
                'temperatur' => 'regex:/^\d+(\.\d{1,2})?$/',
                'kelembaban' => 'regex:/^\d+(\.\d{1,2})?$/',
                // 'foto' => 'mimes:jpg|max:2000',
            ],
        ];

        return Validator::make($data, $rules[$method]);
    }

    /**
     * PLUCKS - plucks statistik
     *
     * @return json plucks
     */
    public function plucks ()
    {
        $response = response()->json([
            'action' => 'plucks',
            'status' => 200,
            'msg' => 'success',
            'plucks' => [
                
            ],
        ], 200);

        return $response;
    }

    /**
     * INDEX - list dataStatistik
     *
     * @return json dataStatistik.list
     */
    public function list(Request $request)
    {
        if(request()->ajax()){
            try {
                $r = $request->all();

                $dataStatistik = Statistik::orderBy('id','desc')->get();

                $response = response()->json([
                    'action' => 'list',
                    'status' => 200,
                    'conditions' => $r,
                    'msg' => 'success',
                    'data' => $dataStatistik, //tadinya 'statistik' => $dataStatistik
                ], 200);

            } catch(\Exception $e) {
                $response = response()->json([
                    'action' => 'list',
                    'status' => 422,
                    'conditions' => $r,
                    'msg' => 'fail',
                    'data' => $e->getMessage(), //tadinya 'errors' => $e->getMessage()
                ], 422);
            }

            return $response;
        }

        return view('data-statistik.index');
    }

    public function temperatur(){
        if(request()->ajax()){
            $data = Statistik::latest('updated_at')->first();

            return response()->json(['result' => $data]);
        }
    }

    public function kelembaban(){
        if(request()->ajax()){
            $data = Statistik::latest('updated_at')->first();

            return response()->json(['result' => $data]);
        }
    }

    /**
     * CREATE - statistik
     *
     * @param  Request $request
     * @return json statistik.created
     */
    public function create(Request $request)
    {
        try {
            $valid = $this->validator($request->all());

            if (!$valid->fails()){
                // $title=(time().'.jpg');
                // $file=app()->basePath('public/foto/');
                // $request->file('foto')->move($file,$title);
                $data=$request->except(['foto']);
                // $data['foto']='foto/'.$title;
                $statistik = Statistik::create($data);
                $statistik->syncRelationships($data);

                $response = response()->json([
                    'action' => 'create',
                    'status' => 200,
                    'msg' => 'success',
                    'statistik' => $statistik->relationships(),
                ], 200);

            } else {
                $response = response()->json([
                    'action' => 'create',
                    'status' => 422,
                    'msg' => 'fail',
                    'errors' => $valid->errors(),
                ], 422);
            }

        } catch(\Exception $e) {
            $response = response()->json([
                'action' => 'create',
                'status' => 422,
                'msg' => 'fail',
                'errors' => $e->getMessage(),
            ], 422);
        }

        return $response;
    }

    /**
     * READ - read statistik
     *
     * @param  integer $id  statistik->id
     * @return json         statistik.readed
     */
    public function read($id, Request $request)
    {
        try{
            $statistik = Statistik::find($id);

            if (! blank($statistik)) {
                $response = response()->json([
                    'action' => 'read',
                    'status' => 200,
                    'msg' => 'success',
                    'statistik' => $statistik->relationships(),
                ], 200);
            } else {
                $response = response()->json([
                    'action' => 'read',
                    'status' => 404,
                    'msg' => 'fail',
                    'errors' => [
                        'statistik' => ['Not found'],
                    ],
                ], 404);
            }
        } catch(\Exception $e) {
            $response = response()->json([
                'action' => 'read',
                'status' => 422,
                'msg' => 'fail',
                'errors' => $e->getMessage(),
            ], 422);
        }

        return $response;
    }

    /**
     * UPDATE - update statistik
     *
     * @param  integer $id      statistik->id
     * @param  Request $request
     * @return json             statistik.updated
     */
    public function update($id, Request $request)
    {
        try {
            $statistik = Statistik::find($id);

            if (! blank($statistik)) {
                $valid = $this->validator($request->all(), 'U', $id);

                if (!$valid->fails()){
                    $statistik->update($request->all());
                    $statistik->syncRelationships($request->all());

                    $response = response()->json([
                        'action' => 'update',
                        'status' => 200,
                        'msg' => 'success',
                        'statistik' => $statistik->relationships(),
                    ], 200);

                } else {
                    $response = response()->json([
                        'action' => 'update',
                        'status' => 422,
                        'msg' => 'fail',
                        'errors' => $valid->errors(),
                    ], 422);
                }

            } else {
                $response = response()->json([
                    'action' => 'update',
                    'status' => 404,
                    'msg' => 'fail',
                    'errors' => [
                        'statistik' => ['Not found'],
                    ],
                ], 404);
            }

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
     * DELETE - delete statistik
     *
     * @param  integer $id      statistik->id
     * @return json         statistik.deleted
     */
    public function delete($id, Request $request)
    {
        try {
            $statistik = Statistik::find($id);

            if (! blank($statistik)) {
                $clone = clone $statistik;

                $statistik->delete();

                $response = response()->json([
                    'action' => 'delete',
                    'status' => 200,
                    'msg' => 'success',
                    'statistik' => $clone,
                ], 200);

            } else {
                $response = response()->json([
                    'action' => 'delete',
                    'status' => 404,
                    'msg' => 'fail',
                    'errors' => [
                        'statistik' => ['Not found'],
                    ],
                ], 404);
            }
        } catch(\Exception $e) {
            $response = response()->json([
                'action' => 'delete',
                'status' => 422,
                'msg' => 'fail',
                'errors' => $e->getMessage(),
            ], 422);
        }

        return $response;
    }
}
