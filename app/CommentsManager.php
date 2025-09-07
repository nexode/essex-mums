<?php

namespace EssexMums\Theme;

class CommentsManager {
    public function __construct() {
        // Hide comments from the admin menu
        add_action( 'admin_menu', [ $this, 'hide_comments' ] );
        // Disable comments on the front end
        add_filter( 'comments_open', [ $this, 'disable_comments_status' ], 20, 2 );
        // Disable comments in the admin menu
        add_action( 'admin_menu', [ $this, 'disable_comments_admin_menu' ] );
        // Disable comments in the admin bar
        add_action( 'admin_bar_menu', [ $this, 'disable_comments_admin_bar' ], 999 );
        // Disable comments support for all post types
        add_action( 'init', [ $this, 'disable_comments_post_types_support' ] );
    }


    public function hide_comments(): void {
        // Hide comments from the admin menu
        remove_menu_page( 'edit-comments.php' );
        // Hide comments from the admin bar
        add_action( 'admin_bar_menu', function ( $wp_admin_bar ) {
            $wp_admin_bar->remove_node( 'comments' );
        }, 999 );
    }

    public function disable_comments_post_types_support(): void {
        $post_types = get_post_types();
        foreach ( $post_types as $post_type ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }


    public function disable_comments_status(): bool {
        return false;
    }

    public function disable_comments_admin_menu(): void {
        remove_menu_page( 'edit-comments.php' );
    }

    public function disable_comments_admin_bar(): void {
        add_action( 'admin_bar_menu', function ( $wp_admin_bar ) {
            $wp_admin_bar->remove_node( 'comments' );
        }, 999 );
    }

}
