<?php
$avatarUrl = $perfil['avatar'] ?? '/img/perfil-placeholder.svg';
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="stylesheet" href="/style.css" />
    <title><?= htmlspecialchars($pageTitle) ?></title>
  </head>
  <body>
    <div class="container">
      <header>
        <div class="nav-wrap">
          <div class="brand-group">
            <img src="<?= htmlspecialchars($avatarUrl) ?>" alt="Foto de perfil" class="nav-avatar" />
            <a href="/" class="site-title">Entreacto</a>
          </div>
          <nav>
            <a href="/" class="<?= $seccion === 'inicio' ? 'active' : '' ?>">Inicio</a>
            <a href="/notas" class="<?= $seccion === 'notas' ? 'active' : '' ?>">Apuntes de camerino</a>
            <a href="/sobre-mi" class="<?= $seccion === 'sobre-mi' ? 'active' : '' ?>">Sobre mí</a>
            <a href="/profesional" class="<?= $seccion === 'profesional' ? 'active' : '' ?>">Profesional / CV</a>
          </nav>
        </div>
      </header>
      <main>
