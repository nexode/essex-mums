<?php

namespace EssexMums\Theme;

/**
 * Essex Mums Theme Bootstrap
 *
 * This file serves as the main entry point for the Essex Mums WordPress theme.
 * It initializes core theme functionality by loading required manager classes.
 *
 * @package EssexMums\Theme
 */

/**
 * Define the theme root directory constant.
 *
 * WPT_DIR holds the absolute path to the theme's root directory.
 * This constant is used throughout the theme to reference files and directories
 * relative to the theme root, ensuring consistent path resolution.
 *
 * @const string WPT_DIR The absolute path to the theme directory.
 */
define( 'WPT_DIR', get_template_directory() );

// Load core theme manager classes
require_once WPT_DIR . '/app/ThemeManager.php';
require_once WPT_DIR . '/app/CommentsManager.php';

// Initialize theme managers
new ThemeManager();    // Handles core theme setup, assets, and functionality
new CommentsManager(); // Manages comment-related features and customizations
