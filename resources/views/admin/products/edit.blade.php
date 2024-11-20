<title>@yield('title', 'Sửa sách')</title>
@extends('layout.admin')

@section('body')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Thêm sách</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Trang chủ</a>
            </li>
            <li>
                <i class="fa fa-angle-right mx-1"></i>
            </li>
            <li>
                <a href="index.html">Sách</a>
            </li>
            <li>
                <i class="fa fa-angle-right mx-1"></i>
            </li>
            <li class="active">
                <strong>Thêm sách</strong>
            </li>
        </ol>
    </div>
</div>

<div class="row wrapper wrapper-content" style="padding: 20px 0 0 !important">
    <div class="ibox">
        <div class="ibox-content">
            <form id="form" action="{{ route('adminproduct.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group @error('name') has-error @enderror">
                            <label>Tên sách <span class="text-danger">*</span></label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $product->name) }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label class="font-normal">Ngôn ngữ <span class="text-danger">*</span></label>
                            <div>
                                <select data-placeholder="Chọn ngôn ngữ..." name="language" class="chosen-select" tabindex="2">
                                    <option value="tieng-viet" {{ old('language', $product->language) == 'tieng-viet' ? 'selected' : '' }}>Tiếng Việt</option>
                                    <option value="tieng-anh" {{ old('language', $product->language) == 'tieng-anh' ? 'selected' : '' }}>Tiếng Anh</option>
                                </select>
                                @error('language')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group">
                            <label class="font-normal">Tác giả <span class="text-danger">*</span></label>
                            <div>
                                <select data-placeholder="Chọn tác giả..." name="id_author" class="chosen-select" tabindex="2">
                                    @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('id_author', $product->id_author) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_author')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group @error('slug') has-error @enderror">
                            <label>Slug <span class="text-danger">*</span></label>
                            <input id="slug" name="slug" type="text" class="form-control" placeholder="ten-san-pham" value="{{ old('slug', $product->slug) }}">
                            @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group @error('quantity') has-error @enderror">
                            <label>Số lượng <span class="text-danger">*</span></label>
                            <input id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" type="number" class="form-control required">
                            @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label class="font-normal">Danh mục <span class="text-danger">*</span></label>
                            <div>
                                <select data-placeholder="Chọn danh mục..." name="id_category" class="chosen-select" tabindex="2">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('id_category', $product->id_category) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_category')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group">
                            <label class="font-normal">Nhà xuất bản <span class="text-danger">*</span></label>
                            <div>
                                <select data-placeholder="Chọn ngôn ngữ..." name="id_manufacturer" class="chosen-select" tabindex="2">
                                    @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id }}" {{ old('id_manufacturer', $product->id_manufacturer) == $manufacturer->id ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_manufacturer')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label class="font-normal">Người dịch</label>
                            <div>
                                <select data-placeholder="Chọn người dịch..." name="id_translator" class="chosen-select" tabindex="2">
                                    <option value="" {{ !old('id_translator', $product->id_translator) ? 'selected' : '' }}>Chọn người dịch</option>
                                    @foreach($translators as $translator)
                                    <option value="{{ $translator->id }}" {{ old('id_translator', $product->id_translator) == $translator->id ? 'selected' : '' }}>
                                        {{ $translator->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="form-group @error('price') has-error @enderror">
                            <label>Giá <span class="text-danger">*</span></label>
                            <input id="price" name="price" type="number" class="form-control required" value="{{ old('price', $product->price) }}">
                            @error('price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group @error('price_sale') has-error @enderror">
                            <label>Giá giảm</label>
                            <input id="price_sale" name="price_sale" type="number" class="form-control" value="{{ old('price_sale', $product->price_sale) }}">
                            @error('price_sale')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group  @error('weight') has-error @enderror">
                            <label>Cân nặng (g) <span class="text-danger">*</span></label>
                            <input id="weight" name="weight" value="{{ old('weight',$product->weight) }}" type="number" class="form-control required">
                            @error('weight')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group @error('year') has-error @enderror">
                            <label>Năm xuất bản <span class="text-danger">*</span></label>
                            <input id="year" name="year" value="{{ old('year', $product->year) }}" type="number" class="form-control required">
                            @error('year')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="i-checks">
                            <label>Hình thức</label> <br>
                            @if($form)
                            <label>
                                <input type="radio" value="bia-cung" name="form" {{ old('form', $form->product_value) == 'bia-cung' ? 'checked' : '' }}>
                                <i></i> Bìa cứng
                            </label>
                            <label>
                                <input type="radio" value="bia-mem" name="form" {{ old('form', $form->product_value) == 'bia-mem' ? 'checked' : '' }}>
                                <i></i> Bìa mềm
                            </label>
                            @else
                            <label>
                                <input type="radio" value="bia-cung" name="form" {{ old('form') == 'bia-cung' ? 'checked' : '' }}>
                                <i></i> Bìa cứng
                            </label>
                            <label>
                                <input type="radio" value="bia-mem" name="form" {{ old('form') == 'bia-mem' ? 'checked' : '' }}>
                                <i></i> Bìa mềm
                            </label>
                            @endif


                        </div>
                    </div>

                    <div class="col-2">
                        <div class="i-checks">
                            <label>Hot</label> <br>
                            <label> <input type="radio" value="1" name="hot" {{ old('hot' , $product->hot) == '1' ? 'checked' : '' }}> <i></i> Có </label>
                            <label> <input type="radio" value="0" name="hot" {{ old('hot', $product->hot) == '0' ? 'checked' : '' }}> <i></i> Không </label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="i-checks">
                            <label>Trạng thái</label> <br>
                            <label> <input type="radio" value="active" name="status" {{ old('status' , $product->status) == 'active' ? 'checked' : '' }}> <i></i> Hiện </label>
                            <label> <input type="radio" value="inactive" name="status" {{ old('status' , $product->status) == 'inactive' ? 'checked' : '' }}> <i></i> Ẩn </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Link video sách</label>
                            <input id="url_video" name="url_video" type="text" class="form-control" value="{{ old('url_video', $product->url_video) }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Từ khóa chính</label>
                            <input id="meta_seo" name="meta_seo" type="text" class="form-control" value="{{ old('meta_seo', $product->meta_seo) }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Description SEO</label>
                            <textarea id="description_seo" placeholder="(Không nhập sẽ tự động lấy phần đầu của description)" name="description_seo" class="form-control">{{ old('description_seo', $product->description_seo) }}</textarea>
                        </div>
                    </div>

                    <div class="col-6">
                        <label>Ảnh chính</label>
                        <span class="image img-cover image-target">
                            <img src="/{{ old('image_cover',$product->image_cover) ? old('image_cover',$product->image_cover) : 'no_image.jpg' }}" class="img-fluid rounded-top" alt="" />
                        </span>
                        <input type="hidden" value="{{ old('image_cover', $product->image_cover) }}" name="image_cover" class="url_image">
                    </div>

                    <div class="col-6">
                        <label>Ảnh phụ</label><br>
                        <button type="button" class="btn btn-success my-2" id="add-image">Thêm ảnh</button>
                        <div class="row" id="image-container">
                            @foreach ($images as $key => $image)
                            <div class="col-3 mt-1 image-wrapper">
                                <span class="image img-cover image-target" style="position: relative;">
                                    <img
                                        src="/{{ $image ?: 'no_image.jpg' }}"
                                        class="img-fluid rounded-top"
                                        alt="Ảnh phụ" style="height: 120px; object-fit: contain;" />
                                </span>
                                <button type="button" class="btn btn-danger btn-sm remove-image mt-1">Xóa ảnh</button>
                                <input
                                    type="hidden"
                                    value="{{ $image }}"
                                    name="{{ $key }}"
                                    class="url_image">
                            </div>
                            @endforeach
                        </div>
                    </div>



                    <!-- Description and Submit Button -->
                    <div class="col-12">
                        <div class="form-group @error('content') has-error @enderror">
                            <label>Description <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" class="content form-control" cols="30" rows="10">{{ old('content', $product->description) }}</textarea>
                            @error('content')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button class="btn btn-success">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('/') }}client/js/lib/toastr.js"></script>

<!-- Jquery Validate -->
<script src="{{ asset('/') }}backend/js/plugins/validate/jquery.validate.min.js"></script>
<!-- Chosen -->
<script src="{{ asset('/') }}backend/js/plugins/chosen/chosen.jquery.js"></script>
<!-- Jasny -->
<script src="{{ asset('/') }}backend/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- DROPZONE -->
<script src="{{ asset('/') }}backend/js/plugins/dropzone/dropzone.js"></script>

<!-- CodeMirror -->
<script src="{{ asset('/') }}backend/js/plugins/codemirror/codemirror.js"></script>
<script src="{{ asset('/') }}backend/js/plugins/codemirror/mode/xml/xml.js"></script>

<script src="{{ asset('/') }}backend/plugins/ckfinder_2/ckfinder.js"></script>

<script src="{{ asset('/') }}backend/plugins/ckeditor/ckeditor.js"></script>

<script src="{{ asset('/') }}backend/lib/ckfinder.js"></script>

<!-- iCheck -->
<script src="{{ asset('/') }}backend/js/plugins/iCheck/icheck.min.js"></script>


<script>
    Dropzone.options.dropzoneForm = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
    };
    document.getElementById('name').addEventListener('input', function() {
        const slugField = document.getElementById('slug');

        // Only generate slug if the slug field is empty or has not been modified
        if (!slugField.dataset.modified) {
            const name = this.value;

            // Convert to slug by removing accents, converting to lowercase, and replacing spaces with hyphens
            const slug = name
                .toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Remove diacritics
                .replace(/[^a-z0-9 ]/g, '') // Remove special characters
                .trim()
                .replace(/\s+/g, '-'); // Replace spaces with hyphens

            // Set slug input value
            slugField.value = slug;
        }
    });

    // Add an event listener to detect if the slug field has been manually edited
    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.modified = true; // Mark as modified
    });
    $(document).ready(function() {
        $('.chosen-select').chosen({
            width: "100%"
        });
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        let imageCount = document.querySelectorAll('.image-wrapper').length; // Count initial images

        // Handle "Add Image" button
        $('#add-image').click(function() {
            const imageContainer = document.getElementById('image-container');
            const lastImageWrapper = imageContainer.querySelector(`.image-wrapper:nth-child(${imageCount}) img`);

            // Check if the last image is still the default placeholder
            if (lastImageWrapper && lastImageWrapper.src.includes('/no_image.jpg')) {
                toastr.error('Vui lòng thay đổi ảnh mặc định trước khi thêm ảnh mới.');
                return;
            }

            if (imageCount < 8) { // Maximum limit of 8 images
                imageCount++; // Increase image count

                // Create new image container
                const newImageDiv = document.createElement('div');
                newImageDiv.classList.add('col-3', 'mt-1', 'image-wrapper');
                newImageDiv.innerHTML = `
        <span class="image img-cover image-target" style="position: relative;">
            <img src="/no_image.jpg" class="img-fluid rounded-top main-image" alt="Ảnh phụ" style="height: 120px; object-fit: contain;" />
        </span>
        <button type="button" class="btn btn-danger btn-sm remove-image mt-1">Xóa ảnh</button>
        <input type="hidden" value="" name="hinh${imageCount}" class="url_image">
    `;

                // Add new image container to the container
                imageContainer.appendChild(newImageDiv);

                // Add delete functionality to the new delete button
                newImageDiv.querySelector('.remove-image').addEventListener('click', function() {
                    newImageDiv.remove(); // Remove image container
                    imageCount--; // Decrease image count
                    updateImageNames(); // Update image names after removal
                });
            } else {
                toastr.error('Đã đạt đến giới hạn tối đa 8 ảnh.');
            }
        });

        // Add delete functionality to any existing images
        document.querySelectorAll('.remove-image').forEach(button => {
            button.addEventListener('click', function() {
                const imageWrapper = this.closest('.image-wrapper');
                imageWrapper.remove(); // Remove image container
                imageCount--; // Decrease image count
                updateImageNames(); // Update image names after removal
            });
        });

        // Function to update image names after an image is removed
        function updateImageNames() {
            const imageWrappers = document.getElementById('image-container').querySelectorAll('.image-wrapper');
            imageWrappers.forEach((wrapper, index) => {
                wrapper.querySelector('.url_image').name = `hinh${index + 1}`;
            });
        }
        var editor_one = CodeMirror.fromTextArea(document.getElementById("code1"), {
            lineNumbers: true,
            matchBrackets: true
        });

        var editor_two = CodeMirror.fromTextArea(document.getElementById("code2"), {
            lineNumbers: true,
            matchBrackets: true
        });

        var editor_two = CodeMirror.fromTextArea(document.getElementById("code3"), {
            lineNumbers: true,
            matchBrackets: true
        });
    });
</script>
@endsection