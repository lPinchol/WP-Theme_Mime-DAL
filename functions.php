<?php
function noel_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $counter;
	$counter++;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">        
        <div class="comment-info">
            <div class="commenter-gravatar"><?php echo get_avatar( $comment, 60 ); ?></div>
            <div class="commenter-name"><?php comment_author_link(); ?></div>
            <div class="clear"></div>          
        </div>        
        <div class="comment-body">
			<?php comment_text(); ?>
            <?php edit_comment_link( __( 'Edit', 'noel' ), ' ' ); ?>
        </div>        
		<div class="comment-meta commentmetadata">
            <a class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s at %2$s', 'noel' ), get_comment_date(),  get_comment_time() ); ?></a>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'noel' ); ?></em>
        <?php else : ?>
			<span class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</span>
		<?php endif; ?>
        <div class="clear"></div>
        </div>        
	</div>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'noel' ); ?> <?php comment_author_link(); ?></p><?php edit_comment_link( __( 'Edit', 'noel' ), ' ' ); ?>
	<?php
			break;
	endswitch;
}

if ( ! isset( $content_width ) )
	$content_width = 600;

function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = $excerpt.'...';
  return $excerpt;
}

show_admin_bar(false);
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'custom-header',
		array(
			'random-default'=> true,
			'flex-width'    => true,
			'width'         => 1400,
			'flex-height'	=> true,
			'height'        => 400,
			'header-text'	=> false,
			// 'default-image' => get_template_directory_uri() . '/materials/banner-0.jpg',
		)
	);
register_default_headers( array(
	'natsumi' => array(
		'url' => '%s/materials/banner-0.jpg',
		'thumbnail_url' => '%s/materials/banner-0_thumb.jpg',
		'description' => __( 'Natsumi', 'noel' )
	),
	'yoshino' => array(
		'url' => '%s/materials/banner-1.jpg',
		'thumbnail_url' => '%s/materials/banner-1_thumb.jpg',
		'description' => __( 'Yoshino', 'noel' )
	),
	'tohka' => array(
		'url' => '%s/materials/banner-2.jpg',
		'thumbnail_url' => '%s/materials/banner-2_thumb.jpg',
		'description' => __( 'Tohka', 'noel' )
	)
) );

add_filter('wp_nav_menu_items', 'add_mimic_link', 10, 2);
function add_mimic_link($items, $args) {
        $items .= '<li class="menu-item"><a href="http://mimic-project.com/blog/free-wordpress-theme-mime-dal/" terget="_blank">MIMIC-Project</a></li>';
    return $items;
}

function diw_disable_default_widgets() {
     if(function_exists('unregister_sidebar_widget')) {
          unregister_widget('WP_Widget_Archives');
          unregister_widget('WP_Widget_Calendar');
          unregister_widget('WP_Widget_Categories');
          unregister_widget('WP_Widget_Links');
          unregister_widget('WP_Widget_Meta');
          unregister_widget('WP_Widget_Pages');
          unregister_widget('WP_Widget_Recent_Comments');
          unregister_widget('WP_Widget_Recent_Posts');
          unregister_widget('WP_Widget_RSS');
          unregister_widget('WP_Widget_Search');
          unregister_widget('WP_Widget_Tag_Cloud');
          unregister_widget('WP_Widget_Text');
     }
}
add_action('widgets_init', 'diw_disable_default_widgets');

register_nav_menus( array(
	'primary' => __( 'Header Navigation', 'noel' ),
	'secondary' => __( 'Footer Navigation', 'noel' ),
) );

function adminFooter() {
        echo '&copy; MIMIC-Project 2014';
}
add_filter('admin_footer_text', 'adminFooter');

function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('template_directory').'/materials/favicon-blog.png" />';
}
add_action('wp_head', 'blog_favicon');

if ( ! function_exists( 'noel_credit' ) ) :
function noel_credit() {
	printf( __( '<div id="ex-note">Website powered by %1$s, Template created by %2$s.</div>', 'noel' ),
		sprintf( '<a href="%1$s">%2$s</a>',
			'http://wordpress.org',
			'WordPress'
		),
		sprintf( '<a href="%1$s">%2$s</a>',
			'http://mimic-project.com',
			'MIMIC-Project'
		)
	);
}
endif;

function noel_theme_menu() {
	add_theme_page( 'Noel Theme Options', 'Theme Options', 'administrator',	'noel_theme_options', 'noel_theme_display' );
}
add_action( 'admin_menu', 'noel_theme_menu' );

function noel_theme_display() {
?>
	<div class="wrap">
		<h2><?php _e( 'Noel Theme Options', 'noel' ); ?></h2>
		<?php settings_errors(); ?>
		<form method="post" action="options.php">
			<?php
				settings_fields( 'noel_theme_general_options' );
				do_settings_sections( 'noel_theme_general_options' );
				submit_button();
			?>
		</form>

		<hr/>
		
		<style>
			.mimicpro-feed {
				list-style-type: disc;
				padding-left: 20px;
			}
			.mimicpro-donate {
				float: right;
				width: 250px;
				padding: 15px;
				margin: 0 0 15px 15px;
				border: 1px solid #e5e5e5;
				background-color: #e5e5e5;
				text-align: center;
			}
		</style>
		
		<div class="mimicpro-donate">
			<p>The author spends many hours working to create this theme.</p>
			<p>If you found this theme useful for you, please consider donating a little fortune for the author.</p>
			<p>Thank you.</p>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="K6775WC99DFQ6">
			<input type="image" src="http://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
		</div>
		
		<h3><?php _e( 'News', 'noel' ); ?></h3>
		
		<ul class="mimicpro-feed">
		<?php
		   require_once(ABSPATH . WPINC . '/rss.php');
				
		   $resp = _fetch_remote_file('http://mimic-project.com/feed/');
		   if ( is_success( $resp->status ) ) {
			  $rss =  _response_to_rss( $resp );			
			  $blog_posts = array_slice($rss->items, 0, 4);
			  
			  $posts_arr = array();
			  foreach ($blog_posts as $item) {
				 echo '<li><a href="'.$item['link'].'" style="font-size:120%;">'.$item['title'].'</a><br>'.$item['description'].'</li>';
			  }
		   } 
		   print('</ul>');
		?>
		<div style="clear:both;"></div>
	</div>
<?php
}

function noel_theme_default_general_options() {
	$defaults = array(
		'noel_social_facebook'		=>	'',
		'noel_social_twitter'		=>	'',
		'noel_social_googleplus'	=>	'',
		'noel_rss'					=>	'',
		'noel_google_analytics'		=>	'',
	);
	return apply_filters( 'noel_theme_default_general_options', $defaults );
}

function noel_initialize_theme_options() {
	if( false == get_option( 'noel_theme_general_options' ) ) {	
		add_option( 'noel_theme_general_options', apply_filters( 'noel_theme_default_general_options', noel_theme_default_general_options() ) );
	}
	add_settings_section( 'general_settings_section', __( 'General Settings', 'noel' ),	'noel_general_options_callback', 'noel_theme_general_options' );
	add_settings_field(	'noel_social_facebook', 'Facebook', 'noel_social_facebook_callback', 'noel_theme_general_options', 'general_settings_section', array( __( 'Put a link to your Facebook page. Leave it empty to disable the icon link.', 'noel' ) ) );
	add_settings_field(	'noel_social_twitter', 'Twitter', 'noel_social_twitter_callback', 'noel_theme_general_options', 'general_settings_section', array( __( 'Put a link to your Twitter page. Leave it empty to disable the icon link.', 'noel' ) ) );
	add_settings_field( 'noel_social_googleplus', 'Google+', 'noel_social_googleplus_callback',	'noel_theme_general_options', 'general_settings_section', array( __( 'Put a link to your Google+ page. Leave it empty to disable the icon link.', 'noel' ) ) );
	add_settings_field( 'noel_rss', 'RSS', 'noel_rss_callback', 'noel_theme_general_options', 'general_settings_section', array( __( 'Activate this setting to display RSS icon link.', 'noel' ) ) );
	add_settings_field( 'noel_google_analytics', 'Google Analytics', 'noel_google_analytics_callback', 'noel_theme_general_options', 'general_settings_section', array( __( 'Put your Google Analytics tracker code here. Leave it empty to disable Google Analytics.', 'noel' ) ) );
	
	register_setting( 'noel_theme_general_options', 'noel_theme_general_options', 'noel_theme_validate_general_options' );
}
add_action( 'admin_init', 'noel_initialize_theme_options' );

function noel_general_options_callback() {
	echo '';
}
function noel_social_facebook_callback($args) {
	$options = get_option( 'noel_theme_general_options' );
	$url = '';
	if( isset( $options['noel_social_facebook'] ) ) { $url = esc_url( $options['noel_social_facebook'] ); }
	echo '<input type="text" id="noel_social_facebook" class="regular-text code" name="noel_theme_general_options[noel_social_facebook]" value="' . $url . '" /><p class="description">'  . $args[0] . '</p>';
}
function noel_social_twitter_callback($args) {
	$options = get_option( 'noel_theme_general_options' );
	$url = '';
	if( isset( $options['noel_social_twitter'] ) ) { $url = esc_url( $options['noel_social_twitter'] ); }
	echo '<input type="text" id="noel_social_twitter" class="regular-text code" name="noel_theme_general_options[noel_social_twitter]" value="' . $url . '" /><p class="description">'  . $args[0] . '</p>';
}
function noel_social_googleplus_callback($args) {
	$options = get_option( 'noel_theme_general_options' );
	$url = '';
	if( isset( $options['noel_social_googleplus'] ) ) {	$url = esc_url( $options['noel_social_googleplus'] ); }
	echo '<input type="text" id="noel_social_googleplus" class="regular-text code" name="noel_theme_general_options[noel_social_googleplus]" value="' . $url . '" /><p class="description">'  . $args[0] . '</p>';
}
function noel_rss_callback($args) {
	$options = get_option( 'noel_theme_general_options' );
	$html = '<input type="checkbox" id="noel_rss" name="noel_theme_general_options[noel_rss]" value="1" ' . checked( 1, isset( $options['noel_rss'] ) ? $options['noel_rss'] : 0, false ) . '/>';
	$html .= '<label for="noel_rss">&nbsp;'  . $args[0] . '</label>';
	echo $html;
}
function noel_google_analytics_callback($args) {
	$options = get_option( 'noel_theme_general_options' );
	echo '<input type="text" id="noel_google_analytics" name="noel_theme_general_options[noel_google_analytics]" value="' . $options['noel_google_analytics'] . '" /><p class="description">'  . $args[0] . '</p>';
}
function noel_theme_validate_general_options( $input ) {
	$output = array();
	foreach( $input as $key => $value ) {
		if( isset( $input[$key] ) ) {
			$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
		}
	}
	return apply_filters( 'noel_theme_validate_noel_settings', $output, $input );
}

$noel_options = get_option( 'noel_theme_general_options' );
$homelinkoutput = str_replace( array( 'http://', 'https://', 'www.' ), '', home_url() );

function noel_facebook() {
	global $noel_options;
	if ( $noel_options['noel_social_facebook'] ) {
		echo $noel_options['noel_social_facebook'] ? '<a class="social-link-f" href="' . esc_url( $noel_options['noel_social_facebook'] ) . '" target="blank"></a>' : '';
	}
	else {
		echo '<span class="social-link-f"></span>';
	}
}
function noel_twitter() {
	global $noel_options;
	if ( $noel_options['noel_social_twitter'] ) {
		echo $noel_options['noel_social_twitter'] ? '<a class="social-link-t" href="' . esc_url( $noel_options['noel_social_twitter'] ) . '" target="blank"></a>' : '';
	}
	else {
		echo '<span class="social-link-t"></span>';
	}
}
function noel_googleplus() {
	global $noel_options;
	if ( $noel_options['noel_social_googleplus'] ) {
		echo $noel_options['noel_social_googleplus'] ? '<a class="social-link-g" href="' . esc_url( $noel_options['noel_social_googleplus'] ) . '" target="blank"></a>' : '';
	}
	else {
		echo '<span class="social-link-g"></span>';
	}
}
function noel_rss() {
	global $noel_options;
	if( isset( $noel_options['noel_rss'] ) && $noel_options[ 'noel_rss' ] ) {
		echo '<a class="social-link-r" href="' . home_url() . '/feed" target="_blank"></a>';
	}
}
function google_analytics_tracking_code(){
	global $noel_options;
	global $homelinkoutput;
	if ( $noel_options['noel_google_analytics'] ) { ?>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', '<?php echo $noel_options['noel_google_analytics'] ?>', '<?php echo $homelinkoutput ?>');
	ga('send', 'pageview');
</script>
<?php }
}
add_action('wp_footer', 'google_analytics_tracking_code');

function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}
add_filter('pre_get_posts','SearchFilter');

add_action('pre_get_posts', 'noel_ignore_sticky');
function noel_ignore_sticky($query)
{ $query->set('ignore_sticky_posts', true); }
