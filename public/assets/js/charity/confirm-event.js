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

    posterImageInput.addEventListener("change", function (event) {
        if (posterImageInput.files.length==0) {
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
                var previewImage = document.getElementById("previewImage");
                previewImage.src = e.target.result;
                previewImage.style.display = "block";
                hasImage = true;
                document.getElementById("viewpos").style.display = "block";
            };

            reader.readAsDataURL(posterImageInput.files[0]);
        }
    });
});

function openModal() {
    var modal = document.getElementById("imageModal");
    var modalImage = document.getElementById("modalImage");
    var previewImage = document.getElementById("previewImage");

    modal.style.display = "block";
    modalImage.src = previewImage.src;
}

function closeModal() {
    var modal = document.getElementById("imageModal");
    modal.style.display = "none";
}