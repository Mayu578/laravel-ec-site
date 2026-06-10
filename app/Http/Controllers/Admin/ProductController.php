<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Intervention Imageを使うためのインポート
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProductController extends Controller
{
    /**
     * 商品一覧画面の表示（例）
     */
    public function index()
    {
        $products = Product::with('section')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * 商品登録画面の表示（例）
     */
    public function create()
    {
        $sections = Section::all();
        return view('admin.products.create', compact('sections'));
    }

    /**
     * 新規商品の保存処理
     */
    public function store(Request $request)
    {
        // 1. バリデーション
        $validated = $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'quantity'    => 'required|integer|min:0',
            'section_id'  => 'required|exists:sections,id',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        // 2. 画像の加工と保存処理
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            
            // ファイル名をユニークな名前（ランダム文字列 + .webp）にする
            $filename = uniqid() . '.webp';

            // マネージャーを初期化（Gdドライバーを使用）
            $manager = new ImageManager(new Driver());

            // 画像を読み込んで400x400にクロップ、WebP形式（画質80%）に変換
            $image = $manager->read($imageFile)
                ->cover(400, 400)
                ->toWebp(80);

            // 保存先のディレクトリパス（storage/app/public/products）
            $destinationPath = storage_path('app/public/products');

            // ★フォルダが存在しなければ、パーミッション0755で自動作成する（再帰的作成を有効に）
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // 指定したパスに画像を物理保存
            $image->save($destinationPath . '/' . $filename);

            // DBに保存用：validated配列のimageキーを上書き
            $validated['image'] = 'products/' . $filename;
        }

        // 3. データベースに商品データを登録（重複なし、1回のみ実行）
        Product::create($validated);

        // 4. 一覧画面へリダイレクト
        return redirect()->route('admin.products.index')
            ->with('success', '商品を追加しました');
    }


    /**
     * 編集フォーム
     */
    public function edit(Product $product)
    {
        $sections = Section::all(); // セクション一覧
        return view('admin.products.edit', compact('product', 'sections'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
            'section_id' => 'required|exists:sections,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());

            $image = $manager->read($request->file('image'))
                ->cover(400, 400);

            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $image->save(storage_path('app/public/products/' . $filename));

            $validated['image'] = 'products/' . $filename;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', '商品を更新しました');
    }



    /**
     * 削除
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Delete the products');
    }
}
