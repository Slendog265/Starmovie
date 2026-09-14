<?php
    $password = "algo1";

    function CSFR($str){
        $size = strlen($str);

        if($size%2 == 0){
            $hexadecimal = bin2hex($str);
        }else{

        }
    }

    //CSFR($password);
    echo strlen(password_hash("holajlnealdnfown7900pppppppppppppppppppppppppppp", PASSWORD_DEFAULT));
?>