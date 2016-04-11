<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Pi Home</title>

    </head>

    <body>
    
<div class="wrap">
<h1>Pi Home</h1>
    
<?php

class Device
{
    public $nom;
    public $id;
    public $etat;
}

$json = json_decode(file_get_contents('device.json'));

$listDevice = array ();

foreach($json->equipements as $equipement)
{
     $toto = new Device();
     $toto->nom = $equipement->nom;
     $toto->id = $equipement->id;
     $toto->etat = $equipement->etat;
     $listDevice[] = $toto;
     
     $on = 'index.php?commande=2110' . $toto->id . '1';
     $off = 'index.php?commande=2110' . $toto->id . '0';
     
    //Action Bouton
	$_GET['commande'] = (int) $_GET['commande'];
	
	if ($_GET['commande'] == '2110' . $toto->id . '1') 
        {system('./radioEmission.cgi '.$_GET['commande']);
         $toto->etat = 1;}
	else if ($_GET['commande'] == '2110' . $toto->id . '0') 
        {system('./radioEmission.cgi '.$_GET['commande']);
         $toto->etat = 0;}
     
     echo "<label>$toto->nom $toto->id : </label>";
     
     if ($toto->etat == 1)
		{
		 
		echo "<a href='$off'<label><input type='checkbox' checked='checked' class='ios-switch green' /><div><div></div></div></label></a>";
   		  
		}
	else if ($toto->etat == 0)
		{
		  echo "<a href='$on'<label><input type='checkbox' class='ios-switch green' /><div><div></div></div></label></a>";

		}
     echo "<br>";    
        
}

file_put_contents("device.json",json_encode(array('equipements' => $listDevice)));

?>

<h2>Domotique par Alexandre</h2>
   
    </body>
</html>