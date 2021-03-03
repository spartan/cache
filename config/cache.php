<?php

return [
    /*
     * Cache adapters:
     * - apc
     * - apcu
     * - dba
     * - file
     * - memcached
     * - redis
     * - memory
     * - mongo
     *
     * Full list:
     * @see https://docs.laminas.dev/laminas-cache/storage/adapter/
     */
    'adapter'    => getenv('CACHE_ADAPTER') ?: 'memory',

    /*
     * Cache standard
     * - psr6
     * - psr16
     *
     * @see https://www.php-fig.org/psr/psr-6/
     * @see https://www.php-fig.org/psr/psr-16/
     */
    'standard'   => 'psr6',

    /*
     * Cache plugins
     *
     * @see https://docs.laminas.dev/laminas-cache/storage/plugin/
     */
    'plugins'    => [],

    /*
     * APC cache adapter
     *
     * @see https://docs.laminas.dev/laminas-cache/storage/adapter/#the-apc-adapter
     */
    'apc'        => [
        'namespace' => getenv('APP_SLUG'),
        'ttl'       => getenv('CACHE_TTL') ?: 60,
    ],

    /*
     * APCu cache adapter
     *
     * You have to install it as additional storage
     *
     * @see https://github.com/laminas/laminas-cache-storage-adapter-apcu
     */
    'apcu'       => [
        'namespace' => getenv('APP_SLUG'),
        'ttl'       => getenv('CACHE_TTL') ?: 60,
    ],

    /*
     * Dba cache adapter
     *
     * @see https://docs.laminas.dev/laminas-cache/storage/adapter/#the-dba-adapter
     */
    'dba'        => [
        'namespace' => getenv('APP_SLUG'),
        'ttl'       => getenv('CACHE_TTL') ?: 60,
    ],

    /*
     * Filesystem cache adapter
     *
     * @see https://docs.laminas.dev/laminas-cache/storage/adapter/#the-filesystem-adapter
     */
    'filesystem' => [
        'namespace' => getenv('APP_SLUG'),
        'ttl'       => getenv('CACHE_TTL') ?: 60,
    ],

    /*
     * Memcached cache adapter
     *
     * @see https://docs.laminas.dev/laminas-cache/storage/adapter/#the-memcached-adapter
     */
    'memcached'  => [
        'namespace' => getenv('APP_SLUG'),
        'ttl'       => getenv('CACHE_TTL') ?: 60,
        'servers'   => [],
    ],

    /*
     * Redis cache adapter
     *
     * @see https://docs.laminas.dev/laminas-cache/storage/adapter/#the-redis-adapter
     */
    'redis'      => [
        'namespace' => getenv('APP_SLUG'),
        'ttl'       => getenv('CACHE_TTL') ?: 60,
    ],

    /*
     * Memory cache adapter
     *
     * @see https://docs.laminas.dev/laminas-cache/storage/adapter/#the-memory-adapter
     */
    'memory'     => [
        'namespace' => getenv('APP_SLUG'),
        'ttl'       => 0,
    ],

    /*
     * Mongo cache adapter
     *
     * @see https://docs.laminas.dev/laminas-cache/storage/adapter/#the-mongodb-adapter
     */
    'mongo'     => [
        'namespace' => getenv('APP_SLUG'),
        'ttl'       => getenv('CACHE_TTL') ?: 300,
    ],
];
