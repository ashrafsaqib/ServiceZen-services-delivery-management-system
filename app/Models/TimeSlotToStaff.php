<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlotToStaff extends Model
{
    use HasFactory;

    protected $fillable = ['time_slot_id','staff_id'];
}
