<?php

namespace Roberts\Leads\Tests\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Tipoff\Support\Models\TestModelStub;

class Phone extends Model
{
    use TestModelStub;

    protected $guarded = [
        'id',
    ];
}
