<?php

namespace Modules\FormSubmit\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\FormSubmit\Database\Factories\FormdataFactory;

class Formdata extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): FormdataFactory
    // {
    //     // return FormdataFactory::new();
    // }
}
