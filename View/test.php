<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments and Replies</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .comment {
            margin-bottom: 20px;
        }

        .reply {
            margin-bottom: 15px;
        }

        .comment-replies {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="comments">
            <h5 class="comment-title py-4">2 Comments</h5>
            <div class="comment d-flex mb-4" data-comment-id="1">
                <div class="flex-shrink-0">
                    <div class="avatar avatar-sm rounded-circle">
                        <img class="avatar-img" src="View/assets/img/person-5.jpg" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="flex-grow-1 ms-2 ms-sm-3">
                    <div class="comment-meta d-flex align-items-baseline">
                        <h6 class="me-2">User 1</h6>
                        <span class="text-muted">2023-07-20</span>
                    </div>
                    <div class="comment-body">
                        This is the first comment.
                    </div>
                    <button class="reply-button btn btn-link">Reply</button>

                    <div class="comment-replies bg-light p-3 mt-3 rounded">
                        <h6 class="comment-replies-title mb-4 text-muted text-uppercase">1 reply</h6>
                        <div class="reply d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="avatar avatar-sm rounded-circle">
                                    <img class="avatar-img" src="View/assets/img/person-4.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                <div class="reply-meta d-flex align-items-baseline">
                                    <h6 class="mb-0 me-2">User 2</h6>
                                    <span class="text-muted">2023-07-20</span>
                                </div>
                                <div class="reply-body">
                                    This is a reply to the first comment.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="comment d-flex mb-4" data-comment-id="2">
                <div class="flex-shrink-0">
                    <div class="avatar avatar-sm rounded-circle">
                        <img class="avatar-img" src="View/assets/img/person-5.jpg" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="flex-grow-1 ms-2 ms-sm-3">
                    <div class="comment-meta d-flex align-items-baseline">
                        <h6 class="me-2">User 3</h6>
                        <span class="text-muted">2023-07-20</span>
                    </div>
                    <div class="comment-body">
                        This is the second comment.
                    </div>
                    <button class="reply-button btn btn-link">Reply</button>

                    <div class="comment-replies bg-light p-3 mt-3 rounded">
                        <h6 class="comment-replies-title mb-4 text-muted text-uppercase">2 replies</h6>
                        <div class="reply d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="avatar avatar-sm rounded-circle">
                                    <img class="avatar-img" src="View/assets/img/person-4.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                <div class="reply-meta d-flex align-items-baseline">
                                    <h6 class="mb-0 me-2">User 4</h6>
                                    <span class="text-muted">2023-07-20</span>
                                </div>
                                <div class="reply-body">
                                    This is a reply to the second comment.
                                </div>
                            </div>
                        </div>
                        <div class="reply d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="avatar avatar-sm rounded-circle">
                                    <img class="avatar-img" src="View/assets/img/person-4.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                <div class="reply-meta d-flex align-items-baseline">
                                    <h6 class="mb-0 me-2">User 5</h6>
                                    <span class="text-muted">2023-07-20</span>
                                </div>
                                <div class="reply-body">
                                    Another reply to the second comment.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form bình luận -->
        <h5 class="comment-title">Leave a Comment</h5>
        <form id="comment-form" action="" method="post">
            <input type="hidden" name="post_id" value="1">
            <input type="hidden" name="parent_id" id="parent-id" value="">
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="comment-message">Message</label>
                    <textarea class="form-control" id="comment-message" name="comment_message" placeholder="Enter your message" cols="30" rows="10" required></textarea>
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Post comment">
                </div>
            </div>
        </form>
    </div>

    <script>
        // Xử lý nhấp vào nút "Reply" để hiển thị form trả lời
        document.querySelectorAll('.reply-button').forEach(function(replyButton) {
            replyButton.addEventListener('click', function() {
                var parentId = this.closest('.comment').dataset.commentId;
                document.getElementById('parent-id').value = parentId;
                window.scrollTo({
                    top: document.querySelector('#comment-form').offsetTop,
                    behavior: 'smooth'
                });
                document.getElementById('comment-message').focus();
            });
        });
    </script>
</body>

</html>