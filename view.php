<?php
    $path = isset($_GET['path']) ? $_GET['path'] : '';
    $fullPath = __DIR__ . '/' . $path;
    if ($path && file_exists($fullPath)):
        if (is_dir($fullPath)) {
            // Try index.html, then index.htm
            $indexFiles = ['index.html', 'index.htm', 'index.php'];
            $found = false;
            foreach ($indexFiles as $index) {
                $indexPath = rtrim($fullPath, '/') . '/' . $index;
                if (file_exists($indexPath)) {
                    readfile($indexPath);
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                echo "No index file found in directory.";
            }
        } else {
            readfile($fullPath);
        }

?>
<!-- AustNet Archive (C) 2025
  --
  -- From here down is the injection of code from the AustNet Archive
  -- Please disragard everything under this section as it is not from the original website.
  -->
<script>
    (function() {
        if (!window.parent.archiveLoaded) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var div = document.createElement('div');
                    div.innerHTML = xhr.responseText;
                    document.body.appendChild(div.firstChild);
                    // Add top padding to body for banner height
                    var bannerHeight = (div.firstChild && div.firstChild.offsetHeight) ? div.firstChild.offsetHeight : 70; // fallback to 70px if not measurable
                    var currentPadding = window.getComputedStyle(document.body).paddingTop;
                    var currentPaddingPx = parseInt(currentPadding) || 0;
                    document.body.style.paddingTop = (currentPaddingPx + bannerHeight) + 'px';

                    // fix banner if it's in a frame
                    var frame = window.parent.document.getElementsByTagName('frameset')[0];
                    if (frame) {
                        var rows = frame.rows.split(',')[0];
                        frame.rows = (60 + parseInt(rows)) + ',*';
                        alert(frame.rows);
                    }
                }
            };
            xhr.open('GET', '/banner.php', true);
            xhr.send();

            document.title = document.title + ' - AustNet Archive';
        }

        window.parent.archiveLoaded = true;

    })();
</script>
<?php
    else:
        echo "File not found.";
    endif;
?>