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
    <form id="commentForm" method="POST" >                          
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
            url: urlroot + '/Customer/comment',
            data: $(this).serialize(),
            success: function () {
                loadComments();
                $('#commentForm')[0].reset();
            }
        });
    });

    $('#comments').on('click', '.replyBtn', function () {
        // Remove any existing reply form
        $('.replyForm').remove();
        // Get the commentId from the clicked button
        // var commentId = $(this).data('commentId'); // Corrected this line
        var commentId = $(this).data('comment-id');

        // Create a new form for the reply
        var replyForm = "<form class='replyForm' method='POST'>";
        replyForm += "<label for='comment'>Your Reply:</label>";
        replyForm += "<textarea name='comment' required></textarea><br>";
        replyForm += "<input type='hidden' name='parentComment' value='" + commentId + "' >"; // Corrected this line
        replyForm += "<button type='submit'>Add Reply</button>";
        replyForm += "</form>";
        // Append the reply form after the comment
        $(this).parent().append(replyForm);
        // Focus on the textarea of the new form
        $(this).parent().find('textarea').focus();
    });

    function loadComments() {
        $.ajax({
            type: 'GET',
            url: urlroot + '/Customer/getComments',
            success: function (data) {
                console.log(data);
                var comments = data;
                displayComments(comments);
            }
        });
    }

    function displayComments(comments) {
        $('#comments').empty();
        for (var i = 0; i < comments.length; i++) {
            var commentId = comments[i].comment_id;
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
