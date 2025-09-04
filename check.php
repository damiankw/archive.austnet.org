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
    if (preg_match('/^(https?:|mailto:|ftp:)/i', $url)) return ['status'=>'external'];
    if (strpos($url, '#') === 0) return ['status'=>'Good'];
    $url = strtok($url, '?'); // Remove query string
    $urlTrimmed = ltrim($url);
    // If the URL is exactly 'index.html', '../index.html', or '/index.html', mark as Ignored
    if (preg_match('#^(\.\./)*index\.html$#i', $urlTrimmed) || preg_match('#^/index\.html$#i', $urlTrimmed)) {
        return ['status'=>'Ignored'];
    }
    // If the normalized path+file is exactly 'index.html', mark as Good
    $fullPath = realpath($dir . '/' . $urlTrimmed);
    if ($fullPath && strtolower(basename($fullPath)) === 'index.html' && dirname($fullPath) === realpath($dir)) {
        return ['status'=>'Good'];
    }
    $yearRoot = dirname($dir);
    $docroot = $_SERVER['DOCUMENT_ROOT'] ?? getcwd();
    // 1. Direct relative
    $path = realpath($dir . '/' . $url);
    if ($path && file_exists($path)) return ['status'=>'Good'];
    // 2. Try relative to docroot
    $alt = realpath($docroot . '/' . ltrim($url, '/'));
    if ($alt && file_exists($alt)) return ['status'=>'Good'];
    // 3. Trim leading ./ or /
    $trimmed = ltrim($url, '/.');
    $trimmedPath = $trimmed ? realpath($dir . '/' . $trimmed) : false;
    if ($trimmed && $trimmedPath && file_exists($trimmedPath)) {
        $rel = getRelativePath($dir, $trimmedPath);
        return ['status'=>'Trim Found','new'=>$rel];
    }
    // 4. Try in year root (0000/trimmedfile)
    $yearRootPath = $yearRoot . '/' . $trimmed;
    if ($trimmed && file_exists($yearRootPath)) {
        $rel = getRelativePath($dir, $yearRootPath);
        return ['status'=>'Root Trim Found','new'=>$rel];
    }
    // 5. Try in year root (0000/file)
    $yearRootPath2 = $yearRoot . '/' . $url;
    if ($url && file_exists($yearRootPath2)) {
        $rel = getRelativePath($dir, $yearRootPath2);
        return ['status'=>'Root Found','new'=>$rel];
    }
    // 6. Search for the full trimmed relative path anywhere in the year directory
    $searchPath = $trimmed ?: $url;
    if ($searchPath) {
        $pattern = $yearRoot . '/**/' . $searchPath;
        $matches = glob($pattern, GLOB_BRACE|GLOB_NOSORT|GLOB_MARK);
        if ($matches && count($matches) > 0) {
            $found = realpath($matches[0]);
            if ($found && file_exists($found)) {
                $rel = getRelativePath($dir, $found);
                return ['status'=>'Found Anywhere','new'=>$rel];
            }
        }
    }
    return ['status'=>'no'];
}

function getRelativePath($from, $to) {
    $from = str_replace(['\\','//'],'/',realpath($from));
    $to = str_replace(['\\','//'],'/',realpath($to));
    $from = explode('/', rtrim($from, '/'));
    $to = explode('/', rtrim($to, '/'));
    while(count($from) && count($to) && ($from[0] == $to[0])) {
        array_shift($from);
        array_shift($to);
    }
    return str_repeat('../', count($from)) . implode('/', $to);
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<style>
body { font-family: Arial, sans-serif; background: #f8f8f8; font-size: 13px; }
table { font-size: 12px; }
tr.missing td { background: #ffe0e0 !important; }
tr.external td { background: #e0e0ff !important; }
tr.ok td { background: #e0ffe0 !important; }
tr.trim td { background: #fffbe0 !important; }
.btn-danger { background-color: #dc3545 !important; color: #fff !important; border-color: #dc3545 !important; }
.btn-warning { background-color: #ffc107 !important; color: #212529 !important; border-color: #ffc107 !important; }
.btn-success { background-color: #198754 !important; color: #fff !important; border-color: #198754 !important; }
.btn-primary { background-color: #0d6efd !important; color: #fff !important; border-color: #0d6efd !important; }
</style>
</head><body>
<div class="container my-4">
<h2 class="mb-3">Link Checker Results for <?php echo htmlspecialchars($year); ?></h2>
<div class="mb-3">
<?php
$currentYear = intval($year);
$prevYear = $currentYear > 0 ? $currentYear - 1 : '';
$nextYear = $currentYear > 0 ? $currentYear + 1 : '';
?>
<a class="btn btn-secondary btn-sm me-2" href="?year=<?php echo $prevYear; ?>" <?php if (!$prevYear) echo 'disabled'; ?>>&laquo; Previous Year</a>
<a class="btn btn-secondary btn-sm me-3" href="?year=<?php echo $nextYear; ?>">Next Year &raquo;</a>
    <button class="btn btn-sm btn-danger me-1" onclick="toggleRows('missing')">Show/Hide Not Found</button>
    <button class="btn btn-sm btn-warning me-1" onclick="toggleRows('trim')">Show/Hide Found (TRIM/ROOT/SEARCH)</button>
    <button class="btn btn-sm btn-success me-1" onclick="toggleRows('ok')">Show/Hide Good</button>
    <button class="btn btn-sm btn-primary me-1" onclick="toggleRows('external')">Show/Hide External</button>
    <button class="btn btn-sm btn-outline-secondary me-1" onclick="toggleRows('all', true)">Show All</button>
    <button class="btn btn-sm btn-outline-secondary me-1" onclick="toggleRows('all', false)">Hide All</button>
</div>
<table class="table table-bordered table-sm align-middle">
<thead class="table-light">
<tr><th>File</th><th>Line</th><th>Type</th><th>URL</th><th>Status</th><th>Found Path</th></tr>
</thead><tbody>
<?php foreach ($results as $r):
    $status = is_array($r['exists']) ? $r['exists']['status'] : $r['exists'];
    $class = ($status === 'Good' || $status === 'Ignored') ? 'ok' : ($status === 'external' ? 'external' : ($status === 'Trim Found' ? 'trim' : ($status === 'Root Trim Found' ? 'trim' : ($status === 'Root Found' ? 'trim' : ($status === 'Found Anywhere' ? 'trim' : 'missing')))));
    // Map status to user-friendly label
    $label = $status;
    if ($status === 'no') $label = 'Not Found';
    elseif ($status === 'Ignored') $label = 'Ignored';
    elseif ($status === 'external') $label = 'External Link';
    elseif ($status === 'Root Trim Found' || $status === 'Root Found') $label = 'Found (ROOT)';
    elseif ($status === 'Trim Found') $label = 'Found (TRIM)';
    elseif ($status === 'Found Anywhere') $label = 'Found (SEARCH)';
?>
<tr class="<?php echo $class; ?>">
<td><?php echo htmlspecialchars(str_replace(__DIR__ . '/', '', $r['file'])); ?></td>
<td><?php echo $r['line']; ?></td>
<td><?php echo $r['type']; ?></td>
<td><?php echo htmlspecialchars($r['url']); ?></td>
<td><?php echo $label; ?></td>
<td><?php echo isset($r['exists']['new']) ? htmlspecialchars($r['exists']['new']) : ''; ?></td>
</tr>
<?php endforeach; ?>
</tbody></table>
</div>
<script>
function toggleRows(type, showAll) {
    var trs = document.querySelectorAll('tr.'+type);
    if (type === 'all') {
        var all = document.querySelectorAll('tbody tr');
        all.forEach(function(tr){ tr.style.display = showAll ? '' : 'none'; });
        return;
    }
    trs.forEach(function(tr){
        tr.style.display = (tr.style.display === 'none') ? '' : 'none';
    });
}
// Hide all rows except 'trim' (TRIM/ROOT/SEARCH) by default on page load
window.addEventListener('DOMContentLoaded', function() {
    var allRows = document.querySelectorAll('tbody tr');
    allRows.forEach(function(tr){
        if (!tr.classList.contains('trim')) {
            tr.style.display = 'none';
        }
    });
});
</script>
</body></html>
