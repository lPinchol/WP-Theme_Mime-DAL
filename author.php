<?php get_header(); ?>

<div id="container">
	<div id="content">
		
<?php 
	if ( have_posts() )
		the_post();
?>
<h2 class="page-title archiveal noel-lock"><?php printf( __( 'Posts written by:<br/>- %s -', 'noel' ), "<span class='vcard'>" . get_the_author() . "</span>" ); ?></h2>
<?php
	rewind_posts();
	get_template_part( 'loop', 'archive' );
?>
        
    </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>