<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package markite
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12 ;

?>

<section class="blog-area blog-single-area pb-100">
    <div class="container">
        <div class="row">
        	<?php 
        		while ( have_posts() ) : the_post(); 
				$categories = get_the_category();
				$separator = ', ';
				$output = '';
				if ( ! empty( $categories ) ) {
				    foreach( $categories as $category ) {
				        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( '%s', 'markite' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
				    }
				}
 
			?>
        	<div class="col-12">
		         <div class="markit-blog-details-breadcrumb">
		           <!-- bg shape area start -->
		           <div class="bg-shape">
		              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/shape-1.png" alt="<?php  print esc_attr__( 'banner', 'markite' ); ?>">
		           </div>
		           <!-- bg shape area end -->

		           <!-- page title area -->
		           <section class="page__title-area  pt-85">
						<div class="page__title-content mb-50">
                          <div class="postbox__meta d-flex">
                             <div class="postbox__tag-2">
                                <?php print trim( $output, $separator ); ?>
                             </div>
                             <div class="postbox__time">
                                <span><?php print esc_html__('4 min read','markite'); ?></span>
                             </div>
                          </div>
                          <h2 class="page__title"><?php the_title(); ?></h2>
                          <div class="postbox__author-2 mt-20">
                             <ul class="d-flex align-items-center p-0">
                                <li>
                                   <div class="postbox__author-thumb-2">
                                      <?php echo get_avatar( get_the_author_meta( 'ID' ) , 50 ); ?>
                                   </div>
                                </li>
                                <li>
                                   <h6><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php print get_the_author(); ?></a></h6>
                                   <span><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php print esc_html__('View Profile','markite'); ?></a></span>
                                </li>
                                <li>
                                   <h6><?php the_time( get_option('date_format') ); ?></h6>
                                   <span><?php print esc_html__('Published','markite'); ?></span>
                                </li>
                                <li class="d-none d-sm-block">
                                   <h6><?php print esc_html__('Join the Conversation','markite'); ?></h6>
                                   <span><a href="<?php comments_link(); ?>"> <?php comments_number(); ?></a></span>
                                </li>
                             </ul>
                          </div>
	                    </div>
		           </section>
		           <!-- page title end -->
		         </div>
        	</div>

			<div class="col-lg-<?php print esc_attr($blog_column); ?> blog-post-items blog-padding">
				<div class="postbox__wrapper postbox__wrapper-details">
					<?php
						get_template_part( 'template-parts/content', get_post_format() );

						?>
					
						<?php 
						if( get_previous_post_link() AND get_next_post_link() ) : ?>

						<div class="blog-details-border d-none">
							<div class="row align-items-center">
								<?php 
								if(get_previous_post_link()) : ?>
		                            <div class="col-lg-6 col-md-6">
		                                <div class="theme-navigation b-next-post text-left mb-30">
		                                    <span><?php print esc_html__( 'Prev Post', 'markite' ); ?></span>
                                            <h4><?php print get_previous_post_link('%link ', '%title'); ?></h4>
		                                </div>
		                            </div>
								<?php 
								endif; ?>

								<?php 
								if(get_next_post_link()) : ?>
		                            <div class="col-lg-6 col-md-6">
		                                <div class="theme-navigation b-next-post text-left text-md-right  mb-30">
		                                    <span><?php print esc_html__( 'Next Post', 'markite' ); ?></span>
		                                    <h4><?php print get_next_post_link( '%link ', '%title' ); ?></h4>
		                                </div>
		                            </div>
								<?php 
								endif; ?>
								
							</div>
						</div>

						<?php 
						endif; ?>

						<?php

						get_template_part( 'template-parts/biography');

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>
				</div>
			</div>
			<?php endwhile; ?>

			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
	        <div class="col-lg-4">
		        	<div class="blog__sidebar-wrapper  ml-30">
		        		<div class="blog__sidebar mb-30">
		        			<?php get_sidebar(); ?>	
		        		</div>
	            	</div>
            </div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
