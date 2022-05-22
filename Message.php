<?php

class Message
{
    public static function content($text)
    {

        $textToResponse =
            [

                "SUCCESS_PULL" => "Satın Alma İşlemi Başarılı" . "\n",
                "SUCCESS_PUSH" => "Yükleme İşlemi Başarılı" . "\n",
                "STATE_EMPTY" => "Dolap Boş Olduğu İçin Ürün Satılamamaktadır" . "\n",
                "STATE_FULL" => "Dolap Dolu Olduğu İçin Daha Fazla Ürün Eklenemez" . "\n",
                "RATE_OF_FULL" => "Doluluk Oranı :",
                "FULL" => " Dolu" . "\n",
                "EMPTY" => " Boş" . "\n",
                "PARTIALLY_FULL" => "Kısmen Dolu" . "\n"
            ];
        echo $textToResponse[$text];

    }

    public static function menu()
    {
        $textToResponse =
            [
                "0" => "Test için Tamamen Doldur",
                "1" => "Test için Tamamen Boşalt",
                "2" => "Ekle",
                "3" => "Çıkar",
                "4" => "Görüntüle",
                "5" => "Kapıyı Aç",
                "6" => "Kapıyı Kapat",
                "7" => "Çıkış",
            ];
        print_r($textToResponse);

    }
}