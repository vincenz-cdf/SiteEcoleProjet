<?php

   $hote="localhost";
   $login="root";
   $mdp="";

   try{
      $connexion = new PDO("mysql:host=$hote;dbname=hfrance", $login, $mdp);
      $connexion->exec("set names utf8");
      return $connexion;
   }
   catch(PDOException $e){
      echo "Erreur :" . $e->getMessage();
      die();
   }

function creerPhrase($connexion,$id,$phrase)
{ 
   $id=str_replace("'","''", $id);
   $phrase=str_replace("'","''", $phrase);
   $req="INSERT into Description values ('$id','$phrase')";
   
   $connexion->query($req);
}

function obtenirPhrase()
{
   $req="SELECT id, phrase from Description order by id";
   return $req;
}   

function obtenirIdD($connexion)
{
    $req ='SELECT LAST_INSERT_ID(id) as "dernierId" from Description order by id desc limit 1';
    $obtenirId=$connexion->query($req);
    $sth = $connexion->query($req);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function obtenirDetailPhrase($connexion, $id)
{
   $req="SELECT * from Description where id='$id'";
   $rsLig=$connexion->query($req);
   return $rsLig->fetchAll();
}

function modifierLigue($connexion,$id,$phrase)
{  
   $phrase=str_replace("'","''", $phrase);
     
   $req="UPDATE Description set phrase='$phrase' where id='$id'";
   
   $connexion->exec($req);
}

function supprimerPhrase($connexion, $id)
{
   $req="DELETE from Description where id='$id'";
   $connexion->exec($req);
}

?>