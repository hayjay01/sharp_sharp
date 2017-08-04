<?php namespace SocialNorm\GitHub;

use SocialNorm\Exceptions\InvalidAuthorizationCodeException;
use SocialNorm\Providers\OAuth2Provider;

class GitHubProvider extends OAuth2Provider
{
    protected $authorizeUrl = "https://github.com/login/oauth/authorize";
    protected $accessTokenUrl = "https://github.com/login/oauth/access_token";
    protected $userDataUrl = "https://api.github.com/user";
    protected $scope = [
        'user:email',
    ];

    protected $headers = [
        'authorize' => [],
        'access_token' => [
            'Accept' => 'application/json'
        ],
        'user_details' => [
            'Accept' => 'application/vnd.github.v3'
        ],
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

    protected function parseTokenResponse($response)
    {
        return $this->parseJsonTokenResponse($response);
    }

    protected function requestUserData()
    {
        $userData = parent::requestUserData();
        $userData['email'] = $this->requestEmail();
        return $userData;
    }

    protected function requestEmail()
    {
        $url = $this->getEmailUrl();
        $emails = $this->getJson($url, $this->headers['user_details']);
        return $this->getPrimaryEmail($emails);
    }

    protected function getEmailUrl()
    {
        $url = $this->getUserDataUrl() .'/emails';
        $url .= "?access_token=".$this->accessToken;
        return $url;
    }

    public function getJson($url, $headers)
    {
        $response = $this->httpClient->get($url, ['headers' => $headers]);
        return json_decode($response->getBody(), true);
    }

    protected function getPrimaryEmail($emails)
    {
        foreach ($emails as $email) {
            if ($email['primary']) {
                return $email['email'];
            }
        }
        return $emails[0]['email'];
    }

    protected function parseUserDataResponse($response)
    {
        $data = json_decode($response, true);
        return $data;
    }

    protected function userId()
    {
        return $this->getProviderUserData('id');
    }

    protected function nickname()
    {
        return $this->getProviderUserData('login');
    }

    protected function fullName()
    {
        return $this->getProviderUserData('name');
    }

    protected function avatar()
    {
        return $this->getProviderUserData('avatar_url');
    }

    protected function email()
    {
        return $this->getProviderUserData('email');
    }
}
