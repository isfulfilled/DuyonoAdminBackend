<?php
class writer {
  private $email;
  private $password;
  public $lastname;
  public $firstname;
  public $picture_address;


  public $title;
  public $author;
  public $impact_today;
  public $date_updated;
  public $death_year;
  public $birth_year;
  public $challenges;
  public $invention;




      public function setEmail($par)
      {
         $this->email = $par;
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
          $return = $sql->fetch();

        if($return){
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
        $this->lastname = null;
        $this->firstname = null;
        $this->picture_address = null;

        $sql = $pdo->prepare("INSERT INTO writer_register (`firstname`,`lastname`,`picture_address`, `email`,`password`, `date_time_added`) VALUES (:firstname,:lastname,:picture_address,:email,:password, :date)");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':password', $password, PDO::PARAM_STR);
        $sql->bindParam(':date', $date, PDO::PARAM_STR);
        $sql->bindParam(':lastname', $this->lastname, PDO::PARAM_STR);
        $sql->bindParam(':firstname', $this->firstname, PDO::PARAM_STR);
        $sql->bindParam(':picture_address', $this->picture_address, PDO::PARAM_STR);
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
                    $response =array('response'=>array('status' => false, 'message' => 'Login not  Succesful'));
                        echo json_encode($response);
                        header('Content-Type: application/json');
                      }
            }else{
              $response =array('response'=>array('status' => false, 'message' => 'Email is not registered'));
                  echo json_encode($response);
                  header('Content-Type: application/json');
            }
      }

      public function add_content(){

      }
}
 ?>
