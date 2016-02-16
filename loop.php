<?php /* the obligatory 404 page */ ?>
<?php if ( ! have_posts() ) : ?>
	<article id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'noel' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'noel' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
<?php endif; ?>

<?php /* here we start our loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>" <?php post_class('blog-loop'); ?>>

	<div class="entry-excerpt"><?php echo get_excerpt(120); ?></div>

	<div class="entry-info"><?php the_time("j M 'y"); ?><br/><small><?php the_time("h:i a"); ?></small></div>
	
	<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } else { echo '<img class="attachment-post-thumbnail wp-post-image" src="'.get_bloginfo("template_url").'/materials/no-image.jpg" />'; }?>
	
	<h2 class="entry-title"><?php the_title(); ?></h2>

</a><!-- #post -->

<?php endwhile; ?>

<?php /* Our usual pagination */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<nav id="page-nav" class="navigation">
		<div class="nav-newer"><?php previous_posts_link( __( '<span class="meta-nav">&laquo;</span> Newer', 'noel' ) ); ?></div>
		<div class="nav-home"><a href="<?php echo home_url( '/' ); ?>"></a></div>
		<div class="nav-older"><?php next_posts_link( __( 'Older <span class="meta-nav">&raquo;</span>', 'noel' ) ); ?></div>
	</nav><!-- #page-nav -->
<?php endif; ?>
