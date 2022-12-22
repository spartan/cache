<?php

namespace Spartan\Cache;

use Laminas\Cache\Service\StorageAdapterFactoryInterface;
use Laminas\Cache\Psr\CacheItemPool\CacheItemPoolDecorator;
use Laminas\Cache\Psr\SimpleCache\SimpleCacheDecorator;
use Laminas\Cache\Storage\Adapter\Memcached;
use Laminas\Cache\Storage\Adapter\Memcached\AdapterPluginManagerDelegatorFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;
use Spartan\Service\Container;
use Spartan\Service\Definition\ProviderInterface;
use Spartan\Service\Pipeline;

/**
 * ServiceProvider Cache
 *
 * @package Spartan\Cache
 * @author  Iulian N. <iulian@spartanphp.com>
 * @license LICENSE MIT
 */
class ServiceProvider implements ProviderInterface
{
    /** @var mixed[] */
    protected array $config = [];

    /**
     * ServiceProvider constructor
     */
    public function __construct()
    {
        $this->config = require './config/cache.php';
    }

    /**
     * @return mixed[]
     */
    public function singletons(): array
    {
        return [
            'cache' => $this->config['standard'] == 'psr6'
                ? CacheInterface::class
                : CacheItemPoolInterface::class,

            CacheInterface::class         => function ($container) {
                $adapterName = $this->config['adapter'];
                $options     = $this->config[$this->config['adapter']];
                $plugins     = $this->config['plugins']; // not implemented

                $storageClassName = 'Laminas\\Cache\\Storage\\Adapter\\' . ucfirst($adapterName);
                $storage          = new $storageClassName($options);

                return new SimpleCacheDecorator($storage);
            },

            CacheItemPoolInterface::class => function ($container) {
                $adapterName = $this->config['adapter'];
                $options     = $this->config[$this->config['adapter']];
                $plugins     = $this->config['plugins']; // not implemented

                $storageClassName = 'Laminas\\Cache\\Storage\\Adapter\\' . ucfirst($adapterName);
                $storage          = new $storageClassName($options);

                return new CacheItemPoolDecorator($storage);
            },
        ];
    }

    /**
     * @param ContainerInterface $container
     * @param Pipeline           $handler
     *
     * @return ContainerInterface
     */
    public function process(ContainerInterface $container, Pipeline $handler): ContainerInterface
    {
        /** @var Container $container */
        return $handler->handle(
            $container->withBindings($this->singletons())
        );
    }
}
