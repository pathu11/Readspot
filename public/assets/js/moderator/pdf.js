
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    
    // Get the approve and reject modals
     const approveModal = document.getElementById('approveModal');
    const rejectModal = document.getElementById('rejectModal');

    const approveButtons = document.querySelectorAll('.update-button');
    const rejectButtons = document.querySelectorAll('.delete-button');

    const closeApproveBtn = approveModal.querySelector('.close');
    const closeRejectBtn = rejectModal.querySelector('.close');

    approveButtons.forEach(button => {
        button.onclick = function() {
            approveModal.style.display = "block";
            const contentId = button.getAttribute('data-content-id');
            document.getElementById('approveButton').onclick = function() {
                approveContent(contentId);
                approveModal.style.display = "none";
            }
        }
    });

    // When the user clicks on the button, open the reject modal
    rejectButtons.forEach(button => {
        button.onclick = function() {
            rejectModal.style.display = "block";
            const contentId = button.getAttribute('data-content-id');
            document.getElementById('rejectButton').onclick = function() {
                rejectContent(contentId);
                rejectModal.style.display = "none";
            }
        }
    });

    // When the user clicks on <span> (x), close the approve modal
    closeApproveBtn.onclick = function() {
        approveModal.style.display = "none";
    }

    // When the user clicks on <span> (x), close the reject modal
    closeRejectBtn.onclick = function() {
        rejectModal.style.display = "none";
    }
    closeViewBtn.onclick = function() {
        viewModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == approveModal) {
            approveModal.style.display = "none";
        }
        if (event.target == rejectModal) {
            rejectModal.style.display = "none";
        }
        if (event.target == viewModal) {
            viewModal.style.display = "none";
        }
    }
    
    
    // rendering pdf

function renderPDF(data) {
    pdfjsLib.getDocument({ data: data }).promise.then(function(pdf) {
        let currentPageNumber = 1;

        renderPage(currentPageNumber, pdf);

        document.getElementById('prev-page').addEventListener('click', function() {
            if (currentPageNumber > 1) {
                currentPageNumber--;
                renderPage(currentPageNumber, pdf);
            }
        });

        document.getElementById('next-page').addEventListener('click', function() {
            if (currentPageNumber < pdf.numPages) {
                currentPageNumber++;
                renderPage(currentPageNumber, pdf);
            }
        });
    });
}

function renderPage(pageNumber, pdf) {
    pdf.getPage(pageNumber).then(function(page) {
        var scale = 1.5;
        var viewport = page.getViewport({ scale: scale });
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        var renderContext = {
            canvasContext: context,
            viewport: viewport
        };
        var renderTask = page.render(renderContext);
        renderTask.promise.then(function() {
            document.getElementById('pdf-viewer').innerHTML = '';
            document.getElementById('pdf-viewer').appendChild(canvas);
        });
    });
}

function viewContent(pdfUrl) {
    console.log('Fetching PDF document from:', pdfUrl);
    
    fetch(pdfUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob();
        })
        .then(blob => {
            console.log('PDF document fetched successfully:', blob);
            renderPDF(blob);
            document.getElementById('viewModal').style.display = "block"; // Show the modal
        })
        .catch(error => {
            console.error('Error fetching PDF document:', error);
            alert('An error occurred while fetching the PDF document. Please try again later.');
        });
}

