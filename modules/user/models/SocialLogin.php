<?php

namespace app\modules\user\models;

use GuzzleHttp\Client;
use Yii;


class SocialLogin
{
    /**
     * Get access_token social network.
     * @return object
     */
    public function getAccessToken()
    {
        $code = $_GET['code'];
        $client = new Client();
        $socialParams = Yii::$app->get('socialUserInfo')->social;
        $resultRequestToken = $client->request('GET', 'https://graph.facebook.com/v2.8/oauth/access_token?client_id='.$socialParams['$idapp'].'&code='.$code.'&client_secret='.$socialParams['$secret'].'&redirect_uri='.$socialParams['$redirect_uri'].'&fields=email&granted_scopes');
        $bodyRequestToken = $resultRequestToken->getBody();
        $objToken = json_decode($bodyRequestToken);
        $access_token = $objToken->{'access_token'};

        return $access_token;
    }

    /**
     * Get user info.
     * @param $access_token
     * @return object
     */
    public function getUserInfo($access_token)
    {
        $client = new Client();
        $query = urldecode(http_build_query(
            array(
                "access_token" => $access_token,
                "fields"	   => "first_name,last_name,email"
            )));
        $resultRequestUserInfo = $client->request('GET', 'https://graph.facebook.com/me?'.$query);
        $bodyRequestUserInfo = $resultRequestUserInfo->getBody();
        $user_info = json_decode($bodyRequestUserInfo);

        return $user_info;
    }
}