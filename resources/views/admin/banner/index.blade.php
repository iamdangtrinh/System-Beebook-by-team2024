<title>@yield('title', 'Banner hình ảnh')</title>
@extends('layout.admin')

@section('body')
    <div class="container-fuild">
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

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="product-gallery">
                        <label>Danh sách hình ảnh banner</label>
                        <div class="file-upload" id="2gallery-upload">
                            <i class="fa fa-cloud-arrow-up"></i> <br> Thả hình ảnh vào đây hoặc bấm vào để tải lên.
                            <input type="hidden" value="" name="image" class="url_image form-control">
                        </div>
                        <div class="mb-3" id="gallery-preview">
                        </div>

                        <label for="text_link">Nhập đường dẫn hình ảnh</label>
                        <input type="text" id="text_link" name="text_link" class="mb-3 form-control" value=""
                            placeholder="{{ env('APP_URL') }}">

                        <select name="type" id="" class="mb-3 form-control setupSelect2">
                            @foreach (config('admin.dashboard.banner') as $key => $item)
                                <option value="{{ $key }}"> {{ $item }}</option>
                            @endforeach
                        </select>
                        <button class="mt-3 btn btn-primary">{{ 'Lưu thay đổi' }}</button>
                </form>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-xl-9">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th style="width: 130px">Hình ảnh</th>
                        <th>Đường dẫn</th>
                        <th style="width: 130px">Loại</th>
                        <th style="width: 130px">Trạng thái</th>
                        <th style="width: 130px">Thứ tự</th>
                        <th style="width: 130px">Hành động</th>
                    </thead>
                    <tbody>
                        @if (count($results) > 0)
                            @foreach ($results as $item)
                                <tr>
                                    <td><span class="d-block" style="width: 140px; height: 100px;"><img
                                                style=" object-fit: cover" class="w-100 h-100 rounded"
                                                src="{{ $item->image }}" alt="{{ $item->image }}"></span></td>
                                    <td><span>{{ $item->text_link }}</span></td>
                                    <td>
                                        @foreach (config('admin.dashboard.banner') as $key => $type)
                                            <span>{{ $key === $item->type ? $type : '' }}</span>
                                        @endforeach

                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch updateStatus" data-id="{{ $item->id }}"
                                            {{ $item->status === 'active' ? 'checked' : '' }} />
                                    </td>

                                    <td><span>{{ $item->order }}</span></td>
                                    <td>
                                        <div class="btn-group gap-2 w-100 __custom_btn_group">
                                            <a href="{{ route('admin.banner.detail', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-warning">Sửa</a>
                                            <a href="{{ route('admin.banner.destroy', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-danger _deleteBanner">Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center p-5" colspan="20">
                                    <img src="{{ asset('/') }}client/images/ico_emptycart.svg"
                                        alt="Hiện tại không hỉnh ảnh banner">
                                    <h3 class="mt-3">Hiện tại không hỉnh ảnh banner</h3>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $results->links() }}
            </div>
        </div>
    </div>

    <script src="{{ asset('/') }}backend/plugins/ckfinder_2/ckfinder.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/switchery/switchery.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/select2/select2.full.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/') }}backend/css/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}backend/css/banner/index.css">
    <script src="{{ asset('/') }}client/js/lib/sweetalert2.js"></script>
    <script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
    <script src="{{ asset('/') }}backend/js/banner/index.js"></script>

@endsection
