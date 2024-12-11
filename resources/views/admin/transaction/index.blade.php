<title>@yield('title', 'Đơn hàng')</title>
@extends('layout.admin')

@section('body')
    <div class="row wrapper wrapper-content p-0">
        <form action="" method="get" class="p-0">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label class="control-label" for="order_id">Hóa đơn</label>
                            <input type="text" id="order_id" name="order_id" value="{{ old('order_id') }}"
                                placeholder="Mã hóa đơn" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 mb-3">
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="ibox">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class=" table table-bordered toggle-arrow-tiny">
                        <thead>
                            <tr>
                                <th>Mã giao dịch</th>
                                <th>Ngân hàng nhận</th>
                                <th>Ngày giao dịch</th>
                                <th>Nội dung giao dịch</th>
                                <th>Mô tả giao dịch</th>
                                <th>Số tiền giao dịch</th>
                                <th>Mã tham chiếu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) > 0)
                                @foreach ($data as $result)
                                    <tr>
                                        <td>{{ $result->id }}</td>
                                        <td>{{ $result->gateway }}</td>
                                        <td>{{ date('h:i d-m-Y', strtotime($result->transactionDate)) }}</td>
                                        <td>{{ $result->content }}</td>
                                        <td>{{ $result->description }}</td>
                                        <td>{{ number_format($result->transferAmount), 0, '.', '.' }} VNĐ</td>
                                        <td>{{ $result->referenceCode }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center p-5" colspan="20">
                                        <img src="{{ asset('/') }}client/images/ico_emptycart.svg"
                                            alt="Không có lịch sử giao dịch">
                                        <h3 class="mt-3">Hiện tại không có lịch sử giao dịch</h3>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
