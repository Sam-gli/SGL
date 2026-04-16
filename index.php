<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$success = "";
$error = "";

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sécurisation des données
    $prenom = htmlspecialchars($_POST['prenom'] ?? '');
    $nom = htmlspecialchars($_POST['nom'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $telephone = htmlspecialchars($_POST['telephone'] ?? '');
    $service = htmlspecialchars($_POST['service'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    $mail = new PHPMailer(true);

    try {
        // CONFIG SMTP GMAIL
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'samakeabdoulaye0196@gmail.com'; // 🔥 remplace
        $mail->Password = 'lnxtpapyayfjsfbo'; // 🔥 ton mot de passe d'application
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Expéditeur et destinataire
        $mail->setFrom($email, $prenom . ' ' . $nom);
        $mail->addAddress('samakeabdoulaye0196@gmail.com');

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = "Nouvelle demande de devis";
        $mail->Body = "
            <h2>Nouvelle demande</h2>
            <p><strong>Prénom:</strong> $prenom</p>
            <p><strong>Nom:</strong> $nom</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Téléphone:</strong> $telephone</p>
            <p><strong>Service:</strong> $service</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();

        // ✅ Redirection après envoi pour éviter le re-POST
        header("Location: ".$_SERVER['PHP_SELF']."?success=1");
        exit;

    } catch (Exception $e) {
        $error = "❌ Erreur: " . $mail->ErrorInfo;
    }
}

// Affichage du message de succès si redirection
if (isset($_GET['success'])) {
    $success = "✅ Message envoyé avec succès !";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SGL – Société de Gestion et de Logistique</title>
<link rel="stylesheet" href="style.css">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="script.js" defer></script>
</head>
<body>

<!-- ═══ NAV ═══ -->
<nav>
  <div class="nav-inner">
    <a href="#" class="nav-brand">
      <div class="brand-mark">
        <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
      </div>
      <div>
        <div class="brand-name">SGL</div>
        <div class="brand-sub">Logistique · Transport</div>
      </div>
    </a>
    <ul class="nav-links">
      <li><a href="#about">À propos</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#fleet">Flotte</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
    <a href="#contact" class="nav-cta">Devis gratuit</a>
    <button class="hamburger-btn" onclick="openDrawer()" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- ═══ DRAWER MOBILE ═══ -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
<div class="drawer" id="drawer">
  <div class="drawer-header">
    <div class="drawer-brand">
      <div class="dn">SGL</div>
      <div class="ds">Gestion & Logistique</div>
    </div>
    <button class="drawer-close" onclick="closeDrawer()" aria-label="Fermer">
      <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
  </div>
  <nav class="drawer-nav">
    <a href="#about" onclick="closeDrawer()">
      <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      À propos
    </a>
    <a href="#services" onclick="closeDrawer()">
      <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
      Services
    </a>
    <a href="#fleet" onclick="closeDrawer()">
      <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l1.38.69M13 16l-2-9m2 9h3"/></svg>
      Flotte
    </a>
    <a href="#contact" onclick="closeDrawer()">
      <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      Contact
    </a>
  </nav>
  <div class="drawer-footer">
    <a href="#contact" onclick="closeDrawer()">Demander un devis</a>
  </div>
</div>

<!-- ═══ HERO ═══ -->
<section id="hero">
  <div class="hero-noise"></div>
  <div class="hero-vline"></div>
  <div class="hero-circle"></div>
  <div class="hero-circle2"></div>
  <div class="hero-inner">
    <div>
      <div class="hero-eyebrow">
        <span class="eyebrow-line"></span>
        Dakar · Sénégal · Disponible 24h/24 — 7j/7
      </div>
      <h1 class="hero-title">
        L'excellence<br>
        <em>logistique</em><br>
        à votre service
      </h1>
      <p class="hero-desc">
        Transport, transit international, location de véhicules, déménagement et événementiel — une solution complète, fiable et réactive pour tous vos projets.
      </p>
      <div class="hero-actions">
        <a href="#contact" class="btn-primary">Demander un devis</a>
        <a href="#services" class="btn-ghost">
          Nos services
          <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>
      <div class="hero-stats">
        <div class="hstat">
          <div class="n">24<span class="u">h</span></div>
          <div class="l">Disponibilité</div>
        </div>
        <div class="hstat">
          <div class="n">48<span class="u">h</span></div>
          <div class="l">Devis rapide</div>
        </div>
        <div class="hstat">
          <div class="n">7<span class="u">/7</span></div>
          <div class="l">Jours actifs</div>
        </div>
      </div>
    </div>
    <div class="hero-panel">
      <div class="hero-panel-box">
        <div class="hpb-head">
          <span>Pôles d'activité</span>
          <span class="hpb-dot"></span>
        </div>
        <div class="hpb-item">
          <div class="hpb-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l1.38.69M13 16l-2-9m2 9h3"/></svg></div>
          <div><div class="hpb-t">Location véhicules</div><div class="hpb-s">Berlines, SUV, Minibus, Cars</div></div>
        </div>
        <div class="hpb-item">
          <div class="hpb-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
          <div><div class="hpb-t">Transit international</div><div class="hpb-s">Import / Export, douanes</div></div>
        </div>
        <div class="hpb-item">
          <div class="hpb-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
          <div><div class="hpb-t">Transport touristique</div><div class="hpb-s">Circuits, hôtels, aéroports</div></div>
        </div>
        <div class="hpb-item">
          <div class="hpb-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
          <div><div class="hpb-t">Événementiel</div><div class="hpb-s">Organisation & coordination</div></div>
        </div>
        <div class="hpb-item">
          <div class="hpb-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg></div>
          <div><div class="hpb-t">Déménagement</div><div class="hpb-s">Local & longue distance</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══ ABOUT ═══ -->
<section id="about">
  <div class="s-inner">
    <div class="about-grid">
      <div class="about-visual reveal">
        <div class="about-main">
          <div class="about-icon-wrap">
            <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
          </div>
          <p class="about-quote">L'excellence logistique<br>au service de vos projets</p>
        </div>
        <div class="about-float">
          <div class="af-n">SGL</div>
          <div class="af-l">Groupe logistique</div>
        </div>
      </div>
      <div class="about-text">
        <div class="s-tag reveal">À propos de nous</div>
        <h2 class="s-title reveal">Votre partenaire<br><em>de confiance</em></h2>
        <p class="reveal" style="margin-top:1.5rem;">
          SGL est une société spécialisée dans le <strong>transport</strong>, la <strong>logistique</strong>, le <strong>transit international</strong>, 
          le <strong>déménagement</strong>, la <strong>location de véhicules</strong> et les <strong>services événementiels</strong>.
        </p>
        <p class="reveal">
          Notre mission : offrir une solution clé en main, fiable et réactive, pour tous vos besoins logistiques, 
          professionnels ou personnels. Avec une disponibilité 24h/24 et 7j/7, une équipe expérimentée et un 
          interlocuteur unique tout au long de la prestation.
        </p>
        <ul class="cl reveal">
          <li><span class="ci"><svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>Interlocuteur unique dédié à votre projet</li>
          <li><span class="ci"><svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>Tarifs transparents, devis rapide sous 48h</li>
          <li><span class="ci"><svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>Flotte moderne et régulièrement entretenue</li>
          <li><span class="ci"><svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>Intervention rapide à Dakar et partout au Sénégal</li>
          <li><span class="ci"><svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>Équipes formées et ponctuelles 7j/7</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ═══ SERVICES ═══ -->
<section id="services">
  <div class="s-inner">
    <div class="svc-header reveal">
      <div>
        <div class="s-tag">Pôles d'activité</div>
        <h2 class="s-title">Ce que nous<br><em>offrons</em></h2>
      </div>
      <p>Une gamme complète de services logistiques pour tous vos projets professionnels et personnels, à Dakar et partout au Sénégal.</p>
    </div>
    <div class="svc-grid">
      <div class="svc-card reveal rd1">
        <div class="svc-num">01</div>
        <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l1.38.69M13 16l-2-9m2 9h3"/></svg></div>
        <h3>Location de Véhicules</h3>
        <ul>
          <li>Berlines de luxe</li><li>SUV & Prado</li><li>Pick-up</li><li>Minibus & Cars</li><li>Avec ou sans chauffeur</li>
        </ul>
      </div>
      <div class="svc-card reveal rd2">
        <div class="svc-num">02</div>
        <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
        <h3>Transport Touristique</h3>
        <ul>
          <li>Circuits personnalisés</li><li>Transferts hôtels / aéroports</li><li>Véhicules adaptés</li><li>Découvrez le Sénégal</li>
        </ul>
      </div>
      <div class="svc-card reveal rd3">
        <div class="svc-num">03</div>
        <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
        <h3>Transit International</h3>
        <ul>
          <li>Déclarations douanières</li><li>Frais maritimes</li><li>Enlèvement à domicile</li><li>Import / Export</li>
        </ul>
      </div>
      <div class="svc-card reveal rd1">
        <div class="svc-num">04</div>
        <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
        <h3>Pôle Événementiel</h3>
        <ul>
          <li>Planning détaillé</li><li>Autorisations administratives</li><li>Coordination complète</li><li>Accueil aux points clés</li>
        </ul>
      </div>
      <div class="svc-card reveal rd2">
        <div class="svc-num">05</div>
        <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg></div>
        <h3>Déménagement</h3>
        <ul>
          <li>Emballage sécurisé</li><li>Chargement & déchargement</li><li>Local ou longue distance</li>
        </ul>
      </div>
      <div class="svc-card reveal rd3">
        <div class="svc-num">06</div>
        <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
        <h3>Location d'Engins</h3>
        <ul>
          <li>Camions bennes</li><li>Terrassement & chantier</li><li>Démolition & forage</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ═══ FLEET ═══ -->
<section id="fleet">
  <div class="s-inner">
    <div class="fleet-layout">
      <div class="fleet-intro reveal">
        <div class="s-tag">Notre parc automobile</div>
        <h2 class="s-title">Une flotte<br><em>variée &<br>moderne</em></h2>
        <p>Véhicules régulièrement entretenus, adaptés à tous vos besoins — du déplacement professionnel au transport de groupe ou de chantier.</p>
        <a href="#contact" class="fleet-link">
          Réserver un véhicule
          <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>
      <div class="fleet-grid">
        <div class="fleet-card reveal rd1">
          <div class="fc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l1.38.69M13 16l-2-9m2 9h3"/></svg></div>
          <h4>Berlines de Luxe</h4><p>Déplacements professionnels premium</p>
        </div>
        <div class="fleet-card reveal rd2">
          <div class="fc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg></div>
          <h4>SUV & Prado</h4><p>Robustesse sur tous les terrains</p>
        </div>
        <div class="fleet-card reveal rd3">
          <div class="fc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg></div>
          <h4>Pick-up</h4><p>Transport de marchandises</p>
        </div>
        <div class="fleet-card reveal rd1">
          <div class="fc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
          <h4>Minibus</h4><p>Transferts de groupes</p>
        </div>
        <div class="fleet-card reveal rd2">
          <div class="fc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></div>
          <h4>Cars & Bus</h4><p>Grande capacité événementielle</p>
        </div>
        <div class="fleet-card reveal rd3">
          <div class="fc-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
          <h4>Engins & Camions</h4><p>Terrassement & chantier</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══ WHY ═══ -->
<section id="why">
  <div class="s-inner">
    <div class="why-top">
      <div class="reveal">
        <div class="s-tag">Pourquoi SGL</div>
        <h2 class="s-title">La différence<br><em>qui compte</em></h2>
      </div>
      <p class="reveal">Nous ne sommes pas qu'un prestataire — nous sommes votre partenaire logistique, engagé sur la qualité, la ponctualité et la disponibilité.</p>
    </div>
    <div class="why-grid">
      <div class="why-card reveal rd1">
        <div class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
        <h4>Interlocuteur unique</h4>
        <p>Un référent dédié suit votre dossier de A à Z, sans relais ni perte d'information.</p>
      </div>
      <div class="why-card reveal rd2">
        <div class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>
        <h4>Devis sous 48h</h4>
        <p>Des tarifs clairs et une réponse rapide pour planifier vos opérations sereinement.</p>
      </div>
      <div class="why-card reveal rd3">
        <div class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
        <h4>Flotte fiable</h4>
        <p>Véhicules révisés aux normes pour garantir votre sécurité à chaque trajet.</p>
      </div>
      <div class="why-card reveal rd4">
        <div class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
        <h4>Couverture nationale</h4>
        <p>Intervention rapide à Dakar et sur l'ensemble du territoire sénégalais, 7j/7.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══ CONTACT ═══ -->
<section id="contact">
  <div class="s-inner">
    <div class="s-tag reveal">Nous contacter</div>
    <h2 class="s-title reveal">Parlons de<br><em>votre projet</em></h2>
    <div class="contact-grid">
      <div class="reveal">
        <p class="contact-intro">Que ce soit pour une location de véhicule, un déménagement ou un événement, notre équipe est disponible 24h/24 pour vous répondre rapidement.</p>
        <div class="c-item">
          <div class="c-dot"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
          <div>
            <div class="c-lbl">Adresse</div>
            <div class="c-val">Almadies Lot B TF 16669,106<br>Almadies, en face FBN Bank — Dakar</div>
          </div>
        </div>
        <div class="c-item">
          <div class="c-dot"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg></div>
          <div>
            <div class="c-lbl">Téléphone</div>
            <div class="c-val">
              <a href="tel:+221775588881">77 558 88 81</a> &nbsp;·&nbsp;
              <a href="tel:+221338651395">33 865 13 95</a> &nbsp;·&nbsp;
              <a href="tel:+221779327777">77 932 77 77</a>
            </div>
          </div>
        </div>
        <div class="c-item">
          <div class="c-dot"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
          <div>
            <div class="c-lbl">Email</div>
            <div class="c-val"><a href="mailto:sglcompagny@gmail.com">sglcompagny@gmail.com</a></div>
          </div>
        </div>
        <div class="c-item">
          <div class="c-dot"><svg viewBox="0 0 24 24" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
          <div>
            <div class="c-lbl">Disponibilité</div>
            <div class="c-val">24h/24 — 7j/7 &nbsp;·&nbsp; Partout au Sénégal</div>
          </div>
        </div>
      </div>
      <div class="reveal">
        <?php if ($success): ?>
    <div style="background: #16a34a; color: white; padding: 10px; margin-bottom: 10px;">
        <?= $success ?>
    </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div style="background: #dc2626; color: white; padding: 10px; margin-bottom: 10px;">
            <?= $error ?>
        </div>
    <?php endif; ?>
        <form class="cform" action="" method="POST">

            <h3 class="cform-title">Demande de devis</h3>
            <p class="cform-sub">Réponse garantie sous 48h ouvrées</p>

            <div class="frow">
            <div class="fg">
                <label>Prénom</label>
                <input type="text" name="prenom" placeholder="Votre prénom" required>
            </div>

            <div class="fg">
                <label>Nom</label>
                <input type="text" name="nom" placeholder="Votre nom" required>
            </div>
            </div>

            <div class="fg">
            <label>Email</label>
            <input type="email" name="email" placeholder="votre@email.com" required>
            </div>

            <div class="fg">
            <label>Téléphone</label>
            <input type="tel" name="telephone" placeholder="+221 77 000 00 00">
            </div>

            <div class="fg">
            <label>Service souhaité</label>
            <select name="service">
            <option value="">Choisissez un service…</option>
            <option>Location de véhicules</option>
            <option>Transport touristique</option>
            <option>Transit international</option>
            <option>Événementiel</option>
            <option>Déménagement</option>
            <option>Location d'engins</option>
            </select>
            </div>

            <div class="fg">
            <label>Message</label>
            <textarea name="message" placeholder="Décrivez votre besoin"></textarea>
            </div>

            <button type="submit" class="btn-sub">
            Envoyer la demande
            </button>

        </form>
      </div>
    </div>
  </div>
</section>

<!-- ═══ FOOTER ═══ -->
<footer>
  <div class="footer-inner">
    <div class="ft">
      <div class="fb">
        <div class="fn">SGL</div>
        <div class="ftag">Société de Gestion et de Logistique</div>
        <p>L'excellence logistique au service de vos projets.<br>Almadies, Dakar — Sénégal</p>
      </div>
      <div class="fc">
        <h5>Services</h5>
        <ul>
          <li><a href="#services">Location de véhicules</a></li>
          <li><a href="#services">Transport touristique</a></li>
          <li><a href="#services">Transit international</a></li>
          <li><a href="#services">Événementiel</a></li>
          <li><a href="#services">Déménagement</a></li>
          <li><a href="#services">Location d'engins</a></li>
        </ul>
      </div>
      <div class="fc">
        <h5>Contact</h5>
        <ul>
          <li><a href="tel:+221775588881">77 558 88 81</a></li>
          <li><a href="tel:+221338651395">33 865 13 95</a></li>
          <li><a href="tel:+221779327777">77 932 77 77</a></li>
          <li><a href="mailto:sglcompagny@gmail.com">sglcompagny@gmail.com</a></li>
        </ul>
      </div>
    </div>
    <div class="fb-bot">
      <span>© 2025 SGL – Société de Gestion et de Logistique. Tous droits réservés.</span>
      <span>Dakar, Sénégal</span>
    </div>
  </div>
</footer>


</body>
</html>