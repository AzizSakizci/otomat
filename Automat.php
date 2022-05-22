<?php

require_once 'Settings.php';
require_once 'Message.php';

class Automat
{
    private $door_status = null;
    private $shelf = null; //3
    private $capacity = null; //20
    private $raf = array();

    public function __construct()
    {
        $this->shelf = SETTINGS::SHELF;
        $this->capacity = SETTINGS::CAPACITY;
        $this->initialParameters();
    }

    /*
     * Space is allocated according to the shelf and capacity
     * Initially considered empty
    */
    public function initialParameters()
    {
        for ($i = 0; $i < $this->shelf; $i++) {
            for ($j = 0; $j < $this->capacity; $j++) {
                $this->raf[$i][$j] = 0;
            }
        }
    }

    public function checkDoorStatus($value)
    {
        $this->door_status = $value;
        return $this->door_status ? 1 : 0;


    }

    public function getDoor()
    {
        return $this->door_status;
    }

    /*
    * Controlling Occupancy Rate
    */
    public function checkOccupancyRate()
    {
        $full = 0;
        $empty = 0;

        for ($i = 0; $i < $this->shelf; $i++) {
            $full += $this->fullShelf($i);
            $empty += $this->spaceShelf($i);
        }

        if ($full == ($this->shelf * $this->capacity)) {
            echo Message::content("RATE_OF_FULL") . Message::content("FULL");
        } elseif ($empty == ($this->shelf * $this->capacity)) {
            echo Message::content("RATE_OF_FULL") . Message::content("EMPTY");
        } else {
            echo Message::content("RATE_OF_FULL") . Message::content("PARTIALLY_FULL");
        }
    }


    /*
     * How many empty pieces are on the shelf?
     */
    public function spaceShelf($shelf)
    {
        if (in_array(0, $this->raf[$shelf])) {
            $spaceCount = array_count_values($this->raf[$shelf]);
            return $spaceCount[0];
        }
        return 0;
    }

    /*
     * How many full pieces are on the shelf?
     */
    public function fullShelf($shelf)
    {
        if (in_array(1, $this->raf[$shelf])) {
            $spaceCount = array_count_values($this->raf[$shelf]);
            return $spaceCount[1];
        }
        return 0;
    }


    public function displayShelf($shelf)
    {
        $result = "";
        foreach ($this->raf[$shelf] as $raf) {
            $result .= $raf ? " Dolu" : " Boş";
        }
        return ($shelf + 1) . ".Raf :" . $result . "\n";
    }

    /*
     * Empty or fill all for testing
    */
    public function queryShelf($shelf, $value)
    {
        for ($i = 0; $i < $this->capacity; $i++) {
            $this->raf[$shelf][$i] = $value;
        }
        if ($value) {
            echo ($shelf + 1) . ". Raf Test Amaçlı Dolu Varsayıldı" . "\n";
        } else {
            echo ($shelf + 1) . ". Raf Test Amaçlı Boş Varsayıldı" . "\n";
        }
    }


    public function takeOutProduct()
    {
        for ($i = 0; $i < $this->shelf; $i++) {
            $checkCount = $this->fullShelf($i);
            if ($checkCount) {
                $findIndex = array_search(1, $this->raf[$i]);
                $this->raf[$i][$findIndex] = 0;
                return Message::content("SUCCESS_PULL");
            }
        }
        return Message::content("STATE_EMPTY");
    }

    public function addProduct()
    {
        for ($i = 0; $i < $this->shelf; $i++) {
            $checkCount = $this->spaceShelf($i);
            if ($checkCount) {
                $findIndex = array_search(0, $this->raf[$i]);
                $this->raf[$i][$findIndex] = 1;
                return Message::content("SUCCESS_PUSH");
            }
        }
        return Message::content("STATE_FULL");
    }
}
