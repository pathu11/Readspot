<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css" /> -->
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/moderator/contents.css" />
  <title>Contents</title>
</head>
<body>
  <?php require APPROOT . '/views/moderator/nav.php';?>
 

  <div class="container">
  <table id="eventTable">
  <thead>   
      <tr>
        <th>Content ID</th>
        <th>Content title</th>
        <th>Content Summary</th>
        <th>Content Image</th>
        <th>Content</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?PHP foreach($data['contentDetails'] as $content): ?>
      <tr>
        <td><?php echo $content->content_id; ?></td>
        <td><?php echo $content->topic; ?></td>
        <td><?php echo $content->text; ?></td>
        <td><img class="content-img" src="<?php echo URLROOT; ?>/assets/images/landing/addContents/<?php echo $content->img; ?>" style="width:20%;">
</td>
        <td>
            <?php if($content->doc){
                echo '<a href="<?php echo URLROOT; ?>/assets/images/landing/addContents/<?php echo $content->doc; ?>">content.pdf</a></td>';
            }
            ?>
          <td class="action-buttons">
          <button class="view-button" >
            <i class="fas fa-eye"></i>
            </button>


                        <button class="update-button" data-content-id="<?php echo $content->content_id; ?>" >
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="delete-button" data-content-id="<?php echo $content->content_id; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td> 
      </tr>
      </tbody>
      <?php endforeach; ?>
    </table>



    <!-- Your HTML content goes here -->
<div id="imageModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <img id="enlargedImg" src="" alt="Enlarged Image">
  </div>
</div>

<!-- Your HTML content goes here -->
<div id="detailsModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div id="detailsContent">
      Content details will be displayed here
    </div>
  </div>
</div>

    <!-- Add approve and reject modals at the end of your body -->

<div id="approveModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Are you sure you want to approve this content?</p><br><br>
    <button class="button" id="approveButton">Yes</button>
    <button class="button cancel-button" id="cancelApprove">Cancel</button>
  </div>
</div>

<div id="rejectModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <p>Are you sure you want to reject this content?</p><br>
        <!-- Input field for rejection reason -->
        <input type="text" placeholder="Give a reason for rejecting shortly" id="rejectReason" name="reason" class="input">
        <br><br>
        <button class="button" id="rejectButton">Yes</button>
        <button class="button cancel-button" id="cancelReject">Cancel</button>
      </div>
    </div>

    <ul class="pagination" id="pagination">
            <li id="prevButton">«</li>
            <li class="current">1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
            <li>6</li>
            <li>7</li>
            <li>8</li>
            <li>9</li>
            <li>10</li>
            <li id="nextButton">»</li>
        </ul>
  </div>

</body>
<script src="<?php echo URLROOT;?>/assets/js/publisher/table.js"></script>
</html>
<script>

 // Get the details modal and content element
    const detailsModal = document.getElementById('detailsModal');
  const detailsContent = document.getElementById('detailsContent');

  // Function to open the details modal and display content details
  function openDetailsModal() {
    detailsModal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the details modal
  detailsModal.querySelector('.close').onclick = function() {
    detailsModal.style.display = "none";
  };

  // When the user clicks anywhere outside of the details modal, close it
  window.onclick = function(event) {
    if (event.target == detailsModal) {
      detailsModal.style.display = "none";
    }
  };

  // Attach event listeners to the view icon buttons
  // Attach event listeners to the view icon buttons
const viewButtons = document.querySelectorAll('.view-button');
viewButtons.forEach(button => {
  button.onclick = function() {
    // Open the details modal
    openDetailsModal();
    // Get the content details from the corresponding content <div> tag
    const contentId = button.parentElement.parentElement.querySelector('td:first-child').textContent;
    const contentTitle = button.parentElement.parentElement.querySelector('td:nth-child(2)').textContent;
    const contentSummary = button.parentElement.parentElement.querySelector('td:nth-child(3)').textContent;
    const contentImageSrc = button.parentElement.parentElement.querySelector('.content-img').src;
    const contentDocSrc = button.parentElement.parentElement.querySelector('a') ? button.parentElement.parentElement.querySelector('a').href : null;
    
    // Construct the content details HTML
    const contentDetailsHTML = `
      <p><b>Content ID: ${contentId}</b></p>
      <p><b>Content Title: ${contentTitle}</b></p>
      <p><b>Content Summary:</p></b> 
      <p>${contentSummary}</p>
      <img src="${contentImageSrc}" alt="Content Image" style="width: 40%">
      ${contentDocSrc ? `<a href="${contentDocSrc}">Content PDF</a>` : ''}
    `;
    console.log(contentDetailsHTML);
    // Set the content details to the modal content
    detailsContent.innerHTML = contentDetailsHTML;
  };
});

    const imageModal = document.getElementById('imageModal');
    const enlargedImg = document.getElementById('enlargedImg');

    // Function to open the image modal and display the enlarged image
    function openImageModal(imgSrc) {
        enlargedImg.src = imgSrc;
        imageModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the image modal
    imageModal.querySelector('.close').onclick = function() {
        imageModal.style.display = "none";
    };

    // When the user clicks anywhere outside of the image modal, close it
    window.onclick = function(event) {
        if (event.target == imageModal) {
            imageModal.style.display = "none";
        }
    };

    // Attach event listeners to the image elements
    const images = document.querySelectorAll('.content-img');
    images.forEach(img => {
        img.onclick = function() {
            const imgSrc = img.src;
            openImageModal(imgSrc);
        };
    });


    // Get the approve and reject modals
    const approveModal = document.getElementById('approveModal');
    const rejectModal = document.getElementById('rejectModal');

    const approveButtons = document.querySelectorAll('.update-button');
    const rejectButtons = document.querySelectorAll('.delete-button');

    const closeApproveBtn = approveModal.querySelector('.close');
    const closeRejectBtn = rejectModal.querySelector('.close');

    const cancelApproveBtn = document.getElementById('cancelApprove');
    const cancelRejectBtn = document.getElementById('cancelReject');
     // Function to close the approve modal
     function closeApproveModal() {
        approveModal.style.display = "none";
    }
    function closeRejectModal() {
        rejectModal.style.display = "none";
    }
    cancelApproveBtn.addEventListener('click', closeApproveModal);
    cancelRejectBtn.addEventListener('click', closeRejectModal);

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

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == approveModal) {
            approveModal.style.display = "none";
        }
        if (event.target == rejectModal) {
            rejectModal.style.display = "none";
        }
    }

    function approveContent(content_id) {
        fetch('<?php echo URLROOT; ?>/moderator/approveContent', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ content_id: content_id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Content approved successfully!');
                window.location.href = window.location.href; // Redirect to current page
            } else {
                alert('Failed to approve content. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while approving the content. Please try again later.');
        });
    }

    function rejectContent(content_id) {
        const reason=document.getElementById('rejectReason').value;
        console.log(reason);
        fetch('<?php echo URLROOT; ?>/moderator/rejectContent', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ content_id: content_id , reason: reason })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Content rejected successfully!');
                // Optionally redirect to another page or refresh the current page
            } else {
                alert('Failed to reject content. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while rejecting the content. Please try again later.');
        });
    }

</script>

