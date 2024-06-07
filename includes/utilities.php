<?php

/**
 * Determine if a string contains any string from an array
 */
function arr_in_string($str, array $arr)
{
  foreach ($arr as $a) {
    if (stripos($str, $a) !== false) {
      return true;
    }
  }
  return false;
}

/**
 * Inline styles for block text, background, and gradient
 * determines if a block requires inline styles for font color, background-color or background gradient
 * returns either an empty string or a string containing inline styles for 'color' and 'background'
 * returned string does not contain "style" attribute so it can be modified or appended later
 */
function get_block_styles($block)
{
  // we only use color so make sure the block it available
  if (empty($block["style"]) || empty($block["style"]["color"])) {
    return "";
  }

  // array used to test if color is a named or programmatic color
  $format_arr = ["hsl", "#", "rgb"];

  $background_color = !empty($block["style"]["color"]["background"])
    ? $block["style"]["color"]["background"]
    : "";
  // if there is a gradient style selected, add it as the background color instead of the
  $has_gradient = !empty($block["style"]["color"]["gradient"]);
  $background_color = $has_gradient
    ? $block["style"]["color"]["gradient"]
    : $background_color;
  $text_color = !empty($block["style"]["color"]["text"])
    ? $block["style"]["color"]["text"]
    : "";

  // if the background or text color are named values instead of hsl, rgb or hex, we don't want to return a style and overwrite class colors, etc.
  $background_color = arr_in_string($background_color, $format_arr)
    ? $background_color
    : "";

  $text_color = arr_in_string($text_color, $format_arr) ? $text_color : "";
  $background_style = "";
  $text_style = "";

  if ($background_color != "") {
    $background_style = "background: " . $background_color . ";";
  }

  if ($text_color != "") {
    $text_style = "color: " . $text_color . ";";
  }

  return $text_style . " " . $background_style;
}

/**
 * Asset path helper
 */
function asset_path($path, $type = "url")
{
  $asset_path = get_stylesheet_directory_uri() . "/assets";

  $path = "$asset_path/$path";

  return $path;
}

/**
 * Inline SVG helper
 */
function inline_svg($path)
{
  if (empty($path)) {
    return "";
  }

  $assets_path = asset_path($path, "dir");

  if (empty($assets_path)) {
    return "";
  }

  return file_get_contents($assets_path, false);
}

/**
 * Get new meta titles for archive, category, taxonomy pages
 */
function get_archive_page_title()
{
  $query_obj = get_queried_object();
  $post_type = get_post_type();

  if (!$query_obj) {
    return "";
  }

  if (is_category() || is_tax()) {
    $new_title = $query_obj->name;
    if (empty($new_title)) {
      $new_title = $query_obj->post_title;
    }
  } else {
    if (is_home()) {
      $new_title = get_the_title(get_option("page_for_posts"));
    } else {
      $new_title = get_the_archive_title();
    }
  }
  return $new_title;
}

/**
 * Determines whether or not the current post is a paginated post.
 */
function is_paginated()
{
  global $wp_query;
  if ($wp_query->max_num_pages > 1) {
    return true;
  } else {
    return false;
  }
}
