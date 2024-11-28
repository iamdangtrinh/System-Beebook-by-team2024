<div>
    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-lg-2">
            <a wire:click="closeModal" class="btn btn-outline btn-primary btn-rounded">Thêm tác giả</a>
        </div>
    </div>

    <div class="row wrapper wrapper-content" style="padding: 10px 0 0 !important">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <div class="form-group">
                        <label class="control-label" for="id">Mã tác giả</label>
                        <input type="text" id="" wire:model.live="id" value=""
                            placeholder="Mã bài viết" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                    <div class="form-group">
                        <label class="control-label" for="title">Tên danh mục</label>
                        <input type="text" id="title" wire:model.live="title" value=""
                            placeholder="Tên tác giả" class="form-control">
                    </div>
                </div>
            </div>
            @if (session('deleted_success'))
                <div class="success text-success">
                    {{ session('deleted_success') }}
                </div>
            @endif
            @if (session('deleted_error'))
                <div class="error text-danger">
                    {{ session('deleted_error') }}
                </div>
            @endif
            @if (session('create_success'))
                <div class="success text-success">
                    {{ session('create_success') }}
                </div>
            @endif
            @if (session('create_error'))
                <div class="error text-danger">
                    {{ session('create_error') }}
                </div>
            @endif
            @if (session('update_success'))
                <div class="success text-success">
                    {{ session('update_success') }}
                </div>
            @endif
            @if (session('update_error'))
                <div class="error text-danger">
                    {{ session('update_error') }}
                </div>
            @endif
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tác giả</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane"
                    aria-selected="false">Nhà sản xuất</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane"
                    aria-selected="false">Người dịch</button>
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
                            @foreach ($gettaxonomy as $tax)
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
                                        <button class="btn btn-warning">Sửa</button>
                                        <button class="btn btn-danger">Xóa</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($paginationData['total'] > $paginationData['perPage'])
                        <nav class="d-flex justify-content-end" role="Page navigation example"
                            aria-label="Pagination Navigation">
                            <ul class="pagination">
                                <!-- Previous Page Link -->
                                <li class="page-item {{ $paginationData['currentPage'] == 1 ? 'disabled' : '' }}">
                                    <button class="page-link" wire:click="previousPage" wire:loading.attr="disabled">
                                        <span aria-hidden="true" class="text-black">&laquo;</span>
                                    </button>
                                </li>

                                <!-- Page Numbers -->
                                @for ($i = 1; $i <= $paginationData['lastPage']; $i++)
                                    <li
                                        class="page-item {{ $paginationData['currentPage'] == $i ? 'active bg-secondary' : '' }}">
                                        <button
                                            class="page-link {{ $paginationData['currentPage'] == $i ? 'text-white' : 'text-black' }}"
                                            wire:click="gotoPage({{ $i }})" wire:loading.attr="disabled">
                                            {{ $i }}
                                        </button>
                                    </li>
                                @endfor

                                <!-- Next Page Link -->
                                <li
                                    class="page-item {{ $paginationData['currentPage'] == $paginationData['lastPage'] ? 'disabled' : '' }}">
                                    <button class="page-link" wire:click="nextPage" wire:loading.attr="disabled">
                                        <span class="text-black" aria-hidden="true">&raquo;</span>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    @endif

                    {{-- {{ $gettaxonomy->links() }} --}}

                </div>
            </div>
        </div>
        @if ($isModal)
            <div class="modal fade show d-block" id="exampleModal" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" style="display: block;">
                <div style="max-width: 70%;" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            @if ($editTaxonomy)
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật bài viết</h1>
                            @else
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm bài viết</h1>
                            @endif
                            <button type="button" class="btn-close" wire:click="closeModal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex flex-column gap-4">
                                                {{-- Form Đăng ký --}}
                                                <form class="d-flex flex-column gap-4">
                                                    {{-- ID (Hidden) --}}
                                                    <input type="hidden" wire:model="id">

                                                    {{-- Post Type --}}
                                                    <div class="form-group"
                                                        style="display: flex; flex-direction: column; gap:5px">
                                                        <label for="PostType">Loại bài viết</label>
                                                        <select wire:model="post_type" id="PostType"
                                                            class="form-control rounded-3">
                                                            <option value="" disabled>Chọn loại bài viết</option>
                                                            <option value="review">Review</option>
                                                            <option value="blog">Blog</option>
                                                        </select>
                                                        @error('post_type')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Title --}}
                                                    <div class="form-group"
                                                        style="display: flex; flex-direction: column; gap:5px">
                                                        <label for="Title">Tên bài viết</label>
                                                        <input type="text" wire:model="title"
                                                            class="form-control rounded-3" placeholder="Tên bài viết"
                                                            id="Title">
                                                        @error('title')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Content --}}
                                                    <div class="col-12">
                                                        <div class="form-group @error('content') has-error @enderror">
                                                            <label>Description <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea name="content" id="content" class="content form-control" cols="30" rows="10">{{ old('content') }}</textarea>
                                                            @error('content')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- Tags --}}
                                                    <div class="form-group"
                                                        style="display: flex; flex-direction: column; gap:5px">
                                                        <label for="Tags">Tags</label>
                                                        <input type="text" wire:model="tags"
                                                            class="form-control rounded-3"
                                                            placeholder="Tags (phân cách bởi dấu phẩy)"
                                                            id="Tags">
                                                        @error('tags')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Image --}}
                                                    {{-- <div class="form-group" style="display: flex; flex-direction: column; gap:5px">
                                                <label for="Image">Hình ảnh</label>
                                                <input type="file" wire:model="image" class="form-control rounded-3" id="Image">
                                                @error('image') <span class="error text-danger">{{ $message }}</span> @enderror
                                            </div> --}}

                                                    {{-- Slug --}}
                                                    <div class="form-group"
                                                        style="display: flex; flex-direction: column; gap:5px">
                                                        <label for="Slug">Slug</label>
                                                        <input type="text" wire:model="slug"
                                                            class="form-control rounded-3" placeholder="Slug"
                                                            id="Slug" disabled>
                                                        @error('slug')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Status --}}
                                                    <div class="d-flex gap-4 align-items-center">
                                                        <label class="fs-6">
                                                            <input type="radio" wire:model="status" value="active">
                                                            Hiện
                                                        </label>
                                                        <label class="fs-6">
                                                            <input type="radio" wire:model="status"
                                                                value="inactive">
                                                            Ẩn
                                                        </label>
                                                        @error('status')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Hot --}}
                                                    <div class="form-group"
                                                        style="display: flex; flex-direction: column; gap:5px">
                                                        <label for="Hot">Hot</label>
                                                        <select wire:model="hot" id="Hot"
                                                            class="form-control rounded-3">
                                                            <option value="0">Không</option>
                                                            <option value="1">Có</option>
                                                        </select>
                                                        @error('hot')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Meta Title SEO --}}
                                                    <div class="form-group"
                                                        style="display: flex; flex-direction: column; gap:5px">
                                                        <label for="MetaTitle">Meta Title SEO</label>
                                                        <input type="text" wire:model="meta_title_seo"
                                                            class="form-control rounded-3"
                                                            placeholder="Meta Title SEO" id="MetaTitle">
                                                        @error('meta_title_seo')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{-- Meta Description SEO --}}
                                                    <div class="form-group"
                                                        style="display: flex; flex-direction: column; gap:5px">
                                                        <label for="MetaDescription">Meta Description SEO</label>
                                                        <textarea wire:model="meta_description_seo" class="form-control rounded-3" placeholder="Meta Description SEO"
                                                            id="MetaDescription" rows="3"></textarea>
                                                        @error('meta_description_seo')
                                                            <span class="error text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>



                                                    {{-- Success Message --}}
                                                    @if (session('success'))
                                                        <div class="alert alert-success">
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif


                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="d-flex flex-col gap-4">
                                        <div class="form-group">
                                            <div class="w-100 d-flex justify-content-center flex-col">
                                                <div class="image-upload">
                                                    <label for="file-upload" style="cursor: pointer;">
                                                        <img style="width: 100%; border: 1px solid black"
                                                            src="{{ asset($image === '' ? 'no_image.jpg' : $image) }}"
                                                            alt="">
                                                    </label>
                                                    <input type="file" id="file-upload" wire:model.change="image"
                                                        style="display: none;" accept="image/*">
                                                </div>
                                                @error('avatar')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @if ($image !== '')
                                        <button wire:click="removeImage">Xóa ảnh</button>
                                    @endif
                                    @if (session('removeImageSuccess'))
                                        <div class="success text-success">
                                            {{ session('removeImageSuccess') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" style="border-radius: 4px" class="btn btn-secondary"
                                wire:click="closeModal">Đóng</button>
                            @if ($dataEditpost)
                                <button type="button"
                                    style="border-radius: 4px; background:#CE2626 !important; color:white !important"
                                    wire:click="Updatepost" class="btn rounded-1  fs-6">Cập nhật</button>
                            @else
                                <button type="button"
                                    style="border-radius: 4px; background:#CE2626 !important; color:white !important"
                                    wire:click="createpost" class="btn rounded-1  fs-6">Xác nhận thêm</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>

        @endif
    </div>
    <style>
        .pagination .page-item.active .page-link {
            background-color: #F4F4F4 !important;
            /* màu xám */
            border-color: #6c757d !important;
            color: black !important
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('swal', (event) => {
                const data = event;
                swal.fire({
                    icon: 'warning',
                    title: 'Bạn có muốn xóa danh mục này không?',
                    text: 'Nếu bạn xóa, hành động này không thể hoàn tác!',
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonColor: 'red',
                    cancelButtonColor: 'black',
                    confirmButtonText: 'Xác nhận xóa'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.dispatch('hanldeDeletedpost')
                    }
                })
            })
        })
    </script>

</div>
<script src="{{ asset('/') }}backend/plugins/ckeditor/ckeditor.js"></script>
