<title>@yield('title', 'Thêm sách')</title>
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
            <form id="form" action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group @error('name') has-error @enderror">
                            <label>Tên sách <span class="text-danger">*</span></label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}">
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
                                    <option value="tieng-viet" {{ old('language') == 'tieng-viet' ? 'selected' : '' }}>Tiếng Việt</option>
                                    <option value="tieng-anh" {{ old('language') == 'tieng-anh' ? 'selected' : '' }}>Tiếng Anh</option>
                                    <!-- Continue for other language options -->
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
                                    <option value="{{ $author->id }}" {{ old('id_author') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
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
                            <input id="slug" name="slug" type="text" class="form-control" placeholder="ten-san-pham" value="{{ old('slug') }}">
                            @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group @error('quantity') has-error @enderror">
                            <label>Số lượng <span class="text-danger">*</span></label>
                            <input id="quantity" name="quantity" value="{{ old('quantity', 0) }}" type="number" class="form-control required">
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
                                    <option value="{{ $category->id }}" {{ old('id_category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                    <option value="{{ $manufacturer->id }}" {{ old('id_manufacturer') == $manufacturer->id ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
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
                                    <option value="" {{ !old('id_translator') ? 'selected' : '' }}>Chọn người dịch</option>
                                    @foreach($translators as $translator)
                                    <option value="{{ $translator->id }}" {{ old('id_translator') == $translator->id ? 'selected' : '' }}>
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
                            <input id="price" name="price" type="number" class="form-control required" value="{{ old('price') }}">
                            @error('price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group @error('price_sale') has-error @enderror">
                            <label>Giá giảm</label>
                            <input id="price_sale" name="price_sale" type="number" class="form-control" value="{{ old('price_sale') }}">
                            @error('price_sale')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group  @error('weight') has-error @enderror">
                            <label>Cân nặng (g) <span class="text-danger">*</span></label>
                            <input id="weight" name="weight" value="{{ old('weight') }}" type="number" class="form-control required">
                            @error('weight')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group @error('year') has-error @enderror">
                            <label>Năm xuất bản <span class="text-danger">*</span></label>
                            <input id="year" name="year" value="{{ old('year') }}" type="number" class="form-control required">
                            @error('year')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="i-checks">
                            <label>Hình thức</label> <br>
                            <label> <input type="radio" value="bia-cung" name="form" {{ old('form') == 'bia-cung' ? 'checked' : '' }}> <i></i> Bìa cứng </label>
                            <label> <input type="radio" value="bia-mem" name="form" {{ old('form') == 'bia-mem' ? 'checked' : '' }}> <i></i> Bìa mềm </label>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="i-checks">
                            <label>Hot</label> <br>
                            <label> <input type="radio" value="1" name="hot" {{ old('hot') == '1' ? 'checked' : '' }}> <i></i> Có </label>
                            <label> <input type="radio" value="0" name="hot" {{ old('hot',0) == '0' ? 'checked' : '' }}> <i></i> Không </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Link video sách</label>
                            <input id="url_video" name="url_video" type="text" class="form-control" value="{{ old('url_video') }}">
                        </div>
                    </div>
                    <!-- <div class="col-4">
                        <div class="i-checks">
                            <label>Trạng thái</label> <br>
                            <label> <input type="radio" value="active" name="status" checked=""> <i></i> Hiện </label>
                            <label> <input type="radio" value="inactive" name="status"> <i></i> Ẩn </label>
                        </div>
                    </div> -->
                    <div class="col-6">
                        <div class="form-group">
                            <label>Từ khóa chính</label>
                            <input id="meta_seo" name="meta_seo" type="text" class="form-control" value="{{ old('meta_seo') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Description SEO</label>
                            <textarea id="description_seo" placeholder="(Không nhập sẽ tự động lấy phần đầu của description)" name="description_seo" class="form-control">{{ old('meta_seo') }}</textarea>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="main-image-wrapper">
                            <label>Ảnh chính</label>
                            <div class="image-container">
                                <img
                                    src="{{ old('image_cover') ?: '/no_image.jpg' }}"
                                    id="main-image"
                                    class="rounded"
                                    alt="Ảnh chính"
                                    style="height: 200px; object-fit: contain; cursor: pointer; display: block;" />
                                <button
                                    type="button"
                                    id="delete-main-image"
                                    class="delete-main-image" style = " {{ old('image_cover') ? 'display: block;' : 'display: none;' }} " >
                                    Xóa ảnh
                                </button>
                            </div>
                            <input type="hidden" id="main-image-hidden" name="image_cover" value="{{ old('image_cover') }}" />
                        </div>

                    </div>

                    <div class="col-6">
                        <div class="product-gallery">
                            <label>Danh sách hình ảnh banner</label>
                            <div class="file-upload" id="gallery-upload">
                                <i class="fa fa-cloud-arrow-up"></i> <br> Thả hình ảnh vào đây hoặc bấm vào để tải lên.
                            </div>
                            <div id="gallery-preview">
                                @foreach ($images as $key => $image)
                                <div class="gallery-item">
                                    <img src="{{$image}}" alt="Gallery Image">
                                    <button class="delete-button">Delete</button>
                                    <input type="hidden" name="{{ $key }}" class="hidden-input" value="{{ $image }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <!-- Description and Submit Button -->
                    <div class="col-12">
                        <div class="form-group @error('content') has-error @enderror">
                            <label>Description <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" class="content form-control" cols="30" rows="10">{{ old('content') }}</textarea>
                            @error('content')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button name="status" value="draft" class="btn btn-default">Lưu nháp</button>
                        <button name="status" value="active" class="btn btn-success">Lưu</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
<script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
<style>
    .product-image,
    .product-gallery {
        margin-bottom: 30px;
    }

    label {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .file-upload {
        width: 100%;
        padding: 40px;
        border: 2px dashed #ccc;
        text-align: center;
        cursor: pointer;
        border-radius: 8px;
        background-color: #fafafa;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .file-upload:hover {
        border-color: #f6c506;
    }

    .file-upload i {
        font-size: 32px;
        color: #f6c506;
    }

    .file-upload img {
        max-width: 100%;
        max-height: 150px;
        margin-top: 10px;
        border-radius: 8px;
    }

    #gallery-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .gallery-item, .main-image-wrapper {
        position: relative;
        display: inline-block;
        border-radius: 8px;
        overflow: hidden;
    }

    .gallery-item img {
        max-width: 100px;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .delete-button, .delete-main-image {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: #ff4d4d;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 12px;
    }

    .delete-button:hover {
        background-color: #e03a3a;
    }

    #main-image-preview {
        margin-top: 10px;
    }
</style>
<script src="{{ asset('/') }}backend/js/product/index.js"></script>
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