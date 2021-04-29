<?php

namespace Revolution\Hatena\Socialite;

use Laravel\Socialite\One\User;
use League\OAuth1\Client\Credentials\TokenCredentials;
use League\OAuth1\Client\Server\Server;

/**
 * http://localdisk.hatenablog.com/entry/2015/12/03/142656
 * Class HatenaServer.
 */
class HatenaServer extends Server
{
    /**
     * {@inheritdoc}
     */
    public function urlTemporaryCredentials()
    {
        $scopes = implode(',', config('services.hatena.scope'));

        return "https://www.hatena.com/oauth/initiate?scope={$scopes}";
    }

    /**
     * {@inheritdoc}
     */
    public function urlAuthorization()
    {
        return 'https://www.hatena.ne.jp/oauth/authorize';
    }

    /**
     * {@inheritdoc}
     */
    public function urlTokenCredentials()
    {
        return 'https://www.hatena.com/oauth/token';
    }

    /**
     * {@inheritdoc}
     */
    public function urlUserDetails()
    {
        return 'http://n.hatena.com/applications/my.json';
    }

    /**
     * {@inheritdoc}
     */
    public function userDetails($data, TokenCredentials $tokenCredentials)
    {
        $user = new User();

        $user->uid = $data['url_name'];
        $user->nickname = $data['display_name'];
        $user->name = $data['url_name'];
        $user->imageUrl = $data['profile_image_url'];
        $user->email = '';

        $used = ['url_name', 'display_name', 'profile_image_url'];

        foreach ($data as $key => $value) {
            if (str_contains($key, 'url')) {
                if (! in_array($key, $used)) {
                    $used[] = $key;
                }

                $user->urls[$key] = $value;
            }
        }

        // Save all extra data
        $user->extra = array_diff_key($data, array_flip($used));

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function userUid($data, TokenCredentials $tokenCredentials)
    {
        return $data['url_name'];
    }

    /**
     * {@inheritdoc}
     */
    public function userEmail($data, TokenCredentials $tokenCredentials)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function userScreenName($data, TokenCredentials $tokenCredentials)
    {
        return $data['name'];
    }
}
