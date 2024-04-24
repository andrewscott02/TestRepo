<?php

    interface IDamageable
    {
        //Can only define methods, not properties
        //Methods must be public
        public function TakeDamage($value);
        public function Kill();
        public function Heal($value);
    }