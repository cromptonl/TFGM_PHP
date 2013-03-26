<?php
	// TFGM API WRAPPER

	namespace Tfgm;
	
	class API {

		/**
		* Required authentication settings
		*/
		private $DevKey;
		private $AppKey;
		private $Type;

		protected $api_server = 'http://opendata.tfgm.com';

		/**
		 * Tfgm\API::__construct()
		 *
		 * @param 		string/array
		 * @access 		public
		 */
		public function __construct( $config )
		{
			if(empty($config))
				die("You must provide your TFGM DevKey along with the unique TFGM AppKey. See the example for help.");
			
			/**
			 * Enables $config to be either an array or text-based params which are then converted
			 *
			 * @example 	$config = "AppKey=123456&DevKey=789012";
			 */
			if(!is_array($config))
				parse_str($config, $config);

			/**
			 * We need the DevKey and AppKey provided by TFGM
			 */
			if(empty($config['DevKey']) or empty($config['AppKey']) or empty($config['Content-type']) or $config['DevKey'] == 'XXX' or $config['AppKey'] == 'YYY')
				die("Register at http://developer.tfgm.com");

			/**
			 * Ensure $config contains a valid string
			 */
			$this->DevKey = $config['DevKey'];
			$this->AppKey = $config['AppKey'];
			$this->Type = $config['Content-type'];

		}
 
 		/**
 		 * Tfgm\API::call()
 		 * 
 		 */
 		public function call( $address, $post = null)
 		{
 			// Check if array or string with params
 			if($post != null && !is_array($post))
 				parse_str($post, $post);

 			// Blank $headers to avoid PHP error notices
 			$headers = null;

 			// Check for DevKey and AppKey and set request headers
 			if(!empty($this->DevKey) && !empty($this->AppKey) && !empty($this->Type))

 			return $this->http( $address, $post, $headers );
 		}

 		private function http($uri, $post = false, $headers)
 		{
 			// Got cURL?
 			if ( !function_exists('curl_init') )
 				die("TFGM_PHP requires the libcurl extension (curl.haxx.se) to run.");

 			// Fire up cURL
 			$resource = curl_init();

 			curl_setopt($resource, CURLOPT_URL, $this->api_server.$uri);
 			curl_setopt($resource, CURLOPT_USERAGENT, 'TFGM_PHP');
 			curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);

 			curl_setopt($resource, CURLOPT_HTTPHEADER, array(
 				'DevKey:'.$this->DevKey, 'AppKey:'.$this->AppKey, 'Content-type:'.$this->Type
 			));

 			// Execute request and kill resource once finished
 			$result = curl_exec($resource);
 			curl_close($resource);

 			// Return JSON / XML
 			if($this->type == 'text/json')
 			{
 				return json_decode($result);
 			}
 			else
 			{
 				return simplexml_load_string($result);
 			}
 		}

	}

?>