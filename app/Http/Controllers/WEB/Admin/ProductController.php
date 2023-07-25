<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Models\Addition;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Extra;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\RelatedProduct;
use App\Models\Setting;
use App\Models\Size;
use App\Traits\imageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ProductController extends Controller
{

    use imageTrait;

    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,
        ]);

        $route = Route::currentRouteAction();
        $route_name = substr($route, strpos($route, "@") + 1);
        $this->middleware(function ($request, $next) use ($route_name) {

            if ($route_name == 'index') {
                if (can(['products-show', 'products-create', 'products-edit', 'products-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('products-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('products-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('products-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->back()->withErrors(__('cp.you_dont_have_permission'));
        });

    }

    public function index()
    {
        $items = Product::filter()->orderBy('id', 'desc')->paginate($this->settings->paginateTotal);
        return view('admin.product.home', [
            'items' => $items,
        ]);
    }

    public function create()
    {
        $colors = Color::where('status', 'active')->latest()->get();
        $brands = Brand::where('status', 'active')->latest()->get();
        $sizes = Size::where('status', 'active')->latest()->get();
        $extras = Extra::where('status', 'active')->latest()->get();
        $products = Product::where('status', 'active')->latest()->get();
        $categories = Category::latest()->get();

        return view('admin.product.create', [
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
            'extras' => $extras,
            'brands' => $brands,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        // foreach($request->related_product_id as $one){
        //         echo $one.'/';
        //             }
        //     return;
        $roles = [
            'price' => ['required', 'numeric', 'min:1'],
            'image' => ['required', 'image'],
            'options' => ['array'],
        ];

        $locales = Language::all()->pluck('lang');

        foreach ($locales as $locale) {
            $roles['title_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

        $this->validate($request, $roles);
        DB::beginTransaction();
        try {
            $item = new Product();

            $item->price = $request->price;
            $item->max_addition = $request->max_addition;
            $item->brand_id = $request->brand_id;
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
                . $characters[rand(0, strlen($characters) - 1)];
            $item->SKU = str_shuffle($pin);
            if ($request->required_addition) {
                $item->required_addition = 'on';
            } else {
                $item->required_addition = 'of';
            }
            foreach ($locales as $locale) {
                $item->translateOrNew($locale)->title = $request->get('title_' . $locale);
                $item->translateOrNew($locale)->description = $request->get('description_' . $locale);
            }

            if ($request->hasFile('image')) {
                $item->image = $this->storeImage($request->file('image'), 'product', $item->getRawOriginal('image'), );
            }
            if (Category::find($request->category_id)) {
                $item->category_id = $request->category_id;
            }

            if ($request->is_best_product) {
                $item->is_best_product = 'on';
            } else {
                $item->is_best_product = 'of';
            }

            if ($request->has_color) {
                $item->has_color = 'on';
            } else {
                $item->has_color = 'of';
            }

            if ($request->has_size) {
                $item->has_size = 'on';
                $item->has_size = 'on';
            } else {
                $item->has_size = 'of';
            }

            if ($request->is_quantity) {
                $item->has_quantity = 'on';
                $item->quantity = $request->quantity;
            } else {
                $item->has_quantity = 'of';
            }

            if ($request->is_best_product) {
                $item->is_best_product = 'on';
            } else {
                $item->is_best_product = 'of';
            }

            if ($request->has_additions) {
                $item->has_additions = 'on';
            } else {
                $item->has_additions = 'of';
            }
            $item->save();

            if ($request->related_product_id) {
                foreach ($request->related_product_id as $one) {
                    $related = new RelatedProduct();
                    $related->product_id = $item->id;
                    $related->related_product_id = $one;
                    $related->save();
                }
            }

            if ($request->has_color === 'on') {
                $item->colors()->sync($request->input('colors_id', []));
            }

            if ($request->has_size === 'on') {
                $item->sizes()->sync($request->input('sizes_id', []));
            }

            if ($request->has_additions) {
                if ($request->has('options')) {
                    foreach ($request->options as $one) {
                        $addition = new Extra();
                        $addition->translateOrNew('en')->name = $one['name_en'];
                        $addition->translateOrNew('ar')->name = $one['name_ar'];
                        $addition->price = $one['price'];
                        $addition->product_id = $item->id;
                        $addition->save();
                    }
                }
            }
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $upload_path = 'uploads/productImages/';
                    $image_url = $upload_path . $image_full_name;
                    $file->move($upload_path, $image_full_name);

                    $item->productImages()->create(
                        ['product_id' => $item->id, 'image' => $image_url]);
                }
            }
//            if ($request->category_id) {
//                $item->categories()->sync($request->input('category_id', []));
//            }

//            if ($request->category_id) {
////                $item->categories()->sync($request->input('category_id', []));
//            }

            DB::commit();
            return back()->with('status', __('cp.create'));
            activity()->causedBy(auth('admin')->user())->log(' انشاء منتج ');

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit($id)
    {
        $colors = Color::where('status', 'active')->latest()->get();
        $sizes = Size::where('status', 'active')->latest()->get();
        $item = Product::with(['category'])->where('id', $id)->first();
        $brands = Brand::where('status', 'active')->latest()->get();
        $extras = Extra::where('product_id', $id)->get();
        $categories = Category::all();
        $products = Product::where('status', 'active')->latest()->get();
        $status = ['active' => 'Active', 'not_active' => 'Not Active'];
        return view('admin.product.edit', [
            'item' => $item,
            'categories' => $categories,
            'status' => $status,
            'colors' => $colors,
            'sizes' => $sizes,
            'additions' => $extras,
            'brands' => $brands,
            'products' => $products,
        ]);
    }

    public function update(Request $request, $id)
    {

        $roles = [
            'price' => ['required', 'numeric', 'min:1'],
            'image' => ['sometimes', 'image'],
        ];
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['title_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }
        $this->validate($request, $roles);
        DB::beginTransaction();
        try {
            $item = Product::query()->findOrFail($id);

            $item->price = $request->price;
            $item->brand_id = $request->brand_id;

            if ($item->SKU == null || $item->SKU == 0) {
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $pin = mt_rand(1000000, 9999999)
                . mt_rand(1000000, 9999999)
                    . $characters[rand(0, strlen($characters) - 1)];
                $item->SKU = str_shuffle($pin);
            }

            foreach ($locales as $locale) {
                $item->translateOrNew($locale)->title = $request->get('title_' . $locale);
                $item->translateOrNew($locale)->description = $request->get('description_' . $locale);
            }

            $item->max_addition = $request->max_addition;

            if ($request->is_best_product) {
                $item->is_best_product = '1';
            } else {
                $item->is_best_product = '0';
            }

            if ($request->required_addition) {
                $item->required_addition = 'on';
            } else {
                $item->required_addition = 'of';
            }
            if ($request->is_quantity) {
                $item->has_quantity = 'on';
                $item->quantity = $request->quantity;
            } else {
                $item->has_quantity = 'of';
            }

            if ($request->is_best_product) {
                $item->is_best_product = 'on';
            } else {
                $item->is_best_product = 'of';
            }

            if ($request->hasFile('image')) {
                $item->image = $this->storeImage($request->file('image'), 'product', $item->getRawOriginal('image'), );
            }
            if (Category::find($request->category_id)) {
                $item->category_id = $request->category_id;
            }
            if ($request->has_color) {
                $item->has_color = 'on';
            } else {
                $item->has_color = 'of';
            }

            if ($request->has_size) {
                $item->has_size = 'on';

            } else {
                $item->has_size = 'of';
            }

            if ($request->has_additions) {
                $item->has_additions = 'on';
            } else {
                $item->has_additions = 'of';
            }
            $item->save();

            if ($request->related_product_id) {
                RelatedProduct::where('product_id', $item->id)->delete();
                
                foreach ($request->related_product_id as $one) {
                    $related = new RelatedProduct();
                    $related->product_id = $item->id;
                    $related->related_product_id = $one;
                    $related->save();
                }
            }

            if ($request->has_color === 'on') {
                $item->colors()->sync($request->input('colors_id', []));
            }

            if ($request->has_size === 'on') {
                $item->sizes()->sync($request->input('sizes_id', []));
            }

            if ($request->has_additions) {
                Extra::query()->where('product_id', $item->id)->delete();
                if ($request->has('options')) {
                    foreach ($request->options as $one) {
                        $addition = new Extra();
                        $addition->translateOrNew('en')->name = $one['name_en'];
                        $addition->translateOrNew('ar')->name = $one['name_ar'];
                        $addition->price = $one['price'];
                        $addition->product_id = $item->id;
                        $addition->save();
                    }
                }
            }
//            if ($request->category_id) {
////                $item->categories()->sync($request->input('category_id', []));
//
//            }

            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $upload_path = 'uploads/productImages/';
                    $image_url = $upload_path . $image_full_name;
                    $file->move($upload_path, $image_full_name);

                    $item->productImages()->create(
                        ['product_id' => $item->id, 'image' => $image_url]);
                }
            }

            DB::commit();
            activity($item->title)->causedBy(auth('admin')->user())->log(' تعديل منتج ');
            return redirect()->back()->with('status', __('cp.update'));

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteProductImage($product_image_id)
    {

        $ProductImage = ProductImage::find($product_image_id);

        if ($ProductImage) {
            $ProductImage->delete();
            return response()->json(['message' => 'Product Image Deleted']);
        } else {
            return response()->json(['message' => 'Product Image Not Deleted']);
        }

    }

    public function show($id)
    {
        $item = Product::with(['user'])->find($id);
        return view('admin.product.sideMenu', compact('item'));
    }

    public function getItems($req, $product_id, Request $request)
    {
        $product = Product::findOrFail($product_id);
        if ($req === 'colors') {
            $item = Product::query()->with(['colors'])->find($product_id);
            $view = view('admin.product.component.colors', ['item' => $item])->render();
            return response()->json(['items' => $view]);
        }
        if ($req === 'sizes') {
            $item = Product::query()->with(['sizes'])->find($product_id);
            $view = view('admin.product.component.sizes', ['item' => $item])->render();
            return response()->json(['items' => $view]);
        }
        if ($req === 'extras') {
            $item = Product::query()->with(['extras'])->find($product_id);
            $view = view('admin.product.component.extras', ['item' => $item])->render();
            return response()->json(['items' => $view]);
        }

        if ($req === 'home') {
            $view = view('admin.product.component.statistics', ['item' => $product])->render();
            return response()->json(['items' => $view]);
        }
    }

    public function deleteProductAdditions($id)
    {
        $product = Addition::query()->where('id', $id)->delete();
        return response([
            'success' => true,
        ]);
    }

    public function trash()
    {
        $items = Product::onlyTrashed()->paginate();
        return view('admin.product.trash', compact('items'));

    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete();
        return redirect()->back()->with('status', __('Product Deleted !'));
    }

    public function restore(Request $request, $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->back()->with('status', __('Product Restored !'));
    }

    public function exportProducts(Request $request)
    {
        activity()->causedBy(auth('admin')->user())->log(' تصدير ملف إكسل لبيانات المنتجات ');
        return Excel::download(new ProductsExport($request), 'products.xlsx');
    }
}
