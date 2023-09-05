<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package markite
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12 ;
$is_author_product = !empty($_GET['author']) ? $_GET['author'] : '';
?>

<div class="blog-area pt-120 pb-90">
    <div class="container">
    	<?php if($is_author_product == 'product'): ?>
		<div class="row">
			<div class="col-lg-<?php print esc_attr($blog_column); ?> blog-post-items">
				<header class="page-header d-none">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
				$productCatIds = array();
				$authorID = get_the_author_meta('ID');
				$args = array(
				    'post_type' => 'product',
				    'post_status' => 'publish',
				    'posts_per_page' => -1,
				    'author'    => $authorID
				);

				$loop = new WP_Query( $args );

				?>        
			
			    <?php if ( $loop->have_posts() ) { ?>
			        <ul class="author_pubproducts">
			        <?php while ( $loop->have_posts() ) : $loop->the_post();
			        	//global $product;
			        	$terms = get_the_terms ( get_the_ID(), 'product_cat' );
			 
						foreach ( $terms as $term ) {
							$productCatIds[$term->term_id] = $term;
						}
			            wc_get_template_part( 'content', 'product' );
			        endwhile; ?>
			        </ul>
			        <?php
			        } else {
			            echo __( 'No products found', 'textdomain' );
			        }
			        wp_reset_postdata();
			    ?>

			</div>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
		        <div class="col-lg-4">
		        	<div class="blog__sidebar-wrapper  ml-30">
		        		<div class="sidebar__widget-title">
		        			<h3><?php print esc_html__('Categories','markite'); ?></h3>
		        		</div>
		        		<div class="blog__sidebar sidebar__widget mb-30">
		        			<ul class="author_pubproducts">
		        			<?php
		        			if( !empty($productCatIds) )
		        			{
		        				foreach($productCatIds as $term)
			        			{ 
			        				?>
			        				<li><a href="<?php echo get_home_url(); ?>/product-category/<?php print $term->slug; ?>"><?php print $term->name; ?></a></li>
			        			 
		        			<?php }
		        			}
		        			?>
		        			</ul>
		        		</div>
	            	</div>
	            </div>
			<?php endif; ?>
    	<?php else: ?>
        <div class="row">
			<div class="col-lg-<?php print esc_attr($blog_column); ?> blog-post-items">

				<?php if ( have_posts() ) : ?>

					<header class="page-header d-none">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;?>
					<div class="basic-pagination mb-40">
	               		<?php markite_pagination('<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>', '', array('class' => '')); ?>
	                </div>
					<?php

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>
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
        <?php endif; ?>
    </div>
</div>
<?php
get_footer();
