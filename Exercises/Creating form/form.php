<?php 
  $valid = array();
  $errors = array();
  if ($_POST) {

    $title = $_POST['title'];

    if (!$title) {
      $errors['title'] = 'Името е задължително поле.';
      echo $errors['title'];
      } 
      elseif (strlen($title) > 150) 
      {
        $errors['title'] = 'Името има максимална дължина 150 символа.'; echo $errors['title']; 
      } 
      else {
        $valid['title'] = $title;   
      }

    $teacher = $_POST['teacher'];
    if (!$teacher) {
      $errors['teacher'] = 'Името на преподавател е задължително поле.';echo $errors['teacher'];   
      } 
      elseif (strlen($teacher) > 200) 
      {
        $errors['teacher'] = 'Името на преподавател има максимална дължина 200 символа.';
        echo $errors['teacher'];       
      } 
      else {
        $valid['teacher'] = $teacher;   
      }

      $description = $_POST['description'];
      if (!$description) {
        $errors['description'] = 'Описанието на дисциплината е задължително поле.';
        echo $errors['description'];   
      } 
      elseif (strlen($description) < 10) 
      {
        $errors['description'] = 'Описанието на дисциплината има минимална дължина 10 символа.';
        echo $errors['description'];  
      } 
      else {
        $valid['description'] = $description;   
      }

      $group = $_POST['group'];
      if(!$group) {
        //it is filled with the first option by default, so can not be missing
      }
      else{
        $valid['group'] = $group;
      }

      $credits = $_POST['credits'];
      if($credits < 0) {
        $errors['credits'] = 'Броят кредити трябва да е цяло положително число';
        echo $errors['credits'];  
      }
      else{
        $valid['credits'] = $credits;   
      }
  }

?>