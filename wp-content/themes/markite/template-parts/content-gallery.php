<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package markite
 */

$gallery_images = function_exists('get_field') ? get_field('gallery_images') : '';


if( is_single() ): ?>
    
    <article id="post-<?php the_ID(); ?>" <?php post_class('postbox__item-details format-gallery fix mb-70'); ?>>
        <?php if (!empty($gallery_images)) : ?>
            <div class="postbox__thumb post_gallery owl-carousel mb-30">
                <?php foreach( $gallery_images as $key => $image ) :  ?>
                   <img src="<?php echo esc_url($image['url']); ?>" alt="<?php print esc_attr__('gallery image','markite'); ?>">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

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

    <article id="post-<?php the_ID(); ?>" <?php post_class('postbox__item format-gallery fix mb-50'); ?>>
        <?php if (!empty($gallery_images)) : ?>
            <div class="postbox__thumb post_gallery owl-carousel">
                <?php foreach( $gallery_images as $key => $image ) :  ?>
                   <img src="<?php echo esc_url($image['url']); ?>" alt="<?php print esc_attr__('gallery image','markite'); ?>">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="postbox__content">
            <div class="postbox__meta mb-10">
                <span><i class="far fa-calendar-check"></i> <?php the_time( get_option('date_format') ); ?> </span>
                <span><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><i class="far fa-user"></i> <?php print get_the_author(); ?></a></span>
                <span><a href="<?php comments_link(); ?>"><i class="far fa-comments"></i> <?php comments_number(); ?></a></span>
            </div>
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


