<?php

namespace App\Http\Controllers\Admin;

use App\Imports\ShopImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class ShopController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin'); // 管理者認証ミドルウェア
  }
  public function import(Request $request)
  {
    // $request->validate([
    //   'file' => [
    //     'required',
    //     'mimes:xlsx,xls,csv',
    //     'max:2048', // ファイルサイズ制限（2MB）
    //   ],
    // ], [
    //   'file.required' => 'ファイルを選択してください',
    //   'file.mimes' => '有効なファイル形式は.xlsx、.xls、または.csvのみです',
    //   'file.max' => 'ファイルサイズは2MB以内でなければなりません',
    // ]);

    try {
      $import = new ShopImport();
      Excel::import($import, $request->file('file'));

      return redirect()->back()->with('success', 'Shops imported successfully.');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
  // インポート処理
  // public function import(Request $request)
  // {
  //   $request->validate([
  //     'file' => 'required|mimes:xlsx,xls,csv|max:2048'
  //   ]);

  // // インポート処理
  //   $import = new ShopImport();
  //   Excel::import($import, $request->file('file'));

  //   // 処理完了後のリダイレクト
  //   return redirect()->back()->with('success', 'Shops imported successfully.');
  // }

  // インポートフォーム表示
  public function importForm()
  {
    return view('admin.shops.import');
  }
}
