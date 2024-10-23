$(document).ready(function () {
    // Ketika checkbox light mode diubah
    $("#light-mode-check").change(function () {
        if ($(this).is(":checked")) {
            // Hapus CSS dark mode jika light mode diaktifkan
            $('link[href="' + select2DarkCss + '"]').remove();
        }
    });

    // Ketika checkbox dark mode diubah
    $("#dark-mode-check").change(function () {
        if ($(this).is(":checked")) {
            // Tambahkan CSS dark mode jika dark mode diaktifkan
            if (!$('link[href="' + select2DarkCss + '"]').length) {
                $("<link/>", {
                    rel: "stylesheet",
                    type: "text/css",
                    href: select2DarkCss,
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
            href: select2DarkCss,
        }).appendTo("head");
    }
});
