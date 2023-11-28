<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class BusinessProfile extends Eloquent
{
    use HasFactory;

    protected $collection = 'business_profiles';
    protected $guarded = [];

}
