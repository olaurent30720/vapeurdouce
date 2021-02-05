<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--twitter-->
    <meta name="twitter:card" content="Vapeur" />
    <!--url du site-->
    <meta name="twitter:site" content="https://olaur.000webhostapp.com" />
    <meta name="twitter:title" content="Cuisson vapeur" />
    <!--description-->
    <meta name="twitter:description" content="Méthode de cuisson à la vapeur" />
    <!--url de l'image de récap du site-->
    <meta name="twitter:image" content="https://files.000webhost.com/public_html/vapeur.jpg" />
    
    <!--opengraph-->
    <meta property="og:title" content="Cuisson vapeur douce"/>
    <meta property="og:type" content="article"/>
    <!--url du site-->
    <meta property="og:url" content="https://olaur.000webhostapp.com"/>
    <meta property="og:image" content="https://files.000webhost.com/public_html/vapeur.jpg"/>
    <meta property="og:description" content="Méthode de cuisson à la vapeur"/>
    <title>Vapeur Douce</title>
    <link rel="stylesheet" href="style.css">
    </head>
<body>
<h1>VAPEUR DOUCE</h1>

<form class = "rechercher" action="" method="get">
    <label for="recherche">Rechercher un aliment</label>
    <input type="text" id="recherche" name="recherche" />
    <input type="submit" value="Rechercher" />
</form>
<div>
<?php
    $recherche = htmlspecialchars(($_GET['recherche']), ENT_QUOTES);//XSS
    $recherche = urlencode($recherche);//gestion des espaces et accents
    $curl = curl_init();
    curl_setopt_array($curl, [ // paramétrage de la session curl
        CURLOPT_URL => "https://api.hmz.tf/?id=".$recherche, //récupère l'url 
        CURLOPT_RETURNTRANSFER => true, // retourne une chaine de caractère
        CURLOPT_TIMEOUT => 1, //durée d'attente avant réponse du serveur
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // force l'http/1.1
        ]);

    $data = curl_exec($curl);
    $data = json_decode($data, true);
    @$aliment = $data['message']['nom'];
    @$trempage = $data['message']['vapeur']['trempage'];
    @$niveau = $data['message']['vapeur']["niveau d'eau"];
    @$cuisson = $data['message']['vapeur']['cuisson'];
    @$message = $data['message'];

echo "Résultat de la recherche pour l'aliment $aliment : <br>
     Trempage : $trempage,<br>
     Niveau d'eau : $niveau,<br>
     Temps de cuisson : $cuisson";
     ?>
<div>
    <?php 
        if ($recherche == 'all') {
            foreach ($message as $item => $value) {
    ?>
    <p><?php echo "$item";?></p><br>
    <?php } 
    }
    ?>
</div>
    
<?php 
curl_close($curl);
?>
</div>

</body>
</html>