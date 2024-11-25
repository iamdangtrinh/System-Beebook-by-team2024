<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxonomyModel extends Model
{
    use HasFactory;
    protected $table = 'taxonomy';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'type',
        'name',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
}

