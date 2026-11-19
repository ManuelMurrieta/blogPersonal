<?php
declare(strict_types=1);

$baseDir = dirname(__DIR__);

function cargarJsonSeguro(string $ruta, array $fallback): array {
    if (!is_file($ruta)) {
        return $fallback;
    }
    $contenido = file_get_contents($ruta);
    if ($contenido === false) {
        return $fallback;
    }
    $datos = json_decode($contenido, true);
    return is_array($datos) ? $datos : $fallback;
}

$ensayosFallback = [
    [
        'slug' => 'el-arte-de-no-compilar-a-las-tres-de-la-manana',
        'title' => 'El arte de no compilar a las tres de la mañana',
        'date' => '2026-11-12',
        'readingTime' => '6 min de lectura',
        'featured' => true,
        'excerpt' => 'Aprender a vivir más lento cuando pasas el día entre terminales, puertos abiertos y la urgencia de tenerlo todo resuelto.',
        'body' => [
            'En ingeniería de sistemas es fácil confundir velocidad con progreso. Levantas un servicio, revisas logs, ajustas un parámetro y sientes que el mundo avanza porque el cursor parpadea rápido. Pero hay cosas que no responden a un `restart`.',
            'Últimamente me interesa el ritmo opuesto: dejar que una idea repose igual que una escena de teatro después de un ensayo general. Cuando dejas de empujar el código a la fuerza, notas qué partes sobran y qué conversaciones pendientes vale la pena tener sin prisa.',
            'Jugar un rato sin objetivo de optimización o sentarme a escuchar a alguien sin preparar la respuesta ya me parece un acto de resistencia bastante decente.'
        ]
    ],
    [
        'slug' => 'escuchar-como-en-un-ensayo-de-teatro',
        'title' => 'Escuchar como en un ensayo de teatro',
        'date' => '2026-10-28',
        'readingTime' => '5 min de lectura',
        'featured' => false,
        'excerpt' => 'En escena nadie habla esperando su turno para presumir lo que sabe; se escucha el aire de la sala y el peso de cada réplica.',
        'body' => [
            'Una buena conversación tiene mucho de camerino y de tabla: no se trata de recitar tu monólogo, sino de notar dónde cambia el tono del otro.',
            'A veces me sorprende lo ruidoso que es todo cuando nadie está escuchando de verdad. En el teatro, un silencio de dos segundos puede sostener media obra; en la vida diaria solemos llenarlo con prisa.'
        ]
    ],
    [
        'slug' => 'guardar-partida-y-salir-a-caminar',
        'title' => 'Guardar partida y salir a caminar',
        'date' => '2026-10-14',
        'readingTime' => '4 min de lectura',
        'featured' => false,
        'excerpt' => 'Los videojuegos me enseñaron a respetar los puntos de guardado; la vida real rara vez avisa antes de cambiar de acto.',
        'body' => [
            'Hay mundos digitales donde descansar junto a una fogata es parte de la mecánica del juego, no una pérdida de tiempo.',
            'Volver a lo sencillo —una charla larga, un café tibio, una tarde sin agendas— es simplemente buscar un punto de guardado antes de seguir.'
        ]
    ]
];

$notasFallback = [
    [
        'date' => '2026-11-18',
        'tag' => 'conversación',
        'text' => '“No es que no tengas tiempo, es que le dices que sí a cosas que ni siquiera te importan.” — Dicho entre pasillos después de clase.'
    ],
    [
        'date' => '2026-11-15',
        'tag' => 'código',
        'text' => 'Probando rutas limpias y evitando dependencias innecesarias. Menos piezas móviles, menos noches en vela.'
    ],
    [
        'date' => '2026-11-10',
        'tag' => 'juego',
        'text' => 'Llevo tres horas explorando un mapa sin mirar guías. Qué alivio no ir corriendo al siguiente marcador.'
    ],
    [
        'date' => '2026-11-04',
        'tag' => 'teatro',
        'text' => 'Luz baja, piso de madera crujiendo y alguien ajustando una silla antes de empezar. Ese sonido ya me baja las revoluciones.'
    ],
    [
        'date' => '2026-10-29',
        'tag' => 'ánimo',
        'text' => 'Semana de campus pesado, pero buenas sobremesas. Todo se equilibra cuando la gente con la que estás es genuina.'
    ]
];

$perfilFallback = [
    'nombre' => 'Entreacto',
    'bio_corta' => 'Estudiante de Ingeniería de Sistemas, programador y amante del teatro. Escribo entre actos, códigos y tardes sin prisa.',
    'sobre_mi' => [
        'Soy estudiante de Ingeniería de Sistemas y paso buena parte del día entre lógica, servidores y problemas que exigen cabeza fría. Pero lo que me mantiene entero es lo que pasa cuando cierro la terminal: el teatro, las charlas largas sin reloj y aprender a vivir un poco más lento.',
        'Me gusta la ironía cuando no lastima, la franqueza sin poses y la nostalgia tranquila de las cosas bien hechas. Este espacio no busca métricas ni aplausos rápidos; es apenas un entreacto para ordenar lo que pienso y lo que voy viviendo.',
        'Si estás aquí leyendo, bienvenido. Siéntate un rato, sin apuro.'
    ],
    'enlaces' => [
        ['label' => 'GitHub', 'url' => 'https://github.com'],
        ['label' => 'Correo', 'url' => 'mailto:hola@ejemplo.com']
    ]
];

$ensayos = cargarJsonSeguro($baseDir . '/datos/ensayos.json', $ensayosFallback);
$notas = cargarJsonSeguro($baseDir . '/datos/diario.json', $notasFallback);
$perfil = cargarJsonSeguro($baseDir . '/datos/perfil.json', $perfilFallback);

$seccion = $_GET['seccion'] ?? 'inicio';
$seccionesPermitidas = ['inicio', 'ensayo', 'notas', 'sobre-mi', 'profesional'];

if (!in_array($seccion, $seccionesPermitidas, true)) {
    $seccion = 'inicio';
}

$slugActual = $_GET['slug'] ?? '';
$ensayoSeleccionado = null;

if ($seccion === 'ensayo') {
    foreach ($ensayos as $item) {
        if (($item['slug'] ?? '') === $slugActual) {
            $ensayoSeleccionado = $item;
            break;
        }
    }
    if ($ensayoSeleccionado === null && !empty($ensayos)) {
        $ensayoSeleccionado = $ensayos[0];
    }
}

$pageTitle = ($perfil['nombre'] ?? 'Entreacto') . ' — Blog personal';
if ($seccion === 'notas') {
    $pageTitle = 'Apuntes de camerino — ' . ($perfil['nombre'] ?? 'Entreacto');
} elseif ($seccion === 'sobre-mi') {
    $pageTitle = 'Sobre mí — ' . ($perfil['nombre'] ?? 'Entreacto');
} elseif ($seccion === 'profesional') {
    $pageTitle = 'Trayectoria y CV — ' . ($perfil['nombre'] ?? 'Entreacto');
} elseif ($seccion === 'ensayo' && $ensayoSeleccionado !== null) {
    $pageTitle = $ensayoSeleccionado['title'] . ' — ' . ($perfil['nombre'] ?? 'Entreacto');
}

$destacado = $ensayos[0] ?? null;
foreach ($ensayos as $item) {
    if (!empty($item['featured'])) {
        $destacado = $item;
        break;
    }
}

$otrosEnsayos = array_values(array_filter($ensayos, static function (array $item) use ($destacado): bool {
    return $destacado === null || ($item['slug'] ?? '') !== ($destacado['slug'] ?? '');
}));

$notasPortada = array_slice($notas, 0, 4);

function h(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($pageTitle) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #FAF8F5;
            --surface: #F3EFEA;
            --ink: #24221F;
            --muted: #666159;
            --accent: #7A4B3A;
            --border: #E2DBD2;
            --font-serif: 'Newsreader', Georgia, serif;
            --font-mono: 'JetBrains Mono', ui-monospace, monospace;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background-color: var(--bg);
            color: var(--ink);
            font-family: var(--font-serif);
            font-size: 19px;
            line-height: 1.72;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration-color: var(--border);
            text-underline-offset: 4px;
            transition: color 0.15s ease, text-decoration-color 0.15s ease;
        }

        a:hover {
            color: var(--accent);
            text-decoration-color: var(--accent);
        }

        .container {
            max-width: 1040px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .narrow {
            max-width: 68ch;
        }

        .mono {
            font-family: var(--font-mono);
            font-size: 0.78rem;
            letter-spacing: 0.02em;
            color: var(--muted);
        }

        header.site-header {
            border-bottom: 1px solid var(--border);
            padding: 28px 0;
            margin-bottom: 48px;
        }

        .header-inner {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            justify-content: space-between;
            gap: 16px 32px;
        }

        .brand {
            font-size: 1.55rem;
            font-weight: 500;
            text-decoration: none;
            letter-spacing: -0.01em;
        }

        .brand:hover {
            color: var(--ink);
        }

        nav.site-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        nav.site-nav a {
            font-family: var(--font-mono);
            font-size: 0.8rem;
            text-decoration: none;
            color: var(--muted);
            padding-bottom: 2px;
            border-bottom: 1px solid transparent;
        }

        nav.site-nav a:hover,
        nav.site-nav a.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }

        .featured-box {
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 36px;
            margin-bottom: 52px;
        }

        .eyebrow {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--accent);
            margin-bottom: 12px;
        }

        h1, h2, h3 {
            font-weight: 500;
            line-height: 1.25;
            margin-top: 0;
            letter-spacing: -0.015em;
        }

        .featured-box h1 {
            font-size: clamp(1.8rem, 3.2vw, 2.5rem);
            margin-bottom: 14px;
        }

        .excerpt {
            color: var(--muted);
            margin: 0 0 20px;
        }

        .read-link {
            font-family: var(--font-mono);
            font-size: 0.82rem;
            color: var(--accent);
            text-decoration: none;
        }

        .read-link:hover {
            text-decoration: underline;
        }

        .home-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(0, 1fr);
            gap: 48px;
            align-items: start;
        }

        .essay-item {
            padding: 24px 0;
            border-bottom: 1px solid var(--border);
        }

        .essay-item:first-child {
            padding-top: 0;
        }

        .essay-item h3 {
            font-size: 1.35rem;
            margin: 6px 0 8px;
        }

        .camerino-box {
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 28px;
        }

        .camerino-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .camerino-header h2 {
            font-size: 1.25rem;
            margin: 0;
        }

        .note-item {
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
        }

        .note-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .note-meta {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 6px;
        }

        .note-tag {
            font-family: var(--font-mono);
            font-size: 0.72rem;
            color: var(--accent);
            background: var(--bg);
            border: 1px solid var(--border);
            padding: 1px 7px;
        }

        .note-text {
            margin: 0;
            font-size: 0.98rem;
            line-height: 1.6;
        }

        .article-header {
            margin-bottom: 32px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .article-header h1 {
            font-size: clamp(1.9rem, 3.6vw, 2.7rem);
            margin: 10px 0 12px;
        }

        .prose p {
            margin: 0 0 22px;
        }

        .prose code {
            font-family: var(--font-mono);
            font-size: 0.85em;
            background: var(--surface);
            padding: 2px 6px;
            border: 1px solid var(--border);
        }

        .cv-block {
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 24px 28px;
            margin-bottom: 24px;
        }

        footer.site-footer {
            margin-top: 72px;
            padding: 32px 0 44px;
            border-top: 1px solid var(--border);
        }

        .footer-inner {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        @media (max-width: 820px) {
            .home-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .featured-box {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="index.php?seccion=inicio"><?= h($perfil['nombre'] ?? 'Entreacto') ?></a>
            <nav class="site-nav" aria-label="Navegación principal">
                <a href="index.php?seccion=inicio" class="<?= $seccion === 'inicio' ? 'active' : '' ?>">Inicio</a>
                <a href="index.php?seccion=ensayo" class="<?= $seccion === 'ensayo' ? 'active' : '' ?>">Ensayos</a>
                <a href="index.php?seccion=notas" class="<?= $seccion === 'notas' ? 'active' : '' ?>">Apuntes de camerino</a>
                <a href="index.php?seccion=sobre-mi" class="<?= $seccion === 'sobre-mi' ? 'active' : '' ?>">Sobre mí</a>
                <a href="index.php?seccion=profesional" class="<?= $seccion === 'profesional' ? 'active' : '' ?>">Trayectoria</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <?php if ($seccion === 'inicio'): ?>
            <?php if ($destacado !== null): ?>
                <section class="featured-box" aria-label="Ensayo destacado">
                    <div class="eyebrow">Apertura del acto</div>
                    <h1>
                        <a href="index.php?seccion=ensayo&slug=<?= urlencode($destacado['slug']) ?>">
                            <?= h($destacado['title']) ?>
                        </a>
                    </h1>
                    <div class="mono" style="margin-bottom: 14px;">
                        <?= h($destacado['date']) ?> · <?= h($destacado['readingTime'] ?? 'Lectura pausada') ?>
                    </div>
                    <p class="excerpt narrow"><?= h($destacado['excerpt']) ?></p>
                    <a class="read-link" href="index.php?seccion=ensayo&slug=<?= urlencode($destacado['slug']) ?>">
                        Leer ensayo completo →
                    </a>
                </section>
            <?php endif; ?>

            <div class="home-grid">
                <section aria-label="Textos largos">
                    <div class="eyebrow">Ensayos</div>
                    <?php foreach ($otrosEnsayos as $ensayo): ?>
                        <article class="essay-item">
                            <div class="mono">
                                <?= h($ensayo['date']) ?> · <?= h($ensayo['readingTime'] ?? 'Lectura') ?>
                            </div>
                            <h3>
                                <a href="index.php?seccion=ensayo&slug=<?= urlencode($ensayo['slug']) ?>">
                                    <?= h($ensayo['title']) ?>
                                </a>
                            </h3>
                            <p class="excerpt" style="margin-bottom: 10px;"><?= h($ensayo['excerpt']) ?></p>
                            <a class="read-link" href="index.php?seccion=ensayo&slug=<?= urlencode($ensayo['slug']) ?>">
                                Pasar a leer →
                            </a>
                        </article>
                    <?php endforeach; ?>
                </section>

                <aside class="camerino-box" aria-label="Apuntes de camerino">
                    <div class="camerino-header">
                        <h2>Apuntes de camerino</h2>
                        <a class="read-link" href="index.php?seccion=notas">Ver todo →</a>
                    </div>
                    <?php foreach ($notasPortada as $nota): ?>
                        <div class="note-item">
                            <div class="note-meta">
                                <span class="mono"><?= h($nota['date']) ?></span>
                                <?php if (!empty($nota['tag'])): ?>
                                    <span class="note-tag"><?= h($nota['tag']) ?></span>
                                <?php endif; ?>
                            </div>
                            <p class="note-text"><?= h($nota['text']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </aside>
            </div>

        <?php elseif ($seccion === 'ensayo'): ?>
            <?php if ($ensayoSeleccionado !== null): ?>
                <article class="narrow prose">
                    <header class="article-header">
                        <div class="eyebrow">Ensayo</div>
                        <h1><?= h($ensayoSeleccionado['title']) ?></h1>
                        <div class="mono">
                            <?= h($ensayoSeleccionado['date']) ?> · <?= h($ensayoSeleccionado['readingTime'] ?? 'Lectura') ?>
                        </div>
                    </header>
                    <?php foreach ($ensayoSeleccionado['body'] as $parrafo): ?>
                        <p><?= h($parrafo) ?></p>
                    <?php endforeach; ?>
                    <p style="margin-top: 36px;">
                        <a class="read-link" href="index.php?seccion=inicio">← Volver al inicio</a>
                    </p>
                </article>
            <?php else: ?>
                <p class="narrow">Todavía no hay ensayos publicados.</p>
            <?php endif; ?>

        <?php elseif ($seccion === 'notas'): ?>
            <section class="narrow">
                <div class="eyebrow">Archivo completo</div>
                <h1 style="margin-bottom: 10px;">Apuntes de camerino</h1>
                <p class="excerpt">Frases escuchadas, avances sin pulir, juegos, teatro y días de ritmo lento.</p>

                <div class="camerino-box" style="margin-top: 28px;">
                    <?php foreach ($notas as $nota): ?>
                        <div class="note-item">
                            <div class="note-meta">
                                <span class="mono"><?= h($nota['date']) ?></span>
                                <?php if (!empty($nota['tag'])): ?>
                                    <span class="note-tag"><?= h($nota['tag']) ?></span>
                                <?php endif; ?>
                            </div>
                            <p class="note-text"><?= h($nota['text']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

        <?php elseif ($seccion === 'sobre-mi'): ?>
            <section class="narrow prose">
                <div class="eyebrow">Sobre mí</div>
                <h1 style="margin-bottom: 24px;">Entre código, escenario y tardes sin reloj</h1>
                <?php foreach ($perfil['sobre_mi'] as $parrafo): ?>
                    <p><?= h($parrafo) ?></p>
                <?php endforeach; ?>
            </section>

        <?php elseif ($seccion === 'profesional'): ?>
            <section class="narrow">
                <div class="eyebrow">Trayectoria</div>
                <h1 style="margin-bottom: 24px;">Ingeniería, sistemas y trabajo práctico</h1>

                <div class="cv-block">
                    <div class="mono" style="margin-bottom: 6px;">FORMACIÓN</div>
                    <h2 style="font-size: 1.25rem; margin-bottom: 8px;">Estudiante de Ingeniería de Sistemas</h2>
                    <p class="excerpt" style="margin-bottom: 0;">
                        Enfoque en arquitectura de software, redes, sistemas operativos Linux y resolución pragmática de problemas técnicos.
                    </p>
                </div>

                <div class="cv-block">
                    <div class="mono" style="margin-bottom: 6px;">PRÁCTICA Y HERRAMIENTAS</div>
                    <h2 style="font-size: 1.25rem; margin-bottom: 8px;">Desarrollo web estático, scripts y administración</h2>
                    <p class="excerpt" style="margin-bottom: 0;">
                        Construcción de sitios limpios, automatización ligera, configuración de entornos y documentación clara sin adornos innecesarios.
                    </p>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <div class="mono">
                <?= h($perfil['nombre'] ?? 'Entreacto') ?> · Sin contadores ni ruido
            </div>
            <div class="footer-links">
                <?php foreach ($perfil['enlaces'] ?? [] as $enlace): ?>
                    <a class="mono" href="<?= h($enlace['url']) ?>"><?= h($enlace['label']) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </footer>
</body>
</html>
