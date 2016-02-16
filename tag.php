<?php get_header(); ?>

<div id="container">
	<div id="content">
    
	<h2 class="page-title archiveal noel-lock"><?php printf( __( 'Tag Archives:<br/>- %s -', 'noel' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h2>

<?php get_template_part( 'loop', 'tag' ); ?>
      
    </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>