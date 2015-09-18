<?php
function remove_html_slashes($content) {
	return filter_var(stripslashes($content), FILTER_SANITIZE_SPECIAL_CHARS);
}

function new_excerpt_length($length) {
	return 11;
}

function new_excerpt_more($more) {
	return '';
}

function remove_objects($content)
{
	$content = preg_replace('/\<div(.*?)\>(.*?)\<\/div\>/s', '', $content);
	$content = preg_replace('/\<object(.*?)\>(.*?)\<\/object\>/s', '', $content);
	return $content;
}

function remove_images($content)
{
	$content = preg_replace('#(<[/]?a.*><[/]?img.*></a>)#U', '', $content);
	$content = preg_replace('#(<[/]?img.*>)#U', '', $content);
	$content = preg_replace("/\[caption(.*)\](.*)\[\/caption\]/Usi", "", $content);
    return $content;
}

function filter_where( $where = '' ) {
	// posts in the last 30 days
	$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
	return $where;
}

function page_read_more($content) {
	$result = preg_split('/<span id="more-\d+"><\/span>/', $content);
	return $result[0];
}

function blog_read_more($content)
{
    $content = preg_replace('#(<a.* class="more-link">.*</a>)#U', '</p><p>$1', $content);
    return $content;
}

function BigFirstChar ($content = '') {
     return '<p class="caps">' . $content;
}

function wrap_img_tags($content)
{
    $content = preg_replace('#(<[/]?img.*>)#U', '<p class="image">$1</p>', $content);
    return $content;
}

function wrap_art_img($content)
{
    $content = preg_replace('#(<p class="image">)<img(.*)class="article-image" />(<\/p>)#i', '<img ${2} class="article-image" /> ', $content);
    return $content;
}

function remove_shortcode_from_index($content) {
  if ( is_home() ) {
    $content = strip_shortcodes( $content );
  }
  return $content;
}

function big_first_char ($content = '') {
     return '<p class="caps">' . $content;
}

function WordLimiter($text,$limit=15){
    $explode = explode(' ',$text);
    $string  = '';

    $dots = '...';
    if(count($explode) <= $limit){
        $dots = '';
    }
    for($i=0;$i<$limit;$i++){
        $string .= $explode[$i]." ";
    }
    if ($dots) {
        $string = substr($string, 0, strlen($string));
    }

    return $string.$dots;
}

load_theme_textdomain( 'bordeaux', TEMPLATEPATH . '/languages' );
	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
		
function bordeaux_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div class="comments-item" id="comment-<?php comment_ID(); ?>">
			<div class="comments-header">
				<div class="user"><a href="<?php if(comment_author_url()) { echo comment_author_url();} else { echo "#"; } ?>" class="user"><?php echo get_avatar( $comment, 36);?> </a><?php printf(__('%1$s', 'bordeaux'), get_comment_author_link());?></div>
				<h2 class="time"><?php printf(__('%1$s<span>&bull;</span>%2$s', 'bordeaux'), get_comment_date("n / j / Y"), get_comment_time());?></h2>
			</div>

			<?php if ($comment->comment_approved == '0') : ?>
			<em style="padding-left:50px;"><?php printf ( __( 'Your comment is awaiting moderation.' , 'bordeaux' ));?></em>
			<br />
			<?php endif; ?>
			<?php comment_text(); ?>
			<p class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<b>Reply</b>'))) ?> <?php edit_comment_link(__('(Edit)'),'  ','') ?></p>
		</div>
	
	
<?php
       }

add_filter('excerpt_length', 'new_excerpt_length');
add_filter('excerpt_more', 'new_excerpt_more');
add_filter('the_content', 'remove_shortcode_from_index');
remove_filter('the_excerpt', 'wpautop');

?>