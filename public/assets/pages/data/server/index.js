"use strict";

// refresh all checks
$("#btnRefresh").click(function () {
    $("#data").addClass("card-progress");

    $.get(window.ServerMonitorRefreshAllUrl, function () {
        window.location.reload();
    });
});

// refresh single check
$(".refresh").click(function () {
    $("#data").addClass("card-progress");

    $.get(
        window.ServerMonitorRefreshUrl,
        { check: $(this).data("checker") },
        function (result) {
            $("#data").removeClass("card-progress");

            if (result.status) {
                swal("Passed", "Check Passed Successfully!", "success");
            } else {
                swal("Failed", result.error, "error");
            }
        }
    );
});
