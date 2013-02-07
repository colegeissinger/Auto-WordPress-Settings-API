<?php

	/**
	 * Settings API Definitions
	 *
	 * This page will allow us to interface with the Settings API by tossing a series of options through
	 * and array. This will allow us to narrow our focus on the data and remove all the tedious coding
	 * required to create just a simple text field or check box.
	 *
	 *	To learn how to use, please refer to the README.md file.
	 *
	 * @package Auto WordPress Settings API
	 * @version 1.1
	 * @author Cole Geissinger
	 */

	// Set the ID or name for this specific section.
	// Used to register our fields with the right section.
	$section_id = 'starters_theme_display_options';

	// Set the ID or name for the settings-id.
	// Not to be confused with $section_id, this variable will let us display fields with the correct section.
	$settings_id = 'starters_display_options';

	// Set the title of the current section.
	$section_title = 'Display Options';

	// Set the description of our current section.
	$section_desc = 'Just a test area to show what is capable right now.';


	// Begin defining our array of sections and fields.
	$options_data = array(
		'section-title' => $section_title,
		'section-desc' => $section_desc,
		'section-id' => $section_id,


		// Define our Settings Section - http://bit.ly/wRZYic
		array(
			'type' => 'settings-section',									 // Define the type of information being passed. Routes to the right function.
			'id' => $settings_id, 						 					 // ID used to identify this section and with which to register options
			'title' => '', 													 // Title to be displayed on the administration page. Left blank on purpose.
			'callback' => 'starters_section_description_callback', // Callback used to render the description of the section.
			'section' => $section_id									 	 // The section in which to add this section of options.
		),


		// Define each of our Settings Fields. These are the actual form fields and their labels - http://bit.ly/AecUgF
		array(
			'type' => 'settings-field',									 // Define the type of information being passed. Routes to the right function.
			'callback' => 'starters_text_callback', 				 	 // The name of the function responsible for rendering the option interface.
			'args' => array(													 // The array of arguments to pass to the callback.
				'id' => 'text_field',										 	 // ID used to identify the field.
				'label' => 'Text Field',										 // The label to the left of the option interface element.
				'description' => 'This field sets a text field.'		 // The Description.
			),
			'section' => $section_id, 			 							 // The section on which this option will be displayed.
			'settings-id' => $settings_id				 					 // The ID of the section to which this field belongs.
		),
		array(
			'type' => 'settings-field',
			'callback' => 'starters_checkbox_callback',
			'args' => array(
				'id' => 'checkbox',
				'label' => 'Checkboxes',
				'description' => 'We can add checkboxes!!',
				'options' => array(
					'Option 1' => 'option-1',
					'Option 2' => 'option-2',
					'Option 3' => 'option-3'
				)
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
		array(
			'type' => 'settings-field',
			'callback' => 'starters_radio_callback',
			'args' => array(
				'id' => 'radio-btns',
				'label' => 'Radio Buttons!',
				'description' => 'As of version 1.1 we can use radio buttons!',
				'options' => array(
					'Radio 1' => 'radio-1',
					'Radio 2' => 'radio-2',
					'Radio 3' => 'radio-3',
					'Radio 4' => 'radio-4'
				)
			),
			'section' => $section_id,
			'settings-id' => $settings_id,
		),


		// Add the section name found in the settings-section array (sanitization is permanent) http://bit.ly/AcJ4Z
		array(
			'type' => 'register-setting',
			'args' => array($section_id, $section_id)
		)
	); // FIN.