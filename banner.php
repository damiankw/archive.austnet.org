<?php
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $domain = $year = $filePath = '';
    if ($referer) {
        $parts = parse_url($referer);
        $domain = isset($parts['host']) ? $parts['host'] : '';
        if (isset($parts['path'])) {
            $pathParts = explode('/', trim($parts['path'], '/'));
            // Find year (first 4-digit segment)
            foreach ($pathParts as $segment) {
                if (preg_match('/^\d{4}$/', $segment)) {
                    $year = $segment;
                    break;
                }
            }
            // File path (everything after year)
            if ($year) {
                $yearIndex = array_search($year, $pathParts);
                $filePath = implode('/', array_slice($pathParts, $yearIndex + 1));
            }
        }
    }
?>
<div id="austnet-archive-banner" style="width:100vw; min-height:54px; background:#2c3e50; color:#fff; display:flex; align-items:center; justify-content:space-between; font-size:1.08em; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen,Ubuntu,Cantarell,sans-serif; position:fixed; top:0; left:0; z-index:1000; box-shadow:0 2px 8px rgba(44,62,80,0.10); padding:0 32px; border-bottom:1px solid #22313a;">
  <div style="display:flex; align-items:center; gap:0.9em;">
    <img src="/images/austnet-logo-small.png" alt="AustNet Logo" />
    <span style="font-weight:700; letter-spacing:0.7px; font-size:1.18em; text-shadow:0 1px 2px rgba(44,62,80,0.10);">AustNet Archive</span>
    <span style="font-size:0.95em; font-weight:400; color:#b8c6d1; margin-left:1.2em;">
      <?php if ($domain) echo 'Domain: <b>' . htmlspecialchars($domain) . '</b>'; ?>
      <?php if ($year) echo ' &mdash; Year: <b>' . htmlspecialchars($year) . '</b>'; ?>
      <?php if ($filePath) echo ' &mdash; Path: <b>' . htmlspecialchars($filePath) . '</b>'; ?>
    </span>
  </div>
  <div style="font-size:1.1em; opacity:0.95; font-weight:600; text-align:right; display:flex; align-items:center; gap:1em; margin-right:2vw;">
    <?php
      // Get all year folders
      $yearDirs = array_filter(scandir(__DIR__), function($d) {
        return is_dir(__DIR__ . "/$d") && preg_match('/^\d{4}$/', $d);
      });
      sort($yearDirs, SORT_NUMERIC);
      $yearIndex = array_search($year, $yearDirs);
      $prevYear = ($yearIndex !== false && $yearIndex > 0) ? $yearDirs[$yearIndex - 1] : null;
      $nextYear = ($yearIndex !== false && $yearIndex < count($yearDirs) - 1) ? $yearDirs[$yearIndex + 1] : null;
    ?>
    <?php if ($prevYear): ?>
      <a href="/<?php echo $prevYear; ?>/<?php echo htmlspecialchars($filePath); ?>" style="color:#fff; text-decoration:none; font-size:1.2em; padding:0 0.3em;">&lt; <?php echo $prevYear; ?></a>
    <?php endif; ?>
    <?php if ($year): ?>
      <span style="color:#b8c6d1; font-size:1.1em;">| <?php echo $year; ?> |</span>
    <?php endif; ?>
    <?php if ($nextYear): ?>
      <a href="/<?php echo $nextYear; ?>/<?php echo htmlspecialchars($filePath); ?>" style="color:#fff; text-decoration:none; font-size:1.2em; padding:0 0.3em;"><?php echo $nextYear; ?> &gt;</a>
    <?php endif; ?>
  </div>
</div>