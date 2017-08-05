<?php namespace AdamWathan\EloquentOAuthL5;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as HttpClient;
use SocialNorm\SocialNorm;
use SocialNorm\ProviderRegistry;
use SocialNorm\Request;
use SocialNorm\StateGenerator;
use AdamWathan\EloquentOAuth\Authenticator;
use AdamWathan\EloquentOAuth\EloquentIdentityStore;
use AdamWathan\EloquentOAuth\IdentityStore;
use AdamWathan\EloquentOAuth\Session;
use AdamWathan\EloquentOAuth\OAuthIdentity;
use AdamWathan\EloquentOAuth\OAuthManager;
use AdamWathan\EloquentOAuth\UserStore;

class EloquentOAuthServiceProvider extends ServiceProvider {

    protected $providerLookup = [
        'facebook' => 'SocialNorm\Facebook\FacebookProvider',
        'github' => 'SocialNorm\GitHub\GitHubProvider',
        'google' => 'SocialNorm\Google\GoogleProvider',
        'linkedin' => 'SocialNorm\LinkedIn\LinkedInProvider',
        'instagram' => 'SocialNorm\Instagram\InstagramProvider',
        'soundcloud' => 'SocialNorm\SoundCloud\SoundCloudProvider',
    ];

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->configureOAuthIdentitiesTable();
        $this->registerIdentityStore();
        $this->registerOAuthManager();
        $this->registerCommands();
    }

    protected function registerIdentityStore()
    {
        $this->app->singleton('AdamWathan\EloquentOAuth\IdentityStore', function ($app) {
            return new EloquentIdentityStore;
        });
    }

    protected function registerOAuthManager()
    {
        $this->app->singleton('adamwathan.oauth', function ($app) {
            $providerRegistry = new ProviderRegistry;
            $session = new Session($app['session']);
            $request = new Request($app['request']->all());
            $stateGenerator = new StateGenerator;
            $socialnorm = new SocialNorm($providerRegistry, $session, $request, $stateGenerator);
            $this->registerProviders($socialnorm, $request);

            if ($app['config']['eloquent-oauth.model']) {
                $users = new UserStore($app['config']['eloquent-oauth.model']);
            } else {
                if ($app['config']['auth.providers.users.model']) {
                    $users = new UserStore($app['config']['auth.providers.users.model']);
                } else {
                    $users = new UserStore($app['config']['auth.model']);
                }
            }

            $authenticator = new Authenticator(
                $app['Illuminate\Contracts\Auth\Guard'],
                $users,
                $app['AdamWathan\EloquentOAuth\IdentityStore']
            );

            $oauth = new OAuthManager($app['redirect'], $authenticator, $socialnorm);
            return $oauth;
        });
    }

    protected function registerProviders($socialnorm, $request)
    {
        if (! $providerAliases = $this->app['config']['eloquent-oauth.providers']) {
            return;
        }

        foreach ($providerAliases as $alias => $config) {
            if (isset($this->getProviderLookup()[$alias])) {
                $providerClass = $this->getProviderLookup()[$alias];

                if ($this->app->bound($providerClass)) {
                    $provider = $this->app->make($providerClass);
                } else {
                    $provider = new $providerClass($config, new HttpClient, $request);
                }

                $socialnorm->registerProvider($alias, $provider);
            }
        }
    }

    protected function getProviderLookup()
    {
        return $this->providerLookup;
    }

    protected function configureOAuthIdentitiesTable()
    {
        OAuthIdentity::configureTable($this->app['config']['eloquent-oauth.table']);
    }

    /**
     * Registers some utility commands with artisan
     * @return void
     */
    public function registerCommands()
    {
        $this->app->bind('command.eloquent-oauth.install', 'AdamWathan\EloquentOAuthL5\Installation\InstallCommand');
        $this->commands('command.eloquent-oauth.install');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['adamwathan.oauth'];
    }

}
