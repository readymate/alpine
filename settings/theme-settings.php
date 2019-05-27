<?php


/**
 * Top Level Menu and submenu
 */
function alpine_theme_options_page()
{
	// add top level menu page
	add_menu_page(
		__('Theme Options', 'alpine'), 		// page title
		__('Theme Options', 'alpine'), 		// menu title
		'manage_options', 								// capability
		'alpine_theme_options', 					// menu slug
		'alpine_theme_options_page_html', // content callback
		'dashicons-star-empty' 						// menu icon
	);
}
add_action('admin_menu', 'alpine_theme_options_page');

/**
 * The page to display all rated content
 * @return void
 */
function alpine_theme_options_page_html()
{
	?>
	<div class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
		<div>
			<form method="post" action="options.php">
				<?php
				settings_fields("alpine_theme_settings_section");
				do_settings_sections("alpine-theme-settings");
				submit_button();
				?>
			</form>
		</div>
	</div>
<?php
}

function alpine_header_layout()
{
	$header_layout = get_option('header-layout', 'flat');
	?>
	<fieldset>
		<legend class="screen-reader-text"><span>Header Layout</span></legend>
		<label>
			<input type="radio" name="header-layout" value="flat" <?php checked('flat' == $header_layout); ?> />
			<span class="date-time-text">Flat</span>
		</label>
		<br>
		<br>
		<label>
			<input type="radio" name="header-layout" value="flat-space-between" <?php checked('flat-space-between' == $header_layout); ?> />
			<span class="date-time-text">Flat - Space Between</span>
		</label>
		<br>
		<br>
		<label>
			<input type="radio" name="header-layout" value="stacked" <?php checked('stacked' == $header_layout); ?> />
			<span class="date-time-text">Stacked</span>
		</label>
		<br>
		<br>
		<label>
			<input type="radio" name="header-layout" value="stacked-center" <?php checked('stacked-center' == $header_layout); ?> />
			<span class="date-time-text">Stacked - Center</span>
		</label>
		<br>
		<br>
		<label>
			<input type="radio" name="header-layout" value="stacked-right" <?php checked('stacked-right' == $header_layout); ?> />
			<span class="date-time-text">Stacked - Right</span>
		</label>
	</fieldset>
<?php
}
function alpine_footer_layout()
{
	$footer_layout = get_option('footer-layout', 'flat');
	?>
	<fieldset>
		<legend class="screen-reader-text"><span>Footer Layout</span></legend>
		<label>
			<input type="radio" name="footer-layout" value="flat" <?php checked('flat' == $footer_layout); ?> />
			<span class="date-time-text">Flat</span>
		</label>
		<br>
		<br>
		<label>
			<input type="radio" name="footer-layout" value="flat-center" <?php checked('flat-center' == $footer_layout); ?> />
			<span class="date-time-text">Flat - Center</span>
		</label>
		<br>
		<br>
		<label>
			<input type="radio" name="footer-layout" value="flat-right" <?php checked('flat-right' == $footer_layout); ?> />
			<span class="date-time-text">Flat - Right</span>
		</label>
		<br>
		<br>
		<label>
			<input type="radio" name="footer-layout" value="flat-space-between" <?php checked('flat-space-between' == $footer_layout); ?> />
			<span class="date-time-text">Flat - Space Between</span>
		</label>
		<br>
		<br>
		<label>
			<input type="radio" name="footer-layout" value="stacked" <?php checked('stacked' == $footer_layout); ?> />
			<span class="date-time-text">Stacked</span>
		</label>
		<br>
		<br>
		<label>
			<input type="radio" name="footer-layout" value="stacked-center" <?php checked('stacked-center' == $footer_layout); ?> />
			<span class="date-time-text">Stacked - Center</span>
		</label>
		<br>
		<br>
		<label>
			<input type="radio" name="footer-layout" value="stacked-right" <?php checked('stacked-right' == $footer_layout); ?> />
			<span class="date-time-text">Stacked - Right</span>
		</label>
	</fieldset>
<?php
}

function header_layout_validate($input)
{
	$trimmed = trim($input);
	if (count($trimmed) > 0 && $trimmed !== '') {
		return $trimmed;
	}
	return '';
}

function footer_layout_validate($input)
{
	$trimmed = trim($input);
	if (count($trimmed) > 0 && $trimmed !== '') {
		return $trimmed;
	}
	return '';
}

function alpine_theme_settings()
{
	add_settings_section("alpine_theme_settings_section", "", null, "alpine-theme-settings");

	add_settings_field(
		"header-layout",
		"Header Layout",
		"alpine_header_layout",
		"alpine-theme-settings",
		"alpine_theme_settings_section"
	);
	register_setting(
		"alpine_theme_settings_section",
		"header-layout",
		"header_layout_validate"
	);

	add_settings_field(
		"footer-layout",
		"Footer Layout",
		"alpine_footer_layout",
		"alpine-theme-settings",
		"alpine_theme_settings_section"
	);
	register_setting(
		"alpine_theme_settings_section",
		"footer-layout",
		"footer_layout_validate"
	);
}

add_action("admin_init", "alpine_theme_settings");
