<?php

namespace App\Models\FirstTest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'modules';
}
