"use strict";

var table = $("#table").DataTable({
    pageLength: 10,
    processing: true,
    serverSide: true,
    responsive: true,
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Semua"],
    ],
    ajax: {
        url: index,
        type: "GET",
    },
    dom: '<"html5buttons">lBrtip',
    oLanguage: {
        sEmptyTable: "Belum ada data",
    },
    columns: [
        {
            width: "10%",
            data: "DT_RowIndex",
            orderable: false,
            searchable: false,
        },
        { data: "name" },
    ],
    buttons: [
        {
            extend: "print",
            text: "Print Semua",
            exportOptions: {
                modifier: {
                    selected: null,
                },
                columns: ":visible",
            },
            messageTop: "Dokumen dikeluarkan tanggal " + moment().format("L"),
            // footer: true,
            header: true,
        },
        {
            extend: "csv",
        },
        {
            extend: "print",
            text: "Print Yang Dipilih",
            exportOptions: {
                columns: ":visible",
            },
        },
        {
            extend: "excelHtml5",
            exportOptions: {
                columns: ":visible",
            },
        },
        {
            extend: "pdfHtml5",
            exportOptions: {
                columns: [0, 1, 2, 5],
            },
        },
        {
            extend: "colvis",
            postfixButtons: ["colvisRestore"],
            text: "Sembunyikan Kolom",
        },
    ],
});

$(".filter_name").on("keyup", function () {
    table.search($(this).val()).draw();
});

$("#modal").fireModal({
    title: "Tambah Tipe Aktivitas",
    size: "modal-lg",
    body: $("#modal-body"),
    footerClass: "bg-whitesmoke",
    autoFocus: true,
    onFormSubmit: function (modal, e, form) {
        let form_data = $(e.target).serialize();
        $("[name='name_type']").val("");
        let fake_ajax = setTimeout(function () {
            form.stopProgress();
            $.ajax({
                url: store,
                type: "POST",
                data: form_data,
                success: function () {
                    swal("Tipe Aktivitas Berhasil Disimpan", {
                        icon: "success",
                    }).then(() => {
                        table.draw();
                        $("#fire-modal-2").modal("hide");
                    });
                },
                statusCode: {
                    422: function (response) {
                        for (var index in response.responseJSON.data) {
                            iziToast.error({
                                title: "Error",
                                message: response.responseJSON.data[index],
                            });
                        }
                    },
                    419: function () {
                        swal("Login session has expired, please login again!", {
                            icon: "error",
                        }).then(function () {
                            window.location.reload();
                        });
                    },
                },
            });
            clearInterval(fake_ajax);
        }, 1500);

        e.preventDefault();
    },
    buttons: [
        {
            text: "Tambah Data",
            submit: true,
            class: "btn btn-primary btn-shadow",
            handler: function (modal) {},
        },
    ],
});
