<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomePage extends Model
{
    use HasFactory;

    protected $table = 'home_details';
    public $timestamps = false;

    protected $fillable = [
        'banner_title',
        'banner_heading',
        'banner_image',
        'card_title',
        'company_logo',
        'company_name',
        'description',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
