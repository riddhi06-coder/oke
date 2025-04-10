<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EventDetail extends Model
{
    use HasFactory;

    protected $table = 'event_details';
    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'banner_title',
        'banner_image',
        'description',
        'event_images',
        'contact_heading',
        'contact_title',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
