<?php

/**
 * @file
 * A script that is called by AJAX functionality from within EXT.
 */

/**
 * Prepares a text string for scrubbing by removing words which the end user
 * requests to be remove from the string. The return from the function
 * will most likely get passed into scrub_text() later in the procedure.
 *
 * @param $text
 *  The text which will have the tags remove from it.
 *
 * @params $tags
 *  An array of elements which will be scrubbed from the text. Do not include
 *  attributes, they will automatically be removed from the text along with
 *  the elements.
 *
 * @return string
 *  A string of text which has the requested tags removed.
 *
 * @see scrub_test()
 */
function remove_elements($text, $tags) {
  if (empty($text)) {
    return "You must include some text from which to have the text removed.";
  }
  elseif (empty($tags)) {
    return "You must include some tags for removal.";
  }
  elseif (empty($text) && empty($tags)) {
    return "You must include both text and tags for this function to work properly.";
  }
}

/**
 * Provides and abstraction to the strip_tags function with some additional
 * case switching for the type of file that is being parsed.
 *
 * @param $string
 *	A string with tags in it (or not) to be parsed and have the tags stripped.
 *
 * @param $tags
 *	The tags which will be passed into remove_elements().
 *
 * @param $type
 *	The type of file from which the tags are being stripped.
 *
 * @return string
 *	A string of scrubbed text. Generally returned via AJAX instead
 *	of a direct call.
 *
 * @see remove_elements()
 *
 */
function scrub_text($string, $tags, $type = 'default') {
	switch ($type) {
		case 'default':
			// Make the string variable a string with the requested elements removed.
			$string = remove_elements($string, $tags);
			strip_tags($string);
			break;
		case 'xml':
			// Make the string variable a string with the requested elements removed.
			$string = remove_elements($string, $tags);
			strip_tags($string);
			break;
		case 'sgml':
			// Make the string variable a string with the requested elements removed.
			$string = remove_elements($string, $tags);
			strip_tags($string);
			break;
	}
}

// Define the POST values into regular instance variables.
$string = $_POST['string'];
$type = $_POST['type'];

if (isset($string) && isset($type)) {
	return scrub_text($string, $type);
}

?>