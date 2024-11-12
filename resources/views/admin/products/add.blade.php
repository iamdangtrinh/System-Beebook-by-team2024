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
            <!-- <form id="form" action="#">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label>Tên sách <span class="text-danger">*</span></label>
                            <input id="name" name="name" type="text" class="form-control required">
                        </div>

                        <div class="form-group">
                            <label>Slug <span class="text-danger">*</span></label>
                            <input id="slug" name="slug" type="text" class="form-control required" placeholder="ten-san-pham">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Giá <span class="text-danger">*</span></label>
                                    <input id="price" name="price" type="number" class="form-control required">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Giá giảm</label>
                                    <input id="price_sale" name="price_sale" type="number" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Số lượng <span class="text-danger">*</span></label>
                            <input id="quantity" name="quantity" type="number" class="form-control required">
                        </div>

                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta SEO</label>
                            <input id="meta_seo" name="meta_seo" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Description SEO</label>
                            <textarea id="description_seo" name="description_seo" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>URL Video</label>
                            <input id="url_video" name="url_video" type="url" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select id="status" name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nổi bật</label>
                            <select id="hot" name="hot" class="form-control">
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Ngôn ngữ</label>
                            <select id="language" name="language" class="form-control">
                                <option value="tieng-viet">Tiếng Việt</option>
                                <option value="tieng-anh">Tiếng Anh</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tác giả</label>
                            <select id="id_author" name="id_author" class="form-control">
                                <option value="1">Tác giả 1</option>
                                <option value="2">Tác giả 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nhà xuất bản</label>
                            <select id="id_manufacturer" name="id_manufacturer" class="form-control">
                                <option value="1">NXB 1</option>
                                <option value="2">NXB 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ảnh chính</label>
                            <input id="image_cover" name="image_cover" type="file" class="form-control-file">
                        </div>

                        <div class="form-group">
                            <label>Ảnh phụ</label>
                            <input id="images" name="images[]" type="file" class="form-control-file" multiple>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Lượt xem</label>
                            <input id="views" name="views" type="number" class="form-control">
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form> -->

            <form id="form" action="#">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label>Tên sách <span class="text-danger">*</span></label>
                            <input id="name" name="name" type="text" class="form-control required">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label class="font-normal">Ngôn ngữ</label>
                            <div>
                                <select data-placeholder="Chọn ngôn ngữ..." class="chosen-select" tabindex="2">
                                    <option value="tieng-viet">Tiếng Việt</option>
                                    <option value="tieng-anh">Tiếng Anh</option>
                                    <option value="tieng-trung">Tiếng Trung</option>
                                    <option value="tieng-nhat">Tiếng Nhật</option>
                                    <option value="tieng-han">Tiếng Hàn</option>
                                    <option value="tieng-phap">Tiếng Pháp</option>
                                    <option value="tieng-duc">Tiếng Đức</option>
                                    <option value="tieng-y">Tiếng Ý</option>
                                    <option value="tieng-tay-ban-nha">Tiếng Tây Ban Nha</option>
                                    <option value="tieng-nga">Tiếng Nga</option>
                                    <option value="tieng-thai">Tiếng Thái</option>
                                    <option value="tieng-a-rap">Tiếng Ả Rập</option>
                                    <option value="tieng-ba-lan">Tiếng Ba Lan</option>
                                    <option value="tieng-ha-lan">Tiếng Hà Lan</option>
                                    <option value="tieng-hy-lap">Tiếng Hy Lạp</option>
                                    <option value="tieng-hindi">Tiếng Hindi</option>
                                    <option value="tieng-philippines">Tiếng Philippines</option>
                                    <option value="tieng-indonesia">Tiếng Indonesia</option>
                                    <option value="tieng-malay">Tiếng Mã Lai</option>
                                    <option value="tieng-swe">Tiếng Thụy Điển</option>
                                    <option value="tieng-bo-dao-nha">Tiếng Bồ Đào Nha</option>
                                    <option value="tieng-hung">Tiếng Hung</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label class="font-normal">Tác giả</label>
                            <div>
                                <select data-placeholder="Chọn ngôn ngữ..." class="chosen-select" tabindex="2">
                                    <option value="tieng-viet">Tiếng Việt</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Slug <span class="text-danger">*</span></label>
                            <input id="slug" name="slug" type="text" class="form-control required" placeholder="ten-san-pham">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Số lượng <span class="text-danger">*</span></label>
                            <input id="quantity" name="quantity" type="number" class="form-control required">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="font-normal">Nhà xuất bản</label>
                            <div>
                                <select data-placeholder="Chọn ngôn ngữ..." class="chosen-select" tabindex="2">
                                    <option value="tieng-viet">Tiếng Việt</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Giá <span class="text-danger">*</span></label>
                            <input id="price" name="price" type="number" class="form-control required">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Giá giảm</label>
                            <input id="price_sale" name="price_sale" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <!-- <div class="i-checks">
                            <label>Trạng thái</label> <br>
                            <label> <input type="radio" value="bia-cung" name="form" checked=""> <i></i> Hoạt động </label>
                            <label> <input type="radio" value="bia-mem" name="form"> <i></i> Không hoạt động </label>
                        </div> -->
                        <div class="form-group">
                            <label>Cân nặng (g) <span class="text-danger">*</span></label>
                            <input id="weight" name="weight" type="number" class="form-control required">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="i-checks">
                            <label>Hình thức</label> <br>
                            <label> <input type="radio" value="bia-cung" name="form"> <i></i> Bìa cứng </label>
                            <label> <input type="radio" value="bia-mem" name="form"> <i></i> Bìa mềm </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="i-checks">
                            <label>Hot</label> <br>
                            <label> <input type="radio" value="bia-cung" name="form"> <i></i> Có </label>
                            <label> <input type="radio" value="bia-mem" name="form" checked=""> <i></i> Không </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Năm xuất bản <span class="text-danger">*</span></label>
                            <input id="year" name="year" type="number" class="form-control required">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Meta SEO</label>
                            <input id="meta_seo" name="meta_seo" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Description SEO</label>
                            <textarea id="description_seo" name="description_seo" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <label>Ảnh chính</label>
                        <span class="image img-cover image-target">
                            <img src="/no_image.jpg" class="img-fluid rounded-top" alt="" />
                        </span>
                        <input type="hidden" value="" name="image" class="url_image">
                    </div>

                    <div class="col-6">
                        <label>Ảnh phụ</label>
                        <div class="row" id="image-container">
                            <!-- Ảnh đầu tiên mặc định hiển thị, không có nút "X" -->
                            <div class="col-3 image-wrapper">
                                <span class="image img-cover image-target" style="position: relative;">
                                    <img src="/no_image.jpg" class="img-fluid rounded-top main-image" alt="Ảnh phụ" />
                                </span>
                                <input type="hidden" value="" name="hinh1" class="url_image">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mt-2" id="add-image">Thêm ảnh</button>
                    </div>
                    <div class="col-12">
                        <div class="float-e-margins">
                            <label>Description</label>
                            <textarea name="content" id="content" class="content" cols="30" rows="10"></textarea>
                        </div>
                        <!-- <form action="#" class="dropzone" id="dropzoneForm">
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form> -->
                    </div>
                    <div class="col-12 mt-3">
                        <button class="btn btn-outline btn-warning">Lưu nháp</button>
                        <button class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script src="{{ asset('/') }}client/js/lib/toastr.js"></script>

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
    $(document).ready(function() {
        $('.chosen-select').chosen({
            width: "100%"
        });
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        let imageCount = 1; // Đếm số ảnh

        // Xử lý nút "Thêm ảnh"
        $('#add-image').click(function() {
            const allImages = document.querySelectorAll('.image-wrapper img');
            let allAreNoImage = Array.from(allImages).every(img => img.src.includes('/no_image.jpg'));

            if (allAreNoImage) {
                toastr.error('Vui lòng thay đổi ảnh mặc định trước khi thêm ảnh mới.');
                return;
            }

            if (imageCount < 8) { // Giới hạn tối đa 8 ảnh
                imageCount++; // Tăng đếm số ảnh

                // Tạo ô ảnh mới
                const newImageDiv = document.createElement('div');
                newImageDiv.classList.add('col-3', 'image-wrapper');
                newImageDiv.innerHTML = `
                    <span class="image img-cover image-target" style="position: relative;">
                        <img src="/no_image.jpg" class="img-fluid rounded-top main-image" alt="Ảnh phụ" />
                        <button type="button" class="btn btn-danger btn-sm remove-image" style="position: absolute; top: 5px; right: 5px;">X</button>
                    </span>
                    <input type="hidden" value="" name="hinh${imageCount}" class="url_image">
                `;

                // Thêm ô ảnh mới vào container
                document.getElementById('image-container').appendChild(newImageDiv);

                // Thêm sự kiện xóa cho nút "X" mới
                newImageDiv.querySelector('.remove-image').addEventListener('click', function() {
                    newImageDiv.remove(); // Xóa ô ảnh
                    imageCount--; // Giảm đếm số ảnh
                });
            } else {
                alert("Đã đạt đến giới hạn tối đa 8 ảnh.");
            }
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