<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package markite
 */
if( is_single() ): ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('postbox__item-details format-search fix mb-70'); ?>>
        <?php 
        if(has_post_thumbnail()): ?>
            <div class="postbox__thumb postbox__thumb-2 fix mb-30">
                <?php the_post_thumbnail('full', array('class' => 'img-responsive' )); ?>
            </div>
        <?php 
        endif; ?>

        <div class="postbox__details mb-30">
           <?php the_content(); ?> 
            
            <div class="markit-blog-page-number">
                <?php
                    wp_link_pages( array(
                        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'markite' ),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ) );
                ?>
            </div>
            <?php print markite_get_tag(); ?>
        </div>
    </article>
<?php
else: ?>



    <article id="post-<?php the_ID(); ?>" <?php post_class('postbox__item format-search fix mb-50'); ?>>
        <?php 
        if( has_post_thumbnail() ): ?>
            <div class="postbox__thumb">
                <a href="<?php the_permalink(); ?>">
                   <?php the_post_thumbnail('full', array('class' => 'img-responsive' )); ?>
                </a>
            </div>
        <?php 
        endif; ?>
        <div class="postbox__content">
            <?php if ( 'post' == get_post_type() ) : ?>
            <div class="postbox__meta mb-10">
                <span><i class="far fa-calendar-check"></i> <?php the_time( get_option('date_format') ); ?> </span>
                <span><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><i class="far fa-user"></i> <?php print get_the_author(); ?></a></span>
                <span><a href="<?php comments_link(); ?>"><i class="far fa-comments"></i> <?php comments_number(); ?></a></span>
            </div>
            <?php endif; ?>
            <h3 class="blog-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="postbox__text post-text mb-20">
                <?php the_excerpt(); ?>
            </div>
            <!-- blog btn -->

            <?php 
                $markite_blog_btn = get_theme_mod('markite_blog_btn','Read More'); 
                $markite_blog_btn_switch     = get_theme_mod('markite_blog_btn_switch', true);  
            ?>


            <?php if(!empty($markite_blog_btn_switch)) : ?>
            <div class="read-more-btn mt-25">
                <a href="<?php the_permalink(); ?>" class="m-btn m-btn-blog mbl-btn"><?php print esc_html($markite_blog_btn); ?></a>
            </div>
            <?php endif; ?>

        </div>
    </article>

<?php
endif; ?>
