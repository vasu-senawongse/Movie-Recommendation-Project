<?php
require "Request.php";
require "Session.php";
require "SpotifyWebAPI.php";
require "SpotifyWebAPIException.php";

$session = new SpotifyWebAPI\Session('05d568e978174c2f9af43aa81a383d12','a262530cd1524f8280a4943e7e8bab41','http://localhost/spotify/src/index.php');
    $session->requestCredentialsToken();
    $accessToken = $session->getAccessToken();
$api = new SpotifyWebAPI\SpotifyWebAPI();
if(isset($GET['code'])){
$session = requestAccessToken($_GET['code']);
$_SESSION['spotifyToken'] = $session->getAccessToken();
header("Location:spotify/src/index.php");
}
else{
$scopes = [
'scope' => [
'playlist-read-private',
'user-read-private',
'playlist-modify-public',
'user-library-read',
'user-read-email',
'user-read-recently-played'
],
];
header('Location:' .$session->getAuthorizeUrl($scopes));
}
?>