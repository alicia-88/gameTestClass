<?php

/**
 * [Description Character]
 * 
 */

class Character
{
    protected int $health;
    protected int $rage;
    public function __construct($health, $rage)
    {
        $this->health = $health;
        $this->rage = $rage;
    }
    public function setHealth(int $health)
    {
        $this->health = $health;
    }
    public function setRage(int $rage)
    {
        $this->rage = $rage;
    }
    public function getHealth(): int
    {
        return $this->health;
    }
    public function getRage(): int
    {
        return $this->rage;
    }
}
