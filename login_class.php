<?php
session_start();
/*if(isset($_POST['userlogin'])){
   $user = new LoginUser($_POST['userlogin'], $_POST['userpassword']);
   exit();
 }*/

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
   if(isset($_POST['userlogin'])){
      $user = new LoginUser($_POST['userlogin'], $_POST['userpassword']);
      exit();
    }
   if(!isset($_POST['userlogin'])){
      unset($_SESSION['name']);
      setcookie( "login", "", time()- 60, "/","", 0);
      header('Location: login.php');
      exit();
   }
   }
   echo 'Это не ajax запрос!';
   exit();


class LoginUser{

   private $userlogin;
   private $password;
   private $username;
   public $error;
   public $success;
   private $storage = "db/data.json";
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
    //  $isFind=0;
      foreach ($this->stored_users as $user) {
         if($user['userlogin'] == $this->userlogin){
           // $isFind=1;
            if(md5($this->salt.$this->password)== $user['password']){
               $this->$response['status'] = 'success';
               $this->username=$user['username'];
               setcookie('login', $user['userlogin'], time() + (86400 * 30), "/"); // 86400 = 1 день
               $_SESSION['name']= $this->username;
               
              // header('Location: profil.php');
             echo json_encode($this->$response);
             return true;
            }
            else{
               $this->$response['status'] = 'errorpass';
               $this->$response['message'] = "Wrong password";
               echo json_encode($this->$response);
               return false;
            }
         } 
         /*else{
            $this->$response['status'] = 'errorlogin';
            $this->$response['message'] = "User with login $this->userlogin do not exists";
            echo json_encode($this->$response);
            return false;
         }*/
         
      }
      $this->$response['status'] = 'errorlogin';
         $this->$response['message'] = "User with login $this->userlogin do not exists";
         echo json_encode($this->$response);
         return false;
   }
}
?>