
$(function () {
    
    $("#allcbx").click(function () {
        if ($(this).is(":checked")) {
            $(".table_list tbody").find("input[type='checkbox']").prop("checked",true);
        } else {
            $(".table_list tbody").find("input[type='checkbox']").prop("checked", false);
        }
    });

});