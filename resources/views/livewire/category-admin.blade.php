<div>
    <div class="row wrapper border-bottom white-bg page-heading" >
        <div class="col-lg-10">
            <h2>Danh mục</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Trang chủ</a>
                </li>
                <li>
                    <i class="fa fa-angle-right mx-1"></i>
                </li>
                <li class="active">
                    <strong>Danh mục</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <a wire:click="closeModal" class="btn btn-outline btn-primary btn-rounded">Thêm danh mục</a>
        </div>
    </div>
    
    <div class="row wrapper wrapper-content" style="padding: 10px 0 0 !important">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <div class="form-group">
                        <label class="control-label" for="order_id">Mã danh mục</label>
                        <input type="text" id="" wire:model.live="idCategory" value="" placeholder="Mã danh mục"
                            class="form-control">
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                    <div class="form-group">
                        <label class="control-label" for="status">Tên danh mục</label>
                        <input type="text" id="status" wire:model.live="nameCategory" value="" placeholder="Tên danh mục"
                            class="form-control">
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
    
        <div class="ibox">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class=" table table-bordered toggle-arrow-tiny" data-page-size="15">
                        <thead>
                            <tr>
                                <th>Mã danh mục</th>
                                <th >Ảnh</th>
                                <th >Tên danh mục</th>
                                <th >Slug</th>
                                <th >order</th>
                                <th >parent_id</th>
                                <th >Trạng thái</th>
                                <th >Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getAllCategory as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    <img 
                                    style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid black" 
                                    src="{{asset('storage/uploads/'.($category->image === '' ? 'no_image.jpg':$category->image))}}" 
                                    >
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->order }}</td>
                                <td>{{ $category->parent_id }}</td>
                                <td class="d-flex justify-content-center" style="border: none" > 
                                    @if ($category->status === 'active')
                                    <div style="width: 10px; height: 10px; background: #00FF00; border-radius: 50%; border: none" class="dot"></div>
                                    @else
                                    <div style="width: 10px; height: 10px; background: red; border-radius: 50%; border: none" class="dot"></div>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="d-flex gap-2">
                                        <a wire:click="editCategory({{$category->id}})"  class="btn btn-sm btn-warning">Sửa</a>
                                        <a wire:click="deleted_category({{ $category->id }}, '{{ $category->image }}')" class="btn btn-sm btn-danger">Xóa</a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach                
                        </tbody>
                    </table>
                    @if (count($getAllCategory) !== 0)
                    @if ($paginationData['total'] > $paginationData['perPage'])
                    <nav class="d-flex justify-content-end" role="Page navigation example" aria-label="Pagination Navigation">
                        <ul class="pagination">
                            <!-- Previous Page Link -->
                            <li class="page-item {{ $paginationData['currentPage'] == 1 ? 'disabled' : '' }}">
                                <button class="page-link" wire:click="previousPage" wire:loading.attr="disabled">
                                    <span aria-hidden="true" class="text-black">&laquo;</span>
                                </button>
                            </li>
            
                            <!-- Page Numbers -->
                            @for ($i = 1; $i <= $paginationData['lastPage']; $i++)
                            <li class="page-item {{ $paginationData['currentPage'] == $i ? 'active bg-secondary' : '' }}">
                                <button class="page-link {{ $paginationData['currentPage'] == $i ? 'text-white' : 'text-black' }}" wire:click="gotoPage({{ $i }})" wire:loading.attr="disabled">
                                    {{ $i }}
                                </button>
                            </li>
                        @endfor
            
                            <!-- Next Page Link -->
                            <li class="page-item {{ $paginationData['currentPage'] == $paginationData['lastPage'] ? 'disabled' : '' }}">
                                <button class="page-link" wire:click="nextPage" wire:loading.attr="disabled">
                                    <span class="text-black" aria-hidden="true">&raquo;</span>
                                </button>
                            </li>
                        </ul>
                    </nav>
                @endif  
                    @endif
                </div>
                @if (count($getAllCategory) === 0)
                <div class="d-flex flex-column" >
                    <img style="height: 200px; object-fit: contain" src='/client/images/manager-user/no-data.webp' alt="">
                    <p class="text-center" style="font-size:1rem " >Không tồn tại tài khoản</p>
                </div>
                @endif
            </div>
        </div>
        @if ($isModal)
    <div  class="modal fade show d-block" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" style="display: block;">
        <div style="max-width: 70%;" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($dataEditCategory)
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật danh mục</h1>
                    @else
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm danh mục</h1>
                    @endif
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex flex-column gap-4">
                                        {{-- Form Đăng ký --}}
                                        <form class="d-flex flex-column gap-4">
                                            {{-- Name --}}
                                            <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                                <label for="CustomerName">Tên danh mục</label>
                                                <input class="form-control rounded-3"  wire:model.live="valueNameCategory" placeholder="Tên danh mục" id="CustomerName" autocorrect="off" autocapitalize="off"  >
                                                @error('valueNameCategory') <span class="error text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            {{-- slug --}}
                                            <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                                <label for="CustomerName">Slug</label>
                                                <input class="form-control rounded-3"  placeholder="Slug" disabled id="CustomerName" autocorrect="off" autocapitalize="off"  value={{$valueSlug}} >
                                            </div>
                                            {{-- Phone --}}
                                            <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                                <label for="CustomerPhone">Thứ tự</label>
                                                <input class="form-control rounded-3" wire:model.live="valueOrderCategory" placeholder="Thứ tự" id="CustomerPhone" autocorrect="off" autocapitalize="off" >
                                                @error('valueOrderCategory') <span class="error text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="d-flex gap-4 align-items-center">
                                                <label class="fs-6" >
                                                    <input type="radio" wire:model.change="valueStatus" name={{$valueStatus}} value="active">
                                                    Hiện
                                                </label>
                                                <label class="fs-6">
                                                    <input type="radio" wire:model.change="valueStatus" name={{$valueStatus}} value="inactive">
                                                    Ẩn
                                                </label>
                                            </div>
                                            <div class="form-group" style="display: flex; flex-direction: column; gap:5px">
                                                <label for="CustomerEmail">Danh mục cha</label>
                                                <select name="" id="" wire:model.change="valueIdParentCategory" style="border: 1px solid #e5e6e7; width: 100%; border-radius: 8px; padding: 6px 12px;" >
                                                    <option value="" disabled>Chọn danh mục</option>
                                                   @foreach ($dataIdCategoryParent as $item)
                                                   <option value={{$item->id}}>{{$item->name}}</option>
                                                   @endforeach
                                                </select>
                                                @error('valueIdParentCategory') <span class="error text-danger">{{ $message }}</span> @enderror
                                            </div>
                                             {{-- Success Message --}}
                                            @if (session('success-sign-up'))
                                                <div class="alert alert-success">
                                                    {{ session('success-sign-up') }}
                                                </div>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="d-flex flex-col gap-4">
                                <div class="form-group" >
                                    <div class="w-100 d-flex justify-content-center flex-col">
                                        <div class="image-upload">
                                            <label for="file-upload" style="cursor: pointer;">
                                                <img 
                                                     style="width: 100%; border: 1px solid black" 
                                                     src="{{ asset('storage/uploads/' . ($imageCategory === '' ? 'no_image.jpg' : $imageCategory)) }}" 
                                                     alt="">
                                            </label>
                                            <input type="file" id="file-upload" wire:model.change="imageCategory" style="display: none;" accept="image/*">
                                        </div>
                                        @error('avatar')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                       </div>
                                   </div>
                                </div>
                                @if ($imageCategory !=='')
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
                    <button type="button" style="border-radius: 4px" class="btn btn-secondary" wire:click="closeModal">Đóng</button>
                    @if ($dataEditCategory)
                    <button type="button" @if ($errors->any() ||  $valueNameCategory==='' || $valueOrderCategory === ''|| $valueIdParentCategory === '') disabled  @endif  style="border-radius: 4px; background:#CE2626 !important; color:white !important" wire:click="UpdateCategory" class="btn rounded-1  fs-6">Cập nhật</button>
                    @else    
                    <button type="button" @if ($errors->any() ||  $valueNameCategory==='' || $valueOrderCategory === ''|| $valueIdParentCategory === '') disabled  @endif  style="border-radius: 4px; background:#CE2626 !important; color:white !important" wire:click="createCategory" class="btn rounded-1  fs-6">Xác nhận thêm</button>
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
            background-color: #F4F4F4 !important; /* màu xám */
            border-color: #6c757d !important;
            color:black !important
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:initialized',()=>{
    @this.on('swal',(event)=>{
        const data=event;
        swal.fire({
            icon: 'warning',
            title: 'Bạn có muốn danh mục này không?',
            text: 'Nếu bạn xóa, hành động này không thể hoàn tác!',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'black',
            confirmButtonText: 'Xác nhận xóa'
        }).then((result)=>{
            if (result.isConfirmed) {
                @this.dispatch('hanldeDeletedCategory')
            }
        })
    })
})
    </script>

</div>
