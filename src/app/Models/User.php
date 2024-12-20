<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Shop;
use App\Models\Favorite;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Auth\Notifications\VerifyEmail;
use App\Models\BookingChange;

use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles;
  /**
   * Guard name for Spatie roles.
   *
   * @var string
   */

  public function getGuardName()
  {
    // 条件によってガード名を動的に返す
    if ($this->hasRole('shop-manager')) {
      return 'shop-manager';
    } elseif ($this->hasRole('admin')) {
      return 'admin';
    }

    return 'web'; // デフォルトは web ガード
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'shop_id',
  ];
  // role プロパティを追加
  protected $with = ['roles'];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];


  // spatie/laravel-permission パッケージを使用しているとき　管理者

  public function isAdmin(): bool
  {
    return $this->hasRole('super-admin');
  }


  public function isManager()
  {
    return $this->hasRole('shop-manager');
  }


  public function shop()
  {
    return $this->belongsTo(Shop::class);
  }

  // Favorite モデルを通じて Shop モデルとの関連付け
  public function favorites()
  {
    return $this->hasMany(Favorite::class, 'user_id');
  }

  // お気に入り登録
  public function favorite(Shop $shop)
  {
    $this->favorites()->create(['shop_id' => $shop->id]);
  }

  // お気に入り解除
  public function unfavorite(Shop $shop)
  {
    $this->favorites()->where('shop_id', $shop->id)->delete();
  }

  public function toggleFavorite(Shop $shop)
  {
    $favorite = $this->favorites()->where('shop_id', $shop->id)->first();

    if ($favorite) {
      $favorite->delete();
    } else {
      $this->favorites()->create(['shop_id' => $shop->id]);
    }
  }

  // お気に入り登録しているかどうかを確認
  public function hasFavorited(Shop $shop)
  {
    return $this->favorites()->where('shop_id', $shop->id)->exists();
  }

  // 予約変更
  public function bookingChanges()
  {
    return $this->hasMany(BookingChange::class);
  }


  public function sendEmailVerificationNotification()
  {
    $this->notify(new VerifyEmail);
  }
  // メール認証を有効にするためのメソッドを追加

  public function markEmailAsVerified()
  {
    $this->email_verified_at = now();
    $this->save();
  }

  public function isVerified()
  {
    return !is_null($this->email_verified_at);
  }
}
