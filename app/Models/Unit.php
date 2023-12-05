<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable=['unit_name','unit_sigle','minimum_stock_level'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
