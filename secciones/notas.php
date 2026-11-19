<div class="reading-container">
  <span class="meta">Archivo del micro-diario</span>
  <h1>Apuntes de camerino</h1>
  <p style="color: var(--ink-muted); margin-bottom: 40px;">
    Frases que escuché, avances chicos, estados de ánimo, fotos sin editar y pensamientos sueltos.
  </p>

  <?php foreach ($notas as $nota): ?>
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
</div>
