<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $table = 'subjects';

    public $fillable = [
        'id',
        'name',
        'time_test',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'time_test' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id' => 'integer',
        'name' => 'string',
        'time_test' => 'string',
    ];
}
