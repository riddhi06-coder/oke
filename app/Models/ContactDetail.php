<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactDetail extends Model
{
    use HasFactory;

    protected $table = 'contact_details';
    public $timestamps = false;

    protected $fillable = [

        'banner_title',
        'banner_heading',
        'banner_image',
        'address',
        'url',
        'business_names',
        'contact_numbers',
        'business_emails',
        'email_ids',
        'business_cards',
        'contact_names',
        'contact_emails',
        'contact_phones',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}

