<?php
$author_data =  get_the_author_meta('description',get_query_var('author') );
$facebook_url = get_the_author_meta( 'markite_facebook');
$twitter_url = get_the_author_meta( 'markite_twitter');
$linkedin_url = get_the_author_meta( 'markite_linkedin');
$instagram_url = get_the_author_meta( 'markite_instagram');
$markite_url = get_the_author_meta( 'markite_youtube');
$markite_write_by = get_the_author_meta( 'markite_write_by');
$author_bio_avatar_size = 180;
if($author_data !=''):
?>


    <div class="postbox__author-3 d-sm-flex grey-bg-2 mb-85">
       <div class="postbox__author-thumb-3 mr-20">
            <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>">
                <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size,'','',array('class'=>'media-object img-circle') ); ?>
            </a>
       </div>
       <div class="postbox__author-content">
            <h4><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php print get_the_author(); ?></a></h4>
            <p><?php the_author_meta( 'description' ); ?></p>
            <div class="author-icon mb-0">
                <?php if (!empty($facebook_url)) : ?>
                <a href="<?php print esc_url($facebook_url); ?>" target="_blank" ><i class="fab fa-facebook-f"></i></a>
                <?php endif; ?>
                <?php if (!empty($twitter_url)) : ?>
                <a href="<?php print esc_url($twitter_url); ?>" target="_blank" ><i class="fab fa-twitter"></i></a>
                <?php endif; ?>
                <?php if (!empty($linkedin_url)) : ?>
                <a href="<?php print esc_url($linkedin_url); ?>" target="_blank" ><i class="fab fa-linkedin"></i></a>
                <?php endif; ?>
                <?php if (!empty($instagram_url)) : ?>
                <a href="<?php print esc_url($instagram_url); ?>" target="_blank" ><i class="fab fa-instagram"></i></a>
                <?php endif; ?>
                <?php if (!empty($markite_url)) : ?>
                <a href="<?php print esc_url($markite_url); ?>" target="_blank" ><i class="fab fa-youtube"></i></a>
                <?php endif; ?>
            </div>
       </div>
    </div>

<?php endif; ?>
