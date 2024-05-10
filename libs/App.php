<?php 


class App{
    public $host = HOST;
    public $dbname = DBNAME;
    public $user  = USER;
    public $pass = PASS;

    public $link;

    // Create a construct

    public function __construct(){
        $this -> connect();

    } 
    
    public function connect(){
        $this -> link = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname."",$this->user,$this->pass);

        if($this -> link){
            echo "Database Connection Working successfully.";
        }
    }
    // Select All
    public function selectAll($query){
        $rows = $this -> link -> query($query);
        $rows -> execute();

        $allRows = $rows -> fetcAll(PDO::FETCH_OBJ);

        if($allRows){
            return $allRows;
        }else{
            return false;
        }
    }
    // Select One row
    public function selectOne($query){
        $rows = $this -> link -> query($query);
        $rows -> execute();

        $singleRow = $rows -> fetch(PDO::FETCH_OBJ);

        if($singleRow){
            return $singleRow;
        }else{
            return false;
        }
    }

    //Insert Query

    public function insert($query,$arr,$path){
        if($this -> validate($arr) == "Empty"){
            echo "<script>alert('One or more inputs are empty')</script>";

        }else{
            $insert_records = $this -> link -> prepare($query);

            $insert_records -> execute($arr);

            header("location: ".$path."");
        }
    }


    // Update Query
    public function update($query,$arr,$path){
        if($this -> validate($arr) == "Empty"){
            echo "<script>alert('One or more inputs are empty')</script>";

        }else{
            $update_records = $this -> link -> prepare($query);

            $update_records -> execute($arr);

            header("location: ".$path."");
        }
    }

    // Delete Query

    public function delete($query,$path){
        
        $delete_records = $this -> link -> query($query);

        $delete_records -> execute();

        header("location: ".$path."");
    }
    

    public function validate($arr){
        if(in_array("",$arr)){
            echo "Empty";
        }
    }



    public function register($query,$arr,$path){
        if($this -> validate($arr) == "Empty"){
            echo "<script>alert('One or more inputs are empty')</script>";

        }else{
            $registerUser = $this -> link -> prepare($query);

            $registerUser -> execute($arr);

            header("location: ".$path."");
        }
    }

    public function login($query,$data,$path){
        // Email

        $loginUser = $this ->link-> query($query);
        $loginUser -> execute();

        $fetch = $loginUser -> fetch(PDO::FETCH_ASSOC);

        if($loginUser -> rowCount() > 0){
            // Password 
            if(password_verify($data['password'], $fetch['password'])){
                // Start session vars
                header("locatin: ".$path."");
            }
        }
    }

    // Starting Sessions
    public function startingSession(){
        session_start();
    }

    // Validating Sessions

    public function validateSession($path){
        if(isset($_SESSION['id'])){
            header("location: ".$path."");
        }
    }


}

