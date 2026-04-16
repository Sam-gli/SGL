<?php

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$service = $_POST['service'];
$message = $_POST['message'];

$destinataire = "samakeabdoualye0196@gmail.com";
$sujet = "Nouvelle demande de devis";

$contenu = "Prenom: $prenom\n";
$contenu .= "Nom: $nom\n";
$contenu .= "Email: $email\n";
$contenu .= "Telephone: $telephone\n";
$contenu .= "Service: $service\n";
$contenu .= "Message:\n$message";

$headers = "From: $email";

mail($destinataire, $sujet, $contenu, $headers);

echo "Message envoyé avec succès";

?>