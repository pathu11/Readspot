<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/moderator/bookReviews.css" />
  <title>Book Reviews</title>
</head>
<body>
  <?php require APPROOT . '/views/moderator/nav.php';?>
  <div class="subNav">
    <div class="reviewNav">
      <div class="reviewTypeActive">
        <a href="<?php echo URLROOT;?>/moderator/bookReviews">Book Reviews</a><span>></span>
      </div>
      <div class="reviewType">
        <a href="<?php echo URLROOT;?>/moderator/contentReviews">Content Reviews</a>
      </div>
    </div>
    <div class="search-bar">
      <input type="text" class="search" id="live-search" autocomplete="off" placeholder="Search by book name, review or customer name..." >
    </div>
  </div>
  <div id="searchresult"></div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $("#live-search").keyup(function(){
        var input = $(this).val();
        var searchType = 'bookReviews';
        //alert(input);
        if(input != ""){
            $.ajax({
              url:"<?php echo URLROOT;?>/moderator/livesearch",
              method:"POST",
              data:{input:input, searchType:searchType},

              success:function(data){
                  $(".table-container").hide();
                  $("#searchresult").html(data);
                  $("#searchresult").css("display","block");
              }
            });
        }else{
            $(".table-container").show();
            $("#searchresult").css("display","none");
        }
      });
    });
  </script>
  
  <div class="table-container">
    <table id="eventTable">
      <tr>
        <th>Profile Image</th>
        <th>Customer Name</th>
        <th>Book Name</th>
        <th>Book Review</th>
        <th>Delete Review</th>
      </tr>
      <?php foreach($data['reviewDetails'] as $review):?>
      <tr>
        <td><img src="<?php echo URLROOT;?>/assets/images/customer/ProfileImages/<?php echo $review->profile_img;?>" ></td>
        <td><?php echo $review->name;?></td>
        <td><?php echo $review->book_name;?></td>
        <td><?php echo $review->review;?></td>
        <td><button onclick="deletePopup('<?php echo $review->review_id;?>')">Delete</button></td>
      </tr>
      <?php endforeach;?>
    </table>
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
  <script src="<?php echo URLROOT;?>/assets/js/moderator/table.js"></script>

  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2>Delete Book Review</h2>
      <div id="deleteReview"></div>
    </div>
  </div>

  <script>
    function deletePopup(review_id){
      var deleteReviewContent = '<p>Are you sure you want to delete this customer book review?</p><a href="<?php echo URLROOT;?>/moderator/deleteBookReview/'+`${review_id}`+'"><button>Delete</button></a>';
      var deletePopup = document.getElementById('deleteReview');
      deletePopup.innerHTML = deleteReviewContent;
      document.getElementById("myModal").style.display = "block";
    }

    function closeModal(){
      document.getElementById("myModal").style.display = "none";
    }
  </script>
</body>
</html>