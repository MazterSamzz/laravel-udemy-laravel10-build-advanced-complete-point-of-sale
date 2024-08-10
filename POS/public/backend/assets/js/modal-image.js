// Get the modal
var modal = document.getElementById("myModal");
// Get all images with the class 'modal-img'
var imgs = document.querySelectorAll(".modal-img");
// Get the modal image element
var modalImg = document.getElementById("modalImg");

// Loop through each image
imgs.forEach(function (img) {
    img.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.getAttribute("data-large"); // Set modal image src from data-large attribute
    };
});

// Get the <span> element that closes the modal
var span = document.querySelector(".close");

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
};

// Optional: Close the modal when clicking outside of it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
