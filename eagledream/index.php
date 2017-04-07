<?php
  // header('Access-Control-Allow-Origin : * ');
  include ("validate.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Eagledream Technologies | API Test</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css" media="screen" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body>
    <div class="wrapped">
      <img src="eagleDream-logo.png" alt="Eagle Dream Technologies Logo"/>
      <div class="error-box">
        <?php
          if(count($errors) > 0){
            echo "Please follow the list below: ";
            echo "<div style='color:white;'>";
            foreach ($errors as $error) {
              echo "--".$error."<br/>";
            }
            echo "</div>";
          }
        ?>
      </div>
      <form class="" action="index.php" method="POST" enctype="multipart/form-data">
        <input type="field" placeholder="Character Name" id="name" name="name" value="<?php echo $_POST['name'] ?>">
        <input type="field" placeholder="Realm" id="realm" name="realm" value="<?php echo $_POST["realm"];?>">
        <input type="submit" id="submitBox" name="submit">
      </form>
    </div>
    <!-- wrapped -->
    <div class="content">
      <div class="col-center">
        <div class="col1">
          <div class="subCol1">
            <div class="attributes">
              <h3>Attributes</h3>
              <div class="acol1">
                <p class="xcol1">Level</p>
                <p  class="xcol2" id='level'></p>
              </div>
              <div class="acol1">
                <p class="xcol1">Health</p>
                <p  class="xcol2" id='health'></p>
              </div>
              <div class="acol1">
                <p class="xcol1">Strength</p>
                <p  class="xcol2" id="str"></p>
              </div>
              <div class="acol1">
                <p class="xcol1">Agility</p>
                <p  class="xcol2" id='agility'></p>
              </div>
            </div>
            <!-- Attribute -->
            <div class="attack">
              <h3>Attack</h3>
              <div class="acol1">
                <p class="xcol1">Defense</p>
                <p  class="xcol2" id='def'></p>
              </div>
              <div class="acol1">
                <p class="xcol1">Power</p>
                <p  class="xcol2" id='power'></p>
              </div>
            </div>
            <!-- Attack -->
            <div class="spell">
              <h3>Spell</h3>
              <div class="acol1">
                <p class="xcol1">Health Regen</p>
                <p  class="xcol2"  id='healthRegen'></p>
              </div>
              <div class="acol1">
                <p class="xcol1">Mana Regen</p>
                <p  class="xcol2" id='manaRegen'></p>
              </div>
            </div>
            <!-- Spell -->
          </div>
          <!-- subCol1 -->

          <div class="subCol2">
            <div class="defense">
              <h3>Defense</h3>
              <div class="acol1">
                <p class="xcol1">Armor</p>
                <p  class="xcol2" id='armor'></p>
              </div>
              <div class="acol1">
                <p class="xcol1">Dodge</p>
                <p  class="xcol2" id='dodge'></p>
              </div>

            </div>
            <div class="enchancements">
              <h3>Enhancements</h3>
              <div class="acol1">
                <p class="xcol1">Critical Strike</p>
                <p  class="xcol2" id='critStrike'></p>
              </div>
              <div class="acol1">
                <p class="xcol1">Haste</p>
                <p  class="xcol2" id='haste'></p>
              </div>
              <div class="acol1">
                <p class="xcol1">Mastery</p>
                <p  class="xcol2" id='mastery'></p>
              </div>
              <div class="acol1">
                <p class="xcol1">Leech</p>
                <p  class="xcol2" id='leech'></p>
              </div>
            </div>
          </div>
          <!-- subCol2 -->
          <div class="subCol3">
            <h3>Compare Stats</h3>
          </div>
          <!-- subCol3 -->
        </div>
        <!-- col1 -->
        <div class="col2">
          <div class="">
            <h3>My Item Sets</h3>
            <div class="acol1">
              <p class="xcol1">Helm</p>
              <p  class="xcol2" id='helm'></p>
            </div>
            <div class="acol1">
              <p class="xcol1">Cheat</p>
              <p  class="xcol2" id='chest'></p>
            </div>
            <div class="acol1">
              <p class="xcol1">Shoulders</p>
              <p  class="xcol2" id='shoulders'></p>
            </div>
            <div class="acol1">
              <p class="xcol1">Legs</p>
              <p  class="xcol2" id='legs'></p>
            </div>
            <div class="acol1">
              <p class="xcol1">Feet</p>
              <p  class="xcol2" id='feet'></p>
            </div>
            <div class="acol1">
              <p class="xcol1">Trinket</p>
              <p  class="xcol2" id='trinket'></p>
            </div>
          </div>
        </div>
        <!-- col2 -->
      </div>
    </div>
    <!-- content -->
    <script type="text/javascript">

      var ar = <?php echo $json ?>;
      var ax = <?php echo $jsonItem ?>;

      var lvl =         document.getElementById('level');
      var health =      document.getElementById("health");
      var str =         document.getElementById("str");
      var agility  =    document.getElementById("agility");
      var def  =        document.getElementById("def");
      var power  =      document.getElementById("power");
      var healthRegen = document.getElementById("healthRegen");
      var manaRegen  =  document.getElementById("manaRegen");
      var armor  =      document.getElementById("armor");
      var dodge  =      document.getElementById("dodge");
      var haste  =      document.getElementById("haste");
      var mastery  =    document.getElementById("mastery");
      var leech  =      document.getElementById("leech");
      var critStrike  = document.getElementById("critStrike");

      var helm  =       document.getElementById("helm");
      var chest  =      document.getElementById("chest");
      var shoulders  =  document.getElementById("shoulders");
      var legs  =       document.getElementById("legs");
      var feet  =       document.getElementById("feet");
      var trinket  =    document.getElementById("trinket");

      var charName =    document.getElementById("name");
      var realm =       document.getElementById("realm");

      // if( !(ar == null) || !(ar == "")){

      window.onload = function(){
        document.getElementsByClassName("content")[0].style.display = "block";
        str.innerHTML = ar.stats.str;
        lvl.innerHTML = ar.level;
        health.innerHTML = ar.stats.health;
        agility.innerHTML = ar.stats.agi;
        def.innerHTML = ar.stats.def;
        power.innerHTML = ar.stats.power;
        healthRegen.innerHTML = ar.stats.hasteRatingPercent + "% PS";
        manaRegen.innerHTML = ar.stats.masteryRating + "% PS";
        armor.innerHTML = ar.stats.armor;
        dodge.innerHTML = ar.stats.dodgeRating + "%";
        haste.innerHTML = ar.stats.haste + "%";
        mastery.innerHTML = ar.stats.mastery;
        leech.innerHTML = ar.stats.leechRating + "%";
        critStrike.innerHTML = ar.stats.critRating + "% CS";

        helm.innerHTML = ax.items.head.name;
        chest.innerHTML = ax.items.chest.name;
        shoulders.innerHTML = ax.items.shoulder.name;
        legs.innerHTML = ax.items.legs.name;
        feet.innerHTML = ax.items.feet.name;
        trinket.innerHTML = ax.items.trinket1.name + " & " + ax.items.trinket2.name;
      }
      //   else{
      //     var x = document.getElementsByClassName("error-box");
      //     x.innerHTML = x.innerHTML + "Sorry, either " +charName.value + " or " + realm.value + " is incorrect. Please try again.";
      //   }
      // }
    </script>
  </body>
</html>
