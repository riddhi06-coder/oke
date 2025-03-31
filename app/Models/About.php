<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory;

    protected $table = 'about_details';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_title',
        'banner_image',
        'page_heading',
        'page_title',
        'image',
        'card_title',
        'year',
        'description',
        'other_description',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
