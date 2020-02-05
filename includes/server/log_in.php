<?php
/**
 * File that check login
 */
if(isset($_POST['login_name']) && isset($_POST['login_pass'])){
    login_check($_POST['login_name'],$_POST['login_pass'],$_POST['login_checkbox']);
}else{
    $result = array('error'=>'All fields must be required');
    echo json_encode($result);
}

function login_check($name,$pass,$check){
    require $_SERVER['DOCUMENT_ROOT'] . '/bin/db.php';
    $name_check = $pdo->prepare("SELECT * FROM users WHERE name= ?");
    $name_check->execute([$name]);
    $name_check_result = $name_check->fetch(PDO::FETCH_ASSOC);
    
    if($name_check_result['name'] == $name){
        if(password_verify($pass,$name_check_result['password'])){

            if(isset($check)){
                $token = $name_check_result['remember_token'];
                setcookie('remember_token',$token,time()+14*60*24*30,"/");
            }else{
                session_start();
                $_SESSION['user_token'] = $name_check_result['remember_token'];
            }
            $result = array('success'=>'Succcess Login');
            echo json_encode($result);
        }else{
            $result = array('error'=>'Incorect Password');
    echo json_encode($result);
        }
    }else{
        $result = array('error'=>'Incorect Name');
    echo json_encode($result);
    }

}