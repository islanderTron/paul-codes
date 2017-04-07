<?php
  if(!empty($_POST)){
    $apikey = "4tdgxgfuhdh6nfr3spmfevpkyk74n7hf";
    $uri =     "https://us.api.battle.net";
    $requri = "";
    $getname = $_POST['name']  ;
    $getrealm = $_POST['realm'];

    $errors= array();

    if(empty($getname)){
      $errors[] = "Fill in character name";
    }
    if (empty($getrealm)) {
      $errors[] = "Fill in realm";
    }
    else{
      $requri = $uri . "/wow/character/" . $getrealm . "/" . $getname . "?fields=stats&locale=en_US&apikey=" . $apikey;
      $json = file_get_contents($requri);

      $requriItem = $uri . "/wow/character/" . $getrealm . "/" . $getname . "?fields=items&locale=en_US&apikey=" . $apikey;
      $jsonItem = file_get_contents($requriItem);
    }
  }
?>
