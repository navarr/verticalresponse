<?php
  namespace VerticalResponse\API;
  // Let's load the required scripts for this file
  require_once(__DIR__ . DIRECTORY_SEPARATOR . 'vr_api_response.php');
  require_once(__DIR__ . DIRECTORY_SEPARATOR . 'vr_api_exception.php');

  /**
   * Base class that handles the calls and responses made to the VR API.
   */
  class VR_APIClient {
    // Attributes
    // This is the base URI for the VR API
    const ROOT_URL = 'https://vrapi.verticalresponse.com/api/v1/';

    public $response;
    
    /*
     * Class constructor
     */
    public function __construct($response) {
    	$this->response = $response;
    }
    
    /*
     * Return the ID of the current object based on the response
     */
    public function id() {
    	return $this->response->attributes['id'];
    }
    
    /*
     * Makes a GET request to the VR API
     * Returns the API response in the form of an associative array
     */
    public function get($url, $parameters = array()) {
    	$url = self::build_request_url($url, $parameters);
    	
      	$ch = self::initialize_curl($url);
      	
      	return self::perform_request($ch);
    }

    /* 
     * Makes a POST request to the VR API
     * Returns the API response in the form of an associative array
     */
    public function post($url, $parameters = array()) {
    	$url = self::build_request_url($url);
    	
      	$ch = self::initialize_curl($url);
      	curl_setopt($ch, CURLOPT_POST, 1);
      	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
      
      	return self::perform_request($ch);
    }

    /*
     * Performs the call to the VR API, and handles the response
     * If any CURL-related errors ocurred during the request, it throws a CURL_Error exception
     * If the API response request got any errors, it throws a VR_API_Error exception
     * Returns the response in the form of an associative array
     */
    public function perform_request($ch) {
      	// Execute the request
      	$response = curl_exec($ch);
      	
      	// Check if curl had an error while processing the request
      	if(curl_error($ch)) {
        	// Throw a new CURL_Error
        	throw new CURL_Error("Error in curl while processing request: ".curl_error($ch), curl_errno($ch));
      	}
      	
      	// Decode the json response
      	$decoded_response = json_decode($response, true);
      	
      	if(!isset($decoded_response)) {
      		$decoded_response = json_decode(
      			json_encode(
      				array(
      					"error" => array("code" => -1, "message" => "JSON returned is not valid.\n" . $response)
      				)
      			), true
      		);
      	}
      	
      	// Check if the VR API response has any errors
      	if(self::got_errors($decoded_response)) {
      		// Close the curl request
      		curl_close($ch);
      		
        	// Throw a new VR_API_Error
        	throw new VR_API_Error($decoded_response['error']);
      	}

      	// Close the curl request
      	curl_close($ch);

      	// Return the JSON decoded response
      	return $decoded_response;
    }

    /*
     * Build a request url with query string parameters
     */
    protected function build_request_url($url, $parameters = array()) {
    	self::add_access_token_to_query_string($parameters);
    	
    	$url .= (strpos($url, '?') !== false) ? "&" : "?";
    	$url .= http_build_query($parameters);
    	
    	return $url;
    }

    /*
     * Checks if the VR API response has errors
     */
    protected function got_errors($response) {
      	// Check if the response has errors
      	return array_key_exists("error", $response) && sizeof($response["error"]) > 0;
    }

    /*
     * Initializes the CURL object with common option settings
     */
    protected function initialize_curl($url) {
      	$ch = curl_init();
      	curl_setopt($ch, CURLOPT_URL, $url);
      	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          	'Content-Type: application/json; charset=utf-8'
        	)
      	);
      	
      	return $ch;
    }
    
    /*
     * Append the access token to the query string
     */
    protected function add_access_token_to_query_string(&$parameters) {
    	$parameters['access_token'] = getenv('VR_API_ACCESS_TOKEN');
    }
  }
?>

