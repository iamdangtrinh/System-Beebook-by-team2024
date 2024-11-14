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

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.products.index', compact([
            'products',
        ]));
    }
    public function add()
    {
        $categories = CategoryProduct::where('status', 'active')->get();
        $authors = Taxonomy::where('type', 'author')->get();
        $translators = Taxonomy::where('type', 'translator')->get();
        $manufacturers = Taxonomy::where('type', 'manufacturer')->get();
        return view('admin.products.add', compact([
            'categories',
            'authors',
            'translators',
            'manufacturers',
        ]));
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
        $product->description_seo = !empty($request->description_seo)
            ? $request->description_seo
            : substr($request->content, 0, 150);
        $product->image_cover = $request->image_cover;
        $product->description = $request->content;
        $product->save();
        if ( $request->form && !empty( $request->form)) {
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
}
