<?php
session_start();
/*if(isset($_POST['username']))
   {	
      $user = new User($_POST['username'],$_POST['userlogin'],$_POST['useremail'], $_POST['userpassword'], $_POST['userpassword2']);
      exit();
   }*/

   if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      if(isset($_POST['username']))
         {	
            $user = new User($_POST['username'],$_POST['userlogin'],$_POST['useremail'], $_POST['userpassword'], $_POST['userpassword2']);
            exit();
         }
      }
      echo 'Это не ajax запрос!';
      exit();
      


class User{
  private $username;
   private $userlogin;
   private $useremail;
   private $raw_password; 

   public $response = array();


   private $encrypted_password;
   public $error;
   public $success;
   private $storage = "db/data.json"; 
   private $stored_users; 
   private $new_user; 

   public function __construct($username, $userlogin, $useremail, $password ){
    $this->username = filter_var(trim($username), FILTER_SANITIZE_STRING); 
    $this->userlogin = filter_var(trim($userlogin), FILTER_SANITIZE_STRING);
    $this->useremail = filter_var(trim($useremail), FILTER_SANITIZE_STRING);
    $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
    $salt  = 'qJB0rGtIn5UB1xG03efyCp';
    $this->encrypted_password = md5($salt.$this->raw_password);
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
 } 

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
 } 

 public function readUser($userlogin){
   $user;
   for($i=0; $i<=count($this->stored_users); $i++)
   {
      $user = [
         "username" => $this->stored_users[$i]['username'],
         "userlogin" => $this->stored_users[$i]['userlogin'],
         "useremail" => $this->stored_users[$i]['useremail'],
         "password" => $this->stored_users[$i]['password'],
      ];
      
      return $user;
   }
   }

 public function updateUser($username, $userlogin, $useremail, $password){
   for($i=0; $i<=count($this->stored_users); $i++)
   {
      if($userlogin == $this->stored_users[$i]['userlogin']){
         $this->stored_users[$i]['username']=$username;
         $this->stored_users[$i]['useremail']=$useremail;
         $this->stored_users[$i]['password']= md5($salt.$password);
      }
   }

   if(file_put_contents($this->storage, json_encode($this->stored_users))){
      $this->$response['status'] = 'update success';
      echo json_encode($this->$response);
         return true;
     }else{
        return false;
      }
   }

   public function deleteUser($userlogin){
      for($i=0; $i<=count($this->stored_users); $i++)
      {
         if($userlogin == $this->stored_users[$i]['userlogin']){
            unset($this->stored_users[$i]);
         }
      }
      if(file_put_contents($this->storage, json_encode($this->stored_users))){
         $this->$response['status'] = 'delete success';
         echo json_encode($this->$response);
            return true;
        }else{
           return false;
         }
      }
} 
?>