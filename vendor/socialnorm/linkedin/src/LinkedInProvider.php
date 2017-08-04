<?php namespace SocialNorm\LinkedIn;

use SocialNorm\Exceptions\InvalidAuthorizationCodeException;
use SocialNorm\Providers\OAuth2Provider;

class LinkedInProvider extends OAuth2Provider
{
    protected $authorizeUrl = "https://www.linkedin.com/uas/oauth2/authorization";
    protected $accessTokenUrl = "https://www.linkedin.com/uas/oauth2/accessToken";
    protected $userDataUrl = "https://api.linkedin.com/v1/people/~";
    protected $scope = [
        'r_basicprofile',
        'r_emailaddress',
    ];
    protected $profileFields = [
        'id',
        'first-name',
        'last-name',
        'email-address',
        'picture-url',
    ];

    protected function compileScopes()
    {
        return implode(' ', $this->scope);
    }

    protected function getAuthorizeUrl()
    {
        return $this->authorizeUrl;
    }

    protected function getAccessTokenBaseUrl()
    {
        $queryString = "code=".$this->request->authorizationCode();
        $queryString .= "&client_id=".$this->clientId;
        $queryString .= "&client_secret=".$this->clientSecret;
        $queryString .= "&redirect_uri=".$this->redirectUri();
        $queryString .= "&grant_type=authorization_code";
        return $this->accessTokenUrl ."?" . $queryString;
    }

    protected function getUserDataUrl()
    {
        return $this->userDataUrl;
    }

    protected function parseTokenResponse($response)
    {
        return $this->parseJsonTokenResponse($response);
    }

    protected function buildUserDataUrl()
    {
        $url = $this->getUserDataUrl();
        $url .= ':('.$this->compileProfileFields().')';
        $url .= '?format=json';
        $url .= "&oauth2_access_token=".$this->accessToken;
        return $url;
    }

    protected function compileProfileFields()
    {
        return implode(',', $this->profileFields);
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
        return $this->getProviderUserData('emailAddress');
    }

    protected function fullName()
    {
        return $this->getProviderUserData('firstName') . ' ' . $this->getProviderUserData('lastName');
    }

    protected function avatar()
    {
        return $this->getProviderUserData('pictureUrl');
    }

    protected function email()
    {
        return $this->getProviderUserData('emailAddress');
    }
}
