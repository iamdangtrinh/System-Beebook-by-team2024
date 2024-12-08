<title>@yield('title', $data->title)</title>
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

            <form autocomplete="off" method="POST">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="product-title-input">Tiêu đề bài viết</label>
                                    <input type="text" class="form-control" id="product-title-input"
                                        value="{{ $data->title }}" placeholder="Tiêu đề bài viết" required>
                                </div>
                                <div>
                                    <label>Mô tả bài viết</label>
                                    <textarea name="content" id="" cols="30" rows="10">{{ $data->content }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Gallery</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h5 class="fs-14 mb-1">Product Image</h5>
                                    <p class="text-muted">Add Product main Image.</p>
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            <div class="position-absolute top-100 start-100 translate-middle">
                                                <label for="product-image-input" class="mb-0" data-bs-toggle="tooltip"
                                                    data-bs-placement="right" title="Select Image">
                                                    <div class="avatar-xs">
                                                        <div
                                                            class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                            <i class="ri-image-fill"></i>
                                                        </div>
                                                    </div>
                                                </label>
                                                <input class="form-control d-none" value="" id="product-image-input"
                                                    type="file" accept="image/png, image/gif, image/jpeg">
                                            </div>
                                            <div class="avatar-lg">
                                                <div class="avatar-title bg-light rounded">
                                                    <img src="" id="product-img" class="avatar-md h-auto" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fs-14 mb-1">Product Gallery</h5>
                                    <p class="text-muted">Add Product Gallery Images.</p>

                                    <div class="dropzone">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple="multiple">
                                        </div>
                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                            </div>

                                            <h5>Drop files here or click to upload.</h5>
                                        </div>
                                    </div>

                                    <ul class="list-unstyled mb-0" id="dropzone-preview">
                                        <li class="mt-2" id="dropzone-preview-list">
                                            <!-- This is used as the file preview template -->
                                            <div class="border rounded">
                                                <div class="d-flex p-2">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm bg-light rounded">
                                                            <img data-dz-thumbnail class="img-fluid rounded d-block"
                                                                src="#" alt="Product-Image" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="pt-1">
                                                            <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-3">
                                                        <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- end dropzon-preview -->
                                </div>
                            </div>
                        </div> --}}
                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    Thông tin seo
                                </h5>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-6 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="title-seo-input">Tiêu đề seo</label>
                                                <input type="text" name="meta_title_seo" class="form-control"
                                                    id="title-seo-input" placeholder="Tiêu đề seo">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-xl-6 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="orders-input">Mô tả tiêu đề seo</label>
                                                <input type="text" class="form-control" name="meta_description_seo"
                                                    id="seo-description-input" placeholder="Mô tả tiêu đề seo">
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
                                    <select class="form-control" id="choices-publish-status-input">
                                        <option value="active" selected>Hiện</option>
                                        <option value="inactive">Ẩn</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Bài viết nổi bật</label>
                                    <select class="form-control" id="choices-publish-status-input">
                                        <option value="1" selected>Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Loại bài viết</label>
                                    <select name="post_type" class="form-control" id="choices-type-post-input">
                                        <option value="blog" selected>Bản tin</option>
                                        <option value="review">Review sách</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="productSelect" class="form-label">Chọn sản phẩm</label>
                                    <select name="id_product" multiple class="form-control setupSelect2" id="id_product">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Thẻ</label>
                                    <select name="tags" multiple class="form-control setupSelect2HasTag" id="tags">
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="views" class="form-label">Lượt xem</label>
                                    <input type="number" min="0" name="views" id="views" class="form-control"
                                        value="0">
                                </div>

                                <div class="mb-3">
                                    <label for="">Ảnh đại diện</label>
                                    <span class="image img-cover image-target">
                                        <img src="/no_image.jpg" class="img-fluid rounded-top" alt="" />
                                    </span>
                                    <input type="hidden" value="" name="image" class="url_image">
                                </div>

                                <div class="text-end mb-3">
                                    <button type="submit" class="btn btn-success w-sm">Submit</button>
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

        });
    </script>
@endsection
