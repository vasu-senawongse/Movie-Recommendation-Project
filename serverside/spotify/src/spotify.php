  <?php
session_start();
require "Request.php";
require "Session.php";
require "SpotifyWebAPI.php";
require "SpotifyWebAPIException.php";

function abc(){
  $session = new SpotifyWebAPI\Session('05d568e978174c2f9af43aa81a383d12','a262530cd1524f8280a4943e7e8bab41','http://localhost/spotify/src/index.php');
  $session->requestCredentialsToken();
  $accessToken = $session->getAccessToken();
      $scopes = array('playlist-read-private','user-read-private','playlist-modify-public','user-library-read','user-read-email','user-read-recently-played');
      $authorizeUrl = $session -> getAuthorizeUrl(array('scope'=>$scopes));
      $_SESSION['spotifyToken'] = $session->getAccessToken();
      $api = new SpotifyWebAPI\ SpotifyWebAPI();
      $accessToken = $_SESSION['spotifyToken'];
      $api->setAccessToken($accessToken);
      return $api;
}

$a = abc();





function doIt($callback)
{
//set clientID, client SecretID and redirectURL got from spotify account
    $session = new SpotifyWebAPI\Session('05d568e978174c2f9af43aa81a383d12','a262530cd1524f8280a4943e7e8bab41','http://localhost/spotify/src/index.php');
      //use it to request for an access token
    $session->requestCredentialsToken();
    $accessToken = $session->getAccessToken();
        $scopes = array('playlist-read-private','user-read-private','playlist-modify-public','user-library-read','user-read-email','user-read-recently-played');
        $authorizeUrl = $session -> getAuthorizeUrl(array('scope'=>$scopes));
        $_SESSION['spotifyToken'] = $session->getAccessToken();
        $api = new SpotifyWebAPI\ SpotifyWebAPI();

        //set the token in the function and varible
        $accessToken = $_SESSION['spotifyToken'];
        $api->setAccessToken($accessToken);
    $data = $api;

    $callback($data);
}

// This is a sample callback function for doIt().
function myCallback($data)
{
  //retrieving the keyword that being sent by AJAX from the mainpage and stored it in $word
  $word = $_GET['word'];

// call the search function and sending the parameter $word for keyword and searching for album with only 1 result
  $search = $data-> search($word,'album','1');
  foreach ($search->albums->items as $lists){
    //stored the albumID of the result in an $albumID variable
$albumId =  $lists->id;
  }
//demonstrate it by using an iframe
echo  '<iframe src="https://open.spotify.com/embed?uri=spotify:album:'.$albumId.'" width="300" height="380" frameborder="0" allowtransparency="true"></iframe>';


}

// Call doIt() and pass our sample callback function's name.
doIt('myCallback');





?>
