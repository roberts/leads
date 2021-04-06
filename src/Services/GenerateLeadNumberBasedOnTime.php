<?php

namespace Roberts\Leads\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Roberts\Leads\Models\Lead;

class GenerateLeadNumberBasedOnTime extends GenerateLeadNumber
{
    public function __invoke(Lead $lead)
    {
        do {
            $number = Str::of(Carbon::now(config('app.timezone'))
                    ->format('ymdB'))
                    ->substr(1, 7) . Str::upper(Str::random(2));
        } while ($this->leadNumberExists($number));

        return $number;
    }
}
