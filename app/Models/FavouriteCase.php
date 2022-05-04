<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteCase extends Model
{
    protected $fillable=['user_id','case_id'];
    use HasFactory;
}
