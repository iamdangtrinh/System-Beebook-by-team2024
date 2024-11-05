(function ($) {
    let DT = {};

    DT.checkAllInput = () => {
        const checkAll = $("#checkAll");
        const inputChecks = $(".checkBoxItem");
        inputChecks.prop("checked", checkAll.is(":checked"));
    };

    $("#checkAll").change(DT.checkAllInput);

    $(".checkBoxItem").change(() => {
        const checkAll = $("#checkAll");
        const inputChecks = $(".checkBoxItem");

        const allChecked =
            inputChecks.length === inputChecks.filter(":checked").length;
        checkAll.prop("checked", allChecked);
    });

    DT.showDataOrder = () => {
        // let table = new DataTable("#tableOrder", {
        //     //     buttons: [{
        //     //         extend: 'pdf',
        //     //         text: 'Xuất hóa đơn (PDF)', // Đổi tên nút
        //     //         className: 'btn btn-primary',
        //     //         pageSize: 'A4',
        //     //         exportOptions: {
        //     //             modifier: {
        //     //                 page: 'all' // Xuất tất cả các trang
        //     //             }
        //     //         },
        //     //     }],
        //     //     layout: {
        //     //         topStart: 'buttons'
        //     //     },
        //     ordering: false,
        //     paging: true,
        //     lengthChange: false,
        //     language: {
        //         search: "Tìm kiếm:",
        //         info: "Hiển thị từ _START_ đến _END_ của _TOTAL_ mục",
        //         emptyTable: "Không tìm thấy đơn hàng",
        //         zeroRecords: "Không tìm thấy đơn hàng"
        //     },
        // });
    };

    DT.dateConfig = () => {
        
    }

    $(document).ready(function () {
        DT.checkAllInput();
        DT.showDataOrder();
    });
})(jQuery);
