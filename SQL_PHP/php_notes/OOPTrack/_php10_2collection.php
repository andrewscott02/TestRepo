<!-- Object-Oriented PHP -->
<!-- https://teamtreehouse.com/library/objectoriented-php-basics-2 -->

<?php
    class Render
    {
        public static function ListGames($games)
        {
            asort($games);
            return implode("\n", $games);
        }
    }

    class Collection
    {
        private $title;
        private $games = [];

        public function __construct($title)
        {
            $this->title = $title;
        }

        public function GetTitle()
        {
            return $this->title;
        }

        public function AddGame($game)
        {
            $this->games[] = $game;
        }

        public function GetGames()
        {
            return $this->games;
        }

        public function GetGameTitles()
        {
            $output = "Games by " . $this->title . ":\n";
            $output .= Render::ListGames($this->games);
			
			return $output;
        }
    }

    $gallery = new Collection("Larian");
    
    $gallery->AddGame("BG3");
    $gallery->AddGame("DOS2");
    $gallery->AddGame("DOS:EE");

    echo($gallery->GetGameTitles());
?>