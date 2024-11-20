<title>@yield('title', 'Thêm bài viết')</title>
@extends('layout.admin')

@section('body')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Bài viết</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Trang chủ</a>
            </li>
            <li>
                <i class="fa fa-angle-right mx-1"></i>
            </li>
            <li>
                <a href="index.html">Bài viết</a>
            </li>
            <li>
                <i class="fa fa-angle-right mx-1"></i>
            </li>
            <li class="active">
                <strong>Thêm bài viết</strong>
            </li>
        </ol>
    </div>
</div>

<div class="row wrapper wrapper-content" style="padding: 20px 0 0 !important">
    <div class="ibox">
        <div class="ibox-content">
            <h2>
                Thêm bài viết
            </h2>

            <form id="blog-form" action="{{ route('blogs.store') }}" method="POST" class="wizard-big">
                @csrf
                <h1>Thông tin bài viết</h1>
                <fieldset>
                    <h2>Nhập thông tin bài viết</h2>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Tiêu đề bài viết *</label>
                                <input id="title" name="title" type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Slug *</label>
                                <input id="slug" name="slug" type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt *</label>
                                <textarea id="summary" name="summary" class="form-control required" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <div style="margin-top: 20px">
                                    <i class="fa fa-file-text" style="font-size: 180px;color: #e5e5e5 "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h1>Nội dung bài viết</h1>
                <fieldset>
                    <h2>Nhập nội dung bài viết</h2>
                    <div class="form-group">
                        <label>Nội dung *</label>
                        <textarea id="content" name="content" class="form-control required" rows="10"></textarea>
                    </div>
                </fieldset>

                <h1>Hoàn tất</h1>
                <fieldset>
                    <h2>Xác nhận</h2>
                    <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> 
                    <label for="acceptTerms">Tôi đồng ý với các điều khoản và điều kiện.</label>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('/') }}backend/js/blogs/index.js"></script>
<!-- Steps -->
<script src="{{ asset('/') }}backend/js/plugins/steps/jquery.steps.min.js"></script>

<!-- Jquery Validate -->
<script src="{{ asset('/') }}backend/js/plugins/validate/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $("#blog-form").steps({
            bodyTag: "fieldset",
            onStepChanging: function(event, currentIndex, newIndex) {
                if (currentIndex > newIndex) {
                    return true;
                }

                var form = $(this);
                form.validate().settings.ignore = ":disabled,:hidden";

                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                var form = $(this);
                form.submit();
            }
        }).validate({
            errorPlacement: function(error, element) {
                element.before(error);
            },
            rules: {
                slug: {
                    required: true
                }
            }
        });
    });
</script>
@endsection
