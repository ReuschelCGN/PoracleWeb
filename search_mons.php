<?php 

include_once "./include/functions.php";
include_once "./include/db_mad.php";
include_once "./config.php";
include_once "./include/defaults.php";

$mons=get_all_mons();

if ( $_POST['searchtype'] == "questmon" ) { 
	$quests_mons=get_quest_mons();
	foreach($quests_mons as $key => $pokemon_id) {
		unset($mons[$pokemon_id]);
	}
}

  foreach($mons as $pokemon_id => $pokemon_name) {
    if ($pokemon_id <= $max_pokemon) {
     if ( $_POST['search'] == "ALL" || stripos($pokemon_name, $_POST['search']) !== FALSE ) {
        $i=$pokemon_id;
	echo "<li>";
	echo "<input type='checkbox' name='mon_$i' id='mon_$i' />\n";
        echo "<label for='mon_$i'><img loading=lazy src='$uicons_pkmn/pokemon/".$i.".png' style='margin-bottom:10px;' />";
        echo "<br>";
        echo "<font size=2>".str_pad($i, 3, "0", STR_PAD_LEFT)."<br>".$pokemon_name."</font></label>";
        echo "</li>\n";
     }
   }
}
