$(document).ready(function () {
    // Ketika checkbox light mode diubah
    $("#light-mode-check").change(function () {
        if ($(this).is(":checked")) {
            // Hapus CSS dark mode jika light mode diaktifkan
            $(
                'link[href="/backend/assets/libs/select2/css/select2.dark.css"]'
            ).remove();
        }
    });

    // Ketika checkbox dark mode diubah
    $("#dark-mode-check").change(function () {
        if ($(this).is(":checked")) {
            // Tambahkan CSS dark mode jika dark mode diaktifkan
            if (
                !$(
                    'link[href="/backend/assets/libs/select2/css/select2.dark.css"]'
                ).length
            ) {
                $("<link/>", {
                    rel: "stylesheet",
                    type: "text/css",
                    href: "/backend/assets/libs/select2/css/select2.dark.css",
                }).appendTo("head");
            }
            // Nonaktifkan light mode
            $("#light-mode-check").prop("checked", false);
        }
    });

    // Set initial theme
    if ($("#dark-mode-check").is(":checked")) {
        $("<link/>", {
            rel: "stylesheet",
            type: "text/css",
            href: "/backend/assets/libs/select2/css/select2.dark.css",
        }).appendTo("head");
    }
});

function isSelect2(id) {
    $(id).select2();
}
