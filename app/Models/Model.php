<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{

    /**
     * FILTER
     *
     * @return object class
     */
    public static function filter(array $conditions)
    {

        $model = static::class;
        $obj = new $model();

        if (! isset($conditions['pagination'])) {
            $conditions['pagination'] = [
                'page' => 1,
                'limit' => 50,
            ];
        }

        $pagination = $conditions['pagination'];
        unset($conditions['pagination']);

        foreach ($conditions as $key => $condition) {

            if (is_array($condition)) {
                if (count($condition) == 1) {
                    $obj = $obj->where($key, $condition[0]);
                } elseif (count($condition) == 2) {
                    if (strtolower(trim($condition[0])) === 'between') {
                        $obj = $obj->whereBetween($key, $condition[1]);
                    } else {
                        $obj = $obj->where($key, $condition[0], $condition[1]);
                    }
                } elseif (count($condition) == 3) {
                    if (strtolower(trim($condition[0])) === 'between') {
                        $obj = $obj->whereBetween($key, $condition[1], $condition[2]);
                    } else {
                        $obj = $obj->where($key, $condition[0], $condition[1], $condition[2]);
                    }
                } else {
                    throw new \Exception("Invalid " . strtoupper($key) . " condition", 1);
                }
            } else {
                if (is_numeric($condition) || is_bool($condition)) {
                    $obj = $obj->where($key, $condition);
                } elseif (is_string($condition)) {
                    $obj = $obj->where($key, 'LIKE', $condition);
                } elseif (is_null($condition)) {
                    $obj = $obj->whereNull($key);
                } else {
                    throw new \Exception("Invalid " . strtoupper($key) . " condition", 2);
                }
            }
        }

        if (! blank($pagination) && is_array($pagination)) {
            $obj = $obj->paginate($pagination['limit'], ['*'], 'page', $pagination['page']);
        } else {
            $obj = $obj->paginate();
        }

        return $obj;
    }
}