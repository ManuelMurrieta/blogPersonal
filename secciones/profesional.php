<?php
$avatarUrl = $perfil['avatar'] ?? '/img/perfil-placeholder.svg';
$nombre = $perfil['nombre'] ?? 'Tu Nombre';
$titulo = $perfil['titulo'] ?? 'Ingeniería de Sistemas';
$resumen = $perfil['resumen'] ?? '';
$cvPdf = $perfil['cvPdf'] ?? '/docs/cv-personal.pdf';
$proyectos = $perfil['experienciaProyectos'] ?? [];
$educacion = $perfil['educacion'] ?? [];
$habilidades = $perfil['habilidades'] ?? [];
$contacto = $perfil['contacto'] ?? [];
?>
<div>
  <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
    <div>
      <span class="meta">Trayectoria · Ingeniería & Proyectos</span>
      <h1 style="font-size: 2.3rem; font-weight: 400;">Perfil profesional & CV</h1>
    </div>

    <div class="btn-group no-print">
      <a href="<?= htmlspecialchars($cvPdf) ?>" download class="btn-link">
        Descargar CV (PDF) ↓
      </a>
      <button onclick="window.print()" class="btn-secondary" style="cursor: pointer;">
        Imprimir hoja
      </button>
    </div>
  </div>

  <section class="cv-sheet">
    <div class="cv-header">
      <div class="cv-identity">
        <img src="<?= htmlspecialchars($avatarUrl) ?>" alt="Foto profesional" class="cv-avatar" />
        <div>
          <h2 class="cv-name"><?= htmlspecialchars($nombre) ?></h2>
          <p class="cv-role"><?= htmlspecialchars($titulo) ?></p>
        </div>
      </div>
    </div>

    <?php if ($resumen): ?>
      <p class="cv-summary"><?= htmlspecialchars($resumen) ?></p>
    <?php endif; ?>

    <div class="cv-grid">
      <div>
        <div class="cv-block">
          <div class="section-label">Experiencia y proyectos destacados</div>
          <?php foreach ($proyectos as $item): ?>
            <div class="cv-entry">
              <div class="cv-entry-head">
                <h3><?= htmlspecialchars($item['cargo']) ?></h3>
                <span class="cv-period"><?= htmlspecialchars($item['periodo']) ?></span>
              </div>
              <span class="cv-org"><?= htmlspecialchars($item['organizacion']) ?></span>
              <p><?= htmlspecialchars($item['descripcion']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="cv-block">
          <div class="section-label">Formación académica</div>
          <?php foreach ($educacion as $edu): ?>
            <div class="cv-entry">
              <div class="cv-entry-head">
                <h3><?= htmlspecialchars($edu['titulo']) ?></h3>
                <span class="cv-period"><?= htmlspecialchars($edu['periodo']) ?></span>
              </div>
              <span class="cv-org"><?= htmlspecialchars($edu['institucion']) ?></span>
              <p><?= htmlspecialchars($edu['descripcion']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <aside>
        <div class="cv-block">
          <div class="section-label">Herramientas y enfoque</div>
          <div class="tag-cloud">
            <?php foreach ($habilidades as $skill): ?>
              <span class="skill-tag"><?= htmlspecialchars($skill) ?></span>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="cv-block">
          <div class="section-label">Contacto y enlaces</div>
          <ul class="contact-list">
            <?php foreach ($contacto as $c): ?>
              <li>
                <strong><?= htmlspecialchars($c['label']) ?>:</strong>
                <a href="<?= htmlspecialchars($c['url']) ?>" target="_blank" rel="noopener">
                  <?= htmlspecialchars($c['valor']) ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </aside>
    </div>
  </section>
</div>
