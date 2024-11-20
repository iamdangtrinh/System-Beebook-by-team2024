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

    DT.dateConfig = () => {
        
    }

    DT.configSelect2 = () => {
        $(".setupSelect2").each(function (indexInArray, valueOfElement) { 
            $(this).select2()
        });
    }

    $(document).ready(function () {
        DT.checkAllInput();
        DT.configSelect2();
    });
})(jQuery);
