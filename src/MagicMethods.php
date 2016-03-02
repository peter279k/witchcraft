<?php

/*
 * This file is part of the Witchcraft package
 *
 * Copyright (c) 2014-2016 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   https://github.com/tuupola/witchcraft
 *
 */

namespace Witchcraft;

trait MagicMethods
{

    public function __call($method, $arguments)
    {
        /* Check if we have dynamic method but ignore getters and setters. */
        if (0 === preg_match("/^(get|set)/", $method)) {
            $inner_method = "get" . ucfirst($method);
            if (method_exists($this, $inner_method)) {
                $value = call_user_func([$this, $inner_method]);
                /* If value is callable run it. */
                if ($value instanceof \Closure) {
                    return call_user_func($value, $arguments[0]);
                }
            }
        }

        /* If dynamic method was not detected assume getter or setter. */
        if (count($arguments)) {

            /* Currently supports only first argument. */
            $value = $arguments[0];

            /* Called with arguments assume we should set. */
            $method = "set" . ucfirst($method);

            if (method_exists($this, $method)) {
                /* If we are setting a callable bind it to current object. */
                if (is_callable($value)) {
                    $value->bindTo($this, $this);
                }
                return call_user_func([$this, $method], $value);
            }
        } else {
            /* Called without arguments assume we should get. */
            $method = "get" . ucfirst($method);
            if (method_exists($this, $method)) {
                return call_user_func([$this, $method]);
            }
        }

        $message =  "Call to undefined method " . __CLASS__ . "::" . $method . "()";

        throw new \RuntimeException($message);
    }
}
