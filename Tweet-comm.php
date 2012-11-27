<?php


require_once('twitterOauth/twitterOauth/twitteroauth.php');

$CONSUMER_KEY = '?';
$CONSUMER_SECRET = '?';
$ACCESS_TOKEN = '?';
$ACCESS_TOKEN_SECRET = '?';


$username = $argv[1];
$URL = 'https://github.com/'.$username.'.atom';


/*
*
* @param $URL : XML file path
* return : entire XML file
*
*/


function get_XML_file ($URL)
{

	$output = file_get_contents($URL);
    return $output;

}


$XML_file = get_XML_file($URL);
$xml = new SimpleXMLElement($XML_file);

$text = $xml->entry[0]->title;
$link = $xml->entry[0]->link['href'];
$final_tweet = '#Github '.$text.' > '.$link.'';


$session = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);


print " [./] .. Sending tweet .. \n";

$session->post('statuses/update', array('status' => "$final_tweet"));

print " [./DONE] Tweet sent."


?>




