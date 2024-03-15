<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Service extends Model
{
    protected $fillable = ['name','image', 'description', 'price','duration','category_id','short_description','discount','status','type'];
    
    public function averageRating()
    {
        return Review::where('service_id', $this->id)->avg('rating');
    }

    public function appointments()
    {
        return $this->hasMany(OrderService::class);
    }

    public function package()
    {
        return $this->hasMany(ServicePackage::class);
    }

    public function userNote()
    {
        return $this->hasOne(ServiceToUserNote::class);
    }
    
    public function orderServices()
    {
        return $this->hasMany(OrderService::class);
    }

    public function addONs()
    {
        return $this->hasMany(ServiceAddOn::class);
    }

    public function variant()
    {
        return $this->hasMany(ServiceVariant::class);
    }
    
    public function FAQs()
    {
        return $this->hasMany(FAQ::class,'service_id')->where('status', '=', '1');;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'staff_to_services', 'service_id', 'staff_id');
    }

    public function categories()
    {
        return $this->belongsToMany(ServiceCategory::class, 'service_to_category', 'service_id', 'category_id');
    }

    // protected function price(): Attribute
    // {
    //     return Attribute::make(
    //         get: function ($price) {
    //             $address = json_decode(request()->cookie('address'), true);
    //             $area = $address['area'] ?? '';
    //             $zone = StaffZone::where('name', $area)->first();

    //             if ($zone && $zone->currency) {
    //                 if ($zone->currency_rate > 0) {
    //                     $price = $zone->currency_rate * $price;
    //                 }
    //                 $price += $zone->extra_charges;
    //             }

    //             ucfirst($price);
    //         } 
    //     );
    // }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: function ($price) {
                $address = json_decode(request()->cookie('address'), true);

                if (empty($address) || !is_array($address)) {
                    return $price;
                }

                $area = $address['area'] ?? '';
                $zone = StaffZone::where('name', $area)->first();

                if ($zone) {
                    if ($zone->currency_rate > 0) {
                        $price = $zone->currency_rate * $price;
                    }
                
                    $price += $zone->extra_charges;
                
                    return $price;
                }

                return number_format($price, 2, '.', ''); 
            },
        );
    }

    protected function discount(): Attribute
    {
        return Attribute::make(
            get: function ($discount) {
                if($discount == null){
                    return null;
                }
                $address = json_decode(request()->cookie('address'), true);

                if (empty($address) || !is_array($address)) {
                    return $discount;
                }

                $area = $address['area'] ?? '';
                $zone = StaffZone::where('name', $area)->first();

                if ($zone) {
                    if ($zone->currency_rate > 0) {
                        $discount = $zone->currency_rate * $discount;
                    }
                
                    $discount += $zone->extra_charges;
                
                    return $discount;
                }

                return number_format($discount, 2, '.', ''); 
            },
        );
    }
}
