<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCareer extends Model
{
    use HasFactory;

    protected $table = 'career_page_details';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_title',
        'banner_image',
        'page_heading',
        'page_title',
        'image',
        'description',
        'review_heading',
        'review_title',
        'rating_heading',
        'ratings',
        'other_description',
        'profile_images',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
