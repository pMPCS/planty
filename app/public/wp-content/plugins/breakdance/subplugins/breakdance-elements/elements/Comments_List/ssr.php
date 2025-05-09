<?php

global $wp_query;

wp_enqueue_script( 'comment-reply' );

echo '<ol class="comments-list">';

$args = [
  'orderby'       => 'comment_date_gmt',
  'order'         => 'ASC',
  'post_id'       => get_the_ID(),
  'status'        => 'approve',
  'no_found_rows' => false,
];

/*
  * Comment author information fetched from the comment cookies.
  */
$commenter = wp_get_current_commenter();

/*
  * The name of the current comment author escaped for use in attributes.
  * Escaped by sanitize_comment_cookies().
  */
$comment_author = $commenter['comment_author'];

/*
  * The email address of the current comment author escaped for use in attributes.
  * Escaped by sanitize_comment_cookies().
  */
$comment_author_email = $commenter['comment_author_email'];

/*
  * The URL of the current comment author escaped for use in attributes.
  */
$comment_author_url = esc_url( $commenter['comment_author_url'] );

if ( is_user_logged_in() ) {
  $args['include_unapproved'] = array( get_current_user_id() );
} else {
  $unapproved_email = wp_get_unapproved_comment_author_email();

  if ( $unapproved_email ) {
    $args['include_unapproved'] = array( $unapproved_email );
  }
}

$comments = get_comments($args);

/**
 * Filters the comments array.
 *
 * @since 2.1.0
 *
 * @param array $comments Array of comments supplied to the comments template.
 * @param int   $post_id  Post ID.
 */
$wp_query->comments = apply_filters( 'comments_array', $comments, get_the_ID() );

wp_list_comments(
    array(
        'reverse_top_level' => false, //Show the latest comments at the top of the list,
        'callback' =>
        // inline function to allow multiple Comments List elements to be on the same page
        function ($comment, $args, $depth) {

            $avatarInset = $args['design']['comment']['avatar']['inset'] ?? false;

            ?>
              <li <?php comment_class("comments-list__item")?> id="comment-<?php comment_ID();?>">
                <article itemscope itemtype="https://schema.org/Comment" id="div-comment-<?php comment_ID();?>" class="comments-list__body">
                    <?php if (!$avatarInset): ?>
                      <div class="comments-list__avatar">
                        <svg class="comments-list__arrow" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                          <path d="m216.5 184.5-48 48a12.099 12.099 0 0 1-17 0 12.008 12.008 0 0 1-3.529-8.5 11.997 11.997 0 0 1 3.529-8.5L179 188H64a11.998 11.998 0 0 1-12-12V32a12 12 0 0 1 24 0v132h103l-27.5-27.5a12.022 12.022 0 0 1 17-17l48 48a12.008 12.008 0 0 1 3.529 8.5 11.997 11.997 0 0 1-3.529 8.5Z" fill="currentColor"/>
                        </svg>
                          <?php echo get_avatar($comment, 80); ?>
                      </div>
                    <?php endif;?>
                  <div class="comments-list__comment">
                    <header class="comments-list__header">
                        <?php if ($avatarInset): ?>
                          <div class="comments-list__avatar comments-list__avatar--header">
                            <svg class="comments-list__arrow" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                              <path d="m216.5 184.5-48 48a12.099 12.099 0 0 1-17 0 12.008 12.008 0 0 1-3.529-8.5 11.997 11.997 0 0 1 3.529-8.5L179 188H64a11.998 11.998 0 0 1-12-12V32a12 12 0 0 1 24 0v132h103l-27.5-27.5a12.022 12.022 0 0 1 17-17l48 48a12.008 12.008 0 0 1 3.529 8.5 11.997 11.997 0 0 1-3.529 8.5Z" fill="currentColor"/>
                            </svg>
                              <?php echo get_avatar($comment, 80); ?>
                          </div>
                        <?php endif;?>
                      <div class="comments-list__author">
                          <?php

            $comment_author = get_comment_author($comment);
            $author_name = str_replace(
                'class="',
                'class="screen-reader-text ',
                sprintf(
                    __('<span itemprop="name">%s</span> <span class="says">says:</span>'),
                    esc_html($comment_author)
                ),
            );

            printf(
                '<h4 itemprop="author" itemscope itemtype="https://schema.org/Person" class="comments-list__author-name toc-ignore">%s</h4>',
                $author_name
            );
            ?>
                        <div class="comments-list__metadata">
                            <?php $comment_timestamp = get_comment_date('', $comment);?>
                          <time itemprop="dateCreated" datetime="<?php comment_time('c');?>" title="<?php echo esc_attr($comment_timestamp); ?>">
                              <?php echo sprintf(__('%s ago'), human_time_diff(get_comment_date('U', $comment), current_time('timestamp'))); ?>
                          </time>
                        </div>

                      </div>


                    </header>

                    <div class="comments-list__entry" itemprop="text">
                      <div class="comments-list__text">
                          <?php comment_text();?>
                          <?php if ('0' === $comment->comment_approved): ?>
                            <p class="comments-list__awaiting-moderation u-text-gray"><?php _e('Your comment is awaiting moderation.');?></p>
                          <?php endif;?>
                      </div>
                    </div>

                    <ul class="comments-list__metadata comments-list__metadata-list">

                        <?php

            $edit_link = get_edit_comment_link();
            $comment_reply_link = get_comment_reply_link(
                array_merge(
                    $args,
                    array(
                        'respond_id' => 'respond',
                        'add_below' => 'comment',
                        'depth' => $depth,
                        'max_depth' => $args['max_depth'],
                    )
                )
            );

            if ($comment_reply_link) {
                echo '<li>';
                echo $comment_reply_link;
                echo '</li>';
            }
            if ($edit_link) {
                echo '<li>';
                echo '<a class="comment-edit-link" href="' . esc_url(get_edit_comment_link()) . '">' . __('Edit') . '</a>';
                echo '</li>';
            }

            ?>
                    </ul>
                  </div>
                </article>
              </li>
                <?php
}
        ,
        'design' => $propertiesData['design'] ?? [],
        'content' => $propertiesData['content'] ?? [],
        'avatar_size' => 48,
    ), $comments);

echo '</ol>';

$comment_pagination = paginate_comments_links(
    array(
        'echo' => false,
        'end_size' => 0,
        'mid_size' => 0,
    )
);

if ($comment_pagination) {
    $pagination_classes = '';

    if (false === strpos($comment_pagination, 'prev page-numbers')) {
        $pagination_classes = ' only-next';
    }
    ?>

  <nav class="pagination<?php echo $pagination_classes ?>" aria-label="<?php esc_attr_e('Comments');?>">
      <?php echo $comment_pagination; ?>
  </nav>
    <?php
}
