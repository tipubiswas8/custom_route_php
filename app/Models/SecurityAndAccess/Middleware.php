<?php

namespace App\Models\SecurityAndAccess;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Middleware extends Model
{
    use HasFactory;
    protected  $table = 'middlewares';
    protected $fillable  = ['name', 'description', 'active_status'];

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('description', 'LIKE', "%{$searchTerm}%");
    }
}
