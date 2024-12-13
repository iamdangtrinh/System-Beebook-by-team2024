<title>
    @yield('title', 'Đơn hàng')</title>
@extends('layout.admin')

@section('body')
    <div>
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

        <div class="row wrapper wrapper-content">
            <div class="ibox-content p-3 m-0 border-bottom">
                <h3 style="p-0">Cập nhật danh mục: {{ $taxonomy->name }}</h3>
                <form action="{{route('admintaxonomy.update', ['id'=> $taxonomy->id])}}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="{{ $taxonomy->type }}">
                    <!-- Cột 1: Nhập tên tác giả -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">Nhập tên tác giả</label>
                            <input type="text" id="name" name="name" class="mb-3 form-control"
                                value="{{ $taxonomy->name }}">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="slug">Đường dẫn</label>
                            <input type="text" name="slug" id="slug" value="{{ $taxonomy->slug }}" placeholder=""
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <button type="submit" class="mt-3 btn btn-primary w-100">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
