"use strict";

$("#tables").dataTable({
    responsive: true,
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
    ],
});
