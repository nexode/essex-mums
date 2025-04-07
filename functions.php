<?php

namespace EssexMums\Theme;

// Define a constant 'WPT_DIR' which holds the absolute path to the directory of the current file.
// The function get_template_directory() is used to get the absolute path to the directory.
// This constant can be used throughout the plugin to reference files and directories relative to the root directory of the plugin.
define( 'WPT_DIR', get_template_directory() );

require_once( WPT_DIR . '/app/ThemeManager.php' );
require_once( WPT_DIR . '/app/Comments.php' );

new ThemeManager();
new CommentsManager();
