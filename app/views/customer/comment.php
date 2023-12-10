<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Section</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<div>
    <h2>Comment Section</h2>
    <div id="comments"></div>
    <hr>
    <h3>Add a Comment</h3>
    <form id="commentForm" method="POST"  >
       
                               
        <label for="comment">Your Comment:</label>
        <textarea id="comment" name="comment" required></textarea><br>
        <span class="error"><?php echo $data['comment_err']; ?></span>
                               
       
        <input type="hidden" id="parentComment" name="parentComment" value="0">
        <button type="submit">Add Comment</button>
    </form>
</div>
<script>var urlroot="<?php echo URLROOT; ?>"
console.log(urlroot)</script>
<script>
    $(document).ready(function () {
        loadComments();

        $('#commentForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: urlroot+'/Customer/comment',
                data: $(this).serialize(),
                success: function () {
                    loadComments();
                    $('#commentForm')[0].reset();
                }
                
            });
        });
       

        $('#comments').on('click', '.replyBtn', function () {
            var commentId = $(this).data('comment-id');
            $('#parentComment').val(commentId);
            $('#name').focus();
        });

        function loadComments() {
            $.ajax({
                type: 'GET',
                url: urlroot+'/customer/getComments',
                success: function (data) {
                  console.log(data); // Check the data received

                  // Assuming 'data' is already an object
                  var comments = data;

                  displayComments(comments);
              }


            });
        }
    //     public function getComments() {
    //     header('Content-Type: application/json'); // Set the content type header
    //     $comments = $this->customerModel->getComments();
    //     echo json_encode($comments);
    // }
        function displayComments(comments) {
            $('#comments').empty();
            for (var i = 0; i < comments.length; i++) {
                var commentId = comments[i].id;
                var name = comments[i].name;
                var comment = comments[i].comment;
                var timestamp = comments[i].timestamp;

                var commentHtml = "<div>";
                commentHtml += "<p>" + name + " : " + comment + "</p>";
                commentHtml += "<small>Posted on: " + timestamp + "</small>";
                commentHtml += "<button class='replyBtn' data-comment-id='" + commentId + "'>Reply</button>";
                commentHtml += "</div>";

                $('#comments').append(commentHtml);
            }
        }
    });
</script>

</body>
</html>
