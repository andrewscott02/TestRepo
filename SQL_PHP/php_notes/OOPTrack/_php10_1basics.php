<!-- Object-Oriented PHP -->
<!-- https://teamtreehouse.com/library/objectoriented-php-basics-2 -->

<!-- Creating Classes and Properties -->
<?php
    class ClassName
    {
        public $objectName;
        public $arrayProperty = [];
        public $defaultValue = "default value";
    }

    $object1 = new ClassName();
    $object1->objectName; //Gets property in class
    $object1->objectName = "new name"; //Sets property in class

    $object2 = new ClassName();
    $object2->objectName; //Gets property in class
    $object2->objectName = "2nd object name"; //Sets property in class
?>

<!-- Methods in Classes -->
<?php
    class ClassName
    {
        public $objectName;

        public function GetName()
        {
            return $this->objectName;
        }
    }

    $object1 = new ClassName();
    $object1->objectName = "new name";
    echo $object1->GetName(); //Calls function
?>

<!-- Access Modifiers -->
<?php
    class ClassName
    {
        public $publicProperty;
        private $privateProperty;
        protected $protectedProperty;
    }
?>

<!-- Arrays -->
<?php
    class ClassName
    {
        private $genres = [
            "fantasy",
            "scifi",
            "horror",
            "puzzle"
        ];

        public $games = [];
        public function GetGames()
        {
            return $this->games;
        }
        public function AddGame($item, $players = 1, $genre = null)
        {
            if (!is_int($players))
            {
                exit("Players must be an int: " . gettype($players));
            }

            if ($genre != null && !in_array(strtolower($genre), $this->genres))
            {
                exit("Invalid genre");
            }

            $this->games[] = [
                "item" => ucwords($item),
                "players" => $players,
                "genre" => ucwords($genre)
            ];
        }
    }

    $object1 = new ClassName();
    $object1->AddGame("DOS 2");
    $object1->AddGame("BG3", 4, "fantasy");
    $object1->AddGame("Portal 2", 1, "puzzle");
    foreach($object1->GetGames() as $game)
    {
        echo "\n" . $game["item"] . " is a " . $game["genre"] . " game for " . $game["players"] . " players";
    }
?>

<!-- Static Methods -->
<?php
    class ClassName
    {
        public $var1;
        public $var2;
    }

    class Render
    {
        public static function DisplayRecipe($object)
        {
            return $object->var1 . " by " . $object->var2;
        }
    }

    $object = new ClassName();
    $object->var1 = "val 1";
    $object->var2 = "val 2";

    echo Render::DisplayRecipe($object);
?>

<!-- Separating Methods -->
<?php
    class ClassName
    {
        private $genres = [
            "fantasy",
            "scifi",
            "horror",
            "puzzle"
        ];

        public $games = [];
        public function GetGames()
        {
            return $this->games;
        }
        public function AddGame($item, $players = 1, $genre = null)
        {
            if (!is_int($players))
            {
                exit("Players must be an int: " . gettype($players));
            }

            if ($genre != null && !in_array(strtolower($genre), $this->genres))
            {
                exit("Invalid genre");
            }

            $this->games[] = [
                "item" => ucwords($item),
                "players" => $players,
                "genre" => ucwords($genre)
            ];
        }
    }

    $object1 = new ClassName();
    $object1->AddGame("DOS 2");
    $object1->AddGame("BG3", 4, "fantasy");
    $object1->AddGame("Portal 2", 1, "puzzle");

    class Render
    {
        public static function GetGames($object)
        {
            $gamesString ="";

            foreach($object->GetGames() as $game)
            {
                $gamesString .= "\n" . $game["item"] . " is a " . $game["genre"] . " game for " . $game["players"] . " players";
            }

            return $gamesString;
        }

        public static function DisplayGames($object)
        {
            echo self::GetGames($object); //use self to access methods/properties on classes
        }
    }

    Render::DisplayGames($object1);
?>

<!-- Magic Methods -->
<?php
    class ClassName
    {
        public $var1;
        
        // Construct Function
        public function __construct($var1 = null)
        {
            $this->var1 = $var1;
        }

        public function __toString()
        {
            return $this->var1;
        }
    }

    $object = new ClassName("this is the value");
    echo $object->var1 . "\n";
    echo $object;
?>

<!-- Magic Constants -->
<!-- 
    __CLASS__
    __DIR__ Path without file name
    __FILE__ Full path with file name
    basename(__FILE__) File name without path
    __LINE__ Gets current line
    __METHOD__ Gets name from method
 -->
<?php
    class ClassName
    {
        public $var1;
        
        // Construct Function
        public function __construct($var1 = null)
        {
            $this->var1 = $var1;
        }

        public function __toString()
        {
            $output = $this->var1 . " from " . __CLASS__ . " from " . __METHOD__ . "() at line: " . __LINE__;
            $output .= "\nYou can use the following methods from this class: ";
            $output .= "\n" . implode("\n", get_class_methods(__CLASS__));
            return $output;
        }
    }

    $object = new ClassName("this is the value");
    echo $object->var1 . "\n";
    echo $object;
?>