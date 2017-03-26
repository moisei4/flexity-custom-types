<?php

return array(

	////////////////////////////////////////
	// Localized JS Message Configuration //
	////////////////////////////////////////

	/**
	 * Validation Messages
	 */
	'validation' => array(
		'alphabet'     => __('Value needs to be Alphabet', 'flexity'),
		'alphanumeric' => __('Value needs to be Alphanumeric', 'flexity'),
		'numeric'      => __('Value needs to be Numeric', 'flexity'),
		'email'        => __('Value needs to be Valid Email', 'flexity'),
		'url'          => __('Value needs to be Valid URL', 'flexity'),
		'maxlength'    => __('Length needs to be less than {0} characters', 'flexity'),
		'minlength'    => __('Length needs to be more than {0} characters', 'flexity'),
		'maxselected'  => __('Select no more than {0} items', 'flexity'),
		'minselected'  => __('Select at least {0} items', 'flexity'),
		'required'     => __('This is required', 'flexity'),
	),

	/**
	 * Import / Export Messages
	 */
	'util' => array(
		'import_success'    => __('Import succeed, option page will be refreshed..', 'flexity'),
		'import_failed'     => __('Import failed', 'flexity'),
		'export_success'    => __('Export succeed, copy the JSON formatted options', 'flexity'),
		'export_failed'     => __('Export failed', 'flexity'),
		'restore_success'   => __('Restoration succeed, option page will be refreshed..', 'flexity'),
		'restore_nochanges' => __('Options identical to default', 'flexity'),
		'restore_failed'    => __('Restoration failed', 'flexity'),
	),

	/**
	 * Control Fields String
	 */
	'control' => array(
		// select2 select box
		'select2_placeholder' => __('Select option(s)', 'flexity'),
		// fontawesome chooser
		'fac_placeholder'     => __('Select an Icon', 'flexity'),
	),

);

/**
 * EOF
 */