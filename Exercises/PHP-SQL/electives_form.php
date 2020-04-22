<?php
    include "./db_connect.php";

     $valid = array();
     $errors = array();

     $inputs = 3;


     /* The only validation for now is if input exists (length constraint constant not included, but migh be)*/
     function validate($input, &$valid, &$errors, $constraint = NULL){
        $check = $_POST["$input"];
    
        if(!$check){
          $errors[$input] = "$input е задължително поле.";
          echo $errors[$input];
          return;
        } elseif($constraint && strlen($check) > $constraint){
          $errors[$input] = "$input трябва да бъде с дължина не повече от $constraint символа";
          echo $errors[$input];
          return;
        }
    
        $valid[$input] = $check;
      }

      validate("title", $valid, $errors);
      validate("description", $valid, $errors);
      validate("lecturer", $valid, $errors);

      if(sizeof($valid) === $inputs)
      {
          $db = new DBConnect();
    
          $conn = $db->getConnection();
    
    
            $db->dbinsert($valid['title'], $valid['description'], $valid['lecturer']);
    
          $db->dbSelectAll();
      } else{
          echo "Something Went Wrong!";
      }

?>