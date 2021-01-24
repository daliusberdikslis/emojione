<?php

namespace Emojione;

use BadMethodCallException;

class Emojione
{
    public static bool $ascii = false;
    public static ?Ruleset $ruleset = null;
    protected static ?ClientInterface $client = null;

    /**
     * Magic caller
     *
     * @param $method
     * @param $args
     * @return mixed
     * @throws BadMethodCallException If the method doesn't exists in client
     */
    public static function __callStatic($method, $args)
    {
        $client = static::getClient();
        $client->ascii = static::$ascii;

        if (!method_exists($client, $method)) {
            throw new BadMethodCallException('The method "' . $method . '" does not exist.');
        }

        return call_user_func_array([$client, $method], $args);
    }

    /**
     * Get the Client
     *
     * @return ClientInterface The Client
     */
    public static function getClient(): ClientInterface
    {
        if (static::$client === null) {
            static::setClient(new Client(new Ruleset()));
        }

        return static::$client;
    }

    /**
     * Set the Client
     *
     * @param ClientInterface $client
     * @return void
     */
    public static function setClient(ClientInterface $client): void
    {
        static::$ascii = $client->ascii;
        static::$client = $client;
        static::$ruleset = new Ruleset();
    }
}