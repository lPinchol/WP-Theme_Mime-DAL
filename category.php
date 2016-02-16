<?php get_header(); ?>

<div id="container">
	<div id="content">
    
	<h2 class="page-title archiveal noel-lock"><?php printf( __( 'Category Archives:<br/>- %s -', 'noel' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h2>
	<?php
		$category_description = category_description();
		if ( ! empty( $category_description ) )
			echo '<div class="archive-meta">' . $category_description . '</div>';
	get_template_part( 'loop', 'category' );
	?>
      
    </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>