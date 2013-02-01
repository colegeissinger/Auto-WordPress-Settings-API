<?php
	/**
	 * Admin theme options and other fun stuff
	 *
	 * Load all of our theme options and processing script, shortcodes and more
	 *
	 * @package Starters
	 * @since Starters 1.0
	 */

	// Load our custom TinyMCE buttons by linking to their init file
	include_once('tinymce-plugins/layout/layout-init.php');


	/********** Set some global variables **********/
	// Set the theme handle (ID). This is used within out theme options data.
	$handle = 'starters';

	// Set the file name of the default tab.
	$default = 'display_options';

	// Set the $active_tab variable. Feed it the default
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : $default;


	// If we are currently viewing the theme options in Appearance, then load the necessary file for our option
	if($pagenow == 'options.php' || (isset($_GET['page']) && $_GET['page'] == 'starters_theme_options')) {
		include('options/' . $active_tab . '.php');
	}


	/**
	 * Load our custom theme options page within Appearance in the admin area using add_theme_page().
	 * add_theme_page() then loads starters_theme_options_display() to load in the HTML for the theme page.
	 * @return void
	 *
	 * @version 1.0
	 * @since 1.0
	 */
	function starters_theme_options_menu() {
		add_theme_page('Theme Options', 'Theme Options', 'administrator', 'starters_theme_options', 'starters_theme_options_display');
	}
	add_action('admin_menu', 'starters_theme_options_menu');


	/**
	 * Defines the HTML for the theme options page. This is loaded via add_theme_page() in starters_theme_options_display()
	 * @return HTML
	 *
	 * @version 1.0
	 * @since 1.0
	 */
	function starters_theme_options_display() {
		global $options_data, $active_tab, $page_url; ?>
		<div class="wrap">
			<div id="icon-themes" class="icon32"></div>
			<h2>Theme Options</h2>

			<?php settings_errors(); ?>

			<h2 class="nav-tab-wrapper">
				<a href="?page=starters_theme_options&amp;tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>">Display Options</a>
			</h2>

			<form action="options.php" method="post">
				<?php
					if($active_tab == 'display_options') {
						settings_fields('starters_theme_display_options');
						do_settings_sections('starters_theme_display_options');
					}

					submit_button();
				?>
			</form>
		</div>
		<?php echo $html;
	}


	/**
	 * Initialize the theme options page by registering our sections, fields and settings.
	 * @return void
	 *
	 * @version 1.0
	 * @since 1.0
	 */
	function starters_initialize_theme_options() {
		global $options_data;

		//echo '<pre>'; print_r($options_data); echo '</pre>';

		if(get_option($options_data['section-id'] == false)) {
			add_option($options_data['section-id']);
		}

		if(isset($options_data)) : // Double check that our data array was imported, or else we'll get errors
			foreach($options_data as $data => $value) {
				//echo '<pre>'; print_r($value); echo '</pre>';

				if(isset($value['type'])) : // Load the switch only if the type key is set
					switch($value['type']) {
						case 'settings-section' : // Register our Settings Section
							add_settings_section($value['id'], $value['title'], $value['callback'], $value['section']);
							break;
						case 'settings-field' : // Register our Settings Fields
							add_settings_field($value['args']['id'], $value['args']['label'], $value['callback'], $value['section'], $value['settings-id'], $value['args']);
							break;
						case 'register-setting' : // Register our settings ;)
							register_setting($value['args'][0], $value['args'][1]);
							break;
					}
				endif;
			}
		endif;
	}
	add_action('admin_init', 'starters_initialize_theme_options');



	/****************************************************************************
	 * Section Callback
	 ****************************************************************************/


	/**
	 * Allows us to output a description for the active section.
	 * This function is called through the settings-section array found in the appropriate page in the options directory.
	 * @return HTML
	 *
	 * @version 1.0
	 * @since 1.0
	 */
	function starters_section_description_callback() {
		global $options_data;

		echo '<p>' . $options_data['section-desc'] . '</p>';
	}


	/****************************************************************************
	 * Fieldset Callback
	 ****************************************************************************/

	/**
	 * Creates the output for our standard input text field. Pass any settings field through this callback to output
	 *
	 * @param  Array $args The array of information for the callback.
	 * @return HTML
	 */
	function starters_text_callback($args) {
		global $options_data;

		// Return the data saved into the database (if the data exists...)
		$options = get_option($options_data['section-id']);

		// Set a variable for our name field here to keep the source code below clean.
		$option_name = $options_data['section-id'] . '[' . $args['id'] . ']';

		// Check if our options data is saved. If not, then return empty
		if(!empty($options[$args['id']])) {
			$value = $options[$args['id']];
		} else {
			$value = '';
		}

		// Output the html while feeding in various pieces of information from our $args array in the $options_data array
		$output = '<input type="text" id="' . $args['id'] . '" class="regular-text" name="' . $option_name . '" value="' . $value . '" />';

		// Output the description
		$output .= '<p class="description"> '  . $args['description'] . '</p>';

		echo $output;
	}


	/**
	 * Creates the output for our standard textarea. Pass any settings field through this callback to output
	 *
	 * @param  Array $args The array of information for the callback.
	 * @return HTML
	 */
	function starters_textarea_callback($args) {
		global $options_data;

		// Return the data saved into the database (if the data exists...)
		$options = get_option($options_data['section-id']);

		// Set a variable for our name field here to keep the source code below clean.
		$option_name = $options_data['section-id'] . '[' . $args['id'] . ']';

		// Check if our options data is saved. If not, then return empty
		if(!empty($options[$args['id']])) {
			$value = $options[$args['id']];
		} else {
			$value = '';
		}

		// Output the html while feeding in various pieces of information from our $args array in the $options_data array
		$output = '<textarea name="' . $option_name . '" id="' . $args['id'] . '" class="large-text" rows="5" cols="30">' . $value . '</textarea>';

		// Output the description
		$output .= '<p class="description"> '  . $args['description'] . '</p>';

		echo $output;
	}


	/**
	 * Creates the output for our standard checkbox. Pass any settings field through this callback to output
	 *
	 * @param  Array $args The array of information for the callback.
	 * @return HTML
	 */
	function starters_checkbox_callback($args) {
		global $options_data;

		// Return the data saved into the database (if the data exists...)
		$options = get_option($options_data['section-id']);

		// Set a variable for our name field here to keep the source code below clean.
		$option_name = $options_data['section-id'] . '[' . $args['id'] . ']';

		// Check if our options data is saved. If not, then return empty
		if(!empty($options[$args['id']])) {
			$value = $options[$args['id']];
		} else {
			$value = '';
		}

		// Output the html while feeding in various pieces of information from our $args array in the $options_data array
		$output = '<input type="checkbox" id="' . $args['id'] . '" name="' . $option_name . '" value="1" ' . checked(1, $value, false) . '/>';

		// Output the description
		$output .= '<label for="' . $args['id'] . '"> '  . $args['description'] . '</label>';

		echo $output;
	}


	/**
	 * Creates the output for our standard dropdown menu. Pass any settings field through this callback to output
	 *
	 * @param  Array $args The array of information for the callback.
	 * @return HTML
	 */
	function starters_dropdown_callback($args) {
		global $options_data;

		// Return the data saved into the database (if the data exists...)
		$options = get_option($options_data['section-id']);

		// Set a variable for our name field here to keep the source code below clean.
		$option_name = $options_data['section-id'] . '[' . $args['id'] . ']';

		// Check if our options data is saved. If not, then return empty
		if(!empty($options[$args['id']])) {
			$value = $options[$args['id']];
		} else {
			$value = '';
		}

		// Output the html while feeding in various pieces of information from our $args array in the $options_data array
		$output = '<select name="' . $option_name . '" id="' . $args['id'] . '">';

		foreach($args['options'] as $key => $val) :
			$output .= '<option value="' . $val . '" ' . selected($value, $val, false) . '>' . $key . '</option>';
		endforeach;

		$output .= '</select>';

		// Output the description
		$output .= '<p class="description"> '  . $args['description'] . '</p>';

		echo $output;
	}


	function starters_theme_sanitize_social_options($input) {
		// Define the array for the updated options
		$output = array();

		// Loop through each of the options sanitizing the data
		foreach($input as $key => $val) {
			if(isset($input[$key])) {
				$output[$key] = esc_url_raw(strip_tags(stripslashes($input[$key])));
			}
		}

		return apply_filters('starters_theme_sanitize_social_options', $output, $input);
	}


	function starters_theme_validate_input_examples($input) {
		// Create the array for storing the validated options
		$output = array();

		foreach($input as $key => $value) {
			// Check to see if the current option has a value. If so, process it.
			if(isset($input[$key])) {
				$output[$key] = strip_tags(stripslashes($input[$key]));
			}
		}

		return apply_filters('starters_theme_validate_input_examples', $output, $input);
	}
