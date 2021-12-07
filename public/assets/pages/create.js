"use strict";

var cleave = new Cleave(".cleavePhone", {
    prefix: "+62",
    delimiter: " ",
    phone: true,
    phoneRegionCode: "id",
});
var cleave = new Cleave(".cleaveNIK", {
    numeral: true,
    delimiter: "",
});
var cleave = new Cleave(".cleavePostCode", {
    numeral: true,
    delimiter: "",
});
var cleave = new Cleave(".cleaveRT", {
    creditCard: true,
    delimiter: "",
});
var cleave = new Cleave(".cleaveRW", {
    creditCard: true,
    delimiter: "",
});

$("#province").on("change", function () {
    var idProvince = this.value;
    $("#city").html("");
    $.ajax({
        url: city,
        type: "POST",
        data: {
            province_id: idProvince,
        },
        dataType: "json",
        success: function (result) {
            $("#city").html('<option value="">PILIH KABUPATEN / KOTA</option>');
            $.each(result.city, function (key, value) {
                $("#city").append(
                    '<option value="' +
                        value.id +
                        '">' +
                        value.name +
                        "</option>"
                );
            });
        },
    });
});

$("#city").on("change", function () {
    var idCity = this.value;
    $("#district").html("");
    $.ajax({
        url: district,
        type: "POST",
        data: {
            city_id: idCity,
        },
        dataType: "json",
        success: function (res) {
            $("#district").html('<option value="">PILIH KECAMATAN</option>');
            $.each(res.district, function (key, value) {
                $("#district").append(
                    '<option value="' +
                        value.id +
                        '">' +
                        value.name +
                        "</option>"
                );
            });
        },
    });
});

$("#district").on("change", function () {
    var idDistrict = this.value;
    $("#village").html("");
    $.ajax({
        url: village,
        type: "POST",
        data: {
            district_id: idDistrict,
        },
        dataType: "json",
        success: function (res) {
            $("#village").html(
                '<option value="">PILIH KELURAHAN / DESA</option>'
            );
            $.each(res.village, function (key, value) {
                $("#village").append(
                    '<option value="' +
                        value.id +
                        '">' +
                        value.name +
                        "</option>"
                );
            });
        },
    });
});

$(document).ready(function () {
    Webcam.set({
        width: 390,
        height: 290,
        image_format: "jpeg",
        jpeg_quality: 100,
    });
    Webcam.attach("#camera_ktp");
    Webcam.attach("#camera_self");
});

function snapshotKTP() {
    swal("Berhasil Mengambil Foto KTP", {
        icon: "success",
    });
    $("#ktp_camera").addClass("d-none");
    $("#ktp_img").removeClass("d-none");
    Webcam.snap(function (data_uri) {
        $(".img_ktp-tag").val(data_uri);

        document.getElementById("img_ktp").innerHTML =
            '<img name="img_ktp" id="sortpicture" class="image" src="' +
            data_uri +
            '"/>';
    });
}

function changeWebcamKTP() {
    $("#ktp_asset").addClass("d-none");
    $("#ktp_camera").removeClass("d-none");
    $("#ktp_img").addClass("d-none");
}

function snapshotSelf() {
    swal("Berhasil Mengambil Foto Diri Sendiri", {
        icon: "success",
    });
    $("#self_camera").addClass("d-none");
    $("#self_img").removeClass("d-none");
    Webcam.snap(function (data_uri) {
        $(".img_self-tag").val(data_uri);
        document.getElementById("img_self").innerHTML =
            '<img name="img_self" id="sortpicture" class="image" src="' +
            data_uri +
            '"/>';
    });
}

function changeWebcamSelf() {
    $("#self_asset").addClass("d-none");
    $("#self_camera").removeClass("d-none");
    $("#self_img").addClass("d-none");
}

$("input[name='ktp_type']").on("click", function () {
    if ($("input[name=ktp_type]:checked").val() == 0) {
        $("#fileKTP").addClass("d-none");
        $("#cameraKTP").removeClass("d-none");
    } else {
        $("#cameraKTP").addClass("d-none");
        $("#fileKTP").removeClass("d-none");
    }
});

$("#photoKTP").on("change", function () {
    var fileName = this.files[0].name;
    $("#label_ktp").html(fileName);
});

$("input[name='self_type']").on("click", function () {
    if ($("input[name=self_type]:checked").val() == 0) {
        $("#fileSelf").addClass("d-none");
        $("#cameraSelf").removeClass("d-none");
    } else {
        $("#cameraSelf").addClass("d-none");
        $("#fileSelf").removeClass("d-none");
    }
});

$("#photoSelf").on("change", function () {
    var fileName = this.files[0].name;
    $("#label_self").html(fileName);
});
