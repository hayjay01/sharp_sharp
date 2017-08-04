<?php namespace SocialNorm\Instagram;

use SocialNorm\Exceptions\InvalidAuthorizationCodeException;
use SocialNorm\Providers\OAuth2Provider;

class InstagramProvider extends OAuth2Provider
{
    protected $authorizeUrl = "https://api.instagram.com/oauth/authorize";
    protected $accessTokenUrl = "https://api.instagram.com/oauth/access_token";
    protected $userDataUrl = "https://api.instagram.com/v1/users/self";
    protected $scope = [
        'basic',
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

    protected function compileScopes()
    {
        return implode('+', $this->scope);
    }

    protected function parseTokenResponse($response)
    {
        return $this->parseJsonTokenResponse($response);
    }

    protected function requestUserData()
    {
        $userData = parent::requestUserData();
        return $userData;
    }

    protected function parseUserDataResponse($response)
    {
        $data = json_decode($response, true);
        return $data['data'];
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
        return $this->getProviderUserData('profile_picture');
    }

    protected function email()
    {
        return null; // Impossible to get email from Instagram
    }
}
