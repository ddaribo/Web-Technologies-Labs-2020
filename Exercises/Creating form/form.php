<?php 

  $valid = array();
  $errors = array();

  $titleLength = 150;
  $teacherNameLength = 200;
  $descriptionLength = 10;
  $minCredits = 0;
  $inputs = 5;

  function validate($input, &$valid, &$errors, $constraint = NULL){
    $check = $_POST["$input"];

    if(!$check){
      $errors[$input] = "$input е задължително поле.";
      echo $errors[$input];
      return;
    }
    elseif($input == "description"){
      if(strlen($check) < $constraint){
        $errors[$input] = "$input трябва да бъде с дължина поне $constraint символа";
        echo $errors[$input];
        return;
      }
    }
    elseif(strcmp($input, "credits") == 0){
      if($check < $constraint){
        $errors[$input] = "$input трябва да бъде цяло положително число";
        echo $errors[$input];
        return;
      }
    }
    elseif($constraint && strlen($check) > $constraint){
      $errors[$input] = "$input трябва да бъде с дължина не повече от $constraint символа";
      echo $errors[$input];
      return;
    }

    $valid[$input] = $check;

  }

  if($_POST){
    validate("title", $valid, $errors, $titleLength);
    validate("teacher", $valid, $errors, $teacherNameLength);
    validate("description", $valid, $errors, $descriptionLength);
    validate("group", $valid, $errors);
    validate("credits", $valid, $errors, $minCredits);
  }

  if(count($valid) == $inputs){
    $filename = 'data.txt';
    $fp = fopen($filename, 'a+');

    $textData = "Име на предмет: " . $valid['title'] . "\n" .
    "Име на преподавател: " . $valid['teacher'] . "\n" .
    "Описание на предмет: " . $valid['description'] . "\n" .
    "Група: " . $valid['group'] . "\n" .
    "Кредити: " . $valid['credits'] . "\n" . "\n";

    if(fwrite($fp, $textData)){
      echo "Successfully saved the information!";
      header( "refresh:2; url=form.html" );
    }
    
    fclose($fp);
  }
  ?>