<div>
    <style>
        .select2-container .select2-selection--single {
            height: 40px !important;
        }

        .select2-container--default .select2-selection--single {
            border: var(--bs-border-width) solid var(--bs-border-color) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px !important;
        }
    </style>
    <!-- JS -->
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
        </div>
        <div class="col-lg-2">
            <a wire:click="closeModal" class="btn btn-outline btn-primary btn-rounded">Thêm Mã giảm giá</a>
        </div>
    </div>

    <div class="row wrapper wrapper-content" style="padding: 10px 0 0 !important">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <div class="form-group">
                        <label class="control-label" for="id">Mã giảm giá</label>
                        <input type="text" id="" wire:model.live="idCoupon" value=""
                            placeholder="Mã giảm giá" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                    <div class="form-group">
                        <label class="control-label" for="title">Tên mã giảm giá </label>
                        <input type="text" id="title" wire:model.live="codeCoupon" value=""
                            placeholder="Tên mã giảm giá" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                    <div class="form-group" style="display: flex; flex-direction: column;">
                        <label class="control-label" for="customer">Trạng thái</label>
                        <select style="padding: 8px 0px" wire:model.change="statusCoupon" name="" id="">
                            <option disabled value="">Vui lòng chọn trạng thái</option>
                            <option value="active">Hoạt động</option>
                            <option value="inactive">Tạm khóa</option>
                        </select>
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
                                <th>ID Mã giảm giá</th>
                                <th>Mã giảm giá</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày hết hạn</th>
                                <th>Số tiền tối thiểu để áp dụng mã giảm giá </th>
                                <th>Số tiền tối đa áp dụng mã giảm giá</th>
                                <th>Số tiền giảm giá</th>
                                <th>Loại mã giảm giá</th>
                                <th>Số lượng mã giảm giá</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $sale)
                                <tr>

                                    <td>{{ $sale->id }}</td>
                                    <td>{{ $sale->code_coupon }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sale['start_date'])->format('H:i-d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sale['expires_at'])->format('H:i-d-m-Y') }}</td>
                                    <td>{{ number_format($sale['coupon_min_spend'], 0, ',', '.') }}Đ</td>
                                    <td>{{ number_format($sale['coupon_max_spend'], 0, ',', '.') }}Đ</td>
                                    <td>
                                        @if ($sale->type_coupon == 'percent')
                                            {{ $sale->discount }}%
                                        @elseif ($sale->type_coupon == 'amount')
                                            {{ number_format($sale->discount, 0, ',', '.') }}Đ
                                        @else
                                            {{ $sale->discount }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($sale->type_coupon == 'percent')
                                            Phần trăm
                                        @elseif ($sale->type_coupon == 'amount')
                                            Số tiền
                                        @else
                                            {{ $sale->type_coupon }}
                                        @endif
                                    </td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>

                                        @if ($sale->status === 'active')
                                            <div style="display: flex; justify-content: center">
                                                <div style="width: 10px; height: 10px; background: #00FF00; border-radius: 50%; border: none"
                                                    class="dot"></div>
                                            </div>
                                        @else
                                            <div style="display: flex; justify-content: center">
                                                <div style="width: 10px; height: 10px; background: red; border-radius: 50%; border: none"
                                                    class="dot"></div>
                                            </div>
                                        @endif

                                    </td>
                                    <td class="text-right">
                                        <div class="d-flex gap-2">
                                            <a wire:click="editCoupon({{ $sale->id }})"
                                                class="btn btn-sm btn-warning">Sửa</a>
                                            <a wire:loading.attr="disabled"
                                                wire:click="deleted_Coupon({{ $sale->id }})"
                                                class="btn btn-sm btn-danger">Xóa
                                                @if ($sale->id === $couponId)
                                                    <span wire:loading wire:target="deletedCoupon">
                                                        <i class="removeLoading fa fa-spinner fa-spin"
                                                            style="font-size:18px"></i>
                                                    </span>
                                                @endif
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (count($coupons) !== 0)
                        @if ($paginationData['total'] > $paginationData['perPage'])
                            <nav class="d-flex justify-content-end" role="Page navigation example"
                                aria-label="Pagination Navigation">
                                <ul class="pagination">
                                    <!-- Previous Page Link -->
                                    <li class="page-item {{ $paginationData['currentPage'] == 1 ? 'disabled' : '' }}">
                                        <button class="page-link" wire:click="previousPage"
                                            wire:loading.attr="disabled">
                                            <span aria-hidden="true" class="text-black">&laquo;</span>
                                        </button>
                                    </li>

                                    <!-- Page Numbers -->
                                    @for ($i = 1; $i <= $paginationData['lastPage']; $i++)
                                        <li
                                            class="page-item {{ $paginationData['currentPage'] == $i ? 'active bg-secondary' : '' }}">
                                            <button
                                                class="page-link {{ $paginationData['currentPage'] == $i ? 'text-white' : 'text-black' }}"
                                                wire:click="gotoPage({{ $i }})"
                                                wire:loading.attr="disabled">
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
                    @endif
                </div>
                @if (count($coupons) === 0)
                    <div class="d-flex flex-column">
                        <img style="height: 200px; object-fit: contain" src='/client/images/manager-user/no-data.webp'
                            alt="">
                        <p class="text-center" style="font-size:1rem ">Không tồn tại mã giảm giá này</p>
                    </div>
                @endif
            </div>
        </div>
        @if ($isModal)
            <div class="modal fade show d-block" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-modal="true" role="dialog" style="display: block;">
                <div style="max-width: 70%;" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            @if ($dataEdit)
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật </h1>
                            @else
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm mã giảm giá</h1>
                            @endif
                            <button wire:loading.attr="disabled" type="button" class="btn-close"
                                wire:click="closeModal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-8" style="display: flex; flex-direction: column; gap:10px">
                                    <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerName">Tên mã khuyến mãi</label>
                                        <input class="form-control rounded-3" style=""
                                            wire:model.live="Value_code_coupon" placeholder="Tên mã khuyến mãi"
                                            id="CustomerName" autocorrect="off" autocapitalize="off">
                                        @error('Value_code_coupon')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerName">Chi tiết khuyến mãi</label>
                                        <input class="form-control rounded-3" wire:model.live="description"
                                            placeholder="Chi tiết khuyến mãi" id="CustomerName" autocorrect="off"
                                            autocapitalize="off">
                                        @error('description')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerName">Ngày bắt đầu</label>
                                        <input class="form-control rounded-3" type="datetime-local"
                                            wire:model.live="start_date" placeholder="Ngày bắt đầu" id="CustomerName"
                                            autocorrect="off" autocapitalize="off">
                                        @error('start_date')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerName">Ngày kết thúc</label>
                                        <input class="form-control rounded-3" type="datetime-local"
                                            wire:model.live="expires_at" placeholder="Ngày kết thúc"
                                            id="CustomerName" autocorrect="off" autocapitalize="off">
                                        @error('expires_at')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerName">Số tiền tối thiểu</label>
                                        <input class="form-control rounded-3" wire:model.live="coupon_min_spend"
                                            placeholder="Số tiền tối thiểu" id="CustomerName" autocorrect="off"
                                            autocapitalize="off">
                                        @error('coupon_min_spend')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerName">Số tiền tối đa</label>
                                        <input class="form-control rounded-3" wire:model.live="coupon_max_spend"
                                            placeholder="Số tiền tối đa" id="CustomerName" autocorrect="off"
                                            autocapitalize="off">
                                        @error('coupon_max_spend')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerName">Giảm giá</label>
                                        <input class="form-control rounded-3" wire:model.live="discount"
                                            placeholder="Giảm giá" id="CustomerName" autocorrect="off"
                                            autocapitalize="off">
                                        @error('discount')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-flex gap-4 align-items-center">
                                        <label for="CustomerName">Loại khuyến mãi</label>
                                        <label class="fs-6">
                                            <input type="radio" wire:model.change="typeCoupon"
                                                name={{ $typeCoupon }} value="amount">
                                            Số tiền
                                        </label>
                                        <label class="fs-6">
                                            <input type="radio" wire:model.change="typeCoupon"
                                                name={{ $typeCoupon }} value="percent">
                                            Phần trăm
                                        </label>
                                    </div>
                                    <div class="form-group " style="display: flex; flex-direction: column; gap:5px">
                                        <label for="CustomerName">Số lượng</label>
                                        <input class="form-control rounded-3" wire:model.live="quantity"
                                            placeholder="Số lượng" id="CustomerName" autocorrect="off"
                                            autocapitalize="off">
                                        @error('quantity')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-flex gap-4 align-items-center">
                                        <label for="CustomerName">Trạng thái</label>
                                        <label class="fs-6">
                                            <input type="radio" wire:model.change="valueStatus"
                                                name={{ $valueStatus }} value="active">
                                            Hiện
                                        </label>
                                        <label class="fs-6">
                                            <input type="radio" wire:model.change="valueStatus"
                                                name={{ $valueStatus }} value="inactive">
                                            Ẩn
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <fieldset>
                                        <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                            <label>Chọn email gởi khuyến mãi </label>
                                            <select @if ($dataEdit) disabled @endif
                                                class="form-control setupSelect2" wire:model.change="newValue">
                                                <option value="" disabled>Vui lòng chọn email</option>
                                                @foreach ($listEmail as $item)
                                                    <option value={{ $item['email'] }}>{{ $item['email'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </fieldset>
                                    @if (!$dataEdit)
                                        <div class="form-group col-md-12 col-lg-12 col-xl-12 pt-2">
                                            <span style="font-size: 1rem; color: black">Danh sách email</span>
                                            <ul>
                                                @foreach ($arr as $item)
                                                    <div
                                                        style="display: flex; align-items: center; justify-content: space-between">
                                                        <li style="font-size: 0.875rem; color: black">
                                                            {{ $item }}</li>
                                                        <i @disabled(true) style="cursor: pointer;"
                                                            wire:click="removeEmail('{{ $item }}')"
                                                            class="icon icon anm anm-times-l">X</i>
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button wire:loading.attr="disabled" type="button" style="border-radius: 4px"
                                class="btn btn-secondary" wire:click="closeModal">Đóng</button>
                            @if ($dataEdit)
                                <button wire:loading.attr="disabled" type="button"
                                    style="border-radius: 4px; background:#198754 !important; color:white !important"
                                    wire:click="updateCoupon" class="btn rounded-1  fs-6">Cập nhật <span wire:loading
                                        wire:target="updateCoupon">
                                        <i class="removeLoading fa fa-spinner fa-spin" style="font-size:18px"></i>
                                    </span></button>
                            @else
                                <button wire:loading.attr="disabled" type="button"
                                    @if (
                                        $errors->any() ||
                                            $Value_code_coupon === '' ||
                                            $description === '' ||
                                            $start_date === '' ||
                                            $expires_at === '' ||
                                            $coupon_min_spend === '' ||
                                            $coupon_max_spend === '' ||
                                            $discount === '' ||
                                            $quantity === '') disabled @endif
                                    style="border-radius: 4px; background:#198754 !important; color:white !important"
                                    wire:click="createCoupon" class="btn rounded-1  fs-6">Xác nhận thêm <span
                                        wire:loading wire:target="createCoupon">
                                        <i class="removeLoading fa fa-spinner fa-spin" style="font-size:18px"></i>
                                    </span> </button>
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
    <script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
    <script>
        $(document).ready(function() {
            document.addEventListener('livewire:initialized', () => {
                @this.on('swal', (event) => {
                    const data = event;
                    swal.fire({
                        icon: 'warning',
                        title: 'Bạn có muốn xóa khuyến mãi này không?',
                        text: 'Nếu bạn xóa, hành động này không thể hoàn tác!',
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: 'red',
                        cancelButtonColor: 'black',
                        confirmButtonText: 'Xác nhận xóa',
                        cancelButtonText: 'Hủy' // Thay đổi văn bản của nút Cancel
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.dispatch('hanldeDeletedCoupon')
                        }
                    })

                })
                Livewire.on("toast", (event) => {
                    toastr.clear();
                    toastr[event.notify](event.message);
                });
            })
            document.addEventListener('livewire:load', function() {
                // Khởi tạo Select2
                let multiSelect = $('#multi-select').select2();

                // Lắng nghe sự kiện thay đổi
                multiSelect.on('change', function() {
                    @this.set('arr', $(this).val()); // Cập nhật giá trị vào Livewire
                });
            });
        });
    </script>
    <link rel="stylesheet" href="{{ asset('/') }}backend/css/plugins/select2/select2.min.css">
    <script src="{{ asset('/') }}backend/js/plugins/select2/select2.full.min.js"></script>


</div>
<script src="{{ asset('/') }}backend/plugins/ckeditor/ckeditor.js"></script>
