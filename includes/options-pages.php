<?php

// Custom Options Pages

add_action("init", function () {
  if (function_exists("acf_add_options_page")) {
    // Default Theme Settings
    acf_add_options_page([
      "page_title" => "Site General Settings",
      "menu_title" => "Site Settings",
      "menu_slug" => "theme-general-settings",
      "capability" => "edit_posts",
      "redirect" => false,
      "position" => 2,
    ]);
  }
});
