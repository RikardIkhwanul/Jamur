<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataFotoController extends Controller
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
                'foto' => 'mimes:jpg|max:2000|required',
            ],
            'U' => [
                'foto' => 'mimes:jpg|max:2000',
            ],
        ];

        return Validator::make($data, $rules[$method]);
    }

    public function readfoto(){
        if (request()->ajax()){
            $data = foto::latest('updated_at')->first();
            return response()->json(['result' => $data]);
        }
    } 

    /**
     * PLUCKS - plucks foto
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
     * INDEX - list dataFoto
     *
     * @return json dataFoto.list
     */
    public function list(Request $request)
    {
        // try {
        //     $r = $request->all();

            // $dataFoto = Foto::get();

            // $response = response()->json([
            //     'action' => 'list',
            //     'status' => 200,
            //     'conditions' => $r,
            //     'msg' => 'success',
            //     'data' => $dataFoto, //tadinya dataFoto
            // ], 200);
        // } catch(\Exception $e) {
        //     $response = response()->json([
        //         'action' => 'list',
        //         'status' => 422,
        //         'conditions' => $r,
        //         'msg' => 'fail',
        //         'data' => $e->getMessage(),
        //     ], 422);
        // }
        // return $response;

        $dataset = Foto::latest('updated_at')->get();
        return view('data-foto.index',['dataset' => $dataset]);
    }
    /**
     * CREATE - foto
     *
     * @param  Request $request
     * @return json foto.created
     */
    public function create(Request $request)
    {
        try {
            $valid = $this->validator($request->all());

            if (!$valid->fails()){
                $title=(time().'.jpg');
                $file=app()->basePath('public/kamera/');
                $request->file('foto')->move($file,$title);
                $data=$request->except(['foto']);
                $data['foto']='kamera/'.$title;
                $statistik = Foto::create($data);
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
     * READ - read foto
     *
     * @param  integer $id  foto->id
     * @return json         foto.readed
     */
    public function read($id, Request $request)
    {
        try{
            $foto = Foto::find($id);

            if (! blank($foto)) {
                $response = response()->json([
                    'action' => 'read',
                    'status' => 200,
                    'msg' => 'success',
                    'foto' => $foto->relationships(),
                ], 200);
            } else {
                $response = response()->json([
                    'action' => 'read',
                    'status' => 404,
                    'msg' => 'fail',
                    'errors' => [
                        'foto' => ['Not found'],
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
     * UPDATE - update foto
     *
     * @param  integer $id      foto->id
     * @param  Request $request
     * @return json             foto.updated
     */
    public function update($id, Request $request)
    {
        try {
            $foto = Foto::find($id);

            if (! blank($foto)) {
                $valid = $this->validator($request->all(), 'U', $id);

                if (!$valid->fails()){
                    $foto->update($request->all());
                    $foto->syncRelationships($request->all());

                    $response = response()->json([
                        'action' => 'update',
                        'status' => 200,
                        'msg' => 'success',
                        'foto' => $foto->relationships(),
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
                        'foto' => ['Not found'],
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
     * DELETE - delete foto
     *
     * @param  integer $id      foto->id
     * @return json         foto.deleted
     */
    public function delete($id, Request $request)
    {
        try {
            $foto = Foto::find($id);

            if (! blank($foto)) {
                $clone = clone $foto;

                $foto->delete();

                $response = response()->json([
                    'action' => 'delete',
                    'status' => 200,
                    'msg' => 'success',
                    'foto' => $clone,
                ], 200);

            } else {
                $response = response()->json([
                    'action' => 'delete',
                    'status' => 404,
                    'msg' => 'fail',
                    'errors' => [
                        'foto' => ['Not found'],
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
