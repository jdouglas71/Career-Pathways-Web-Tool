<?php
define('AWS_KEY', 'AKIAJTYFFWRURSGGNJ5Q');
define('AWS_SECRET_KEY', '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');

class ThisSite extends SiteSettings {

	public $debug = true;
	
	public $olmis_enabled = FALSE;
	public $oregon_skillset_enabled = TRUE;

	//JGD: Need to change?:
	public $lang_file = 'humboldt';
	
	function name() { return "Humboldt Career Pathways Web Tool"; }
	//JGD: NEed to change?
	function email_name() { return "Humboldt CTE Pathways"; }
	//JGD: NEed to change?
	function email() { return "helpdesk@careermaphumboldt.com"; }

	//JGD: NEed to change?
	function recipient_email() { return "helpdesk@careermaphumboldt.com"; }

	function __construct() {
		$this->DBname = 'strateg3_pathways';
		$this->DBuser = 'strateg3_pathway';
		$this->DBpass = '!!_CPT_pathway';

		$this->ConnectDB();
	}

	function base_url() { return $_SERVER['SERVER_NAME']; }
	function cache_path($folder="") { 
		//JGD: Changed.
		$base_dir = '/home/strateg3/public_html/careerpathways/cache/';
		
		if( $folder ) {
			if( !is_dir($base_dir . $folder) ) 
				mkdir($base_dir . $folder, 0777);
		}
	
		return $base_dir . $folder . '/';
	}

	function https_port() { return ""; }
	function https_server() { return $_SERVER['SERVER_NAME']; }
	function force_https_login() { return false; }

	function recaptcha_publickey() { return '6Ldg9wEAAAAAADD5_LekXYwr2W6xeSDvPSrn2ULE'; }
	function recaptcha_privatekey() { return '6Ldg9wEAAAAAAHq3SbV8Ko0VEpcUEzg-QFq1DIx6'; }
}

?>
