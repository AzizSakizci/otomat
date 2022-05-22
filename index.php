<?php
include "Automat.php";

class App extends Automat
{
    public function input($key)
    {
        switch ($key) {
            case 0:
                if (!$this->getDoor()) {
                    echo "Kapı Kapalı\n";
                    break;
                }
                $this->queryShelf(0, 1);
                $this->queryShelf(1, 1);
                $this->queryShelf(2, 1);
                $this->checkOccupancyRate();
                break;

            case 1:
                if (!$this->getDoor()) {
                    echo "Kapı Kapalı\n";
                    break;
                }
                $this->queryShelf(0, 0);
                $this->queryShelf(1, 0);
                $this->queryShelf(2, 0);
                $this->checkOccupancyRate();
                break;

            case 2:
                if (!$this->getDoor()) {
                    echo "Kapı Kapalı \n";
                    break;
                }
                $this->addProduct();
                $this->checkOccupancyRate();
                break;

            case 3:
                if (!$this->getDoor()) {
                    echo "Kapı Kapalı\n";
                    break;
                }

                $this->takeOutProduct();
                $this->checkOccupancyRate();
                break;

            case 4:
            {
                if (!$this->getDoor()) {
                    echo "Kapı Kapalı\n";
                    break;
                }
                echo $this->displayShelf(0);
                echo $this->displayShelf(1);
                echo $this->displayShelf(2);
                break;
            }

            case 5 :
            {
                $this->checkDoorStatus(1);
                break;
            }

            case 6 :
            {

                $this->checkDoorStatus(0);
                break;
            }

            default:
                Message::menu();
                break;
        }

        return $this;

    }

    public function calistir()
    {
        Message::menu();
        $key = (int)readline('Kapı kapalı !!! : Açmak için [5] Kapalılığa devamı icin [6] girmelisiniz ');
        $this->input($key);

        do {
            $key = (int)readline('Menüden Numara Seçiniz:');
            $this->input($key);

        } while ($key != 7);
    }
}

$app = new App();
$app->calistir();




