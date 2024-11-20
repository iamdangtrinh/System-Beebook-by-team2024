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

        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xl-6">
                    <div class="product-gallery">
                        <label>Danh sách hình ảnh banner</label>
                        <div class="file-upload" id="gallery-upload">
                            <i class="fa fa-cloud-arrow-up"></i> <br> Thả hình ảnh vào đây hoặc bấm vào để tải lên.
                            <input type="hidden" value="" name="image" class="url_image">
                        </div>
                        <div id="gallery-preview"></div>
                        
                        <input type="text" name="text_link" class="mt-3 form-control" placeholder="Nhập đường dẫn hình ảnh">
                    </div>
                </div>


                {{-- <div class="col-sm-12 col-md-12 col-xl-6">
                    <div class="product-image">
                        <label>Hình ảnh banner phụ</label>
                        <div class="file-upload" id="main-image">
                            <i class="fa fa-cloud-arrow-up"></i> <br> Thả hình ảnh vào đây hoặc bấm vào để tải lên.
                        </div>
                        <div id="main-image-preview"></div>
                        <input type="hidden" name="main_image" id="main-image-path">
                    </div>
                </div> --}}
            </div>

            <button class="btn btn-primary">Lưu thay đổi</button>
        </form>


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
@endsection
