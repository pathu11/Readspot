function toggleOther() {
    var otherCheckbox = document.querySelector('input[name="bookCategory[]"][value="other"]');
    var otherCategory = document.getElementById("otherCategory");

    if (otherCheckbox.checked) {
        otherCategory.style.display = "inline-block";
        otherCategory.setAttribute("required", "required");
    } else {
        otherCategory.style.display = "none";
        otherCategory.removeAttribute("required");
    }
}

document.addEventListener("DOMContentLoaded", function () {
    var posterImageInput = document.getElementById("posterImageInput");
    var hasImage = false;

    // Check if posterImageInput is correctly defined
    console.log("posterImageInput:", posterImageInput);

    if (posterImageInput) {
        posterImageInput.addEventListener("change", function (event) {
            // Check if the change event is triggered
            console.log("Change event triggered");

            if (posterImageInput.files.length == 0) {
                console.log("No files selected");

                var previewImage = document.getElementById("previewImage");
                previewImage.src = "";
                previewImage.style.display = "none";
                posterImageInput.value = "";
                hasImage = false;
                document.getElementById("viewpos").style.display = "none";

                return;
            }

            if (posterImageInput.files && posterImageInput.files[0]) {
                if (hasImage) {
                    var confirmChange = confirm("Do you want to change the image?");
                    if (!confirmChange) {
                        console.log("Image change canceled");

                        var previewImage = document.getElementById("previewImage");
                        previewImage.src = "";
                        previewImage.style.display = "none";
                        posterImageInput.value = "";
                        hasImage = false;
                        document.getElementById("viewpos").style.display = "none";

                        return;
                    }
                }

                var reader = new FileReader();

                reader.onload = function (e) {
                    // Check if reader is reading the file and triggering onload
                    console.log("FileReader onload triggered");

                    var previewImage = document.getElementById("previewImage");
                    previewImage.src = e.target.result;
                    previewImage.style.display = "block";
                    hasImage = true;
                    document.getElementById("viewpos").style.display = "block";
                };

                reader.onerror = function (error) {
                    // Log FileReader errors
                    console.error("FileReader error:", error);
                };

                reader.readAsDataURL(posterImageInput.files[0]);
            }
        });
    } else {
        console.error("posterImageInput not found");
    }
});

function openModal() {
    var modal = document.getElementById("imageModal");
    var modalImage = document.getElementById("modalImage");
    var previewImage = document.getElementById("previewImage");

    // Check if modal and modalImage are correctly defined
    console.log("modal:", modal);
    console.log("modalImage:", modalImage);

    if (modal && modalImage && previewImage) {
        modal.style.display = "block";
        modalImage.src = previewImage.src;
    } else {
        console.error("Modal or image elements not found");
    }
}

function closeModal() {
    var modal = document.getElementById("imageModal");

    // Check if modal is correctly defined
    console.log("modal:", modal);

    if (modal) {
        modal.style.display = "none";
    } else {
        console.error("Modal not found");
    }
}


document.addEventListener("DOMContentLoaded", function () {
    var startDateInput = document.getElementById("startDate");
    var placeholderText = document.querySelector(".placeholder-text");

    startDateInput.addEventListener("input", function () {
        if (startDateInput.value) {
            placeholderText.style.display = "none";
        } else {
            placeholderText.style.display = "block";
        }
    });
});
