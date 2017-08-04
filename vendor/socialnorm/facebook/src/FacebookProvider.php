<?php namespace SocialNorm\Facebook;

use SocialNorm\Exceptions\InvalidAuthorizationCodeException;
use SocialNorm\Providers\OAuth2Provider;

class FacebookProvider extends OAuth2Provider
{
    protected $authorizeUrl = "https://www.facebook.com/dialog/oauth";
    protected $accessTokenUrl = "https://graph.facebook.com/v2.4/oauth/access_token";
    protected $userDataUrl = "https://graph.facebook.com/v2.4/me";
    protected $scope = [
        'email',
    ];
    protected $fields = [
        'email',
        'name',
        'first_name',
        'last_name',
        'age_range',
        'timezone',
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
        $url .= "?access_token={$this->accessToken}";
        $url .= "&fields=" . implode(',', $this->fields);
        return $url;
    }

    protected function requestAccessToken()
    {
        $url = $this->getAccessTokenBaseUrl();
        try {
            $response = $this->httpClient->get($url, [
                'query' => [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'redirect_uri' => $this->redirectUri(),
                    'code' => $this->request->authorizationCode(),
                ],
            ]);
        } catch (BadResponseException $e) {
            throw new InvalidAuthorizationCodeException((string) $e->getResponse());
        }
        return $this->parseTokenResponse((string) $response->getBody());
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
        return $this->getProviderUserData('name');
    }

    protected function fullName()
    {
        return $this->getProviderUserData('name');
    }

    protected function avatar()
    {
        return 'https://graph.facebook.com/v2.4/'.$this->userId().'/picture';
    }

    protected function email()
    {
        return $this->getProviderUserData('email');
    }
}
