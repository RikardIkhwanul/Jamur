<?php

namespace App\Models;

use App\Models\Model;


class Statistik extends Model
{
    

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'data_statistik';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'temperatur', 'kelembaban',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        
    ];

    /**
     * Campos do tipo Date da tabela
     *
     * @var array
     */
    protected $dates = [

    ];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('d-m-Y H:i:s');
    }
    
    
    

    /**
     * syncRelationships
     */
    public function syncRelationships(Array $data)
    {
        
    }

    /**
     * Relationships
     */
    public function relationships()
    {
        $this->relationships = [
            
        ];

        return $this;
    }
}
