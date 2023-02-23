class AjaxFormSubmitter {
    constructor({ form = "", beforeSubmit = null, success = null, error = null, removeSpinnerOnSuccess = true, resetFormOnSuccess = true, scrollToError = true, scrollElement = 'html, body', offset = 0 } = {}) {
        this.form = form;
        this.beforeSubmit = beforeSubmit;
        this.success = success;
        this.error = error;
        this.scrollToError = scrollToError;
        var self = this;
        const button = $(form + ' button[type="submit"]');
        if ($(button).find(".spinner").length === 0) {
            $(button).html('<span class="spinner me-2" role="status" aria-hidden="true"></span> ' + $(button).html());
        }
        $(form + " .form-group").each((index, element) => {
            const field = $(element).data("field");
            if (field) {
                if ($(element).find(".text-danger").length === 0) {
                    $(element).html($(element).html() + '<div><small class="text-danger error-' + field + '"></small></div>');
                }
            }
        });
        $(form + " input").on('change focus', function(e) {
            $(this).removeClass("is-invalid");
            $(this).closest(".form-group").removeClass("has-error");
            $(this).closest(".form-group").find(".text-danger").html("");
        });
        $(form + " select").on('change focus', function(e) {
            $(this).removeClass("is-invalid");
            $(this).closest(".form-group").removeClass("has-error");
            $(this).closest(".form-group").find(".text-danger").html("");
        });
        $(form + " textarea").on('change focus', function(e) {
            $(this).removeClass("is-invalid");
            $(this).closest(".form-group").removeClass("has-error");
            $(this).closest(".form-group").find(".text-danger").html("");
        });
        $(form).on("submit", function (e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            if (beforeSubmit) {
                formData = beforeSubmit(formData);
            }
            $(form + ' button[type="submit"]').prop("disabled", true);
            $(form + " .spinner").addClass("spinner-border spinner-border-sm");
            self.clear();
            $.ajax({
                url: $(this).attr("action"),
                data: formData,
                type: "POST",
                contentType: false,
                //contentType: "application/json; charset=utf-8",
                dataType: "JSON",
                processData: false,
                beforeSend: function(request) {
                    request.setRequestHeader("Referer-Full-Url", window.location.href.split('?')[0]);
                },
                success: function (response) {
                    if (removeSpinnerOnSuccess) {
                        $(form + ' button[type="submit"]').prop("disabled", false);
                        $(form + " .spinner").removeClass("spinner-border spinner-border-sm");
                    }
                    if (resetFormOnSuccess) {
                        $(form)[0].reset();
                    }
                    if (success) {
                        success(response);
                    }
                },
                error: function (xhr) {
                    $(form + ' button[type="submit"]').prop("disabled", false);
                    $(form + " .spinner").removeClass("spinner-border spinner-border-sm");

                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $(form + ' input[name="' + key + '"]').addClass("is-invalid");
                        $(form + ' select[name="' + key + '"]').addClass("is-invalid");
                        $(form + ' textarea[name="' + key + '"]').addClass("is-invalid");
                        $(form + " .error-" + key).html(value[0]);
                        $(form + ' .form-group[data-field="' + key + '"]').addClass("has-error");
                    });
                    if (scrollToError) {
                        const parentTop = $(scrollElement).offset().top;
                        const errorTop = $(form + " .form-group.has-error").offset().top;
                        const scroll = errorTop + offset - parentTop;
                        // console.log( $(form + " .form-group.has-error").data('field') );
                        // console.log(parentTop);
                        // console.log(errorTop);
                        // console.log(scroll);
                        $(scrollElement).animate({ scrollTop: scroll }, 500);
                    }
                    if (error) {
                        error(xhr);
                    }
                },
            });
        });
    }
    clear() {
        $(this.form + " .text-danger").html("");
        $(this.form + " .form-group").removeClass("has-error");
        $(this.form + " input").removeClass("is-invalid");
        $(this.form + " select").removeClass("is-invalid");
        $(this.form + " textarea").removeClass("is-invalid");
    }
}
