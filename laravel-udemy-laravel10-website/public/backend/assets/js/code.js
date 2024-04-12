// // Delete for <a href="xxx" id="delete"> </a>
// $(function () {
//     $(document).on("click", "#delete", function (e) {
//         e.preventDefault();
//         var link = $(this).attr("href");

//         Swal.fire({
//             title: "Are you sure?",
//             text: "Delete This Data?",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             confirmButtonText: "Yes, delete it!",
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 window.location.href = link;
//                 Swal.fire("Deleted!", "Your file has been deleted.", "success");
//             }
//         });
//     });
// });

// Delete for Submit button
$(function () {
    $(document).on("click", "[id='delete']", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest("form").submit(); // Submit form containing the clicked button
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
            }
        });
    });
});
