<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    protected $fillable=['name'];

    public function role()
    {
        return $this->belongsTo(Role::class)->withTimestamps();
    }
}
