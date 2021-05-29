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
       
    } //koniec funkcji konstruktora
    
    function __destruct() {
        $this->mysqli->close();
    }
    public function select($sql, $pola) {
        //parametr $sql – łańcuch zapytania select
        //parametr $pola - tablica z nazwami pol w bazie 
        //Wynik funkcji – kod HTML tabeli z rekordami (String)
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
    public function insert($sql) {
        //Dodawanie do bazy
        if($this->mysqli->query($sql)==TRUE) {
            echo "Zarejestrowano pomyślnie";
        }
        else{
            echo "Błąd: ".$this->mysqli->error;
        }
        
    }
    public function delete($sql) {
        $this->mysqli->query($sql);
            
        
    }
  public function update($sql) {
        //Dodawanie do bazy
        if($this->mysqli->query($sql)==TRUE) {
           
        }
        else{
            echo "Błąd: ".$this->mysqli->error;
        }
        
    }
    
    public function selectUser($login, $passwd, $tabela) {
 //parametry $login, $passwd , $tabela – nazwa tabeli z użytkownikami
 //wynik – id użytkownika lub -1 jeśli dane logowania nie są poprawne
 $id = -1;
 $sql = "SELECT * FROM $tabela WHERE login='$login'";

 if ($result = $this->mysqli->query($sql)) {
 $ile = $result->num_rows;
 if ($ile == 1) {
 $row = $result->fetch_object(); //pobierz rekord z użytkownikiem
 $hash = $row->password; //pobierz zahaszowane hasło użytkownika
 //sprawdź czy pobrane hasło pasuje do tego z tabeli bazy danych:
 if (password_verify($passwd, $hash))
 $id = $row->id_user; //jeśli hasła się zgadzają - pobierz id użytkownika
 }
 }
    
 return $id; //id zalogowanego użytkownika(>0) lub -1
}
   

    
    
} //koniec klasy Baza
?>