<?php
session_start();
class RegisterUser{
   private $username;
   private $userlogin;
   private $useremail;
   private $confirm_password;
   private $raw_password; //голый пароль

   public $response = array();


   private $encrypted_password; //захешированный пароль
   public $error;
   public $success;
   private $storage = "data.json"; 
   private $stored_users; // array будет хранить всех зарегистрированных пользователей из файла JSON.
   private $new_user; // array который будет содержать имя пользователя, емаил, логин и хешированный пароль.
   //Все эти свойства будут инициализированы своими значениями сразу же при вызове класса. 
   public function __construct($username, $userlogin, $useremail, $password, $confirm_password ){
    $this->username = filter_var(trim($username), FILTER_SANITIZE_STRING); //очищаем и обрезаем входящее имя пользователя и сохраняем его в свойстве имени пользователя.
    $this->userlogin = filter_var(trim($userlogin), FILTER_SANITIZE_STRING);
    $this->useremail = filter_var(trim($useremail), FILTER_SANITIZE_STRING);
    $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
    $this->encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    $this->stored_users = json_decode(file_get_contents($this->storage), true);
    $this->new_user = [
       "username" => $this->username,
       "userlogin" => $this->userlogin,
       "useremail" => $this->useremail,
       "password" => $this->encrypted_password,
    ];
        $this->insertUser();
 }



 private function usernameExists(){
    foreach ($this->stored_users as $user) {

        if($this->userlogin == $user['userlogin']){
         $this->$response['status'] = 'errorlogin';
         $this->$response['message'] = "User with login $this->userlogin already exists";
         return true;
         }
         
         if($this->useremail == $user['useremail']){
         $this->$response['status'] = 'erroremail';
         $this->$response['message'] = "User with email $this->useremail already exists";
         return true;}
         }

 } // Checking if the username is taken.

 private function insertUser(){
    if($this->usernameExists() == FALSE){
        array_push($this->stored_users, $this->new_user);
        if(file_put_contents($this->storage, json_encode($this->stored_users))){
         $this->$response['status'] = 'success';
         echo json_encode($this->$response);
            return true;
        }else{
           return false;
        }
     } else{
      echo json_encode($this->$response);
     }

 } // Insert the user in the JSON file.
} 
?>