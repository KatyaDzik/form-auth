<?php
class LoginUser{
   // class properties --------------------------------------
   private $userlogin;
   private $password;
   private $username;
   public $error;
   public $success;
   private $storage = "data.json";
   private $stored_users;
 
   // class methods -----------------------------------------
   public function __construct($userlogin, $password){
      $this->userlogin= $userlogin;
      $this->password = $password;
      $this->stored_users = json_decode(file_get_contents($this->storage), true);
      $this->login();
   }
 
   private function login(){
      foreach ($this->stored_users as $user) {
         if($user['userlogin'] == $this->userlogin){
            if(password_verify($this->password, $user['password'])){
             $this->username=$user['username'];
               // You can set a session and redirect the user to his account.
               return  $this->success = "Hi $this->username, you are loged in";
            }
         }
      }
      return $this->error = "Wrong username or password";
   }
} // end of class
?>