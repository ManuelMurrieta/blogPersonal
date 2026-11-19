<div class="reading-container">
  <span class="meta">Archivo del micro-diario</span>
  <h1>Apuntes de camerino</h1>
  <p style="color: var(--ink-muted); margin-bottom: 40px;">
    Frases que escuché, avances chicos, estados de ánimo y pensamientos sin editar.
  </p>

  <?php foreach ($notas as $nota): ?>
    <div class="note-entry">
      <span class="note-date"><?= htmlspecialchars($nota['date']) ?></span>
      <p><?= htmlspecialchars($nota['text']) ?></p>
    </div>
  <?php endforeach; ?>
</div>
