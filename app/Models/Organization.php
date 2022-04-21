<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Organization extends Model
{
    use HasFactory;
    

    public function user(){
        return $this->belongsTo(User::class,'id');
    }

    public function adminwhoVerified(){
        // return $this->belongsTo(Admin::class,'id');
        return $this->belongsTo(Admin::class, 'verifiedby');
    }

    public function orgcases()
    {
        return $this->hasMany(DonationCase::class,'organization_id');
    }
}
