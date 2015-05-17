<?php
/** 
* Toggl api
* ------------------------
* this thing creates an api to visualize and analyse your work on toggl.
* the connection data is stored in a file called .key.php. The file contains
* three varibles: $token, $ws and $ua. There is an example below.
*
* <?php
* 
* API token, [...] can find it under "My Profile" in the Toggl account
* $token = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
*
* // workspace_id: integer, the workspace which data you want to access
* // this integer is present in almost any url from toggl, for example in:
* // https://www.toggl.com/app/reports/summary/540728
* // the integer is at the end of the url
* $ws  = xxxxxx;
*
* // user_agent: string, the name of your application or your email address
* $ua  = "xxxxxxxxxxxxxxx";
*
*
*
* Or, just put the raw values on the methods, anything goes.
*
*/

include_once('.key.php');
include_once('Toggl.php');

if(empty($_GET)){
  header("Content-Type: application/json");
  echo json_encode([
    'response' => false, 
    'post' => $_POST,
    'get' => $_GET,
    'error' => 'show me the money first!!'
  ]);
  die();
}

// create the new toggl class
$toggl = new Toggl($token);


// GET THE BASIC USER DATA
$method = filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING);

switch ($method) {
  case 'me':
    $response = $toggl->get_me();
    break;

  case 'weekly':
    $response = $toggl->get_w_reports($ua, $ws);
    $error = null;
    break;

  default:
    $response = false;
    break;
}

// OUTPUT THE RESPONSE
header("Content-Type: application/json");
echo $response;