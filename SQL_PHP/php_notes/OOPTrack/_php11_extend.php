<!-- Extending Object-Oriented PHP -->
<!-- https://teamtreehouse.com/library/extending-objectoriented-php -->

<!-- Extending with Subclasses -->
<?php
    class BaseClass
    {
        public $var1;
        public $var2;
        
        public function Function()
        {

        }
    }

    class ChildClass extends BaseClass
    {
        //Inherits properties and methods, but can also add additional ones
        public $var3;
        
        public function AnotherFunction()
        {

        }
    }

    $object = new ChildClass();
    $object->Function();

    // Finding Class Info with get_class
    var_dump(get_class($object));

    //Check Object Class with is_a()
    if (is_a($object, "ChildClass"))
    {
        echo "Object is a ChildClass";
        $object->AnotherFunction();
    }
	else
	{
		echo "Not a ChildClass";
	}
?>

<!-- Extending Multiple Classes -->
<?php
    class BaseClass
    {
        public $var1;
        public $var2;
        
        public function Function()
        {

        }
    }

    class AnotherClass
    {
        public $var3;
    }

    class ChildClass extends BaseClass
    {
        //Inherits properties and methods, but can also add additional ones
        public $var3;
    }

    $object = new ChildClass();

    $object->Function();
?>

<!-- Stripping Tags -->
<?php
    // Strips tags, but allows specified tags
    $allowedTags = "<p><br><b><strong><em><u><ol><ul><li>";
    $description = "Description with <p>good tags</p> and <a>bad tags</a>";

    $description1 = strip_tags($$description, $allowedTags); // Strips tags, but allows specified tags
    $description2 = strip_tags($$description); // Strips all tags
?>

<!-- Override and Protect Scope -->
<?php
    class BaseClass
    {
        // Protected is private from outside the class
        // but allows child classes to access them
        protected $var1;
        protected $var2;
        
        public function Function($input)
        {
            //Does one thing
        }
    }

    class ChildClass extends BaseClass
    {
        //Inherits properties and methods, but can also add additional ones
        
        protected $var3; //Protected is available in parent classes

        public function Function($input) //Overrides function in base class
        {
            parent::setValues($input); //Call to base function method
            //Overrides function in base class, doing another thing
        }
    }
?>

<!-- Static Scope -->
<?php
    class BaseClass
    {
        // Strips tags, but allows specified tags
        protected static $allowedTags = "<p><br><b><strong><em><u><ol><ul><li>";
        protected $description = "Description with <p>good tags</p> and <a>bad tags</a>";

        public static function displayAllowedTags()
        {
            return htmlspecialchars(self::$allowedTags); //Use self:: to access static properties and methods
        }

        public function getDescription()
        {
            return strip_tags($this->description, self::$allowedTags);
        }
    }

    $object = new BaseClass();

    echo $object::displayAllowedTags(); //Use :: to access static properties and methods
    echo BaseClass::displayAllowedTags(); //Can use either class or object for static properties or methods
    echo $object->getDescription();
?>

<!-- Extending Multiple Classes -->
<?php
    class BaseClass
    {
        public $var1;
        public $var2;
        
        public function Function()
        {

        }
    }

    class ChildClass extends BaseClass
    {
        //Inherits properties and methods, but can also add additional ones
        public $var3;
    }

    class GrandchildClass extends ChildClass
    {
        //Inherits from child and base
        public $var4;

        public function Function()
        {

        }
    }

    class AnotherClass extends ChildClass
    {
        //Inherits from child and base, but not from grandchild class
        public $var4;
    }

    $object = new ChildClass();

    $object->Function();
?>