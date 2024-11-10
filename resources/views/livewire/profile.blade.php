<div>
    <div class="pt-3" >
        <div class="container">
   <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12" style="">
        <div class="bg-white w-100" style="box-shadow: 0 0 40px rgba(0, 0, 0, 0.1); border-radius: 8px">
                <h1 style="font-weight: bold; color: #C92127; padding: 18px 20px 12px 20px; border-bottom: 1px solid #F6F6F6 ">TÀI KHOẢN</h1>
                <div style="padding: 8px 10px" class="d-flex flex-column gap-1">
                    <a href="/profile" class="hover-item">Thông tin tài khoản</a>
                    <a href="{{route('your-order.index')}}" class="hover-item" >Đơn hàng của tôi</a>
                    <a href="{{route('wishlist.index')}}" class="hover-item" >Sản phẩm yêu thích</a>
                  </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="bg-white w-100" style="box-shadow: 0 0 40px rgba(0, 0, 0, 0.1); padding: 20px 15px; border-radius: 8px">
                <h2 class="fw-bold">Thông tin tài khoản</h2>
                <form wire:submit='handleEditProfile' class="d-flex flex-column gap-2 "> 
                   <div class="w-100 d-flex justify-content-center flex">
                    <div class="image-upload">
                        <label for="file-upload" style="cursor: pointer;">
                            <img 
                                 style="width: 100px; height: 100px; border-radius: 50%; border: 1px solid black" 
                                 src={{ Auth::user()->avatar !== null ? asset('storage/'.Auth::User()->avatar) : "/client/images/manager-user/no_avt.png" }}
                                 alt="User Avatar">
                        </label>
                        <input type="file" wire:model.change="avatar" id="file-upload" wire:model.live="avatar" style="display: none;" accept="image/*">
                    </div>
                    @error('avatar')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                   </div>
                    <div class="col-12 position-relative">
                       <div class="form-group">
                           <label for="CustomerName">Họ tên</label>
                           <input wire:model.live="name" class="rounded-1"   id="CustomerEmail" autocorrect="off" autocapitalize="off" >
                       </div>
                       @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                   </div>
                   <div class="col-12 position-relative">
                    <div class="form-group">
                        <label for="CustomerName">Số điện thoại</label>
                        <input wire:model.live="phone" class="rounded-1"   id="CustomerEmail" autocorrect="off" autocapitalize="off" >
                    </div>
                    @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 position-relative">
                    <div class="form-group">
                        <label for="CustomerName">Email</label>
                        <input wire:model.live="email" class="rounded-1"  id="CustomerEmail" autocorrect="off" autocapitalize="off" >
                    </div>
                    @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                    <div class="position-relative">
                        <label for="input-address">Địa chỉ </label>
                        <input class="form-control" wire:model.live="address" 
                            id="input-address-autocomplete" type="text">
                        <ul class="list-group position-absolute w-100">
                            @if ($chooseAddress)
                            @foreach ($chooseAddress as  $value)
                            <li wire:click="addAddress('{{ $value['description'] }}')" class="list-group-item cursor-pointer">
                                {{ $value['description'] }}
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                {{-- <div class="col-12 position-relative">
                    <div class="form-group">
                        <label for="CustomerName">Địa chỉ</label>
                        <input wire:model.live="address" class="rounded-1"  id="CustomerEmail" autocorrect="off" autocapitalize="off" >
                    </div>
                    @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                </div> --}}
                <div class="d-flex align-items-center gap-3 pt-2" > 
                    <button 
                    @if ($errors->any() || 
                         ($name === $result->name && 
                          $phone === $result->phone && 
                          $email === $result->email && 
                          $address === $result->address

                          )) 
                        disabled 
                    @endif 
                    type="submit" class="btn">Cập nhật</button>
                <a wire:click="confirmDelete"  class="btn "  >Xóa Tài Khoản</a>
                </div>
                @if (session('success'))
                <span class="success text-success"> {{ session('success') }}</span>
            @endif
                @if (session('error'))
                <span class="error text-danger"> {{ session('error') }}</span>
            @endif
            </form>
        </div>
    </div>
   </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</div>
<style>
    .hover-item {
  color: black;
  transition: color 0.3s ease;
  font-weight: 500;
  border-bottom: 1px solid #F6F6F6;
  padding: 10px;
   
}
.hover-item:hover {
  color: #C92127;
  text-decoration: none;
}
.hover-item.active {
  color: #BF9A61;
}
</style>
<script>
    // Lấy tất cả các mục
// Lấy tất cả các mục
const items = document.querySelectorAll('.hover-item');

// Lấy đường dẫn hiện tại (path của trang)
const currentPath = window.location.pathname;

// Lặp qua các mục và so sánh đường dẫn
items.forEach(item => {
  // Lấy đường dẫn của mỗi thẻ <a>
  const itemHref = item.getAttribute('href');
  
  // So sánh đường dẫn của mục với đường dẫn hiện tại
  if (itemHref === currentPath) {
    // Nếu khớp, thêm class 'active'
    item.classList.add('active');
  }
});
document.addEventListener('livewire:initialized',()=>{
    @this.on('swal',(event)=>{
        const data=event;
        swal.fire({
            icon: 'warning',
            title: 'Bạn có muốn xóa?',
            text: 'Nếu bạn xóa, hành động này không thể hoàn tác!',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'black',
            confirmButtonText: 'Xác nhận xóa'
        }).then((result)=>{
            if (result.isConfirmed) {
                @this.dispatch('hanldeDeleted')
            }
        })
    })
})
</script>
</div>
