<?php
$avatarUrl = $perfil['avatar'] ?? '/img/perfil-placeholder.svg';
$facetas = $perfil['facetasPersonales'] ?? [];
?>
<div>
  <span class="meta">Bitácora personal</span>
  <h1 style="font-size: 2.4rem; font-weight: 400; margin-bottom: 32px;">Sobre mí</h1>

  <div class="about-layout">
    <div>
      <div class="reading-body">
        <p>
          Estudio Ingeniería de Sistemas, paso buena parte del día entre código, lógica y pantallas, y aun así creo que las cosas más verdaderas pasan cuando apagamos el monitor y nos sentamos a conversar sin apuro. Me gusta el teatro porque obliga a estar presente, a escuchar de verdad y a habitar el silencio tanto como la palabra.
        </p>
        <p>
          Últimamente ando intentando aprender a vivir más lento. No es fácil cuando el mundo te pide velocidad constante y soluciones inmediatas, pero sí necesario. Me mueven las charlas largas que empiezan hablando de un videojuego o de una película y terminan tocando recuerdos, dudas o planes que nadie tenía previstos; me mueve estar cerca de la gente con la que da gusto coincidir.
        </p>
        <p>
          Escribo desde un lugar bastante sencillo: a veces con ironía, a veces con nostalgia, casi siempre intentando entender qué me está pasando por dentro. No vengo a dar lecciones ni fórmulas mágicas. Este espacio es solo una mesa puesta por si te apetece leer con calma, revisar lo que voy pensando o quedarte un rato.
        </p>
      </div>

      <?php if (!empty($facetas)): ?>
        <div class="personal-cards">
          <?php foreach ($facetas as $faceta): ?>
            <div class="mini-card">
              <span class="mini-card-title"><?= htmlspecialchars($faceta['titulo']) ?></span>
              <p><?= htmlspecialchars($faceta['detalle']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="about-gallery">
      <figure class="photo-frame">
        <img src="<?= htmlspecialchars($avatarUrl) ?>" alt="Retrato personal" />
        <figcaption class="photo-caption">
          <span>Autorretrato sin pose</span>
          <span>#01</span>
        </figcaption>
      </figure>

      <figure class="photo-frame tilt-left landscape">
        <img src="/img/teatro-ensayo.svg" alt="Escenario o rincón cotidiano" />
        <figcaption class="photo-caption">
          <span>Donde pasan las ideas</span>
          <span>#02</span>
        </figcaption>
      </figure>
    </div>
  </div>
</div>
