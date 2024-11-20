<title>@yield('title', 'Đơn hàng')</title>
@extends('layout.admin')

@section('body')
    <div class="container-fuild">
        {{-- <form action="{{route('admin.banner.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xl-6">
                    <div class="product-gallery">
                        <label>Danh sách hình ảnh banner</label>
                        <div class="file-upload" id="gallery-upload">
                            <i class="fa fa-cloud-arrow-up"></i> <br> Thả hình ảnh vào đây hoặc bấm vào để tải lên.
                        </div>
                        <div id="gallery-preview"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-xl-6">
                    <div class="product-image">
                        <label>Hình ảnh banner phụ</label>
                        <div class="file-upload" id="main-image">
                            <i class="fa fa-cloud-arrow-up"></i> <br> Thả hình ảnh vào đây hoặc bấm vào để tải lên.
                        </div>
                        <div id="main-image-preview"></div>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary">Lưu thay đổi</button>
        </form> --}}

        <div class="row">
            <div class="col-sm-12 col-md-12 col-xl-3">
                <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <div class="product-gallery">
                        <label>Danh sách hình ảnh banner</label>
                        <div class="file-upload" id="gallery-upload">
                            <i class="fa fa-cloud-arrow-up"></i> <br> Thả hình ảnh vào đây hoặc bấm vào để tải lên.
                            <input type="hidden" value="" name="image" class="url_image">
                        </div>
                        <div class="mb-3" id="gallery-preview"></div>

                        <label for="text_link">Nhập đường dẫn hình ảnh</label>
                        <input type="text" id="text_link" name="text_link" class="mb-3 form-control"
                            placeholder="{{ env('APP_URL') }}">

                        <select name="type" id="" class="mb-3 form-control setupSelect2">
                            @foreach (config('admin.dashboard.banner') as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>

                        <button class="mt-3 btn btn-primary">Lưu thay đổi</button>
                </form>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-xl-9">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Hình ảnh</th>
                        <th>Đường dẫn</th>
                        <th>Trạng thái</th>
                        <th>Thứ tự</th>
                        <th>Hành động</th>
                    </thead>
                    <tbody>
                        @foreach ($results as $item)
                            <tr>
                                <td><span class="d-block" style="width: 140px"><img class="w-100 rounded"
                                            src="{{ $item->image }}" alt="{{ $item->image }}"></span></td>
                                <td><span>{{ $item->text_link }}</span></td>
                                <td>
                                    @if ($item->status == 'active')
                                        <span class="badge badge-info">Đang hoạt động</span>
                                    @elseif($item->status == 'inactive')
                                        <span class="badge">Ngưng hoạt động</span>
                                    @endif
                                </td>

                                <td><span>{{ $item->order }}</span></td>
                                <td>
                                    <button class="btn btn-warning">Chỉnh sửa</button>
                                    <button class="btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    </div>
    <style>
        .product-image,
        .product-gallery {
            margin-bottom: 30px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
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

        .gallery-item {
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

        .delete-button {
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
    <script src="{{ asset('/') }}backend/plugins/ckfinder_2/ckfinder.js"></script>
    <script src="{{ asset('/') }}backend/js/banner/index.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/select2/select2.full.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/') }}backend/css/plugins/select2/select2.min.css">
@endsection
