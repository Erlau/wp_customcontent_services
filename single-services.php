<?php
 /* Template Name: Services Template */
get_header(); ?>
<div id="primary">
    <div id="content" role="main">
    <?php
    $mypost = array( 'post_type' => 'services', 'orderby' => 'menu_order', 'order'   => 'ASC' );
    $loop = new WP_Query( $mypost );
    ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        	<?php if (has_post_thumbnail( $post->ID ) ): ?>
			<?php $imageser = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
				$imageser = $imageser[0]; ?>
			<?php endif; ?>
            <!-- Display service contents -->
            <div class="entry-content service-content" style="background-image:url('<?php echo $imageser; ?>');">
				<div class="service-content-inner">
                	<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</div>
			</div>
        </article>
 
    <?php endwhile; ?>
    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>