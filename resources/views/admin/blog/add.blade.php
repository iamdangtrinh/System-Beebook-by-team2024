<title>@yield('title', 'Thêm bài viết mới')</title>
@extends('layout.admin')
@section('body')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Tạo bài viết</h4>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <form autocomplete="off" action="{{ route('adminblog.add') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="product-title-input">Tiêu đề bài viết</label>
                                    <input type="text" class="form-control" name="title" id="product-title-input"
                                        value="{{ old('title') }}" placeholder="Tiêu đề bài viết" required>
                                </div>
                                <div>
                                    <label>Mô tả bài viết</label>
                                    <textarea name="content" id="" cols="30" rows="10">{{ old('content') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    Thông tin seo
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-12 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="title-seo-input">Tiêu đề seo</label>
                                                <input type="text" name="meta_title_seo" class="form-control"
                                                    id="title-seo-input" placeholder="Tiêu đề seo"
                                                    value="{{ old('meta_title_seo') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-xl-12 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="seo-description-input">Mô tả tiêu đề
                                                    seo</label>
                                                <textarea name="meta_description_seo" id="seo-description-input" cols="30" rows="10" placeholder="Mô tả tiêu đề seo">
                                                    {{ old('meta_description_seo') }}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Trạng thái</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Trạng thái</label>
                                    <select class="form-control" id="choices-publish-status-input" name="status">
                                        <option value="active">Hiện
                                        </option>
                                        <option value="inactive">Ẩn
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="choice_title_hot" class="form-label">Bài viết nổi bật</label>
                                    <select class="form-control" name="hot" id="choice_title_hot">
                                        <option value="1">Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="post_type" class="form-label">Loại bài viết</label>
                                    <select name="post_type" class="form-control" id="post_type">
                                        <option value="blog">Bản tin </option>
                                        <option value="review">Review sách</option>
                                    </select>
                                </div>

                                <div id="showProduct" class="mb-3">
                                    <label for="productSelect" class="form-label">Chọn sản phẩm</label>

                                    <select name="id_product[]" multiple class="form-control setupSelect2" id="id_product">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tags" class="form-label">Thẻ</label>
                                    <select name="tags[]" multiple class="form-control setupSelect2HasTag" id="tags">
                                       
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="views" class="form-label">Lượt xem</label>
                                    <input type="number" min="0" name="views" id="views"
                                        class="form-control" value="{{ $data->views ?? 0 }}">
                                </div>

                                <div class="mb-3">
                                    <label for="">Ảnh đại diện</label>
                                    <span class="image img-cover image-target">
                                        <img src="/no_image.jpg" class="img-fluid rounded-top"
                                            alt="" />
                                    </span>
                                    <input type="hidden" value="" name="image" class="url_image">
                                </div>

                                <div class="text-end mb-3">
                                    <button type="submit" class="btn btn-success w-sm">Thêm mới</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('/') }}backend/plugins/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('/') }}backend/plugins/ckfinder_2/ckfinder.js"></script>

    <link rel="stylesheet" href="{{ asset('/') }}backend/css/plugins/select2/select2.min.css">
    <script src="{{ asset('/') }}backend/js/plugins/select2/select2.full.min.js"></script>

    <script src="{{ asset('/') }}backend/lib/ckfinder.js"></script>
    <script>
        $(document).ready(function() {
            $('#post_type').change(toggleProductVisibility);
            toggleProductVisibility();

            function toggleProductVisibility() {
                if ($('#post_type').val() == 'blog') {
                    $('#showProduct').addClass('d-none');
                } else {
                    $('#showProduct').removeClass('d-none');
                }
            }
            CKEDITOR.replace("seo-description-input", {
                height: 250,
                language: "vi",
            });

            $('#product-title-input').on('input', function() {
                $('#title-seo-input').val($(this).val());
            });

        });
    </script>
@endsection
