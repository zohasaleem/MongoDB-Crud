<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use AptCD\Permission\Traits\HasRoles;


class BusinessProfile extends Model
{
    use HasFactory, HasRoles;

    protected $guard_name = 'web';
    protected $collection = 'business_profiles';
    protected $guarded = [];

}
