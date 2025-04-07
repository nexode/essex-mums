<?php

namespace EssexMums\Theme;

class ThemeManager
{
    public function __construct()
    {
        // Hook theme setup, scripts, styles, and other custom functionalities
        add_action('after_setup_theme', [$this, 'theme_support'], 20);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles_and_scripts']);
        add_action('enqueue_block_assets', [$this, 'register_theme_editor_styles']);
        add_action('init', [$this, 'register_pattern_categories']);
    }

    /**
     * Register the initial theme setup.
     * Adds and removes theme support for specific WordPress features.
     *
     * @return void
     */
    public function theme_support(): void
    {
        add_theme_support('responsive-embeds');
        add_theme_support('post-formats', array('aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'));
        remove_theme_support('custom-background');
        remove_theme_support('custom-header');
    }

    /**
     * Enqueue both styles and scripts for the theme.
     *
     * @return void
     */
    public function enqueue_styles_and_scripts(): void
    {
        $this->register_styles();
        $this->enqueue_styles();
        $this->register_scripts();
        $this->enqueue_scripts();
    }

    /**
     * Registers styles for the theme.
     *
     * @return void
     */
    private function register_styles(): void
    {
        $theme_version = wp_get_theme()->get('Version');
        $style_uri = $this->get_asset_uri('/assets/styles/app.min.css');

        if ($style_uri) {
            wp_register_style('essex-mums-app', $style_uri, [], $theme_version);
        }
    }

    /**
     * Enqueues styles for the theme.
     *
     * @return void
     */
    private function enqueue_styles(): void
    {
        wp_enqueue_style('essex-mums-app');
    }

    /**
     * Registers scripts for the theme.
     *
     * @return void
     */
    private function register_scripts(): void
    {
        $script_uri = $this->get_asset_uri('/assets/scripts/main.min.js');

        if ($script_uri) {
            wp_register_script('essex-mums-main', $script_uri, [], null, true);
        }
    }

    /**
     * Enqueues scripts for the theme.
     *
     * @return void
     */
    private function enqueue_scripts(): void
    {
        wp_enqueue_script('essex-mums-main');
    }

    /**
     * Registers the editor styles for EssexMums Theme.
     *
     * @return void
     */
    public function register_theme_editor_styles(): void
    {
        $editor_style_uri = $this->get_asset_uri('/assets/styles/editor.min.css');

        if ($editor_style_uri) {
            wp_enqueue_style('essex-mums-editor', $editor_style_uri, [], null);
        }
    }

    /**
     * Registers pattern categories for the EssexMums Theme.
     *
     * @return void
     */
    public function register_pattern_categories(): void
    {
        register_block_pattern_category('essex-mums', [
            'label' => __('EssexMums', 'essex-mums')
        ]);
    }

    /**
     * Helper function to get the asset URI.
     * Checks if the file exists before returning the URI.
     *
     * @param string $relative_path Relative path of the asset.
     * @return string|null URI of the asset or null if the file does not exist.
     */
    private function get_asset_uri(string $relative_path): ?string
    {
        $file_path = get_template_directory() . $relative_path;
        if (file_exists($file_path)) {
            return get_template_directory_uri() . $relative_path;
        }
        return null;
    }
}
