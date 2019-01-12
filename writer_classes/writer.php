<?php
class writer {
  private $email;
  private $password;
  private $lastname;
  private $firstname;
  public $picture_address;


      public function setEmail($par)
      {
         $this->email = $par;
      }
      public function setLastname($par)
      {
         $this->lastname = $par;
      }
      public function setFirstname($par)
      {
         $this->firstname = $par;
      }

      public function setPassword($par)
      {
         $this->password = $par;
      }
      // check if email exist
      public function email_exist(){
        global $pdo;
        $email =  $this->email;
        
        $sql = $pdo->prepare("SELECT email FROM writer_register WHERE email = :email");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);


        $sql->execute();

        if($sql){
          return true;
        }else{
          return false;
        }
      }


      public function register(){
        global $pdo;

        $password = password_hash($this->password, PASSWORD_DEFAULT);
        $email = $this->email;
        $date = date("l jS \of F Y h:i:s A");
        $lastname = null;
        $firstname = null;
        $picture_address = null;

        $sql = $pdo->prepare("INSERT INTO writer_register (`firstname`,`lastname`,`picture_address`, `email`,`password`, `date_time_added`) VALUES (:firstname,:lastname,:picture_address,:email,:password, :date)");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':password', $password, PDO::PARAM_STR);
        $sql->bindParam(':date', $date, PDO::PARAM_STR);
        $sql->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $sql->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $sql->bindParam(':picture_address', $picture_address, PDO::PARAM_STR);
        $sql->execute();
        if($sql){
          $response =array('response'=>array('status' => true, 'message' => 'You have been Registered Succesfully'));
              echo json_encode($response);
              header('Content-Type: application/json');

        }else{
          $response = array('status' => false, 'message' => 'Registration was not succesful, Please try again');
              echo json_encode($response);
              header('Content-Type: application/json');

        }

      }

      public function login(){
            global $pdo;
            $email = $this->email;
            $password = $this->password;
            if(self::email_exist() == true){
                  $sql = $pdo->prepare("SELECT password FROM writer_register WHERE email = :email");
                  $sql->bindParam(':email', $email, PDO::PARAM_STR);
                  $sql->execute();
                  $writer = $sql->fetch();
                  if($writer && password_verify($password, $writer['password'])){
                    $response =array('response'=>array('status' => true, 'message' => 'Login Succesful'));
                        echo json_encode($response);
                        header('Content-Type: application/json');
                  }else{
                    $response =array('response'=>array('status' => true, 'message' => 'Login not  Succesful'));
                        echo json_encode($response);
                        header('Content-Type: application/json');
                      }
            }
      }
}
 ?>
