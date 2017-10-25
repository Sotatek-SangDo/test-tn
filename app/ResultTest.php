<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultTest extends Model
{
    public $table = 'result_tests';

    public $fillable = [
        'user_id',
        'subject_id',
        'date',
        'mark',
        'exam_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'subject_id' => 'integer',
        'date' => 'date',
        'mark' => 'integer',
        'exam_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'integer',
        'subject_id' => 'integer',
        'date' => 'date',
        'mark' => 'integer',
        'exam_id' => 'string'
    ];
}
