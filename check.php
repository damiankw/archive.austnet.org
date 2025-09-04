<?php
// check.php?year=YYYY
// Scans all *.html files in the given year folder, checks internal links, and outputs a report.
// Usage: /check.php?year=1998

function getLinks($file, &$results) {
    $lines = file($file);
    $dir = dirname($file);
    foreach ($lines as $num => $line) {
        // AREA HREF
        if (preg_match_all('/<AREA[^>]*HREF=["\']?([^"\'> ]+)/i', $line, $matches)) {
            foreach ($matches[1] as $url) {
                $results[] = [
                    'file' => $file,
                    'line' => $num+1,
                    'type' => 'AREA HREF',
                    'url' => $url,
                    'exists' => checkExists($url, $dir)
                ];
            }
        }
        // BODY BACKGROUND
        if (preg_match_all('/<BODY[^>]*BACKGROUND=["\']?([^"\'> ]+)/i', $line, $matches)) {
            foreach ($matches[1] as $url) {
                $results[] = [
                    'file' => $file,
                    'line' => $num+1,
                    'type' => 'BODY BACKGROUND',
                    'url' => $url,
                    'exists' => checkExists($url, $dir)
                ];
            }
        }
        // IMG SRC
        if (preg_match_all('/<IMG[^>]*SRC=["\']?([^"\'> ]+)/i', $line, $matches)) {
            foreach ($matches[1] as $url) {
                $results[] = [
                    'file' => $file,
                    'line' => $num+1,
                    'type' => 'IMG SRC',
                    'url' => $url,
                    'exists' => checkExists($url, $dir)
                ];
            }
        }
        // A HREF
        if (preg_match_all('/<A[^>]*HREF=["\']?([^"\'> ]+)/i', $line, $matches)) {
            foreach ($matches[1] as $url) {
                $results[] = [
                    'file' => $file,
                    'line' => $num+1,
                    'type' => 'A HREF',
                    'url' => $url,
                    'exists' => checkExists($url, $dir)
                ];
            }
        }
    }
}

function checkExists($url, $dir) {
    // Ignore external links
    if (preg_match('/^(https?:|mailto:|ftp:|#)/i', $url)) return 'external';
    $url = strtok($url, '?'); // Remove query string
    $path = realpath($dir . '/' . $url);
    if ($path && file_exists($path)) return 'yes';
    // Try relative to docroot
    $docroot = $_SERVER['DOCUMENT_ROOT'] ?? getcwd();
    $alt = realpath($docroot . '/' . ltrim($url, '/'));
    if ($alt && file_exists($alt)) return 'yes';
    return 'no';
}

function scanYear($year) {
    $base = __DIR__ . "/$year";
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($base, FilesystemIterator::SKIP_DOTS)
    );
    $results = [];
    foreach ($files as $file) {
        if (preg_match('/\.html?$/i', $file)) {
            getLinks($file, $results);
        }
    }
    return $results;
}

$year = isset($_GET['year']) ? preg_replace('/[^0-9]/', '', $_GET['year']) : '';
if (!$year || !is_dir(__DIR__ . "/$year")) {
    die('<h2>Invalid or missing year. Usage: /check.php?year=1998</h2>');
}
$results = scanYear($year);
?><!DOCTYPE html>
<html><head>
<title>Link Checker for <?php echo htmlspecialchars($year); ?></title>
<style>
body { font-family: Arial, sans-serif; background: #f8f8f8; }
table { border-collapse: collapse; width: 100%; background: #fff; }
th, td { border: 1px solid #ccc; padding: 6px 10px; }
th { background: #eee; }
tr.missing td { background: #ffe0e0; }
tr.external td { background: #e0e0ff; }
tr.ok td { background: #e0ffe0; }
</style>
</head><body>
<h2>Link Checker Results for <?php echo htmlspecialchars($year); ?></h2>
<table>
<tr><th>File</th><th>Line</th><th>Type</th><th>URL</th><th>Status</th></tr>
<?php foreach ($results as $r):
    $class = $r['exists'] === 'yes' ? 'ok' : ($r['exists'] === 'external' ? 'external' : 'missing'); ?>
<tr class="<?php echo $class; ?>">
<td><?php echo htmlspecialchars(str_replace(__DIR__ . '/', '', $r['file'])); ?></td>
<td><?php echo $r['line']; ?></td>
<td><?php echo $r['type']; ?></td>
<td><?php echo htmlspecialchars($r['url']); ?></td>
<td><?php echo $r['exists']; ?></td>
</tr>
<?php endforeach; ?>
</table>
<p style="margin-top:2em;color:#888;font-size:90%">Checked <?php echo count($results); ?> links in year <?php echo htmlspecialchars($year); ?>.</p>
</body></html>
