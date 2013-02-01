<?php

	// Set the ID or name for this specific section
	$section_id = 'starters_theme_display_options';

	// Set the ID or name for the settings-id
	$settings_id = 'starters_display_options';

	// Set the title of the current section.
	$section_title = 'Display Options';

	// Set the description of our current section.
	$section_desc = 'Just a test area to show what is capable right now.';


	// Begin defining our array of information.
	$options_data = array(
		'section-title' => $section_title,
		'section-desc' => $section_desc,
		'section-id' => $section_id,


		// Define our Settings Section http://bit.ly/wRZYic
		array(
			'type' => 'settings-section',									 // Define the type of function this data is for
			'id' => $settings_id, 						 // ID used to identify this section and with which to register options
			'title' => '', 													 // Title to be displayed on the administration page
			'callback' => 'starters_section_description_callback', // Callback used to render the description of the section
			'section' => $section_id									 // The section on which to add this section of options
		),


		// Define each of our Settings Fields. These are the actual form fields and their labels. http://bit.ly/AecUgF
		array(
			'type' => 'settings-field',									 // Define the type of function this data is for
			'callback' => 'starters_text_callback', 				 	 // The name of the function responsible for rendering the option interface
			'args' => array(													 // The array of arguments to pass to the callback.
				'id' => 'text_field',										 	 // ID used to identify the field throughout the theme
				'label' => 'Text Field',										 // The label to the left of the option interface element
				'description' => 'This field sets a text field.'		 // The Description
			),
			'section' => $section_id, 			 							 // The section on which this option will be displayed
			'settings-id' => $settings_id				 					 // The ID of the section to which this field belongs
		),
		array(
			'type' => 'settings-field',
			'callback' => 'starters_checkbox_callback',
			'args' => array(
				'id' => 'checkbox',
				'label' => 'Checkboxes',
				'description' => 'We can add checkboxes!!'
			),
			'section' => $section_id,
			'settings-id' => $settings_id
		),
		array(
			'type' => 'settings-field',
			'callback' => 'starters_textarea_callback',
			'args' => array(
				'id' => 'textarea',
				'label' => 'Textarea',
				'description' => 'Set the textarea. <strong>We can even add HTML</strong>'
			),
			'section' => $section_id,
			'settings-id' => $settings_id,
		),
		array(
			'type' => 'settings-field',
			'callback' => 'starters_dropdown_callback',
			'args' => array(
				'id' => 'dropdown',
				'label' => 'Dropdowns',
				'description' => 'We can also generate dropdowns',
				'options' => array(
					'Option 1' => 'option-1',
					'Option 2' => 'option-2',
					'Option 3' => 'option-3'
				)
			),
			'section' => $section_id,
			'settings-id' => $settings_id,
		),


		// Add the section name found in the settings-section array http://bit.ly/AcJ4Z
		array(
			'type' => 'register-setting',
			'args' => array($section_id, $section_id)
		)
	); // FIN.