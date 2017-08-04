<?php

use Mockery as M;
use SocialNorm\GitHub\GitHubProvider;
use SocialNorm\Request;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Client as HttpClient;

class GitHubProviderTest extends TestCase
{
    private function getStubbedHttpClient($fixtures = [])
    {
        $mock = new MockHandler($this->createResponses($fixtures));
        $handler = HandlerStack::create($mock);
        return new HttpClient(['handler' => $handler]);
    }

    private function createResponses($fixtures)
    {
        $responses = [];
        foreach ($fixtures as $fixture) {
            $response = require $fixture;
            $responses[] = new Response($response['status'], $response['headers'], $response['body']);
        }

        return $responses;
    }

    /** @test */
    public function it_can_retrieve_a_normalized_user()
    {
        $client = $this->getStubbedHttpClient([
            __DIR__ . '/_fixtures/github_accesstoken.php',
            __DIR__ . '/_fixtures/github_user.php',
            __DIR__ . '/_fixtures/github_email.php',
        ]);

        $provider = new GitHubProvider([
            'client_id' => 'abcdefgh',
            'client_secret' => '12345678',
            'redirect_uri' => 'http://example.com/login',
        ], $client, new Request(['code' => 'abc123']));

        $user = $provider->getUser();

        $this->assertEquals('4323180', $user->id);
        $this->assertEquals('adamwathan', $user->nickname);
        $this->assertEquals('Adam Wathan', $user->full_name);
        $this->assertEquals('adam@example.com', $user->email);
        $this->assertEquals('https://avatars.githubusercontent.com/u/4323180?v=3', $user->avatar);
        $this->assertEquals('abcdefgh12345678', $user->access_token);
    }

    /**
     * @test
     * @expectedException SocialNorm\Exceptions\ApplicationRejectedException
     */
    public function it_fails_to_retrieve_a_user_when_the_authorization_code_is_omitted()
    {
        $client = $this->getStubbedHttpClient([
            __DIR__ . '/_fixtures/github_accesstoken.php',
            __DIR__ . '/_fixtures/github_user.php',
            __DIR__ . '/_fixtures/github_email.php',
        ]);

        $provider = new GitHubProvider([
            'client_id' => 'abcdefgh',
            'client_secret' => '12345678',
            'redirect_uri' => 'http://example.com/login',
        ], $client, new Request([]));

        $user = $provider->getUser();
    }
}
