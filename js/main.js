// INITIALIZE THE APP
var App = function(){
  // make a generic XMLHttprequest to handle the connections
  var conn = new XMLHttpRequest(),
  // set the base url to make the api calls
      url  = '/toggl_api.php',
  // define return object
      app  = {
        // make the api call
        get : function(method, callback){
          conn.open('POST', url + "?method=" + method, true);
          conn.onload = callback;
          conn.send();
        }
      };
  return app;
}

// initialize the app
var toggl = new App();

// get my data
toggl.get('me', function(){
  var response = JSON.parse(this.responseText);
  console.log(response);
});
