<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use AptCD\Permission\Traits\HasRoles;

class Blog extends Model
{
    use HasFactory, HasRoles;

    protected $guard_name = 'web';
    protected $collection = 'blogs';
    protected $guarded = [];
}
