<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session',

	/**
	 * Consumers
	 */
	'consumers' => array(


		/**
		 * Google
		 */
		'Google' => array(
			'client_id'     => '629574582444-88t193ull6utjkv15mn5l5aqqp8k28jr.apps.googleusercontent.com',
			'client_secret' => 'aF3WWOkoddWX3qVRB8Y2Cpbt',
			'scope'         => array('userinfo_email', 'userinfo_profile'),
		),

		/**
		 * Github
		 */
		'GitHub' => array(
			'client_id'     => 'd5864d1cb15d5bd5a65b',
			'client_secret' => '630485d3741bd8c40d95481a5831797659c9aa1d'
		),

		/**
		 * Linkedin
		 */
		'Linkedin' => array(
			'client_id'     => '77cdd1bp1kq3cd',
			'client_secret' => 'IDnlpfi5HeK5arTR',
			'scope'         => array('r_emailaddress', 'r_basicprofile'),
		),

	)

);