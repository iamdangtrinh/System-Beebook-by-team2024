<div>
    <div class="pt-3" >
        <div class="container">
   <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12" style="">
        <div class="bg-white w-100" style="box-shadow: 0 0 40px rgba(0, 0, 0, 0.1); border-radius: 8px">
                <h1 style="font-weight: bold; color: #C92127; padding: 18px 20px 12px 20px; border-bottom: 1px solid #F6F6F6 ">TÀI KHOẢN</h1>
                <div style="padding: 8px 10px" class="d-flex flex-column gap-1">
                    <a href="/profile" class="hover-item">Thông tin tài khoản 1</a>
                    <a href="" class="hover-item" >Sổ địa chỉ</a>
                    <a href="" class="hover-item" >Đơn hàng của tôi</a>
                    <a href="" class="hover-item" >Ví vocher</a>
                    <a href="" class="hover-item" >Sách theo bộ</a>
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
               <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 position-relative">
                    <div class="form-group">
                        <label for="CustomerName">Tỉnh/Thành phố</label>
                       <select name="" id="" wire:model.change="province">     
                        @if (Auth::user()->city_id === null)
                            <option >Vui lòng chọn thành phố</option>     
                            @foreach ($dataProvince as $item)
                            <option value={{$item['ProvinceID']}}>{{$item['ProvinceName']}}</option>
                            @endforeach
                        @else
                        <option value={{Auth::user()->city_id}}  >{{$userProvince['ProvinceName']}}</option>     
                            @foreach ($dataProvince as $item)
                            <option value={{$item['ProvinceID']}}>{{$item['ProvinceName']}}</option>
                            @endforeach                           
                        @endif                       
                       </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 position-relative">
                    <div class="form-group">
                        <label for="CustomerName">Quận huyện</label>
                        <select name="" id="" wire:model.change = 'district' >
                            @if (Auth::user()->province_id !== null)
                            <option value={{Auth::user()->province_id}}>{{$userDistrict['DistrictName']}}</option>
                            @forEach ($dataDistrict as $item)
                            <option value={{$item['DistrictID']}}>{{$item['DistrictName']}}</option>
                            @endforeach 
                            @else
                            @if ($dataDistrict === [])
                                <option > Vui lòng chọn quận huyện</option>
                                @else
                                @forEach ($dataDistrict as $item)
                            <option value={{$item['DistrictID']}}>{{$item['DistrictName']}}</option>
                            @endforeach 
                            @endif                          
                            @endif  
                        </select>
                    </div>
                </div>
               </div>
               <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 position-relative">
                    <div class="form-group">
                        <label for="CustomerName">Phường/Xã</label>
                        <select name="" id="" wire:model="ward">
                            @if (Auth::user()->ward_id !== null) 
                                @if ($dataWard === [])
                                    <option >Vui lòng chọn phường xã</option>
                                @else 
                                <option value={{Auth::user()->ward_id}}>{{ $userWard['WardName'] }}</option>
                                @foreach ($dataWard as $item)
                                <option value="{{ $item['WardCode'] }}">{{ $item['WardName'] }}</option>
                            @endforeach
                                @endif
                                @else
                                @if ($dataWard === [])
                                <option >Vui lòng chọn phường xã</option>
                            @else 
                            @foreach ($dataWard as $item)
                            <option value="{{ $item['WardCode'] }}">{{ $item['WardName'] }}</option>
                        @endforeach
                            @endif
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-6 position-relative">
                    <div class="form-group">
                        <label for="CustomerName">Địa chỉ</label>
                        <input wire:model.live="address" class="rounded-1" id="CustomerEmail" autocorrect="off" autocapitalize="off" >
                    </div>
                    @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                </div>
                <div class="d-flex align-items-center gap-3 pt-2" > 
                    <button 
                     @if ($errors->any() || $dataToUpdate === [] ) 
                      disabled 
                      @endif 
                       type="submit" class="btn" >Cập nhật</button>
                <a  href=""  class="btn "  >Xóa Tài Khoản</a>
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
</script>
</div>
