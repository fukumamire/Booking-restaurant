<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  use HasFactory;
  protected $fillable = [
    'rating',
    'comment',
    'shop_image_url'
  ];

  public function shop()
  {
    return $this->belongsTo(Shop::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
