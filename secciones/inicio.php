<?php
$destacado = null;
$otrosEnsayos = [];

foreach ($ensayos as $e) {
    if (!empty($e['featured']) && $destacado === null) {
        $destacado = $e;
    } else {
        $otrosEnsayos[] = $e;
    }
}

if ($destacado === null && count($ensayos) > 0) {
    $destacado = array_shift($otrosEnsayos);
}

$notasRecientes = array_slice($notas, 0, 3);
$avatarUrl = $perfil['avatar'] ?? '/img/perfil.jpg';
?>

<section class="hero-editorial">
  <div>
    <?php if ($destacado): ?>
      <span class="meta">
        Destacado · <?= htmlspecialchars($destacado['date']) ?> · <?= htmlspecialchars($destacado['readTime']) ?>
      </span>
      <h1>
        <a href="/ensayo?slug=<?= urlencode($destacado['slug']) ?>" style="border: none;">
          <?= htmlspecialchars($destacado['title']) ?>
        </a>
      </h1>
      <p><?= htmlspecialchars($destacado['excerpt']) ?></p>
      <div class="btn-group">
        <a href="/ensayo?slug=<?= urlencode($destacado['slug']) ?>" class="btn-link">
          Leer ensayo completo →
        </a>
        <a href="/profesional" class="btn-secondary">
          Perfil profesional & CV
        </a>
      </div>
    <?php endif; ?>
  </div>

  <figure class="photo-frame">
    <img src="<?= htmlspecialchars($avatarUrl) ?>" alt="Retrato personal" />
    <figcaption class="photo-caption">
      <span>Entre código y escenario</span>
      <span>2026</span>
    </figcaption>
  </figure>
</section>

<div class="main-grid">
  <section>
    <div class="section-label">Textos largos</div>
    <?php foreach ($otrosEnsayos as $essay): ?>
      <article class="essay-item">
        <span class="meta"><?= htmlspecialchars($essay['date']) ?> · <?= htmlspecialchars($essay['readTime']) ?></span>
        <h2>
          <a href="/ensayo?slug=<?= urlencode($essay['slug']) ?>">
            <?= htmlspecialchars($essay['title']) ?>
          </a>
        </h2>
        <p><?= htmlspecialchars($essay['excerpt']) ?></p>
      </article>
    <?php endforeach; ?>
  </section>

  <aside class="diary-box">
    <div class="section-label">Apuntes de camerino</div>
    <?php foreach ($notasRecientes as $nota): ?>
      <div class="note-entry">
        <span class="note-date"><?= htmlspecialchars($nota['date']) ?></span>
        <p><?= htmlspecialchars($nota['text']) ?></p>
        <?php if (!empty($nota['image'])): ?>
          <figure class="note-photo">
            <img src="<?= htmlspecialchars($nota['image']) ?>" alt="Nota visual" />
            <?php if (!empty($nota['caption'])): ?>
              <figcaption><?= htmlspecialchars($nota['caption']) ?></figcaption>
            <?php endif; ?>
          </figure>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
    <a href="/notas" style="font-family: var(--font-mono); font-size: 0.78rem;">
      Abrir archivo de notas →
    </a>
  </aside>
</div>
