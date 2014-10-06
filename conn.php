<?php
/** 
* Toggl connection
* ------------------------
* first, you need to create a file called .key.api
* that includes a var named $key, like this:
* <?php
* 
* $key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
*/

include_once('.key.php');

// GET THE BASIC USER DATA
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_USERPWD, "{$key}:api_token");
 curl_setopt($ch, CURLOPT_URL, 'https://www.toggl.com/api/v8/me' );
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
 $result = curl_exec($ch);

 // show the JSON response
 header("Content-Type: application/json");
 echo $result;
