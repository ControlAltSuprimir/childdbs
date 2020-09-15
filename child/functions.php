<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}


function template_styles(){
    wp_register_style('bootstrap','https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',false,'4.4.1','all');
    wp_register_style('montserrat','https://fonts.googleapis.com/css?family=Montserrat&display=swap',false,'','all');
    wp_enqueue_style('main-style', get_stylesheet_uri(), array('bootstrap','montserrat'),'1.0','all');

    wp_register_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', false, true );
    wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery','popper'), true);

    wp_enqueue_script( 'custom', get_template_directory_uri()."/../child/assets/js/custom.js", false,"1.1", true );
    wp_localize_script('custom','selectyear',array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));

    wp_enqueue_script( 'dbtable', get_template_directory_uri()."/../child/assets/js/dbtable.js", false,"1.1", true );
}


add_action('wp_enqueue_scripts','template_styles');
add_theme_support( 'post-thumbnails' );

function my_custom_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Custom', 'your-theme-domain' ),
            'id' => 'custom-side-bar',
            'description' => __( 'Custom Sidebar', 'your-theme-domain' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'my_custom_sidebar' );



add_action("wp_ajax_nopriv_filterYear","filterYear");
add_action("wp_ajax_filterYear","filterYear");

function filterYear(){
    
    $dbName = 'db-de-prueba';
    $dbUser = 'root';
    $dbPass = '';
    $servername = '192.168.64.2';


    $mysqli = mysqli_connect($servername,$dbUser,$dbPass,$dbName,"3306");
    
    $query = mysqli_query($mysqli, "SELECT * FROM articles WHERE year=".$_POST["year"]." ORDER BY title");
    $return=array();
    while($result = mysqli_fetch_array($query)){
        $return[]=array(
            'id'    => $result['id_article'],
            'magazine' => $result['id_magazines'],
            'title' => $result['title'],
            'year' => $result['year']
        );
        /*$return=push_array($return, array($result['id_artice']=>$result['title']));*/
    }

    wp_send_json($return);
    
}
