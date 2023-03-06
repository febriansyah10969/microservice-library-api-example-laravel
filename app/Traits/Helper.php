<?php

namespace App\Traits;

trait Helper
{

    public function ValidatePhoneNumber($phone) {
        // kadang ada penulisan no hp 0811 239 345
        $phone = str_replace(" ","",$phone);
        // kadang ada penulisan no hp (0274) 778787
        $phone = str_replace("(","",$phone);
        // kadang ada penulisan no hp (0274) 778787
        $phone = str_replace(")","",$phone);
        // kadang ada penulisan no hp 0811.239.345
        $phone = str_replace(".","",$phone);
    
        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($phone))){
            
            // cek apakah no hp karakter 1-2 adalah 62
            if (substr(trim($phone), 0, 2) == '62'){
                $phone = trim($phone);
            }
            // cek apakah no hp karakter 1-3 adalah +62
            else if (substr(trim($phone), 0, 3) == '+62'){
                $phone = '62'.substr(trim($phone), 3);
            }
            // cek apakah no hp karakter 1 adalah 0
            else if (substr(trim($phone), 0, 1) == '0'){
                $phone = '62'.substr(trim($phone), 1);
            }
        }
        
        return $phone;
    }

}
