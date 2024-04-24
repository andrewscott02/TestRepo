<!-- Designing Interfaces in PHP -->
<!-- https://teamtreehouse.com/library/designing-interfaces-in-php -->

<!-- Autoloading -->
<?php
    require_once __DIR__ . "config.php"; //may not need dir
    //autoload function in config file
?>

<!-- Using Interfaces -->
<?php
    //Using the Idamageable interface in the Interfaces folder
    class Health implements IDamageable
    {
        protected $health;
        protected $maxHealth;

        public function __construct($health)
        {
            $this->maxHealth = $health;
            $this->health = $health;
        }
		
        public function TakeDamage($value)
        {
            //Hit
            $this->health -= $value;

            if ($this->health < 0)
            {
                $this->health = 0;
                echo("Died");
            }
            else
            {
                echo($this->health . "\n");
            }
        }

        public function Kill()
        {
            //Code here
        }

        public function Heal($value)
        {
            //Healed
            $this->health += $value;

            if ($this->health > $this->maxHealth)
            {
                $this->health = $this->maxHealth;
            }
        }
    }

	$object  = new Health(10);
	$object->TakeDamage(2);
	$object->TakeDamage(5);
	$object->TakeDamage(7);
?>

<!-- Using Multiple Interfaces in a Single Class -->
<?php
    //Using the Idamageable interface in the Interfaces folder
    class Health implements IDamageable, ITest
    {
        protected $health;
        protected $maxHealth;

        public function __construct($health)
        {
            $this->maxHealth = $health;
            $this->health = $health;
        }
		
        public function TakeDamage($value)
        {
            //Hit
            $this->health -= $value;

            if ($this->health < 0)
            {
                $this->health = 0;
                echo("Died");
            }
            else
            {
                echo($this->health . "\n");
            }
        }

        public function Kill()
        {
            //Code here
        }

        public function Heal($value)
        {
            //Healed
            $this->health += $value;

            if ($this->health > $this->maxHealth)
            {
                $this->health = $this->maxHealth;
            }
        }

        public function TestFunction()
        {
            //Code here
        }
    }

	$object  = new Health(10);
	$object->TakeDamage(2);
	$object->TakeDamage(5);
	$object->TakeDamage(7);
?>

<!-- Extending Interfaces -->
<?php
    //Like classes, interfaces can also extend other interfaces
    interface IHealth extends IDamageable, IHealable, IKillable
    {
        public function HealthFunction(); //Additional function only this interface implements
    }
?>

<!-- Optional Parameters -->
<?php

    interface IInterface
    {
        public function InterfaceFunction();
    }

    class Class1 implements IInterface
    {
        //Can use optional parameters in class even if interface has none
        public function InterfaceFunction($optparam = null)
        {
            //Code here
        }
    }

    class Class2 implements IInterface
    {
        public function InterfaceFunction()
        {
            //Code here
        }
    }
?>