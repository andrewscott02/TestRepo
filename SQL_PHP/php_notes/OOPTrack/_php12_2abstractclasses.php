<!-- Designing Interfaces in PHP -->
<!-- https://teamtreehouse.com/library/designing-interfaces-in-php -->

<!-- Abstract Classes -->
<?php
    //Like interfaces
    //Drawback, can only inherit from one class at a time, including abstract classes

    abstract class AbstractClass
    {
        public abstract function PubFunc();
        
        
        protected abstract function ProtFunc();
        
        //Cannot define private abstract functions
        //private abstract function PrivFunc();
    }

    class BaseClass extends AbstractClass
    {
        public function PubFunc()
        {
            //code here
        }
        
        
        protected function ProtFunc()
        {
            //code here
        }
    }

    //Cannot instantiate abstract classes
    //$object = new AbstractClass();
?>

<!-- 
    Use cases for Abstract Classes:
    * Do you need access modifiers other than public?
    * Will a lot of related classes share the interface methods?
 -->