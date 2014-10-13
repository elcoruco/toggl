<?php
/** 
* Toggl connection test
* ------------------------
* for this example, you need to create a file called .key.php
* that includes your keys, something like this:
*
* <?php
* 
* API token, [...] can find it under "My Profile" in the Toggl account
* $token = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
*
* // workspace_id: integer, the workspace which data you want to access
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

// create the new toggl class
$toggl = new Toggl($token);

// GET THE BASIC USER DATA
//$me = $toggl->get_me();

// GET THE REPORTS
$reports = $toggl->get_w_reports($ua, $ws);

// OUTPUT THE RESPONSE
header("Content-Type: application/json");
echo $reports;