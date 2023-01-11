<?php
class Baza {
    private $mysqli; //uchwyt do BD
    
    public function __construct($serwer, $user, $pass, $baza) {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
        /* sprawdz połączenie */
        if ($this->mysqli->connect_errno) {
            printf("Nie udało sie połączenie z serwerem: %s\n",
            $this->mysqli->connect_error);
            exit();
        }
        /* zmien kodowanie na utf8 */
        if ($this->mysqli->set_charset("utf8")) {
        //udało sie zmienić kodowanie
        }
       
    }
    
    function __destruct() {
        $this->mysqli->close();
    }

    public function selectPole($sql, $pola) {
        $tresc = " ";
        if ($result = $this->mysqli->query($sql)) {
            $ilepol = count($pola); //ile pól
            $ile = $result->num_rows; //ile wierszy
            // pętla po wyniku zapytania $results

            while ($row = $result->fetch_object()) {

                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc.=$row->$p;
                }
                $tresc.=" ";
            }

            $result->close(); /* zwolnij pamięć */
        }

        return $tresc;
    }
    function getPasswordRow($userId)
    {
        $tresc = [];
        if ($result = $this->mysqli->query("select * from password where userId='$userId'")) {
           // $ile = $result->num_rows; //ile wierszy
            while ($row = $result->fetch_object()) {
                  array_push($tresc,$row);
              }

            $result->close(); /* zwolnij pamięć */
        }
        return $tresc;
    }
    function getLog($userId)
    {
        $tresc = [];
        if ($result = $this->mysqli->query("select * from logged_in_users where userId='$userId'")) {

            while ($row = $result->fetch_object()) {
                array_push($tresc,$row);
            }

            $result->close(); /* zwolnij pamięć */
        }
        return $tresc;
    }
    function getBlockLogin($ipAddress, $userId)
    {
        $tresc = [];
        if ($result = $this->mysqli->query("select * from block_login where ipAddress='$ipAddress' AND userId='$userId'")) {

            while ($row = $result->fetch_object()) {
                array_push($tresc,$row);
            }

            $result->close(); /* zwolnij pamięć */
        }
        return $tresc;
    }
    public function insert($sql) {

        if($this->mysqli->query($sql)) {

        }
        else{
            echo "Error: ".$this->mysqli->error;
        }
        
    }
    public function delete($sql) {
        $this->mysqli->query($sql);
            
        
    }
  public function update($sql) {

        if($this->mysqli->query($sql)==TRUE) {
           
        }
        else{
            echo "Error: ".$this->mysqli->error;
        }
        
    }
    
    public function selectUser($login, $passwd, $tabela) {
 //parametry $login, $passwd , $tabela – nazwa tabeli z użytkownikami
 //wynik – id użytkownika lub -1 jeśli dane logowania nie są poprawne
        $sql = "SELECT * FROM $tabela WHERE login='$login'";

     if ($result = $this->mysqli->query($sql)) {
         $ile = $result->num_rows;
         if ($ile == 1) {
             $row = $result->fetch_object(); //pobierz rekord z użytkownikiem
             $hash = $row->password; //pobierz zahaszowane hasło użytkownika
                 $salt=$row->salt;
                 $passwd=$salt.$passwd;
             $user['id'] = $row->id_user;
                 if (password_verify($passwd, $hash)) {
                      $user['access']=true;
                 }else {
                     $user['access']=false;
                 }
         } else {
             $user=NULL;
         }
     }

    return $user;

}
   
}
?>