<?php
define('AWS_KEY', 'AKIAJTYFFWRURSGGNJ5Q');
define('AWS_SECRET_KEY', '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');

class ThisSite extends SiteSettings {

	public $debug = true;
	
	public $olmis_enabled = FALSE;
	public $oregon_skillset_enabled = TRUE;

	//Change if necessary. The language file refers to the file /lang/$lang_file.php and contains language specific to the site.
	public $lang_file = 'humboldt';

	//UPDATE for new site. 
	function name() { return "Humboldt Career Pathways Web Tool"; }
	//UPDATE for new site.
	function email_name() { return "Humboldt CTE Pathways"; }
	//UPDATE for new site.
	function email() { return "helpdesk@careermaphumboldt.com"; }

	//UPDATE for new site.
	function recipient_email() { return "helpdesk@careermaphumboldt.com"; }

	//UPDATE for new site.
	function __construct() {
		$this->DBname = 'wwwcaree_pathways';
		$this->DBuser = 'wwwcaree_pathway';
		$this->DBpass = '!!__CPT__pathway';

		$this->ConnectDB();
	}

	function base_url() { return $_SERVER['SERVER_NAME']; }
	function cache_path($folder="") { 
		//UPDATE for new site.
		$base_dir = '/home/wwwcaree/public_html/cache/';
		
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
