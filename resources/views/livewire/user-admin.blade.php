<div>
    <div class="row wrapper border-bottom white-bg page-heading" >
        <div class="col-lg-10">
        </div>
        <div class="col-lg-2">
            <a wire:click="closeModal" class="btn btn-outline btn-primary btn-rounded">Thêm tài khoản</a>
        </div>
    </div>
    
    <div class="row wrapper wrapper-content" style="padding: 20px 0 0 !important">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <div class="form-group">
                        <label class="control-label" for="order_id">Mã tài khoản</label>
                        <input type="text" id="order_id" wire:model.live="idUser" value="" placeholder="Mã tài khoản"
                            class="form-control">
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                    <div class="form-group">
                        <label class="control-label" for="status">Email</label>
                        <input type="text" id="status" wire:model.live="email" value="" placeholder="Email"
                            class="form-control">
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                    <div class="form-group">
                        <label class="control-label" for="customer">Số điện thoại</label>
                        <input type="text" id="customer" wire:model.live="phone" value="" placeholder="Số điện thoại"
                            class="form-control">
                    </div>
                </div>
                <div class="col-sm-4 mb-3"  >
                    <div class="form-group"  style="display: flex; flex-direction: column; ">
                        <label class="control-label" for="customer">Quyền</label>
                        <select style="padding: 8px 0px;border-radius: .375rem; border:1px solid #999" wire:model.change="role" name="" id="">
                            <option disabled value="">Vui lòng chọn quyền</option>
                            <option value="admin">Quản lý</option>
                            <option value="customer">Khách hàng</option>
                        </select>
                       
                    </div>
                    
                </div>
                <div class="col-sm-4 mb-3">
                    <div class="form-group" style="display: flex; flex-direction: column;">
                        <label class="control-label" for="customer">Trạng thái</label>
                        <select style="padding: 8px 0px; border-radius: .375rem; border:1px solid #999" wire:model.change="status" name="" id="">
                            <option disabled value="">Vui lòng chọn trạng thái</option>
                            <option value="active">Hoạt động</option>
                            <option value="inactive">Tạm khóa</option>
                        </select>
                    </div>
                </div>
            </div>
          
    
        </div>    
        <div class="ibox">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class=" table table-bordered toggle-arrow-tiny" data-page-size="15">
                        <thead>
                            <tr>
                                <th>Mã TK</th>
                                <th >Ảnh</th>
                                <th >Họ Tên</th>
                                <th >Email</th>
                                <th >Số điện thoại</th>
                                <th >Địa chỉ</th>
                                <th >Trạng thái</th>
                                <th >Quyền</th>
                                <th >Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getAllUser as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <img 
                                    style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid black" 
                                    src="{{asset('storage/uploads/'.$user->avatar)}}" 
                                    alt="User Avatar">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td style="width: 20%">{{ $user->address }}</td>
                                <td > 
                                    @if ($user->status === 'active')
                                   <div class="d-flex justify-content-center" >
                                    <div style="width: 10px; height: 10px; background: #00FF00; border-radius: 50%; border: none" class="dot"></div>
                                   </div>
                                    @else
                                   <div class="d-flex justify-content-center" >
                                    <div style="width: 10px; height: 10px; background: red; border-radius: 50%; border: none" class="dot"></div>
                                   </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->roles === 'admin') 
                                    Quản lý
                                    @else
                                    Khách hàng
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group gap-2 w-100 __custom_btn_group">
                                        <a wire:click="editUser({{$user->id}})" class="btn badge text-light text-bg-warning">Chỉnh sửa  <span wire:loading wire:target="editUser({{$user->id}})">
                                       </a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach                
                        </tbody>
                    </table>
                    @if (count($getAllUser) !== 0)
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
                    {{-- {{ $products->links('pagination::bootstrap-5') }} --}}
                </div>
                @if (count($getAllUser) === 0)
                <div class="d-flex flex-column" >
                    <img style="height: 200px; object-fit: contain" src='/client/images/manager-user/no-data.webp' alt="">
                    <p class="text-center" style="font-size:1rem " >Không tồn tại tài khoản</p>
                </div>
                @endif
            </div>
        </div>
        @if (session('errorCreate'))
        <div class="error text-danger">
            {{ session('errorCreate') }}
        </div>
    @endif
    @if (session('successCreate'))
    <div class="success text-success">
        {{ session('successCreate') }}
    </div>
    @endif
    @if (session('updateSuccess'))
    <div class="success text-success">
        {{ session('updateSuccess') }}
    </div>
    @endif
    @if (session('updateError'))
    <div class="error text-danger">
        {{ session('updateError') }}
    </div>
@endif
    </div>
    <!-- Modal -->
    @if ($isModal)
    <div class="modal fade show d-block" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($DataEditUser)
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật tài khoản</h1>
                    @else                        
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm tài khoản</h1>
                    @endif
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex flex-column gap-4">
                                {{-- Form Đăng ký --}}
                                <form class="d-flex flex-column gap-4">
                                   <div class="form-group" >
                                    <div class="w-100 d-flex justify-content-center flex-col">
                                        <div class="image-upload">
                                            <label for="file-upload" style="cursor: pointer;">
                                                <img 
                                                     style="width: 100px;height: 100px;object-fit: cover;border-radius: 50%; border: 1px solid black" 
                                                     src="{{ asset('storage/uploads/' . ($valueAvatar === '' ? 'no_image.jpg' : $valueAvatar)) }}" 
                                                     alt="">
                                            </label>
                                            <input type="file" wire:model.change="valueAvatar" id="file-upload" wire:model.live="avatar" style="display: none;" accept="image/*">
                                        </div>
                                      
                                        @error('avatar')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                       </div>
                                       @if ($valueAvatar !=='')
                                       <div style="display: flex; justify-content: center; padding-top: 10px" > 
                                        <button type="button" wire:click="removeImage">Xóa ảnh</button> 
                                       </div>
                                        @endif
                                   </div>
                                    {{-- Name --}}
                                    <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerName">Họ tên</label>
                                        <input class="form-control rounded-3"  wire:model.live="valueName" placeholder="Họ tên" id="CustomerName" autocorrect="off" autocapitalize="off"  >
                                        @error('valueName') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- Phone --}}
                                    <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerPhone">Số điện thoại</label>
                                        <input class="form-control rounded-3" wire:model.live="valuePhone" placeholder="Số điện thoại" id="CustomerPhone" autocorrect="off" autocapitalize="off" >
                                        @error('valuePhone') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- Email --}}
                                    <div class="form-group" style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerEmail">Email</label>
                                        <input class="form-control rounded-3" wire:model.live="valueEmail" placeholder="Email" id="CustomerEmail" autocorrect="off" autocapitalize="off" >
                                        @error('valueEmail') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                 
                                    <div class="form-group" style="display: flex; flex-direction: column; gap:5px">
                                        <div class="position-relative">
                                            <label for="input-address">Địa chỉ </label>
                                            <input class="form-control rounded-3" wire:model.live="address" 
                                                type="text" placeholder="Địa chỉ">
                                            <ul class="list-group position-absolute w-100">
                                                @if ($chooseAddress)
                                                @foreach ($chooseAddress as  $value)
                                                <li wire:click="addAddress('{{ $value['description'] }}')" class="list-group-item cursor-pointer bg-white" style="border-bottom: 1px solid black; cursor: pointer;">
                                                    {{ $value['description'] }}
                                                </li>
                                                @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                     {{-- Role --}}
                                    <div class="form-group" style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerEmail">Quyền</label>
                                        <select name="" id="" wire:model.live="valueStatus" style="border: 1px solid black; width: 100%; border-radius: 8px; padding: 6px 12px;" >
                                            <option  value="customer">Khách hàng</option>
                                            <option value="admin">Quản lý</option>
                                        </select>
                                    </div>
                                    @if ($DataEditUser)      
                                    <div class="form-group" style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerEmail">Trạng thái</label>
                                        <select name="" id="" wire:model.live="valueStatus1" style="border: 1px solid black; width: 100%; border-radius: 8px; padding: 6px 12px;" >
                                            <option value="active">Hoạt động</option>
                                            <option value="inactive">Tạm khóa</option>
                                        </select>
                                    </div>
                                    @endif
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
                <div class="modal-footer">
                    <button type="button" style="border-radius: 4px" class="btn btn-secondary" wire:click="closeModal">Đóng</button>
                    @if ($DataEditUser)
                    <button type="button" wire:loading.attr="disabled"   @if ($errors->any() ||  $valuePhone==='' || $valueName === ''||$valueEmail === '' || $disabled )  disabled @endif style="border-radius: 4px; background:#198754 !important; color:white !important" wire:click="updateUser" class="btn rounded-1  fs-6">Cập nhật  <span wire:loading wire:target="updateUser">
                        <i class="removeLoading fa fa-spinner fa-spin" style="font-size:18px"></i>
                    </span></button>
                    @else
                        <button type="button"   wire:loading.attr="disabled"   @if ($errors->any() ||  $valuePhone==='' || $valueName === ''||$valueEmail === '' || $disabled )  disabled @endif style="border-radius: 4px; background:#198754 !important; color:white !important" wire:click="createUser" class="btn rounded-1  fs-6">Xác nhận thêm 
                            <span wire:loading wire:target="createUser">
                                <i class="removeLoading fa fa-spinner fa-spin" style="font-size:18px"></i>
                            </span>
                        </button>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
    <style>
        .pagination .page-item.active .page-link {
            background-color: #F4F4F4 !important; /* màu xám */
            border-color: #6c757d !important;
            color:black !important
        }
    </style>
    <script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
    <script>
        document.addEventListener('livewire:initialized',()=>{
    Livewire.on("toast", (event) => {
        toastr.clear();
        toastr[event.notify](event.message); 
});
})
</script>
</div>
