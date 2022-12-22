<?php

namespace Spartan\Cache;

/**
 * Cache Facade
 *
 * @method static mixed get($key, $default = null)
 * @method static bool set($key, $value, $ttl = null)
 * @method static bool delete($key)
 * @method static bool clear()
 * @method static iterable getMultiple($keys, $default = null)
 * @method static bool setMultiple($values, $ttl = null)
 * @method static bool deleteMultiple($keys)
 * @method static bool has($key)
 *
 * @package Spartan\Cache
 * @author  Iulian N. <iulian@spartanphp.com>
 * @license LICENSE MIT
 */
class Cache
{
    const TTL_ONE_MINUTE = 60;
    const TTL_ONE_HOUR   = self::TTL_ONE_MINUTE * 60;
    const TTL_ONE_DAY    = self::TTL_ONE_HOUR * 24;
    const TTL_ONE_WEEK   = self::TTL_ONE_DAY * 7;
    const TTL_ONE_MONTH  = self::TTL_ONE_DAY * 30;
    const TTL_ONE_YEAR   = self::TTL_ONE_DAY * 365;
    const TTL_FOREVER    = self::TTL_ONE_YEAR * 100;

    /**
     * @return \Psr\SimpleCache\CacheInterface
     * @throws \ReflectionException
     * @throws \Spartan\Service\Exception\ContainerException
     * @throws \Spartan\Service\Exception\NotFoundException
     */
    public static function adapter()
    {
        return container()->get('cache');
    }

    /**
     * @param string  $name
     * @param mixed[] $args
     *
     * @return mixed
     * @throws \ReflectionException
     * @throws \Spartan\Service\Exception\ContainerException
     * @throws \Spartan\Service\Exception\NotFoundException
     */
    public static function __callStatic(string $name, array $args)
    {
        return self::adapter()->{$name}(...$args);
    }

    /**
     * @param string   $key
     * @param \Closure $callback
     * @param int      $ttl
     *
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     * @throws \Spartan\Service\Exception\ContainerException
     * @throws \Spartan\Service\Exception\NotFoundException
     */
    public static function getAlways(string $key, \Closure $callback, int $ttl = 0)
    {
        if (self::adapter()->has($key)) {
            return self::adapter()->get($key);
        }

        $value = $callback();
        self::adapter()->set($key, $value, $ttl ?: (int)getenv('CACHE_TTL'));

        return $value;
    }
}
