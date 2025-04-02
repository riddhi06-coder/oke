<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessDetail extends Model
{
    use HasFactory;

    protected $table = 'business_details';
    public $timestamps = false;

    protected $fillable = [
        'business_id',
        'banner_label',
        'banner_image',
        'logo',
        'banner_heading',
        'banner_description',
        'year',
        'project_completed',
        'industry_label',
        'industry_heading',
        'industry_image',
        'industry_images',
        'industry_descriptions',
        'service_heading',
        'service_images',
        'service_descriptions',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
