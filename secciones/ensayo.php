<?php
$slug = $_GET['slug'] ?? '';
$ensayoActual = null;

foreach ($ensayos as $e) {
    if ($e['slug'] === $slug) {
        $ensayoActual = $e;
        break;
    }
}
?>

<article class="reading-container">
  <a href="/" style="font-family: var(--font-mono); font-size: 0.8rem; display: inline-block; margin-bottom: 32px;">
    ← Volver al inicio
  </a>

  <?php if ($ensayoActual): ?>
    <span class="meta"><?= htmlspecialchars($ensayoActual['date']) ?> · <?= htmlspecialchars($ensayoActual['readTime']) ?></span>
    <h1><?= htmlspecialchars($ensayoActual['title']) ?></h1>
    <div class="reading-body">
      <?php foreach ($ensayoActual['paragraphs'] as $p): ?>
        <p><?= htmlspecialchars($p) ?></p>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <h1>Texto no encontrado</h1>
    <p>Parece que este ensayo todavía no ha sido escrito o el enlace cambió.</p>
  <?php endif; ?>
</article>
