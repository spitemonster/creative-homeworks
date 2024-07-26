<?php

if (!function_exists('get_field')) {
	return "can't get field";
}


	$content = get_field("announcement_content", "options");
	$link = get_field("announcement_bar_link", "options");
	$can_close = get_field("announcement_bar_can_close", "options") == "true";
?>

<?php if (!empty($link)): ?>
	<a class="announcement-bar__link" href="<?= $link; ?>">
<?php endif; ?>
	<div class="announcement-bar">
		<p><?= $content; ?></p>

		<?php if ($can_close): ?>
			<button class="announcement-bar__close">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/></svg>
				<span class="visually-hidden">Close Announcement Bar</span>
			</button>
		<?php endif; ?>
	</div>
<?php if (!empty($link)): ?>
	</a>
<?php endif; ?>