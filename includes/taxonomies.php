<?php

// register custom taxonomies

add_action("init", function()
{
  register_taxonomy(
    "project-type",
    ["case-study"],
    [
		"labels" => array(
			"name" => _x( "Project Types", "taxonomy general name" ),
			"singular_name" => _x( "Project Type", "taxonomy singular name" ),
			"search_items" =>  __( "Search Project Types" ),
			"all_items" => __( "All Project Types" ),
			"parent_item" => __( "Parent Project Type" ),
			"parent_item_colon" => __( "Parent Project Type:" ),
			"edit_item" => __( "Edit Project Type" ),
			"update_item" => __( "Update Project Type" ),
			"add_new_item" => __( "Add New Project Type" ),
			"new_item_name" => __( "New Project Type Name" ),
			"menu_name" => __( "Project Types" ),
		  ),
      "hierarchical" => false,
      "show_in_rest" => true,
      "show_admin_column" => true,
      "rewrite" => [
        "slug" => "project-type",
        "with_front" => true,
      ],
    ]
  );
});
