</div><!-- #main -->

<footer id="footer">

	<?php if ( has_nav_menu( 'secondary' ) ) : ?>
		<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'menu', 'container' => '' ) ); ?>
	<?php else : ?>
		<ul class="menu">
			<li><a href="http://mimic-project.com" target="_blank">ミミック-プロジェクト</a></li>
			<li><a href="http://mimic-project.com/date-a-live" target="_blank">デモ</a></li>
			<li><a href="http://www.compileheart.com" target="_blank">コンパイルハート</a></li>
			<li><a href="http://www.compileheart.com/date" target="_blank">デート・ア・ライブ</a></li>
			<li><a href="http://wordpress.org">ワードプレス</a></li>
		</ul>
	<?php endif; ?>

	<?php noel_credit(); ?>

</footer><!-- #footer -->

</section><!-- #wrapper -->

<div class="noel-toolbar">
	<?php noel_facebook(); noel_twitter(); noel_googleplus(); noel_rss(); ?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'noel' ); ?>" />
	</form>
</div>

<?php wp_footer(); ?>
</BODY>
</HTML>