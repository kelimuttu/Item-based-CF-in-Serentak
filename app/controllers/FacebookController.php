<?php
session_start();
// added in v4.0.0
require_once 'fb_autoload.php';
//require_once __DIR__.'/fb_autoload.php';
//require 'functions.php'; // Include functions

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphUser;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;

class FacebookController extends BaseController {

  public function masuk(){
  FacebookSession::setDefaultApplication(Config::get('facebook.appId'), Config::get('facebook.secret'));
  $helper = new  FacebookRedirectLoginHelper(url('/fblogin'));
  $scope = array('email');

  $session = $helper->getSessionFromRedirect();
 

    if ( isset( $session ) ) {
        //return Redirect::to('/bergabung');
        $request = new FacebookRequest( $session, 'GET', '/me' );
        $response = $request->execute();
        // get response
        $graphObject = $response->getGraphObject();
        $fbid = $graphObject->getProperty('id');              // To Get Facebook ID
        $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
        $femail = $graphObject->getProperty('email');

        Session::put('logged_in', '1');
        Session::put('level', 'user');
        Session::put('user_name', $fbfullname);
        Session::put('fbid', $fbid);

        //$fbcheck = $this->checkuser($fbid,$fbfullname,$femail);
        $fbcheck = $this->check($fbid);
        if ($fbcheck == TRUE) {
          $data = array(
          'fbname'=>$fbfullname,
          'fbemail' =>$femail
          );
          Users::where('fbid', '=', $fbid)->update($data);
          $userid = Users::where('fbid', '=', $fbid)->first()->id;
          Session::put('user_id', $userid);
          return Redirect::to('/beranda');
        }else{
          Users::create($data); 
          $userid = Users::where('fbid', '=', $fbid)->first()->id;
          Session::put('user_id', $userid);
          return View::make('selamat_bergabung');
        }

    }else {
      $loginUrl = $helper->getLoginUrl($scope);
      return Redirect::to($loginUrl);
    }
  }

  public function check($fbid) {
    $check = Users::where('fbid', '=', $fbid)->count();
    if (empty($check)) { 
        return FALSE;
      // Users::create($data); 
      } else {    
        return TRUE;
        // Users::where('fbid', '=', $fbid)->update($data);
      }
  }

    // public function checkuser($fbid,$fbname,$fbemail) {
  //   $data = array(
  //     'fbid'=>$fbid,
  //     'fbname'=>$fbname,
  //     'fbemail' =>$fbemail
  //     );
  //   $check = Users::where('fbid', '=', $fbid)->count();
  //   if (empty($check)) { 
  //     Users::create($data); 
  //     } else {    
  //       Users::where('fbid', '=', $fbid)->update($data);
  //     }
  // }

}