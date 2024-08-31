function formValidation(form) {
    $("#" + form).validate({
        rules: {
            name: {
                required: true,
            },
            category_id: {
                required: true,
            },
            supplier_id: {
                required: true,
            },
            garage: {
                required: true,
            },
            store: {
                required: true,
            },
            buying_date: {
                required: true,
            },
            expire_date: {
                required: true,
            },
            buying_price: {
                required: true,
            },
            selling_price: {
                required: true,
            },
            image: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please Enter Product Name",
            },
            category_id: {
                required: "Please Select Category",
            },
            supplier_id: {
                required: "Please Select Supplier",
            },
            garage: {
                required: "Please Enter Garage",
            },
            store: {
                required: "Please Enter Product Store",
            },
            buying_date: {
                required: "Please Select Buying Date",
            },
            expire_date: {
                required: "Please Select Expire Date",
            },
            buying_price: {
                required: "Please Enter ",
            },
            selling_price: {
                required: "Please Enter ",
            },
            image: {
                required: "Please Enter ",
            },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
    });
}
