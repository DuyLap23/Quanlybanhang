<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::query()
            ->with(['catelogue', 'tags'])
            ->latest('id')
            ->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catelogues = Catelogue::query()->pluck('name', 'id')->all();
        // dd($catelogues);
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();
        $properties = [
            'Is Active' => 'is_active',
            'Is Hot Deal' => 'is_hot_deal',
            'Is Good Deal' => 'is_good_deal',
            'Is New' => 'is_new',
            'Is Show Home' => 'is_show_home',
        ];
        return view(self::PATH_VIEW . __FUNCTION__, compact('catelogues', 'properties', 'colors', 'sizes', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);
        $dataProduct['is_active'] ??= 0;
        $dataProduct['is_hot_deal'] ??= 0;
        $dataProduct['is_good_deal'] ??= 0;
        $dataProduct['is_new'] ??= 0;
        $dataProduct['is_show_home'] ??= 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

        if ($request->hasFile('img_thumbnail')) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }

        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];

        foreach ($dataProductVariantsTmp as $key => $value) {
            $tmp = explode('-', $key);
            // dd($key);
            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $value['quantity'],
                'image' => $value['image'] ?? null,
            ];
        }

        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->file('product_galleries') ?: [];

        try {
            DB::beginTransaction();

            $product = Product::query()->create($dataProduct);

            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_id'] = $product->id;

                if ($dataProductVariant['image']) {
                    $dataProductVariant['image'] = Storage::put('products', $dataProductVariant['image']);
                }

                ProductVariant::query()->create($dataProductVariant);
            }

            $product->tags()->sync($dataProductTags);

            foreach ($dataProductGalleries as $key => $image) {
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => $image->store('products'),
                ]);
            }

            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
           dd($exception->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = Product::findOrFail($product->id);

        $catelogues = Catelogue::all();
        // Lấy danh sách catelogues liên kết với product
        $ctg = $product->catelogue()->pluck('id')->toArray();

        $properties = [
            'Is Active' => 'is_active',
            'Is Hot Deal' => 'is_hot_deal',
            'Is Good Deal' => 'is_good_deal',
            'Is New' => 'is_new',
            'Is Show Home' => 'is_show_home',
        ];

        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        $allTags = Tag::all();
        // Lấy tất cả các tag liên kết với sản phẩm cụ thể
        $tags = $product->tags()->pluck('id')->toArray();

        $productVariants = $product
            ->variants()
            ->get()
            ->keyBy(function ($item) {
                return $item->product_size_id . '-' . $item->product_color_id;
            });

        return view('admin.products.edit', compact('product', 'catelogues', 'ctg', 'properties', 'colors', 'sizes', 'allTags', 'tags', 'productVariants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);
        $dataProduct['is_active'] ??= 0;
        $dataProduct['is_hot_deal'] ??= 0;
        $dataProduct['is_good_deal'] ??= 0;
        $dataProduct['is_new'] ??= 0;
        $dataProduct['is_show_home'] ??= 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

        if ($request->hasFile('img_thumbnail')) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $request->file('img_thumbnail'));
        }

        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];

        foreach ($dataProductVariantsTmp as $key => $value) {
            $tmp = explode('-', $key);
            // dd($key);
            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $value['quantity'] ?? 0,
                'image' => $value['image'] ?? null,
            ];
        }

        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->file('product_galleries') ?: [];

        try {
            DB::beginTransaction();
            $product = Product::findOrFail($product->id);
            $product->update($dataProduct);

            // Lấy các biến thể hiện có và gán key dựa trên product_size_id và product_color_id
            $existingVariants = $product->variants()->get()->keyBy(function($item) {
                return $item->product_size_id . '-' . $item->product_color_id;
            });

            foreach ($dataProductVariants as $dataProductVariant) {
                // Tạo khoá
                $variantKey = $dataProductVariant['product_size_id'] . '-' . $dataProductVariant['product_color_id'];

                if (isset($existingVariants[$variantKey])) {
                    // Cập nhật biến thể hiện có
                    $variant = $existingVariants[$variantKey];
                    if (isset($dataProductVariant['image'])) {
                        $dataProductVariant['image'] = Storage::put('products', $dataProductVariant['image']);
                    }
                    else {
                        // Giữ lại ảnh cũ nếu không có ảnh mới
                        $dataProductVariant['image'] = $variant->image;
                    }
                    $variant->update($dataProductVariant);
                    unset($existingVariants[$variantKey]);
                } else {
                    // Tạo biến thể mới
                    $dataProductVariant['product_id'] = $product->id;
                    ProductVariant::create($dataProductVariant);
                }
            }
                // Xóa các biến thể không còn tồn tại trong dữ liệu mới
                foreach ($existingVariants as $variant) {
                    $variant->delete();
                }


                $product->tags()->sync($dataProductTags);

            foreach ($dataProductGalleries as $key => $image) {
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => $image->store('products'),
                ]);
            }

            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::transaction(function () use ($product) {
                $product->tags()->sync([]);
                $product->galleries()->delete();
                $product->variants()->delete();
                $product->delete();
            }, 3);
            return back();
        } catch (\Exception $exception) {
            return back();
        }
    }
}
