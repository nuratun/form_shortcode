<?php

class FS_Activation {
	function __construct() {
		return $this;
	}

	/**
	 * @since    0.1
	 */
	public function activate() {
		flush_rewrite_rules();
	}

}
