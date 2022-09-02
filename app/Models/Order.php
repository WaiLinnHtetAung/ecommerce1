<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','first_name','last_name','member_card','birthday','gender','company',
    'street','city','town','email','phone',
    'payment','records','price','qty','tax',
    ];
}
