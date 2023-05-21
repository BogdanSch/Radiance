<?php if (post_password_required()) {
    return;
}
?>
<div class="blog-comments">
    <?php
    $comments_count = get_comments_number();
    _e('<h4 class="comments-count">' . $comments_count . ' Comments</h4>');
    if (have_comments()) {
        $i = 1;
        foreach ($comments as $comment) {
            ?>
            <div class="comment comment-<?php _e($i); ?>">
                <div class="d-flex">
                    <div class="comment-img">
                        <span class="comment-avatar clearfix">
                            <?php echo get_avatar($comment, 60, '', '', ['class' => 'd-flex mr-3 rounded-circle']); ?>
                        </span>
                    </div>
                    <div class="comment-content">
                        <h5>
                            <?php comment_author(); ?>
                        </h5>
                        <time>
                            <?php comment_date(); ?>
                        </time>
                        <p>
                            <?php comment_text(); ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        }
        the_comments_pagination();
    }
    ?>
    <div class="reply-form">
        <h5>Leave a Comment:</h5>
        <p>Your email address will not be published. Required fields are marked *</p>
        <div class="card-body">
            <?php comment_form(
                [
                    'comment_field' => '<div class="form-group">
                    <textarea name="comment" cols="58" rows="3" class="form-control" placeholder="Leave your reply here: "></textarea>
                    </div>',
                    'fields' => [
                        'author' =>
                        '<div class="col col-sm-4">
                    <label>' . __('Name', 'radiance') . '</label>
                    <input type="text" name="author" class="form-control" />
                    </div>',
                        'email' =>
                        '<div class="col col-sm-4">
                    <label>' . __('Email', 'radiance') . '</label>
                    <input type="text" name="email" class="form-control" />
                    </div>',
                        'url' =>
                        '<div class="col col-sm-4">
                    <label>' . __('Website', 'radiance') . '</label>
                    <input type="text" name="url" class="form-control" />
                    </div>',
                    ],
                    'class_submit' => 'btn btn-primary',
                    'label_submit' => __('Submit Comment', 'radiance'),
                    'title_reply' => __('', 'radiance'),
                    'comment_notes_before' => '',
                    'logged_in_as' => ''
                ]
            );
            ?>
        </div>
    </div>
</div>