<?php

namespace App\Service;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Cache\CacheItemInterface;

class MixRepository 
{

    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheInterface $cache
        )
    {
        //
    }

    public function findAll(): ?array
    {
        return $this->cache->get('mixes data', function(CacheItemInterface $cacheItemInterface) {
            $cacheItemInterface->expiresAfter(5);
            $response = $this->httpClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
            return $response->toArray();
        });
    
    }
}