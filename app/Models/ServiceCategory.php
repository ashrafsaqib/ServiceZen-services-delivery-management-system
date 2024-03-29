<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = ['title', 'description','parent_id','status'];
    
    public function service()
    {
        return $this->hasMany(Service::class,'category_id','id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'parent_id');
    }

    public function childCategories()
    {
        return $this->hasMany(ServiceCategory::class, 'parent_id');
    }

    public function FAQs()
    {
        return $this->hasMany(FAQ::class,'category_id')->where('status', '=', 'your_desired_status');
    }
}
