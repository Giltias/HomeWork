<?php
add_theme_support('menus');
add_theme_support('widgets');
add_theme_support( 'html5', array( 'search-form' ) );
register_sidebar( array(
        'name' => 'sidebar',
        'id' => 'sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s sidebar__sidebar-item">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sidebar-item__title">',
        'after_title' => '</h3>'
    ) );

function get_post_image($fields = [], $post = null) {
    $url = (!empty($fields['banner']))
        ? $fields['banner']['sizes']['thumbnail']
        : get_the_post_thumbnail_url($post);
    if (!empty($url)) {
        return $url;
    }
    return '/img/post_thumb/thumb_1.jpg';
}

function get_pagination() {
    the_posts_pagination( array(
        'mid_size'  => 2,
        'prev_text' => __( '<<' ),
        'next_text' => __( '>>' ),
    ) );
}

function get_price_akcia($fields = []) {
    if (!empty($fields['price'])) {
        return "<p>Скидка: {$fields['price']}%</p>";
    }
    return '';
}

function my_special_nav_class( $classes, $item ) {

        $classes[] = 'nav-list__nav-item';

    return $classes;

}

add_filter( 'nav_menu_css_class', 'my_special_nav_class', 10, 4 );

// Register Custom Post Type
function akcia_post_type() {

    $labels = array(
        'name'                  => _x( 'Акции', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Акция', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Акции', 'text_domain' ),
        'name_admin_bar'        => __( 'Акции', 'text_domain' ),
        'archives'              => __( 'Item Archives', 'text_domain' ),
        'attributes'            => __( 'Item Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
        'all_items'             => __( 'All Items', 'text_domain' ),
        'add_new_item'          => __( 'Add New Item', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Item', 'text_domain' ),
        'update_item'           => __( 'Update Item', 'text_domain' ),
        'view_item'             => __( 'View Item', 'text_domain' ),
        'view_items'            => __( 'View Items', 'text_domain' ),
        'search_items'          => __( 'Search Item', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Акция', 'text_domain' ),
        'description'           => __( 'Акции', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'akcia', $args );

}
add_action( 'init', 'akcia_post_type', 0 );