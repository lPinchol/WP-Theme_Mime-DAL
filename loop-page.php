<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1 class="entry-title"><?php the_title(); ?></h1>
    <div class="entry-content">
    	<?php the_content(); ?>
        <?php edit_post_link( __( 'Edit', 'noel' ), '<span class="edit-link">', '</span>' ); ?>
    </div><!-- .entry-content -->
</article><!-- #post -->

<?php endwhile; ?>