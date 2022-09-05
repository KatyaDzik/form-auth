<?php
 if(isset($_POST['userlogin'])){
   $user = new LoginUser($_POST['userlogin'], $_POST['userpassword']);
 }

class LoginUser{

   private $userlogin;
   private $password;
   private $username;
   public $error;
   public $success;
   private $storage = "data.json";
   private $stored_users;
   private $salt='qJB0rGtIn5UB1xG03efyCp';
   public $response = array();
   
   public function __construct($userlogin, $password){
      $this->userlogin= $userlogin;
      $this->password = $password;
      $this->stored_users = json_decode(file_get_contents($this->storage), true);
      $this->login();
   }
 
   private function login(){
      foreach ($this->stored_users as $user) {
         if($user['userlogin'] == $this->userlogin){
            if(md5($this->salt.$this->password)== $user['password']){
               $this->$response['status'] = 'success';
             $this->username=$user['username'];
             echo json_encode($this->$response);
             return true;
            }
            else{
               $this->$response['status'] = 'errorpass';
               $this->$response['message'] = "Wrong password";
               echo json_encode($this->$response);
               return false;
            }
         } else{
            $this->$response['status'] = 'errorlogin';
            $this->$response['message'] = "User with login $this->userlogin do not exists";
            echo json_encode($this->$response);
            return false;
         }
         
      }
   }
}
?>