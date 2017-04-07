<?php
  // $json = file_get_contents('http://pokeapi.co/api/v2/pokemon/1');
  //
  // $name = json_decode($json);
  //
  // echo $name->forms[0]->name;

  $json = file_get_contents('http://pokeapi.co/api/v2/pokemon/');

  $name = json_decode($json);

  // echo ($name->results[0]->name);

  $arrayPokemon = array();
  for($x = 0; $x <= $name->count; $x++){
    $arrayPokemon[] = $name[$x];
  }

  print_r($arrayPokemon);
  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PokeAPI</title>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.2.min.js"></script>
  </head>
  <body>

    <h1>Pokemon Info</h1>
    name:<input type="text" name="name" class="name" value="">
    <div class="pic"></div>
    <div class='name'></div>
    <div class='level'></div>
    <div class="pic2"></div>
    <div class='name2'></div>

  </body>
</html>
