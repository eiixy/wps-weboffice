<?php

namespace Eiixy\WebOffice\Models;

use App\Models\Traits\HasChildren;
use App\Models\Traits\HasResources;
use App\Models\Traits\HasUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class WebOfficeResourceVersion extends Model
{
    protected $table = 'web_office_resource_versions';
    protected $guarded = [];
}
