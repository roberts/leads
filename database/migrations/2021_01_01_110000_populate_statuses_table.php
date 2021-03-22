<?php

use Illuminate\Database\Migrations\Migration;
use Roberts\Leads\Enums\LeadStatus;
use Roberts\Leads\Models\Lead;
use Tipoff\Statuses\Models\Status;

class PopulateStatusesTable extends Migration
{
    public function up()
    {
        Status::publishStatuses(Lead::STATUS_TYPE, LeadStatus::getValues());
    }
}
