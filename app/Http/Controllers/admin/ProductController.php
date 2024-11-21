<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Taxonomy;
use App\Models\ProductMeta;
use App\Models\CategoryProduct;

class ProductController extends Controller
{
    protected function selected()
    {
        return [
            "id",
            "id_category",
            "name",
            "description",
            "slug",
            "quantity",
            "status",
            'language',
            "url_video",
            "image_cover",
            "views",
            "price",
            "price_sale",
            "hot",
            "year",
            "meta_seo",
            "description_seo",
            "created_at",
            "updated_at",
            "deleted_at",
            "id_author",
            "id_translator",
            "id_manufacturer"
        ];
    }

    public function index(Request $request)
    {
        // Lấy danh sách danh mục
        $categories = CategoryProduct::where('status', 'active')->get();

        // Bắt đầu query sản phẩm
        $query = Product::query();

        // Lọc theo danh mục
        if ($request->filled('id_category')) {
            $query->where('id_category', $request->id_category);
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Lọc theo sản phẩm hot
        if ($request->filled('hot')) {
            $query->where('hot', $request->hot);
        }

        // Lọc theo tên sách
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Lọc theo giá
        if ($request->filled('price')) {
            $priceRange = explode('-', $request->price);
            if (count($priceRange) == 2) {
                $minPrice = $priceRange[0];
                $maxPrice = $priceRange[1];
        
                $query->where(function ($q) use ($minPrice, $maxPrice) {
                    $q->where(function ($q) use ($minPrice, $maxPrice) {
                        // Lọc theo giá giảm nếu có
                        $q->whereNotNull('price_sale')
                          ->whereBetween('price_sale', [$minPrice, $maxPrice]);
                    })->orWhere(function ($q) use ($minPrice, $maxPrice) {
                        // Lọc theo giá gốc nếu không có giá giảm
                        $q->whereNull('price_sale')
                          ->whereBetween('price', [$minPrice, $maxPrice]);
                    });
                });
            }
        }
        

        // Truy vấn sản phẩm không phải trạng thái 'draft'
        $products = $query->where('status', '!=', 'draft')->orderBy('created_at', 'desc')->paginate(12);

        // Lấy các sản phẩm nháp và sản phẩm đã bị xóa mềm
        $drafts = Product::where('status', 'draft')->orderBy('created_at', 'desc')->get();
        $trashedProducts = Product::onlyTrashed()->get();

        // Trả về view
        return view('admin.products.index', compact([
            'products',
            'drafts',
            'trashedProducts',
            'categories',
        ]));
    }

    public function add()
    {
        $categories = CategoryProduct::where('status', 'active')->get();
        $authors = Taxonomy::where('type', 'author')->get();
        $translators = Taxonomy::where('type', 'translator')->get();
        $manufacturers = Taxonomy::where('type', 'manufacturer')->get();
        $images = [];
        for ($i = 1; $i <= 8; $i++) {
            $key = "hinh$i";
            // Check if there's a value in old input or database, and stop if null is encountered
            $image = old($key, $dbImages[$key] ?? null);

            if ($image === null) {
                break; // Exit the loop if no image is found
            }

            $images[$key] = $image; // Store the image if it's not null
        }
        // dd($images);
        return view('admin.products.add', compact([
            'categories',
            'images',
            'authors',
            'translators',
            'manufacturers',
        ]));
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id); // Tìm sản phẩm
        // Kiểm tra sản phẩm có trong bill hay không
        if ($product->billDetails()->exists()) {
            // Nếu sản phẩm có trong đơn hàng, cập nhật trạng thái
            $product->update(['status' => 'inactive']);
            return redirect()->back()->with('error', 'Không thể xóa sản phẩm này vì đã có trong đơn hàng. Trạng thái được đặt về inactive.');
        }
        $product->delete(); // Xóa mềm (soft delete)
        return redirect()->back()->with('success', 'Sản phẩm đã được xóa.');
    }
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete(); // Xóa vĩnh viễn
        return redirect()->back()->with('success', 'Sản phẩm đã được xóa vĩnh viễn.');
    }
    public function forceDeleteAll()
    {
        $trashedProducts = Product::onlyTrashed();
        if ($trashedProducts->count() == 0) {
            return redirect()->back()->with('error', 'Không có sản phẩm nào để xóa.');
        }
        $trashedProducts->forceDelete(); // Xóa vĩnh viễn tất cả
        return redirect()->back()->with('success', 'Tất cả sản phẩm đã được xóa vĩnh viễn.');
    }
    public function restore($id)
    {
        // Khôi phục sản phẩm từ bảng soft deleted
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('adminproduct.index')->with('success', 'Sản phẩm đã được khôi phục!');
    }
    public function restoreAll()
    {
        $trashedProducts = Product::onlyTrashed();
        if ($trashedProducts->count() == 0) {
            return redirect()->back()->with('error', 'Không có sản phẩm nào để khôi phục.');
        }
        // Khôi phục tất cả sản phẩm đã xóa mềm
        Product::onlyTrashed()->restore();

        return redirect()->route('adminproduct.index')->with('success', 'Tất cả sản phẩm đã được khôi phục!');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug|regex:/^[a-z0-9-]+$/',
            'language' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'price_sale' => 'nullable|integer|min:0|lt:price',
            'weight' => 'required|integer|min:0',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'content' => 'required',
        ], [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'slug.required' => 'Slug là bắt buộc.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug này đã tồn tại, vui lòng chọn slug khác.',
            'slug.regex' => 'Slug không được có khoảng trắng, dấu và ký tự đặc biệt.',
            'language.required' => 'Ngôn ngữ là bắt buộc.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'price.required' => 'Giá là bắt buộc.',
            'price.integer' => 'Giá phải là số nguyên.',
            'price.min' => 'Giá phải lớn hơn hoặc bằng 0.',
            'price_sale.integer' => 'Giá giảm phải là số nguyên.',
            'price_sale.min' => 'Giá giảm phải lớn hơn hoặc bằng 0.',
            'price_sale.lt' => 'Giá giảm phải nhỏ hơn giá.',
            'weight.required' => 'Cân nặng là bắt buộc.',
            'weight.integer' => 'Cân nặng phải là số nguyên.',
            'weight.min' => 'Cân nặng phải lớn hơn hoặc bằng 0.',
            'year.required' => 'Năm xuất bản là bắt buộc.',
            'year.digits' => 'Năm xuất bản phải là 4 chữ số.',
            'year.min' => 'Năm xuất bản phải từ 1900 trở lên.',
            'year.max' => 'Năm xuất bản không được lớn hơn năm hiện tại.',
            'content.required' => 'Không được để trống!',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->language = $request->language;
        $product->id_author = $request->id_author;
        $product->id_category = $request->id_category;
        $product->quantity = $request->quantity;
        $product->id_manufacturer = $request->id_manufacturer;
        $product->id_translator = $request->id_translator;
        $product->price = $request->price;
        $product->price_sale = $request->price_sale;
        $product->weight = $request->weight;
        $product->hot = $request->hot;
        $product->year = $request->year;
        $product->meta_seo = $request->meta_seo;
        $product->url_video = $request->url_video;
        $product->status = $request->status;
        $product->description_seo = !empty($request->description_seo)
            ? strip_tags($request->description_seo) // Loại bỏ thẻ HTML từ description_seo
            : (strlen(strip_tags($request->content)) > 150
                ? substr(strip_tags($request->content), 0, 150) . "..." // Cắt và thêm "..."
                : strip_tags($request->content)); // Nếu không cần cắt, chỉ cần trả về toàn bộ nội dung

        $product->image_cover = $request->image_cover;
        $product->description = $request->content;
        $product->save();
        if ($request->form && !empty($request->form)) {
            // Create and save product metadata for each image
            $meta = new ProductMeta();
            $meta->id_product = $product->id; // Link metadata to the newly created product
            $meta->product_key = 'form';  // Use the dynamic key (hinh1, hinh2, ...)
            $meta->product_value =  $request->form;  // Store the image value (e.g., image path or URL)
            $meta->save();  // Save image metadata to the database
        }

        // Loop through image fields (hinh1, hinh2, ..., hinh8)
        for ($i = 1; $i <= 8; $i++) {
            $imageKey = 'hinh' . $i; // Dynamically create the field name (hinh1, hinh2, ...)

            // If any image is missing (for example, hinh1), break out of the loop
            if (!$request->has($imageKey)) {
                break;
            }

            // Check if the image field exists and is not empty
            if ($request->has($imageKey) && !empty($request->$imageKey)) {
                // Create and save product metadata for each image
                $meta = new ProductMeta();
                $meta->id_product = $product->id; // Link metadata to the newly created product
                $meta->product_key = $imageKey;  // Use the dynamic key (hinh1, hinh2, ...)
                $meta->product_value = $request->$imageKey;  // Store the image value (e.g., image path or URL)
                $meta->save();  // Save image metadata to the database
            }
        }

        return redirect()->route('adminproduct.index')->with('success', 'Thêm sản phẩm thành công!');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = CategoryProduct::where('status', 'active')->get();
        $authors = Taxonomy::where('type', 'author')->get();
        $translators = Taxonomy::where('type', 'translator')->get();
        $manufacturers = Taxonomy::where('type', 'manufacturer')->get();
        // Fetch images in the order of hinh1, hinh2, ...
        // Fetch images from the database
        $form = ProductMeta::where('id_product', $id)
            ->where('product_key', 'form')
            ->first();
        $dbImages = ProductMeta::where('id_product', $id)
            ->where('product_key', 'like', 'hinh%')
            ->orderByRaw("CAST(SUBSTRING(product_key, 5) AS UNSIGNED)") // Sort by hinhX numerically
            ->pluck('product_value', 'product_key')
            ->toArray();

        // Prepare images: prioritize old() values, fallback to database values
        $images = [];
        for ($i = 1; $i <= 8; $i++) {
            $key = "hinh$i";
            // Check if there's a value in old input or database, and stop if null is encountered
            $image = old($key, $dbImages[$key] ?? null);

            if ($image === null) {
                break; // Exit the loop if no image is found
            }

            $images[$key] = $image; // Store the image if it's not null
        }
        // dd($form);
        return view('admin.products.edit', compact([
            'product',
            'images',
            'form',
            'categories',
            'authors',
            'translators',
            'manufacturers',
        ]));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id . '|regex:/^[a-z0-9-]+$/',
            'language' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'price_sale' => 'nullable|integer|min:0|lt:price',
            'weight' => 'required|integer|min:0',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'content' => 'required',
        ], [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'slug.required' => 'Slug là bắt buộc.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug này đã tồn tại, vui lòng chọn slug khác.',
            'slug.regex' => 'Slug không được có khoảng trắng, dấu và ký tự đặc biệt.',
            'language.required' => 'Ngôn ngữ là bắt buộc.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'price.required' => 'Giá là bắt buộc.',
            'price.integer' => 'Giá phải là số nguyên.',
            'price.min' => 'Giá phải lớn hơn hoặc bằng 0.',
            'price_sale.integer' => 'Giá giảm phải là số nguyên.',
            'price_sale.min' => 'Giá giảm phải lớn hơn hoặc bằng 0.',
            'price_sale.lt' => 'Giá giảm phải nhỏ hơn giá.',
            'weight.required' => 'Cân nặng là bắt buộc.',
            'weight.integer' => 'Cân nặng phải là số nguyên.',
            'weight.min' => 'Cân nặng phải lớn hơn hoặc bằng 0.',
            'year.required' => 'Năm xuất bản là bắt buộc.',
            'year.digits' => 'Năm xuất bản phải là 4 chữ số.',
            'year.min' => 'Năm xuất bản phải từ 1900 trở lên.',
            'year.max' => 'Năm xuất bản không được lớn hơn năm hiện tại.',
            'content.required' => 'Không được để trống!',
        ]);

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->language = $request->language;
        $product->id_author = $request->id_author;
        $product->id_category = $request->id_category;
        $product->quantity = $request->quantity;
        $product->id_manufacturer = $request->id_manufacturer;
        $product->id_translator = $request->id_translator;
        $product->price = $request->price;
        $product->price_sale = $request->price_sale;
        $product->weight = $request->weight;
        $product->hot = $request->hot;
        $product->year = $request->year;
        $product->meta_seo = $request->meta_seo;
        $product->url_video = $request->url_video;
        $product->status = $request->status;
        $product->description_seo = !empty($request->description_seo)
            ? strip_tags($request->description_seo) // Loại bỏ thẻ HTML từ description_seo
            : (strlen(strip_tags($request->content)) > 150
                ? substr(strip_tags($request->content), 0, 150) . "..." // Cắt và thêm "..."
                : strip_tags($request->content)); // Nếu không cần cắt, chỉ cần trả về toàn bộ nội dung

        $product->image_cover = $request->image_cover;
        $product->description = $request->content;
        $product->save();
        // Xóa tất cả metadata cũ (nếu có) và thêm mới nếu có thay đổi
        ProductMeta::where('id_product', $product->id)->delete();
        if ($request->form && !empty($request->form)) {
            // Create and save product metadata for each image
            $meta = new ProductMeta();
            $meta->id_product = $product->id; // Link metadata to the newly created product
            $meta->product_key = 'form';  // Use the dynamic key (hinh1, hinh2, ...)
            $meta->product_value =  $request->form;  // Store the image value (e.g., image path or URL)
            $meta->save();  // Save image metadata to the database
        }

        // Loop through image fields (hinh1, hinh2, ..., hinh8)
        for ($i = 1; $i <= 8; $i++) {
            $imageKey = 'hinh' . $i; // Dynamically create the field name (hinh1, hinh2, ...)

            // If any image is missing (for example, hinh1), break out of the loop
            if (!$request->has($imageKey)) {
                break;
            }

            // Check if the image field exists and is not empty
            if ($request->has($imageKey) && !empty($request->$imageKey)) {
                // Create and save product metadata for each image
                $meta = new ProductMeta();
                $meta->id_product = $product->id; // Link metadata to the newly created product
                $meta->product_key = $imageKey;  // Use the dynamic key (hinh1, hinh2, ...)
                $meta->product_value = $request->$imageKey;  // Store the image value (e.g., image path or URL)
                $meta->save();  // Save image metadata to the database
            }
        }
        return redirect()->route('adminproduct.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }
    public function updateHot(Request $request)
    {
        try {
            $product = Product::findOrFail($request->id);
            $product->hot = $request->hot; // Cập nhật giá trị hot
            $product->save();

            return response()->json([
                'status' => true,
                'message' => 'Cập nhật trạng thái sản phẩm thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Cập nhật trạng thái sản phẩm thất bại!'
            ]);
        }
    }
}
