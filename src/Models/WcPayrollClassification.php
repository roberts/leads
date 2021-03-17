<?php

namespace Roberts\WorkCompLeads\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WcPayrollClassification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo(WcLead::class, 'wc_lead_id');
    }
}
