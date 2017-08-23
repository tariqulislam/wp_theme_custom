<?php
if ( ! isset( $content_width ) ) $content_width = 900;


if (!function_exists('tfuse_sidebar_position')):
/* This Function Set sidebar position
 * To override tfuse_sidebar_position() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/
    function tfuse_sidebar_position() {
        global $TFUSE;

        $sidebar_position = $TFUSE->ext->sidebars->current_position;
        if ( empty($sidebar_position) ) $sidebar_position = 'full';

        return $sidebar_position;
    }

// End function tfuse_sidebar_position()
endif;

if (!function_exists('tfuse_user_profile')) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_user_profile( $fields = array() )
    {
        $tfuse_meta = null;

        // Get stnadard user contact info
        $standard_meta = array(
            'first_name' => get_the_author_meta('first_name'),
            'last_name' => get_the_author_meta('last_name'),
            'email'     => get_the_author_meta('email'),
            'url'       => get_the_author_meta('url'),
            'aim'       => get_the_author_meta('aim'),
            'yim'       => get_the_author_meta('yim'),
            'jabber'    => get_the_author_meta('jabber')
        );

        // Get extended user info if exists
        $custom_meta = (array) get_the_author_meta('theme_fuse_extends_user_options');

        $_meta = array_merge($standard_meta,$custom_meta);

        foreach ($_meta as $key => $item) {
            if ( !empty($item) && in_array($key, $fields) ) $tfuse_meta[$key] = $item;
        }

        return apply_filters('tfuse_user_profile', $tfuse_meta, $fields);
    }

endif;

if (!function_exists('tfuse_action_comments')) :
/**
 *  This function disable post commetns.
 *
 * To override tfuse_action_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_comments() {
        global $post;
            comments_template( '' );
    }

    add_action('tfuse_comments', 'tfuse_action_comments');
endif;

if (!function_exists('tfuse_get_comments')):
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_get_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_get_comments($return = TRUE, $post_ID) {
        $num_comments = get_comments_number($post_ID);

        if (comments_open($post_ID)) {
            if ($num_comments == 0) {
                $comments = __('No Comments','tfuse');
            } elseif ($num_comments > 1) {
                $comments = $num_comments . __(' Comments','tfuse');
            } else {
                $comments = __('1 Comment','tfuse');
            }
            $write_comments = '<a class="link-comments" href="' . get_comments_link() . '">' . $comments . '</a>';
        } else {
            $write_comments = __('Comments are off','tfuse');
        }
        if ($return)
            return $write_comments;
        else
            echo $write_comments;
    }

endif;

if (!function_exists('tfuse_pagination')):
    
function tfuse_pagination( $args = array(), $query = '' ) {
   
    global $wp_rewrite, $wp_query;
        if ( $query ) {

            $wp_query = $query;

        } // End IF Statement
        /* If there's not more than one page, return nothing. */ 
        if ( 1 >= $wp_query->max_num_pages )
            return false;

        /* Get the current page. */
        $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
        
        /* Get the max number of pages. */
        $max_num_pages = intval( $wp_query->max_num_pages );  

        /* Set up some default arguments for the paginate_links() function. */
        $defaults = array(
            'base' => add_query_arg( 'paged', '%#%' ),
            'format' => '',
            'total' => $max_num_pages,
            'current' => $current,
            'prev_next' => false,
            'show_all' => false,
            'end_size' => 2,
            'mid_size' => 1,
            'add_fragment' => '',
            'type' => 'plain',
            'before' => '',
            'after' => '',
            'echo' => true,
        );

        /* Add the $base argument to the array if the user is using permalinks. */
        if( $wp_rewrite->using_permalinks() )
            $defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

        /* If we're on a search results page, we need to change this up a bit. */
        if ( is_search() ) {
            $search_permastruct = $wp_rewrite->get_search_permastruct();
            if ( !empty( $search_permastruct ) )
                $defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
        }

        /* Merge the arguments input with the defaults. */
        $args = wp_parse_args( $args, $defaults ); 

        /* Don't allow the user to set this to an array. */
        if ( 'array' == $args['type'] )
            $args['type'] = 'plain';

        /* Get the paginated links. */
        $page_links = paginate_links( $args );

        /* Remove 'page/1' from the entire output since it's not needed. */
        $page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

        /* Wrap the paginated links with the $before and $after elements. */
        $page_links = $args['before'] . $page_links . $args['after'];

        /* Return the paginated links for use in themes. */
            ?>
            <nav class="navigation paging-navigation" role="navigation">
                <div class="pagination loop-pagination">

                    <?php 
                        
                        $prev = get_previous_posts_link('<span class="btn btn-dark btn-transparent prev">'.__('Prev Page','tfuse').'</span>');
                        $next = get_next_posts_link('<span class="btn btn-dark btn-transparent next">'.__('Next Page','tfuse').'</span>');
                        
                         if(!empty($prev)) echo $prev;
                        else echo '<a href="javascript:void(0)" class="btn btn-disabled btn-transparent prev">'.__('Prev Page','tfuse').'</a>';
                        
                        if(!empty($next)) echo $next;
                        else echo '<a href="javascript:void(0)" class="btn btn-disabled btn-transparent next">'.__('Next Page','tfuse').'</a>';                       
                    ?>
                </div>
            </nav>
            <?php
}
endif;

if (!function_exists('tfuse_shortcode_content')) :
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_shortcode_content() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_shortcode_content($position = '', $return = false)
    {
        $page_shortcodes = '';
        global $is_tf_front_page,$is_tf_blog_page,$post,$TFUSE;
        $types = $TFUSE->request->isset_GET('types') ? $TFUSE->request->GET('types') : '';
        
        if($position == 'before') $position = 'content_top';
        elseif($position == 'after') $position =  'content_bottom';
        else $position = 'content_bot';

        if((is_front_page() || $is_tf_front_page) && !$is_tf_blog_page)
        {  
            if(tfuse_options('homepage_category')=='page'){
                $page_id = tfuse_options('home_page'); 
                $page_shortcodes = tfuse_page_options($position,'',$page_id);
            }
            else
            $page_shortcodes = tfuse_options($position);
        }
        elseif($is_tf_blog_page)
        { 
           $position ='blog_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif (is_singular()) {
            global $post;
            $page_shortcodes = tfuse_page_options($position);
        } 
        elseif (is_category()) {
            $cat_ID = get_query_var('cat');
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        } 
        elseif(is_search())
        { 
           $position ='s_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif (is_tax() && $types != 'all_rooms') {
            $taxonomy = get_query_var('taxonomy');
            $term = get_term_by('slug', get_query_var('term'), $taxonomy);
            $cat_ID = $term->term_id;
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        }
        elseif(is_404())
        { 
           $position ='404_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif(is_archive())
        {
            $position ='archive_'.$position;
            $page_shortcodes = tfuse_options($position);
        }

        $page_shortcodes = tfuse_qtranslate($page_shortcodes);

        $page_shortcodes = apply_filters('themefuse_shortcodes', $page_shortcodes);

        if ($return)
            return $page_shortcodes;
        else
        {
            if((($position == 'content_bottom') && !empty($page_shortcodes)) || (($position == 'blog_content_bottom') && !empty($page_shortcodes)) || (($position == '404_content_bottom') && !empty($page_shortcodes)) || (($position == 'search_content_bottom') && !empty($page_shortcodes)))
            { 
                    echo $page_shortcodes;
            }
            elseif((($position == 'content_top') && !empty($page_shortcodes))|| (($position == 'blog_content_top') && !empty($page_shortcodes) ) || (($position == '404_content_top') && !empty($page_shortcodes) ) || (($position == 'search_content_top') && !empty($page_shortcodes) ) )
            {
                    echo $page_shortcodes;
            }
            else
                echo $page_shortcodes;
        }
    }

// End function tfuse_shortcode_content()
endif;


if (!function_exists('tfuse_category_on_front_page')) :
/**
 * Dsiplay homepage category
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_category_on_front_page()
    {
        if ( !is_front_page() ) return;

        global $is_tf_front_page,$homepage_categ;
        $is_tf_front_page = false;

        $homepage_category = tfuse_options('homepage_category');
        $homepage_category = explode(",",$homepage_category);
        foreach($homepage_category as $homepage)
        {
            $homepage_categ = $homepage;
        }

        if($homepage_categ == 'specific')
        {
            $is_tf_front_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;           
            
            $specific = tfuse_options('categories_select_categ');

            $ids = explode(",",$specific);
            $posts = array(); 
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                        'cat' => $specific,
                        'orderby' => 'date',
                        'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
                        
            return;
        }
        elseif($homepage_categ == 'page')
        {
            global $front_page;
            $is_tf_front_page = true;
            $front_page = true;
            $archive = 'page.php';
            $page_id = tfuse_options('home_page');

            $args=array(
                'page_id' => $page_id,
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'ignore_sticky_posts'=> 1
            );
            query_posts($args);
            include_once(locate_template($archive));
            wp_reset_query();
            return;
        }
        elseif($homepage_categ == 'all')
        {
            $archive = 'archive.php';

            $is_tf_front_page = true;
            wp_reset_postdata();
            include_once(locate_template($archive));
            return;
        }
 
    }

// End function tfuse_category_on_front_page()
endif;

if (!function_exists('tfuse_category_on_blog_page')) :
    /**
     * Dsiplay blogpage category
     *
     * To override tfuse_category_on_blog_page() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_category_on_blog_page()
    {
        global $is_tf_blog_page;
        $blogpage_categ ='';
        if ( !$is_tf_blog_page ) return;
        $is_tf_blog_page = false;

        $blogpage_category = tfuse_options('blogpage_category');
        $blogpage_category = explode(",",$blogpage_category);
        foreach($blogpage_category as $blogpage)
        {
            $blogpage_categ = $blogpage;
        }
        if($blogpage_categ == 'specific')
        {
            $is_tf_blog_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $specific = tfuse_options('categories_select_categ_blog');

            $ids = explode(",",$specific);
            $posts = array();
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'cat' => $specific,
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
        else
        {  
            $is_tf_blog_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $categories = get_categories();

            $ids = array();
            foreach($categories as $cats){
                $ids[] = $cats -> term_id;
            }
            $posts = array(); 

            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
    }
// End function tfuse_category_on_blog_page()
endif;
    
function new_excerpt_more( $more ) {
    $more = '...<a href="'.get_permalink().'" class="read_link"><span>'. __('Keep Reading','tfuse').'</span></a>';
        return $more;
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
    return 150;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

if ( !function_exists('tfuse_img_content')):

    function tfuse_img_content(){ 
        $content = $link = '';
		$args = array(
			'numberposts'     => -1,
		); 
        $posts_array = get_posts( $args );
        $option_name = 'thumbnail_image';
		foreach($posts_array as $post):
			$featured = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));  
			if(tfuse_page_options('thumbnail_image',false,$post->ID)) continue;
			
			if(!empty($featured))
			{
				$value = $featured[0];
				tfuse_set_page_option($option_name, $value, $post->ID);
				tfuse_set_page_option('disable_image', true , $post->ID); 
			}
			else
			{
				$args = array(
				 'post_type' => 'attachment',
				 'numberposts' => -1,
				 'post_parent' => $post->ID
				); 
				$attachments = get_posts($args);
				if ($attachments) {
				 foreach ($attachments as $attachment) { 
								$value = $attachment->guid; 
								tfuse_set_page_option($option_name, $value, $post->ID);
								tfuse_set_page_option('disable_image', true , $post->ID); 
							 }
				}
				else
				{
					$content = $post->post_content;
						if(!empty($content))
						{   
							preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content,$matches);
							if(!empty($matches))
							{
								$link = $matches[1]; 
								tfuse_set_page_option($option_name, $link , $post->ID);
								tfuse_set_page_option('disable_image', false , $post->ID);
							}
						}
				}
			}
                        
		endforeach;
			tfuse_set_option('enable_content_img',false, $cat_id = NULL);
    }
endif;

if ( tfuse_options('enable_content_img'))
{ 
    add_action('tfuse_head','tfuse_img_content');
}

if(!function_exists('tfuse_feedFilter')) :

    function tfuse_feedFilter($query) {
        if ($query->is_feed) {
            add_filter('the_content', 'tfuse_feedContentFilter');
        }
        return $query;
    }
    add_filter('pre_get_posts','tfuse_feedFilter');

    function tfuse_feedContentFilter($content) {
        $thumb = tfuse_page_options('single_image');
        $image = '';
        if($thumb) {
            $image = '<a href="'.get_permalink().'"><img align="left" src="'. $thumb .'" width="200px" height="150px" /></a>';
            echo $image;
        }
        $content = $image . $content;
        return $content;
    }

endif;

function tfuse_change_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/','/ class="submenu-1" /',$menu);
    return $menu;
}
add_filter ('wp_nav_menu','tfuse_change_submenu_class');

if (!function_exists('tfuse_count_attachment')) :	
    function tfuse_count_attachment($ID,$option) 
    {	
        $countat = 0;
        $attachments = tfuse_get_gallery_images($ID,TF_THEME_PREFIX . '_' . $option);
        if ($attachments) {  
            $countat = count($attachments);
        }
        return $countat;
    }
endif;

//display logo
if (!function_exists('tfuse_type_logo')) :
    function tfuse_type_logo() { 
        global $is_tf_blog_page,$is_tf_front_page;
    
        $logo_type = tfuse_options('logo_type');
		
		if($is_tf_blog_page)
                $text = tfuse_options('logo_text_sub_cat','The Blog');
            elseif(is_tag())
                $text = single_tag_title("", false);
            elseif(is_tax())
            {
                $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                
                if($term->taxonomy == 'tags')
                    $text = $term->name;
                else
                    $text = tfuse_options('logo_text_sub_gal','Gallery');
            }
            elseif (is_single())
            {
                global $post;
                if($post->post_type == 'gallery')
                     $text = tfuse_options('logo_text_sub_gal','Gallery');
                else
                    $text = tfuse_options('logo_text_sub_cat','The Blog');
            }
            elseif(is_category() || is_archive())
                $text = tfuse_options('logo_text_sub_cat','The Blog');
            elseif(is_page())
                $text = get_the_title();
            elseif(is_404())
                $text = __('404 Page','tfuse');
            elseif(is_search())
                $text = __('Search Page','tfuse');
            elseif($is_tf_front_page)
                $text = tfuse_options('logo_text_sub_cat','The Blog');
            else
                $text = '';
    
        if($logo_type == 'img')
        {
            $logo_upload = tfuse_options('logo');
            if(!empty($logo_upload)) 
            {  ?> 
                  <a href="<?php echo home_url(); ?>"><img src="<?php echo tfuse_options('logo'); ?>"  border="0" /></a>
                  <h2 class="site-description"><a href="<?php echo home_url(); ?>"><?php echo $text; ?></a></h2>
      <?php }
        }
        else
        { 
            ?>
            <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php echo tfuse_options('logo_text','TAPPTASTIC'); ?></a></h1>
            <h2 class="site-description"><?php echo $text; ?></h2>
 <?php  }
    }
endif;

if (!function_exists('tfuse_shorten_string')) :
    /**
     * To override tfuse_shorten_string() in a child theme, add your own tfuse_shorten_string()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

function tfuse_shorten_string($string, $wordsreturned)

{
    $retval = $string;

    $array = explode(" ", $string);
    if (count($array)<=$wordsreturned)

    {
        $retval = $string;
    }
    else

    {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array)." ...";
    }
    return $retval;
}

endif;

if (!function_exists('tfuse_filter_get_avatar')){

    function tfuse_filter_get_avatar($avatar, $id_or_email, $size, $default, $alt){
        $email_hash = '';
        $avatar_src = tfuse_options('default_avatar', false);
        if(empty($avatar_src)) {
            return $avatar;
        }

        $email = '';
        if ( is_numeric($id_or_email) ) {
            $id = (int) $id_or_email;
            $user = get_userdata($id);
            if ( $user )
                $email = $user->user_email;
        } elseif ( is_object($id_or_email) ) {
            // No avatar for pingbacks or trackbacks
            $allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
            if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
                return false;

            if ( !empty($id_or_email->user_id) ) {
                $id = (int) $id_or_email->user_id;
                $user = get_userdata($id);
                if ( $user)
                    $email = $user->user_email;
            } elseif ( !empty($id_or_email->comment_author_email) ) {
                $email = $id_or_email->comment_author_email;
            }
        } else {
            $email = $id_or_email;
        }

        if ( !empty($email) )
            $email_hash = md5( strtolower( trim( $email ) ) );

        $url = 'http://gravatar.com/' . $email_hash . '.php'; 
        $result = unserialize(@file_get_contents($url)); 
        
        if(!is_array($result)){  
            $avatar = "<img alt='' src='".TF_GET_IMAGE::get_src_link($avatar_src)."' class='avatar avatar-".$size." photo avatar-default' height='".$size."' width='".$size."' />";
        }
        return $avatar;
    }
    add_filter('get_avatar', 'tfuse_filter_get_avatar',10,5);
}

add_theme_support( 'automatic-feed-links' );



function tfuse_feedburner_url($output, $feed)
{
    $feedburner_url = tfuse_options('feedburner_url');
    if($feedburner_url && (($feed == 'rss2') || ($feed == '' && false === strpos($output, '/comments/feed/'))) )
        return $feedburner_url;
    return $output;
}
add_filter('feed_link','tfuse_feedburner_url',10,2);


function tf_time_passed($timestamp)
{
     $diff = time() - (int)$timestamp;

     if ($diff == 0) 
          return 'just now';

     $intervals = array
     (
         1                   => array('year',    31556926),
         $diff < 31556926    => array('month',   2628000),
         $diff < 2629744     => array('week',    604800),
         $diff < 604800      => array('day',     86400),
         $diff < 86400       => array('hour',    3600),
         $diff < 3600        => array('minute',  60),
         $diff < 60          => array('second',  1)
     );

      $value = floor($diff/$intervals[1][1]);
      return $value.' '.$intervals[1][0].($value > 1 ? 's' : '').' ago';
}

if (!function_exists('tfuse_main_header')) :	
    function tfuse_main_header() 
    {	
        $default_image = tfuse_options('default_bg');
        
        if(!empty($default_image))
            echo  '<style>
                    #masthead {background: #131619 url('.$default_image.');}
                </style>';
        else
            echo  '<style>
                    #masthead {background: #131619 url('.get_template_directory_uri().'/images/pattern.png);}
                  </style>';
    }
endif;

if ( !function_exists('tfuse_show_filter')):
function tfuse_show_filter(){
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
    $group = $term->taxonomy;
    $term_id = $term->term_id;
    $template_slug= $term->slug;
    $template_parent= $term->parent;
    $args = array( 'taxonomy' => $group );
    $terms = get_terms($group, $args);

    $count = count($terms);
    $i=0;
    if($template_parent==0) $template_parent = $term_id;

        if ($count > 0)
        {
		$term_list='';$term_list_view_all ='';
            foreach ($terms as $term)
            {
                $i++;
                if($template_parent != $term->parent)
                    if($term->slug==$template_slug)
                    {
					    
                        $term_list_view_all .= '<li class="categories-item active"><a  href="'.get_bloginfo('url').'/?galleries=' .$term->slug.  '"><i class="filter-icon"></i><span>' . $term->name . '</span></a></li>';
                    }
                    elseif($template_parent==$term->term_id)
                    {
					    
                        $term_list_view_all .= '<li class="categories-item"><a href="'.get_bloginfo('url').'/?galleries=' .$term->slug. '"><i class="filter-icon"></i><span>' . $term->name . '</span></a></li>';
                    }

                    if( $template_parent==$term->parent)
                    {
                        if($term->slug == $template_slug)
                        {		
                            $term_list .= '<li class="categories-item active"><a href="'.get_bloginfo('url').'/?galleries=' .$term->slug. '"><i class="filter-icon"></i><span>' . $term->name . '</span></a></li>';
                        }
                        else
                        {
						    
                            $term_list .= '<li class="categories-item"><a href="'.get_bloginfo('url').'/?galleries=' .$term->slug. '"><i class="filter-icon"></i><span>' . $term->name . '</span></a></li>';
                        }
                    }
                }
                echo $term_list_view_all.$term_list;
            }
}
endif;


if ( !function_exists('tfuse_get_term_list')):
function tfuse_get_term_list($post_type,$id){
    if($post_type == 'gallery')
        echo get_the_term_list($id,'galleries', '', ', ' );
    else
        echo get_the_category_list(', ');
}
endif;


if ( !function_exists('tfuse_get_image')):
function tfuse_get_image(){
    global $post; $image_arg = array();
    
    $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));

    $default_image = tfuse_options('default_bg');

    if($post->post_type == 'post')
    {
        if(!empty($image) || !empty($default_image))
        {
            $image_arg['img'] = !empty($image) ? $image : $default_image;

            $image_arg['style'] = 'style="background-image: url('.$image_arg['img'].');"';
        }
        else
        {
            $image_arg['style'] = 'style="background: #131619 url('.get_template_directory_uri().'/images/pattern.png'.');"';
            $image_arg['img'] = get_template_directory_uri().'/images/pattern.png';
        }
    }
    else
    {
        if(!empty($default_image))
        {
            $image_arg['img'] = $default_image;

            $image_arg['style'] = 'style="background-image: url('.$image_arg['img'].');"';
        }
        else
        {
            $image_arg['style'] = 'style="background: #131619 url('.get_template_directory_uri().'/images/pattern.png'.');"';
            $image_arg['img'] = get_template_directory_uri().'/images/pattern.png';
        }
    }
    
    return $image_arg;
}
endif;

if ( !function_exists('tfuse_render_view')):

function tfuse_render_view($file_path, $view_variables = array()) {
	extract($view_variables, EXTR_REFS);

	ob_start();

	require $file_path;

	return ob_get_clean();
}
endif;