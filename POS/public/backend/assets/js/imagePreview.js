function imagePreview(imageId, previewId) {
    $(document).ready(function () {
        $(imageId).change(function (e) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $(previewId).attr("src", e.target.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    });
}
