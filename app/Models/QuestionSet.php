<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSet extends Model
{
    use HasFactory;

    protected $table = 'QuestionSets';
    protected $fillable = [
        'id',
        'Name',
        'QuestionsNum',
    ];
}
