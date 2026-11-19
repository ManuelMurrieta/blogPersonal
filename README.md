# Entreacto — Blog personal y espacio profesional (PHP + Vercel)

## Estructura
- `api/index.php`: Punto de entrada y enrutador para Vercel.
- `secciones/`: Vistas PHP modulares (`header.php`, `footer.php`, `inicio.php`, `ensayo.php`, `notas.php`, `sobre-mi.php`, `profesional.php`).
- `datos/`: Contenido editable en JSON (`ensayos.json`, `diario.json`, `perfil.json`).
- `public/img/`: Carpeta para tus fotos reales (`perfil.jpg`, etc.).
- `public/docs/`: Carpeta para subir tu CV descargable (`cv-personal.pdf`).
- `public/style.css`: Diseño editorial con marcos fotográficos, tarjetas de proyectos y hoja de CV.

## Cómo personalizar tus datos
1. **Tus fotos:** Sube tu retrato a `public/img/perfil.jpg` y actualiza la ruta en `datos/perfil.json` (o reemplaza `perfil-placeholder.svg`).
2. **Tu CV en PDF:** Sube tu archivo a `public/docs/cv-personal.pdf` para que el botón de descarga funcione directamente.
3. **Tu trayectoria:** Edita `datos/perfil.json` con tus proyectos, stack, formación y experiencia.
