<?php
require_once __DIR__ . './Character.php';
class Orc extends Character
{
    private int $damage;
    public function __construct(int $health, int $rage)
    {
        parent::__construct($health, $rage);
    }
    public function __toString(): string
    {
        return 'L\'Orc a une santé de ' . $this->health . ' est une rage de ' . $this->rage . '.';
    }
    public function setDamage(int $damage)
    {
        $this->damage = $damage;
    }
    public function getDamage(): int
    {
        return $this->damage;
    }
    public function attack()
    {
        $this->damage = rand(600, 800);
    }
    public function attacked(int $damage)
    {
        $this->health -= $damage;
    }
}
