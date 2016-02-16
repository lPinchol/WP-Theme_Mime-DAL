<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1 class="entry-title"><?php the_title(); ?></h1>
    <div class="entry-content">
    	<?php the_content(); ?>
        <?php wp_link_pages(array('before'=>'<p class="post-sub-pages">'.__( 'Pages:' ))); ?>		
        <?php edit_post_link( 'Edit', '<div class="edit-link">', '</div>' ); ?>
    </div>
	<div class="entry-sidebar">
		<div class="entry-gadget author noel-lock">
			<?php the_author(); ?>
		</div>
		<div class="entry-gadget date noel-lock">
			<?php the_time('D, d/m Y'); ?>
		</div>
		<div class="entry-gadget cat">
			<?php the_category(', '); ?>
		</div>
		<?php if (!has_tag()) : ?>
		<?php else : ?>
		<div class="entry-gadget tag">
			<?php the_tags('',', ',''); ?>
		</div>
		<?php endif ?>
	</div>
</article><!-- #post -->

<?php comments_template( '', true ); ?>

<?php endwhile; ?>
