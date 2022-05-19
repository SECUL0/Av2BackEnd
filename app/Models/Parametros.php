<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class av2 extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cabeca',
        'orelha',
        'olho',
        'nariz',
        'boca',
        'queixo',
        'braco',
        'tronco',
        'perna',
        'pe'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cabeca' => 'int',
        'orelha' => 'int',
        'olho' => 'int',
        'nariz' => 'int',
        'boca' => 'int',
        'queixo' => 'int',
        'braco' => 'int',
        'tronco' => 'int',
        'perna' => 'int',
        'pe' => 'int',
       
    ];
}