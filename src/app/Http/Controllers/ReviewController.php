<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth; // Authファサードをインポート

class ReviewController extends Controller
{

  public function create($shopId)
  {
    $shop = Shop::findOrFail($shopId); // IDを使って店舗を取得
    return view('review', ['shop' => $shop]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'rating' => 'required|integer|min:1|max:5',
      'title' => 'nullable|string|max:20',
      'comment' => 'required|string|min:20|max:400',
      'shop_id' => 'required|exists:shops,id',
    ], [
      'rating.required' => '評価は必須です。',
      'comment.min' => 'コメントは20文字以上でなければなりません。',
    ]);

    if (!Auth::check()) { // ユーザーがログインしていない場合
      return redirect()->route('request_login')->withErrors(['user_not_authenticated' => 'ログインしてください。']);
    }

    $shopId = $request->input('shop_id'); // リクエストから shop_id を取得
    $shop = Shop::findOrFail($shopId); // shop_id で店舗を見つけます。

    $review = new Review;
    $review->shop_id = $shop->id;
    $review->user_id = Auth::id();
    $review->rating = $request->rating;
    $review->title = $request->title;
    $review->comment = $request->comment;
    $review->save();

    return redirect()->route('shop.detail', $shop->id)->with('success', 'レビューが正常に提出されました。');
  }
}
