"use strict";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$("#tables").dataTable({
    responsive: true,
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
    ],
});

let modal_body =
    '<form method="GET" action="/change-name"><input type="text" class="form-control" name="name" required></form>';

$("#name").fireModal({
    body: modal_body,
    center: true,
    title: "Ganti Nama",
});
