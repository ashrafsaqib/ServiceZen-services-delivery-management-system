<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = ['name','time_start','time_end','active','type','date','group_id','space_availability','available_staff'];

    public function group()
    {
        return $this->hasOne(StaffGroup::class,'id','group_id');
    }

    public function appointment(){
        return $this->hasMany(ServiceAppointment::class,'time_slot_id','id');
    }

    public function staffGroup()
    {
        return $this->belongsTo(StaffGroup::class, 'group_id');
    }
}
