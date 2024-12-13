<title>
    @yield('title', 'Đơn hàng')</title>
@extends('layout.admin')

@section('body')
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">

            </div>

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
        </div>

        <div class="row wrapper wrapper-content" style="padding: 10px 0 0 !important">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <!-- Cột 1: Nhập tên tác giả -->
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label for="text_link">Nhập tên tác giả</label>
                            <input type="text" id="text_link" name="text_link" class="mb-3 form-control" value="">
                        </div>
                    </div>

                    <!-- Cột 2: Tên danh mục -->
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label class="control-label" for="title">Slug</label>
                            <input type="text" id="title" value="" placeholder="Slug+" class="form-control">
                        </div>
                    </div>

                    <!-- Cột 3: Nút Lưu thay đổi -->
                    <div class="col-sm-4 mb-3">
                        <button class="mt-3 btn btn-primary w-100">Lưu thay đổi</button>
                        <!-- w-100 để nút chiếm hết chiều rộng của cột -->
                    </div>
                </div>
            </div>


            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tác giả</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Nhà sản
                        xuất</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Người phiên
                        dịch</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                </div>

                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                </div>
            </div>

            <div class="ibox">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class=" table table-bordered toggle-arrow-tiny" data-page-size="15">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Loại</th>
                                    <th>Tên</th>
                                    <th>Đường dẫn</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taxonomies as $tax)
                                    <tr>
                                        <td>{{ $tax->id }}</td>

                                        <td>
                                            @if ($tax->type === 'author')
                                                Tác giả
                                            @elseif ($tax->type === 'translator')
                                                Người phiên dịch
                                            @elseif ($tax->type === 'manufacturer')
                                                Nhà sản xuất
                                            @else
                                                Không xác định
                                            @endif
                                        </td>
                                        <td>{{ $tax->name }}</td>
                                        <td>{{ $tax->slug }}</td>
                                        <td class="text-right">
                                            <button class="btn btn-warning" style="border-radius: 5px; padding: 8px 16px; font-size: 14px; text-align: center; display: inline-flex; align-items: center; min-width: 80px; background-color: #ffc107; border-color: #ffc107; color: #fff; text-decoration: none;">Sửa</button>
                                            <a href="{{ route('admintaxonomy.forceDelete', ['id' => $tax->id]) }}" class="btn btn-danger deleteBtn" style="border-radius: 5px; padding: 8px 16px; font-size: 14px; text-align: center; display: inline-flex; align-items: center; min-width: 80px; background-color: #dc3545; border-color: #dc3545; color: #fff; text-decoration: none;">Xóa</a>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $taxonomies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Sử dụng jQuery để bắt sự kiện click
        $(document).on('click', '.deleteBtn', function(event) {
            event.preventDefault(); // Ngừng hành động mặc định của nút (nếu có)

            // Hiển thị SweetAlert để xác nhận
            Swal.fire({
                title: "Bạn có muốn xóa danh mục này không?",
                text: "Nếu bạn xóa, hành động này không thể hoàn tác!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#000",
                confirmButtonText: "Xác nhận xóa",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Xử lý nếu người dùng xác nhận xóa
                    Swal.fire({
                        title: "Đã xóa!",
                        text: "Danh mục của bạn đã bị xóa.",
                        icon: "success"
                    });

                    window.location.href = $(this).attr('href')
                }
            });
        });
    </script>
@endsection
