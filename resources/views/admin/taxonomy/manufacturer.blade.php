<title>@yield('title', 'Danh mục nhà sản xuất')</title>
@extends('layout.admin')

@section('body')
    <div>
        @if ($errors->any())
            <ul class="navbar-nav alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row wrapper wrapper-content" style="padding: 10px 0 0 !important">
            <div class="ibox-content m-b-sm border-bottom">
                <form action="{{ route('admintaxonomy.add') }}" method="post">
                    <div class="row">
                        <!-- Cột 1: Nhập tên nhà sản xuất -->
                        @csrf
                        <input type="hidden" id="type" name="type" class="mb-3 form-control" value="author">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name">Nhập tên nhà sản xuất</label>
                                <input type="text" id="name" name="name" class="mb-3 form-control"
                                    value="">
                            </div>
                        </div>

                        <!-- Cột 2: Tên danh mục -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="slug">Đường dẫn</label>
                                <input type="text" id="slug" name="slug" value="" placeholder=""
                                    class="form-control">
                            </div>
                        </div>

                        <!-- Cột 3: Nút Lưu thay đổi -->
                        <div class="col-sm-4">
                            <button class="mt-3 btn btn-primary w-100">Thêm nhà sản xuất</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="ibox">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class=" table table-bordered toggle-arrow-tiny" data-page-size="15">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Loại</th>
                                    <th>Tên danh mục</th>
                                    <th>Đường dẫn</th>
                                    <th style="width: 200px">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taxonomies as $tax)
                                    <tr>
                                        <td>{{ $tax->id }}</td>

                                        <td>
                                            @if ($tax->type === 'author')
                                                nhà sản xuất
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

                                            <a href="{{ route('admintaxonomy.edit', ['id' => $tax->id]) }}"
                                                class="btn btn-warning" style="width: max-content">Sửa</a>
                                            <a href="{{ route('admintaxonomy.forceDelete', ['id' => $tax->id]) }}"
                                                class="btn btn-danger deleteBtn" style="width: max-content">Xóa</a>
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
        $(document).ready(function() {
            $(document).on('click', '.deleteBtn', function(event) {
                event.preventDefault();

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
                        Swal.fire({
                            title: "Đã xóa!",
                            text: "Danh mục của bạn đã bị xóa.",
                            icon: "success"
                        });

                        window.location.href = $(this).attr('href')
                    }
                });
            });
        });
    </script>
@endsection
