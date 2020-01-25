<?php
if(isset($_POST['registr_name']) && isset($_POST['registr_pass']) && isset($_POST['confirm_pass'])){

    if($_POST['registr_pass'] == $_POST['confirm_pass']){
        register_check($_POST['registr_name'],$_POST['registr_pass']);
    }else{
        $result = array("error" =>'Different passwords!');
        echo json_encode($result);
        
    }
}else{
    $result = ['error'=>'All fields must be required'];
    echo json_encode($result);

}

function register_check($name, $password){
    require '/OSPanel/domains/websockets/bin/db.php';
    $valid_name = "/^[A-Z]{1}+[a-zA-Z0-9._-]{2,}/";
    $valid_password = "/^[A-Z]{1}+[a-zA-Z0-9._-]{7,}/";
    if($name && $password){
            if(preg_match($valid_name,$name) == 1){
                if(preg_match($valid_password,$password) == 1){

                $name_validator = $pdo->prepare("SELECT `name` FROM users WHERE name=?");
                $name_validator->execute([$name]);
                $name_validator_result = $name_validator->fetch(PDO::FETCH_ASSOC);

                if($name_validator_result['name'] == $name){
                    $result = array("error"=> 'A user with the same name already exists');
                    echo json_encode($result);
                    die();
                }

            $token = bin2hex(random_bytes(10));
            setcookie('remember_token',$token,time()+ 14*60*24*30,"/");
            $values = [
                $name,
                password_hash($password,PASSWORD_DEFAULT),
                $token
            ];
            $request = $pdo->prepare("INSERT INTO users (name,password,remember_token) VALUES 
            (?,?,?)");

            $result_r = $request->execute($values);
            if($result_r){
                $result = array('success'=>'New account was successfully registered.');
                echo json_encode($result);
            }else{
                $result = array('error'=>'Some problems. Please try again later');
                echo json_encode($result);
                
            }
        }else{
            $result = array('error'=>'Password must: Begin with a capital letter, contain at least two characters, at least one number');
            echo json_encode($result);  
            }
        }else{
            $result = array('error'=>'Name must: Begin with a capital letter, contain at least two characters');
            echo json_encode($result);
            
        }
}else{
    $result = array('error'=>'Some edit inputs are empty');
    echo json_encode($result);

    }
}
