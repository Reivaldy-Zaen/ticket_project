<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SqliLabProduct extends Model
{
    use HasFactory;

    protected $table = 'sqli_lab_products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];
}
