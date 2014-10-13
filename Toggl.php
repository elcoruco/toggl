<?php

/**
* Toggl
*
* @author elcoruco <el.coruco@gmail.com>
*/

class Toggl{

  /*
  * config data
  * -------------------------------------------------------------------------------------
  */
  const ME_ENDPOINT        = "https://www.toggl.com/api/v8/me";
  const REPORTS_ENDPOINT   = "https://toggl.com/reports/api/v2";
  const W_REPORTS_ENDPOINT = "https://toggl.com/reports/api/v2/weekly";
  const D_REPORTS_ENDPOINT = "https://toggl.com/reports/api/v2/details";
  const S_REPORTS_ENDPOINT = "https://toggl.com/reports/api/v2/summary";

  const WORKSPACES_ENDPOINT = "https://www.toggl.com/api/v8/workspaces";

  public $token;
  public $ch;
  public $user_agent;

  /*
  * constructor
  * -------------------------------------------------------------------------------------
  */
  function __construct($token){
    // your token of the app
    $this->token = $token;
  }

  /*
  * main functions
  * -------------------------------------------------------------------------------------
  */

  // P E R S O N A L   D A T A
  //
  // get the personal info
  public function get_me(){
    return $this->make_conn(self::ME_ENDPOINT);
  }

  // R E P O R T S
  //
  // get weekly reports
  public function get_w_reports($user_agent, $workspace_id){
    $params = [
      'user_agent'   => $user_agent,
      'workspace_id' => $workspace_id
    ];
    return $this->make_conn(self::W_REPORTS_ENDPOINT, $params);
  }

  /*
  * helper functions
  * -------------------------------------------------------------------------------------
  */

  // make the call to the toggl api
  private function make_conn($url, $params = []){
    // define the curl conn
    $this->ch = curl_init();
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($this->ch, CURLOPT_USERPWD, "{$this->token}:api_token");
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // set the params, if avaliable
    $url = empty($params) ? $url : $url . '?' . @http_build_query($params);
    //curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
    //curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($this->ch, CURLOPT_URL, $url);

    // finish the thing
    $response = curl_exec($this->ch);
    curl_close($this->ch);
    return $response;
  }
}