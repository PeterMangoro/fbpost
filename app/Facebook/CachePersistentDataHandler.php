<?php

namespace App\Facebook;

use Facebook\PersistentData\PersistentDataInterface;
use Illuminate\Cache\CacheManager;

class CachePersistentDataHandler implements PersistentDataInterface
{
    protected $cache;
    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    public function get($key)
    {
        if ($value = $this->cache->pull($key)) {
            $this->cache->forget($key);
        }

        return $value;
    }

    public function set($key, $value)
    {
        $this->cache->put($key, $value);
    }
}
