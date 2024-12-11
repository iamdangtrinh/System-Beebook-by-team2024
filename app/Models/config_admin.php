<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class config_admin extends Model
{
    use HasFactory;
    protected $table = 'config_admin';
    protected $primaryKey = 'id';
    protected $fillable = ['key', 'value'];
}
