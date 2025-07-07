<?php

#usado em processo de debug do wp-cron
#wp_cache_delete( 'alloptions', 'options' );

#session_start();
#https://stackoverflow.com/questions/64377032/getting-an-active-php-session-was-detected-critical-warning-in-wordpress
if ( !session_id() ) {
    session_start( [
        'read_and_close' => true,
    ] );
}


/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/
// Desativar exibição de erros
// Desativar exibição de erros e avisos
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL & ~E_NOTICE);

register_activation_hook(__FILE__, 'premios_registrar_post_type');
require_once("new-theme/CPF.php");
new CPF();

require_once("new-theme/NewTheme.php");
$NewTheme = new \NewTheme\NewTheme();

require_once("new-theme/AgendaWPJSON.php");
$Agenda = new AgendaWPJSON();

global $NewTheme;

require_once("new-theme/Integracoes.php");
$Integracoes = new \NewTheme\Integracoes();

require_once("new-theme/Publicidade.php");
$Publicidade = new Publicidade();

global $Integracoes;
// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once( 'library/admin.php' );



/*********************
* LAUNCH BONES
* Let's get everything up and running.
*********************/
function new_get_page_by_title( $page_title, $output = OBJECT, $post_type = 'page' ) {
    $args  = array(
        'title'                  => $page_title,
        'post_type'              => $post_type,
        'post_status'            => 'publish',
        'posts_per_page'         => 1,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false,
        'no_found_rows'          => true,
        'orderby'                => 'post_date ID',
        'order'                  => 'ASC',
    );
    $query = new WP_Query( $args );
    $pages = $query->posts;

    if ( empty( $pages ) ) {
        return null;
    }

    return get_post( $pages[0], $output );
}

function bones_ahoy() {

	//Allow editor style.
	add_editor_style();

	// let's get language support going, if you need it
	load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

	// launching operation cleanup
	add_action( 'init', 'bones_head_cleanup' );
	// A better title
	add_filter( 'wp_title', 'rw_title', 10, 3 );
	// remove WP version from RSS
	add_filter( 'the_generator', 'bones_rss_version' );
	// remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
	// clean up comment styles in the head
	add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
	// clean up gallery output in wp
	add_filter( 'gallery_style', 'bones_gallery_style' );

	// enqueue base scripts and styles
	add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
	// ie conditional wrapper

	// launching this stuff after theme setup
	bones_theme_support();

	// adding sidebars to Wordpress (these are created in functions.php)
	add_action( 'widgets_init', 'bones_register_sidebars' );

	// cleaning up random code around images
	add_filter( 'the_content', 'bones_filter_ptags_on_images' );
	// cleaning up excerpt
	add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/
if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/
// Thumbnail sizes
add_image_size( 'cmsp-fullwidth', 640, 999999, true);
add_image_size( 'cmsp-featured-post-thumb', 482, 226, true);
add_image_size( 'cmsp-sidebar-featured-post-thumb', 300, 226, true);
add_image_size( 'cmsp-233-175', 233, 175, true);

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
				'cmsp-fullwidth' => __('Largura total'),
		) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocos. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/*
	A good tutorial for creating your own Sections, Controls and Settings:
	https://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722

	Good articles on modifying the default options:
	https://natko.com/changing-default-wordpress-theme-customization-api-sections/
	https://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162

	To do:
	- Create a js for the postmessage transport method
	- Create some sanitize functions to sanitize inputs
	- Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
	// $wp_customize calls go here.
	//
	// Uncomment the below lines to remove the default customize sections

	// $wp_customize->remove_section('title_tagline');
	// $wp_customize->remove_section('colors');
	// $wp_customize->remove_section('background_image');
	// $wp_customize->remove_section('static_front_page');
	// $wp_customize->remove_section('nav');

	// Uncomment the below lines to remove the default controls
	// $wp_customize->remove_control('blogdescription');

	// Uncomment the following to change the default section titles
	// $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
	// $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'banner-row',
		'name' => 'Banners - horizontal',
		'description' => 'Fileira horizontal de banners (carrossel com mais de 4 imagens)',
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '',
		'after_title' => '',
	));

	register_sidebar(array(
		'id' => 'banner-col',
		'name' => 'Banners - vertical',
		'description' => 'Fileira vertical de banners (carrossel com mais de 4 imagens)',
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '',
		'after_title' => '',
	));

  register_sidebar(array(
    'id' => 'sidebar-1',
    'name' => 'Lateral Posts Imagem',
    'description' => '',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ));

  register_sidebar(array(
    'id' => 'camara-fotografica',
    'name' => 'Câmara Fotográfica',
    'description' => 'Use o bloco de texto para criar o texto de abertura para todos os posts de Câmara Fotográfica',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ));

  /*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/* Remove WP Admin Bar*/
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
		if (!current_user_can('edit_posts') && !is_admin()) {
			add_filter('show_admin_bar', '__return_false');
		}
}
/* Remove WP Admin Bar*/

/*E-mail Content-type: HTML*/
/* add_filter( 'wp_mail_content_type', 'set_html_content_type' );

function set_html_content_type() {

	return 'text/html';
}*/
/*E-mail Content-type: HTML*/

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
	 $GLOBALS['comment'] = $comment; ?>
	<div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
		<article  class="cf">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="https://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content cf">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

//Extra
function remove_menus_author(){
	$author = wp_get_current_user();
	if(isset($author->roles[0])){
			$current_role = $author->roles[0];
	}else{
			$current_role = 'no_role';
	}

	if($current_role == 'author'){
		remove_menu_page( 'index.php' );                  //Dashboard
		remove_menu_page( 'edit.php?post_type=podcasts' );                   //Posts
		remove_menu_page( 'edit.php?post_type=slider-home' );                   //Posts
		remove_menu_page( 'edit.php?post_type=top-banner' );                   //Posts
		remove_menu_page( 'edit.php?post_type=vereador' );                   //Posts
		remove_menu_page( 'edit.php?post_type=gallery-item' );                   //Posts
		remove_menu_page( 'edit.php?post_type=idea' );                   //Posts
		remove_menu_page( 'edit.php?post_type=boletim_inf' );                   //Posts
		remove_menu_page( 'edit.php?post_type=partido' );                   //Posts
		remove_menu_page( 'sistemas' );                 //Media
		remove_menu_page( 'wpcf7' );                 //Media
		remove_menu_page( 'upload.php' );                 //Media
		remove_menu_page( 'tools.php' );                  //Tools
		remove_menu_page( 'edit-comments.php' );               //Comments
	}
}
add_action( 'admin_menu', 'remove_menus_author' );

// Shortcode para iframe
function iframe_shortcode( $atts , $content = null ) {

	// Attributes
	$code_atts = shortcode_atts( array(
				'width' => '',
				'height' => '',
				'src' => '',
		), $atts );

	$qwidth = $code_atts['width'];
	$qheight = $code_atts['height'];
	$qurl = $code_atts['src'];

	$output = '<iframe width="'. $qwidth .'" height="'. $qheight .'" scrolling="no" frameborder="no" src="'. $qurl .'"></iframe>';

	// Return code
	return $output;
}
add_shortcode( 'cmsp_iframe', 'iframe_shortcode' );


/**
 * Contact Form 7 *****************************************************************************************************
 */

// Contact Form 7 v5+ eliminou on_sent_ok
// [contact-form-7 id="40455" title="Focos de Mosquito"] usava:
// on_sent_ok: "document.getElementById('hideform').style.display = 'none';"
// O código abaixo trata substitui
add_action( 'wp_footer', 'mycustom_wp_footer' );
 
function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( '40455' == event.detail.contactFormId ) {
        document.getElementById('hideform').style.display = 'none';
    }
}, false );
</script>
<?php
}

//permite adicionar shortcode na chamada de forms que precisam do email do vereador a que a página se refere
add_filter( 'shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter', 10, 3);
 
function custom_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
    $my_attr = 'dynamichidden-email-vereador';
 
    if ( isset( $atts[$my_attr] ) ) {
        $out[$my_attr] = $atts[$my_attr];
    }
 
    return $out;
}

// LGPD - Flamingo / Advanced CF7 DB
// não gravar IP
// https://wpsocket.com/plugin/advanced-cf7-db/faq/
// do_shortcode( '[cf7-db-display-ip site_id="(your-site-id)"]' );
do_shortcode( '[cf7-db-display-ip]' );

//https://contactform7.com/2018/07/12/contact-form-7-503/#anonymizing-ip-address
add_filter( 'wpcf7_remote_ip_addr', 'wpcf7_anonymize_ip_addr' );


/**
 * FIM: Contact Form 7 *****************************************************************************************************
 */

function cmsp_customize_app_password_availability(
    $available,
    $user
) {
    if ( ! user_can( $user, 'manage_options' ) ) {
        $available = false;
    }
 
    return $available;
}
 
add_filter(
    'wp_is_application_passwords_available_for_user',
    'cmsp_customize_app_password_availability',
    10,
    2
);

/**
 * Restringir AppPwd para Admin *****************************************************************************************************
 */
 
 
 
 /**
 * FIM: Restringir AppPwd para Admin *****************************************************************************************************
 */



/*
	Migração PRODAM >>> Oracle Cloud
	Força Envio de e-mails via PHPmailer
	Francisco Arena 27/04/2017
*/
function set_smtp_credentials( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->SMTPAuth = true;
}
add_action('phpmailer_init', 'set_smtp_credentials');

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  
  //https://stackoverflow.com/questions/1966169/how-to-check-if-an-array-element-exists
  if(isset($matches [1] [0])) {
	  $first_img = $matches [1] [0];

	  if(empty($first_img)){ //Defines a default image
		$first_img = "/images/default.jpg";
	  }
  }
  return $first_img;
}


//add_action( 'admin_menu', 'rudr_top_lvl_menu' );

if(function_exists('acf_add_custom_options_page'))
acf_add_custom_options_page(array(
    'page_title' => 'Configurações Gerais',
    'menu_title' => 'Configurações Gerais',
    'menu_slug' => 'theme-general-settings',
    'icon_url' => 'dashicons-screenoptions',
));

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
define('ALLOW_UNFILTERED_UPLOADS', true);
function fix_svg_thumb_display() {
    echo '<style>
    td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
      width: 100% !important; 
      height: auto !important; 
    }
  </style>';
}
add_action('admin_head', 'fix_svg_thumb_display');
/* DON'T DELETE THIS CLOSING TAG */

function get_id_of_option($name)
{
    if ($posts = get_posts(array(
        'name' => $name,
        'post_status' => 'publish',
        'post_type' => 'acf-cop',
        'posts_per_page' => 1
    ))) return $posts[0]->ID;

    return 0;
}

//include 'acf-flexible-content-main/flexible-content.php';

function enable_comments_on_pages() {
    add_post_type_support( 'page', 'comments' );

}
add_action( 'init', 'enable_comments_on_pages' );


// Enable Gutenberg for all post types
add_filter('use_block_editor_for_post_type', '__return_true', 10);

// Optionally, you can also disable the classic editor
//add_filter('replace_editor', '__return_true');
    //print_r(get_post_meta(get_the_ID(), '_cmsp_feature-page_link'));


function custom_search_filter($query) {
    if (is_search() && !is_admin() && isset($_GET['type'])) {
        $post_type = sanitize_text_field($_GET['type']);
        $query->set('post_type', $post_type);
    }
}
add_action('pre_get_posts', 'custom_search_filter');

// Redefinir o pre_get_posts antes da barra lateral
function reset_pre_get_posts_before_sidebar() {
    remove_action('pre_get_posts', 'custom_search_filter');
}
add_action('template_redirect', 'reset_pre_get_posts_before_sidebar');



function modify_attachment_url($url, $post_id) {
    // Obtenha o caminho da URL atual do anexo
    $upload_dir = wp_upload_dir();
    $base_url = $upload_dir['baseurl'];
    // Verifique se a URL do anexo contém "/sites/"
    if (strpos($url, '/sites/') !== false) {
        // Extraia o caminho relativo após "/sites/"
        $relative_path = str_replace('/sites/4', '', $url);
        $relative_path = str_replace('/sites/1', '', $url);

        // Construa a nova URL com base no caminho relativo
        $new_url = $relative_path;

        // Retorne a nova URL
        return $new_url;
    }

    // Caso contrário, retorne a URL original
    return $url;
}

// Modificar também o srcset
function modify_attachment_srcset($sources, $size_array, $image_src, $image_meta, $attachment_id) {
    // Modifique cada fonte no conjunto de srcset
    foreach ($sources as &$source) {
        $source['url'] = modify_attachment_url($source['url'], $attachment_id);
    }

    // Retorne as fontes modificadas
    return $sources;
}

// Aplicar o filtro para modificar o srcset do anexo
add_filter('wp_calculate_image_srcset', 'modify_attachment_srcset', 10, 5);

// Aplicar o filtro para modificar a URL do anexo
add_filter('wp_get_attachment_url', 'modify_attachment_url', 10, 2);


function hasTextOutsideTags($string) {
	if($string && !is_search()) {
        // Remove as tags HTML da string

        $stringWithoutTags = strip_tags($string);

        // Remove apenas as tags HTML vazias
        if(stringWithoutTags) {
            $stringWithoutEmptyTags = preg_replace('/<[^/>]*>([\s]?)*</[^>]*>/', '', $stringWithoutTags);

            // Remove espaços em branco e caracteres especiais
            $cleanString = preg_replace('/\s+/', '', $stringWithoutEmptyTags);

            // Verifica se a string resultante possui algum texto
            if (strlen($cleanString) > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
    return false;
}


if ( ! function_exists( 'wpartisan_set_no_found_rows' ) ) :

    /**
     * Sets the 'no_found_rows' param to true.
     *
     * In the WP_Query class this stops the use of SQL_CALC_FOUND_ROWS in the
     * MySql query it generates.
     *
     * @param  WP_Query $wp_query The WP_Query instance. Passed by reference.
     * @return void
     */
    function wpartisan_set_no_found_rows( \WP_Query $wp_query ) {
            if(is_front_page())
            $wp_query->set( 'no_found_rows', true );
    }
endif;
add_filter( 'pre_get_posts', 'wpartisan_set_no_found_rows', 10, 1 );



/** ############  FILTRO SPAM RELEVANSSI ########
    https://www.relevanssi.com/knowledge-base/keyword-based-search-blocking/
*/
add_filter( 'pre_get_posts', 'rlv_block_search' );
function rlv_block_search( $query ) {

    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress .= $_SERVER['HTTP_CLIENT_IP'] . ';';
    }
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress .= $_SERVER['HTTP_X_FORWARDED_FOR']. ';';
    }
    if(isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress .= $_SERVER['HTTP_X_FORWARDED']. ';';
    }
    if(isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress .= $_SERVER['HTTP_FORWARDED_FOR']. ';';
    }
    if(isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress .= $_SERVER['HTTP_FORWARDED']. ';';
    }
    if(isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress .= $_SERVER['REMOTE_ADDR'];
    }

    //IPs que bombardeiam o Relevanssi. OBS: 66.249.66.78/79 são associados ao Google Search e se bloqueados no gateway impedem a leitura do robots.txt
    $IPblacklist = array( '66.249.66.78', '66.249.66.79');
	foreach ( $IPblacklist as $ip ) {
		if(strpos($ipaddress, $ip) > -1) {
			http_response_code( 410 );
			exit();
		}
	}


    if ( ! empty( $query->query_vars['s'] ) ) {
	// add blacklist entries here; no need for whole words, use the smallest part you can
        $blacklist = array( '大', '奖', 'д', 'и', 'э', 'ž', '£', '¥', '💠', 'WebMD', 'Pharma', 'Trust4Me', 'Cheap', 'win301', 'prescription', 'Receta', 'Lovegra', 'Levofloxacina', 'Mupirocinum', 'Lanoxin', 'Digoxina', 'without', 'iffoqjpggbei', 'uqvwwoejc', 'jsequtwrdqqx', 'Kaufen' );
        foreach ( $blacklist as $term ) {
            if ( mb_stripos( $query->query_vars['s'], $term ) !== false ) {
                http_response_code( 410 );
                exit();
            }
        }
     }
}



/**
############  PURGE DA CACHE DO WP-OPTIMIZE ########

OBS: a URL atividade-legislativa/agenda-da-camara/	foi adicionada como exceção no painel do plugin
*/
/*
//https://www.advancedcustomfields.com/resources/acf-save_post/
add_action( 'acf/save_post', function( $post_id ) {

	//debug: error_log('Ação acf/save_post foi disparada');
	
	$post_type = get_post_type($post_id);
	//debug: error_log('$post_type = ' . $post_type);
	if ('agenda_cerimonial' != $post_type) {//group_5bd09fc40768a
	  return;
	}
	
	//if (wp_is_post_revision($post_id)) {
	//	$post_id = wp_get_post_parent_id($post_id);
	//}
    
	try {
		# limpa a cache da página da agenda do cerimonial
		# OBS: a home parece sempre ser atualizada quando há atualização de dados
		# https://plugins.trac.wordpress.org/browser/wp-optimize/trunk/cache/class-wpo-page-cache.php
		WPO_Page_Cache::delete_single_post_cache(273);// https://portalcmsp.brazilsouth.cloudapp.azure.com/atividade-legislativa/agenda-da-camara/		
	} catch (Exception $e) {
		error_log($e->getMessage());
	}
	
} );*/

//area dos premios

function registrar_post_type_premios() {
    $labels = array(
        'name'               => 'Prêmios',
        'singular_name'      => 'Prêmio',
        'add_new'            => 'Adicionar Novo',
        'add_new_item'       => 'Adicionar Novo Prêmio',
        'edit_item'          => 'Editar Prêmio',
        'new_item'           => 'Novo Prêmio',
        'all_items'          => 'Todos os Prêmios',
        'view_item'          => 'Ver Prêmio',
        'search_items'       => 'Buscar Prêmios',
        'not_found'          => 'Nenhum prêmio encontrado',
        'not_found_in_trash' => 'Nenhum prêmio encontrado na lixeira',
        'menu_name'          => 'Prêmios'
    );
	$args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'premios'),
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-awards',
        'show_in_rest'       => true,
    );
	register_post_type('premios', $args);
}
add_action('init', 'registrar_post_type_premios');
function adicionar_meta_box_ano() {
    add_meta_box(
        'meta_box_ano',
        'Ano do Prêmio',
        'exibir_meta_box_ano',
        'premios',
        'side',
        'default'
    );
}
// Adiciona a metabox com os campos personalizados
function adicionar_meta_boxes_premios() {
    add_meta_box(
        'informacoes_premio',
        'Informações do Prêmio',
        'renderizar_meta_box_premio',
        'premios',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'adicionar_meta_boxes_premios');

function renderizar_meta_box_premio($post) {
    wp_nonce_field('salvar_dados_premio', 'premio_nonce');

    $descricao = get_post_meta($post->ID, 'descricao_premio', true);
    $como_participar = get_post_meta($post->ID, 'como_participar', true);
    $formulario = get_post_meta($post->ID, 'formulario_inscricao', true);
    $livreto = get_post_meta($post->ID, 'livreto_premio', true);
    $status = get_post_meta($post->ID, 'status_inscricao', true);
    $status = $status ?: 'ativa'; // padrão

    echo '<p><strong>Status da Inscrição:</strong><br>';
    echo '<label><input type="radio" name="status_inscricao" value="ativa" ' . checked($status, 'ativa', false) . '> Inscrição Ativa</label><br>';
    echo '<label><input type="radio" name="status_inscricao" value="encerrada" ' . checked($status, 'encerrada', false) . '> Inscrição Encerrada</label></p>';

    echo '<p><label for="descricao_premio"><strong>Descrição do Prêmio:</strong></label></p>';
    wp_editor(
        $descricao,
        'descricao_premio',
        array(
            'textarea_name' => 'descricao_premio',
            'media_buttons' => false,
            'textarea_rows' => 8,
            'teeny' => false,
            'quicktags' => true,
        )
    );

    echo '<p><label for="como_participar"><strong>Arquivo "Como Participar":</strong></label><br />';
    echo '<input type="text" name="como_participar" id="como_participar" value="' . esc_attr($como_participar) . '" style="width:80%;" />';
    echo '<button type="button" class="button selecionar-arquivo" data-target="como_participar">Selecionar da Mídia</button></p>';

    echo '<p><label for="formulario_inscricao"><strong>Arquivo "Formulário de Inscrição":</strong></label><br />';
    echo '<input type="text" name="formulario_inscricao" id="formulario_inscricao" value="' . esc_attr($formulario) . '" style="width:80%;" />';
    echo '<button type="button" class="button selecionar-arquivo" data-target="formulario_inscricao">Selecionar da Mídia</button></p>';

    echo '<p><label for="livreto"><strong>Arquivo "Livreto":</strong></label><br />';
    echo '<input type="text" name="livreto" id="livreto" value="' . esc_attr($livreto) . '" style="width:80%;" />';
    echo '<button type="button" class="button selecionar-arquivo" data-target="livreto">Selecionar da Mídia</button></p>';
}


// Salva os dados
function salvar_dados_meta_premio($post_id) {
    if (!isset($_POST['premio_nonce']) || !wp_verify_nonce($_POST['premio_nonce'], 'salvar_dados_premio')) return;

    if (array_key_exists('descricao_premio', $_POST)) {
        update_post_meta($post_id, 'descricao_premio', sanitize_textarea_field($_POST['descricao_premio']));
    }

    if (array_key_exists('como_participar', $_POST)) {
        update_post_meta($post_id, 'como_participar', esc_url_raw($_POST['como_participar']));
    }

    if (array_key_exists('formulario_inscricao', $_POST)) {
        update_post_meta($post_id, 'formulario_inscricao', esc_url_raw($_POST['formulario_inscricao']));
    }
    if (isset($_POST['livreto'])) {
        update_post_meta($post_id, 'livreto', esc_url_raw($_POST['livreto']));
    }
    if (isset($_POST['status_inscricao'])) {
        update_post_meta($post_id, 'status_inscricao', sanitize_text_field($_POST['status_inscricao']));
    }
}
function premios_admin_scripts($hook) {
    global $post;
    if ($hook === 'post-new.php' || $hook === 'post.php') {
        if ($post->post_type === 'premios') {
            wp_enqueue_media();
            wp_add_inline_script('jquery', "
                jQuery(document).ready(function($) {
                    $('.selecionar-arquivo').click(function(e) {
                        e.preventDefault();
                        var button = $(this);
                        var target = $('#' + button.data('target'));
                        var custom_uploader = wp.media({
                            title: 'Selecionar Arquivo',
                            button: { text: 'Usar este arquivo' },
                            multiple: false
                        }).on('select', function() {
                            var attachment = custom_uploader.state().get('selection').first().toJSON();
                            target.val(attachment.url);
                        }).open();
                    });
                });
            ");
        }
    }
}
add_action('admin_enqueue_scripts', 'premios_admin_scripts');

add_action('save_post', 'salvar_dados_meta_premio');

add_action('add_meta_boxes', 'adicionar_meta_box_ano');
function exibir_meta_box_ano($post) {
    $ano = get_post_meta($post->ID, 'ano', true);
    echo '<label for="ano">Ano:</label>';
    echo '<input type="text" id="ano" name="ano" value="' . esc_attr($ano) . '" size="4" />';
}
function salvar_meta_box_ano($post_id) {
    if (array_key_exists('ano', $_POST)) {
        update_post_meta($post_id, 'ano', sanitize_text_field($_POST['ano']));
    }
}
add_action('save_post', 'salvar_meta_box_ano');

function carregar_estilo_single_premios() {
    if (is_singular('premios')) {
        wp_enqueue_style(
            'estilo-single-premios',
            get_template_directory_uri() . '/single-premios.css',
            array(),
            '1.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'carregar_estilo_single_premios');

?>