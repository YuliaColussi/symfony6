<?php

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Bridge\Twig\Command\DebugCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class MixRepository
{

    public function __construct(
        private HttpClientInterface $githubContentClient,
        private CacheInterface $cache,
        #[Autowire('%kernel.debug%')]
        private bool $isDebug,
        #[Autowire(service: 'twig.command.debug')]
        private DebugCommand $twigDebugCommand
    ) {
        //
    }

    public function findAll(): ?array
    {
        /*$output = new BufferedOutput();
        $this->twigDebugCommand->run(new ArrayInput([]), $output);
        dd($output);*/
        return $this->cache->get('mixes data', function (CacheItemInterface $cacheItemInterface) {
            $cacheItemInterface->expiresAfter($this->isDebug ? 5 : 60);
            $response = $this->githubContentClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
            return $response->toArray();
        });
    }
}
