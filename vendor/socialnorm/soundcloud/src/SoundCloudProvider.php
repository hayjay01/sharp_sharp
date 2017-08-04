<?php namespace SocialNorm\SoundCloud;

use SocialNorm\Exceptions\InvalidAuthorizationCodeException;
use SocialNorm\Providers\OAuth2Provider;

class SoundCloudProvider extends OAuth2Provider
{
    protected $authorizeUrl = "https://soundcloud.com/connect";
    protected $accessTokenUrl = "https://api.soundcloud.com/oauth2/token";
    protected $userDataUrl = "https://api.soundcloud.com/me.json";
    protected $scope = [
        'non-expiring',
    ];

    protected $headers = [
        'authorize' => [],
        'access_token' => ['Content-Type' => 'application/x-www-form-urlencoded'],
        'user_details' => [],
    ];

    protected function getAuthorizeUrl()
    {
        return $this->authorizeUrl;
    }

    protected function getAccessTokenBaseUrl()
    {
        return $this->accessTokenUrl;
    }

    protected function getUserDataUrl()
    {
        return $this->userDataUrl;
    }

    protected function buildUserDataUrl()
    {
        $url = $this->getUserDataUrl();
        $url .= "?oauth_token=".$this->accessToken;
        return $url;
    }

    protected function parseTokenResponse($response)
    {
        return $this->parseJsonTokenResponse($response);
    }

    protected function parseUserDataResponse($response)
    {
        return json_decode($response, true);
    }

    protected function userId()
    {
        return $this->getProviderUserData('id');
    }

    protected function nickname()
    {
        return $this->getProviderUserData('username');
    }

    protected function fullName()
    {
        return $this->getProviderUserData('full_name');
    }

    protected function avatar()
    {
        return $this->getProviderUserData('avatar_url');
    }

    protected function email()
    {
        return null; // Impossible to get email from SoundCloud
    }
}
