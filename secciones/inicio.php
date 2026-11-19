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

$notasRecientes = array_slice($notas, 0, 4);
?>

<?php if ($destacado): ?>
  <section class="featured">
    <span class="meta">
      Destacado · <?= htmlspecialchars($destacado['date']) ?> · <?= htmlspecialchars($destacado['readTime']) ?>
    </span>
    <h1>
      <a href="/ensayo?slug=<?= urlencode($destacado['slug']) ?>" style="border: none;">
        <?= htmlspecialchars($destacado['title']) ?>
      </a>
    </h1>
    <p><?= htmlspecialchars($destacado['excerpt']) ?></p>
    <a href="/ensayo?slug=<?= urlencode($destacado['slug']) ?>">Leer ensayo completo →</a>
  </section>
<?php endif; ?>

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
      </div>
    <?php endforeach; ?>
    <a href="/notas" style="font-family: var(--font-mono); font-size: 0.78rem;">
      Abrir archivo de notas →
    </a>
  </aside>
</div>
