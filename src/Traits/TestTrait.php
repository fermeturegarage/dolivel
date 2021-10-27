<?php

namespace Fermeturegarage\Dolivel\Traits;

trait TestTrait
{
    public function hello($sName = 'World')
    {
        echo 'Hello '.$sName.' !<br>';
    }
    public function direct()
    {
        echo 'Hello direct<br>';
    }
    public static function static()
    {
        echo 'Hello static<br>';
    }
}
