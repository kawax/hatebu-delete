<?php

namespace App\Bookmark;

use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use SimpleXMLElement;

class Feed
{
    /**
     * @param  User  $user
     * @return SimpleXMLElement
     *
     * @throws GuzzleException
     */
    public function get(User $user): SimpleXMLElement
    {
        $feed = $user->hatenaBookmark()->feed($user->name);

        return simplexml_load_string($feed);
    }
}
