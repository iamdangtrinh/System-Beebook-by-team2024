<title>@yield('title', 'Giỏ hàng')</title>
@extends('layout.admin')


@section('body')
    <link href="{{ asset('/') }}backend/js/lib/datatable/datatables.min.css" rel="stylesheet">
    <script src="{{ asset('/') }}backend/js/lib/datatable/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}backend/js/lib/datatable/vfs_fonts.js"></script>
    <script src="{{ asset('/') }}backend/js/lib/datatable/datatable.min.js"></script>

    </script>

    <style>
        /* Thêm border cho bảng DataTable */
        #tableOrder {
            border-collapse: collapse;
            width: 100%;
            /* Đảm bảo bảng chiếm toàn bộ chiều rộng */
        }

        #tableOrder th,
        #tableOrder td {
            border: 1px solid #ddd;
            /* Border cho ô */
            padding: 8px;
            /* Padding cho ô */
        }

        #tableOrder th {
            background-color: #f2f2f2;
            /* Màu nền cho tiêu đề */
            text-align: left;
            /* Căn trái tiêu đề */
        }

        .pagination .page-item .page-link.first,
        .pagination .page-item .page-link.last {
            display: none;
        }
    </style>

    <table id="tableOrder" class="cell-border compact stripe">
        <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"></th>
                <th>Mã đơn hàng</th>
                <th>Họ và tên</th>
                <th>Số điện thoại</th>
                <th>Tổng đơn hàng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input class="checkBoxItem" type="checkbox"></td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
            <tr>
                <td><input class="checkBoxItem" type="checkbox"></td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
            <tr>
                <td><input class="checkBoxItem" type="checkbox"></td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
        </tbody>
    </table>
    <script>
        jQuery(document).ready(function() {
            

            // checkbox
        });
    </script>
    <script src="{{ asset('/') }}backend/js/order/index.js"></script>

@endsection
