<?php
require_once __DIR__ . './Character.php';
class Hero extends Character
{
    private string $weapon;
    private int $weaponDamage;
    private string $shield;
    private int $shieldValue;
    public function __construct(string $weapon, int $weaponDamage, string $shield, int $shieldValue, int $health, int $rage)
    {
        $this->setWeapon($weapon);
        $this->setWeaponDamage($weaponDamage);
        $this->setShield($shield);
        $this->shieldValue = $shieldValue;
        parent::__construct($health, $rage);
    }

    public function setWeapon(string $weapon)
    {
        $this->weapon = $weapon;
    }
    public function setWeaponDamage(int $weaponDamage)
    {
        $this->weaponDamage = $weaponDamage;
    }
    public function setShield(string $shield)
    {
        $this->shield = $shield;
    }
    public function setShieldValue(int $damage)
    {
        if ($this->shieldValue - $damage < 0) {
            $this->shieldValue = 0;
        } else {
            $this->shieldValue -= $damage;
        }
    }
    public function getWeapon(): string
    {
        return $this->weapon;
    }
    public function getWeaponDamage(): int
    {
        return $this->weaponDamage;
    }
    public function getShield(): string
    {
        return $this->shield;
    }
    public function getShieldValue(): int
    {
        return $this->shieldValue;
    }
    public function __toString(): string
    {
        return 'Mon Héro à une arme de type ' . $this->weapon . ' son attaque est de ' . $this->weaponDamage . ',<br> il posséde une armure de type ' . $this->shield . ' sa valeur de défense est de ' . $this->shieldValue . ',<br> sa santé est de ' . $this->health . ' est une rage de ' . $this->rage . '.';
    }
    public function attacked(int $damage)
    {
        if ($this->shieldValue - $damage < 0) {
            $this->health -= abs($this->shieldValue - $damage);
        }
        if ($this->getHealth() < 0) {
            $this->setHealth(0);
        }
        $this->shieldValue = round(($this->getShieldValue() - ($damage / 17)));
        $this->rage += 30;
    }
}
