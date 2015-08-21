<?php
	// Let's load the required scripts for this file
	require_once(__DIR__ . DIRECTORY_SEPARATOR . 'vr_api_test.php');
	
	/**
	 * DISCLAIMER! (Please read this first)
	 * The following PHP script demonstrates the capabilities of the Test class defined in the test folder.
	 * The goal of this wrapper is to help you get started with the VR API. The wrapper provides
	 * insights into connecting and making VR API calls. You can extend this and create your own
	 * custom application. The wrapper does not cover all the API calls VR provides. For a full
	 * list of API calls VR provides, please refer to the documentation. This software is
	 * provided "as-is", please note that VerticalResponse will not maintain or update this.
	 */
	
	/**
	 * This file provides examples of all the methods in the Test class of this wrapper
	 */

	// This method is used to format the output of the examples above
	function display_response($response, $title)
	{
		// Let's print the title followed by a empty line
		echo '<br/>'.$title.'<br/><br/>';
		echo print_r($response);
		echo '<br/><br/>End of '.$title.'<br/>';
	}
	
	// Let's create a contact
	try {
		$contact = VerticalResponse\API\Test::create_contact(
				array(
						'email' => 'dummy_contact_'.time().'@verticalresponse.com'
				)
		);
		// Let's display the response of the request using the display_response function defined at the end of this file
		display_response($contact, 'Create a contact');
	} catch(Exception $e) {
		print_r("Error occurred when creating contact: " . $e->getMessage() . "\n" . $e->getTraceAsString());
		exit(1);
	}
	
	// Let's see your contacts
	try {
		$contacts = VerticalResponse\API\Test::get_contacts();
		display_response($contacts, 'List your contacts');
	} catch(Exception $e) {
		print_r("Error occurred when listing contacts: " . $e->getMessage() . "\n" . $e->getTraceAsString());
		exit(1);
	}
	
	// Let's get the details of one of your contacts
	try {
		$contact = $contacts->items[0];
		$details = VerticalResponse\API\Test::get_contact_details($contact);
		display_response($details, 'Get the details of one of your contacts');
	} catch(Exception $e) {
		print_r("Error occurred when getting details of a contact: " . $e->getMessage() . "\n" . $e->getTraceAsString());
		exit(1);
	}
	
	// Let's create a list
	try {
		$list = VerticalResponse\API\Test::create_list(
				array(
						'name' => 'Dummy list'.time()
				)
		);
		display_response($list, 'Create a list');
	} catch(Exception $e) {
		print_r("Error occurred when creating list: " . $e->getMessage() . "\n" . $e->getTraceAsString());
		exit(1);
	}
	// Let's see all your lists
	try {
		$lists = VerticalResponse\API\Test::get_lists();
		display_response($lists, 'Get your lists');
	} catch(Exception $e) {
		print_r("Error occurred when getting lists: " . $e->getMessage() . "\n" . $e->getTraceAsString());
		exit(1);
	}
	
	// Let's see the details of one of your lists
	// Let's use the lists object of the previous example ($lists)
	try {
		$list = $lists->items[0];
		$details = VerticalResponse\API\Test::list_details($list);
		display_response($details, 'Get details of one of your lists');
	} catch(Exception $e) {
		print_r("Error occurred when getting details of a list: " . $e->getMessage() . "\n" . $e->getTraceAsString());
		exit(1);
	}
	
	// Let's see the contacts that belong to one of your lists
	// Let's use the list object of the previous example ($list)
	try {
		$contacts = VerticalResponse\API\Test::get_lists_contacts($list);
		display_response($contacts, 'Get the contacts of one of your lists');
	} catch(Exception $e) {
		print_r("Error occurred when getting contacts of a list: " . $e->getMessage() . "\n" . $e->getTraceAsString());
		exit(1);
	}
	
	// Let's create a new contact in one of your lists
	// Let's use the list object of the previous example ($list)
	try {
		$contact = VerticalResponse\API\Test::create_list_contact(
				array(
						'email' => 'dummy_list_contact_'.time().'@verticalresponse.com'
				), $list
		);
		display_response($contact, 'Create a contact in a list');
	} catch(Exception $e) {
		print_r("Error occurred when creating contact in a list: " . $e->getMessage() . "\n" . $e->getTraceAsString());
		exit(1);
	}
	
	exit(0);
?>
