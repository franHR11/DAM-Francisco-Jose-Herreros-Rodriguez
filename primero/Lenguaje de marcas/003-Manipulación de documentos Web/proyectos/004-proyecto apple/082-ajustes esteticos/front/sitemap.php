<?php
// Configuración básica
$base_url = "https://pcprogramacion.es";
$exclude = ["/admin", "/private"]; // Rutas a excluir del sitemap

// Función para rastrear el sitio web
function crawl_site($url, $base_url, &$visited = []) {
    $html = @file_get_contents($url);
    if ($html === false) {
        return [];
    }

    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $links = $xpath->query("//a[@href]");
    $urls = [];

    foreach ($links as $link) {
        $href = $link->getAttribute("href");
        if (strpos($href, "#") === 0 || in_array($href, $visited)) {
            continue; // Ignorar anclajes y duplicados
        }
        if (filter_var($href, FILTER_VALIDATE_URL) === false) {
            // Convertir rutas relativas en URLs absolutas
            $href = rtrim($base_url, "/") . "/" . ltrim($href, "/");
        }
        if (strpos($href, $base_url) === 0) {
            $urls[] = $href;
            $visited[] = $href;
        }
    }

    foreach (array_unique($urls) as $sub_url) {
        if (!in_array($sub_url, $visited)) {
            $urls = array_merge($urls, crawl_site($sub_url, $base_url, $visited));
        }
    }
    return array_unique($urls);
}

// Generar URLs
$urls = crawl_site($base_url, $base_url);

// Crear el sitemap XML
header("Content-Type: application/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

foreach ($urls as $url) {
    if (!in_array(parse_url($url, PHP_URL_PATH), $exclude)) {
        echo "  <url>" . PHP_EOL;
        echo "    <loc>" . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . "</loc>" . PHP_EOL;
        echo "    <lastmod>" . date("Y-m-d") . "</lastmod>" . PHP_EOL;
        echo "    <changefreq>weekly</changefreq>" . PHP_EOL;
        echo "    <priority>0.8</priority>" . PHP_EOL;
        echo "  </url>" . PHP_EOL;
    }
}

echo '</urlset>' . PHP_EOL;
