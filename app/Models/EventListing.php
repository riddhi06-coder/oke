<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventListing extends Model
{
    use HasFactory;

    protected $table = 'events_listing';
    public $timestamps = false;

    protected $fillable = [
        'banner_title',
        'banner_heading',
        'banner_image',
        'events_title',
        'slug',
        'image',
        'event_loaction',
        'event_date',
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
