<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class HistorySold extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'payment_type',
        'total_price',
        'address',
        'muljal',
        'address_phone_number',
        'long',
        'lat',
        'name',
        'accepted',
        'accepted_time',
        'order_time',
        'data'
    ];
}
