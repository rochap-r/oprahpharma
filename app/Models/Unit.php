<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable=['unit_name','unit_sigle'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
