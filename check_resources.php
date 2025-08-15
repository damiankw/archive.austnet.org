<?php
// check_resources.php
// Scans a given folder's index.html, follows all local links, and checks if the resources exist.

function get_local_links($html, $base_dir, &$external_links = []) {
    if (empty($html)) return [];
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $links = [];
    $tags = [
        'a' => 'href',
        'img' => 'src',
        'link' => 'href',
        'script' => 'src',
    ];
    foreach ($tags as $tag => $attr) {
        foreach ($dom->getElementsByTagName($tag) as $element) {
            $url = $element->getAttribute($attr);
            if (!$url) continue;
            // Collect web.archive.org and austnet.org links
            if (preg_match('#^https?://web\\.archive\\.org#i', $url) || preg_match('#^https?://(www\\.)?austnet\\.org#i', $url)) {
                if (!in_array($url, $external_links)) $external_links[] = $url;
            }
            // Local resource
            if (!preg_match('#^(https?:)?//#', $url) && strpos($url, 'mailto:') !== 0 && strpos($url, 'javascript:') !== 0) {
                $links[] = $url;
            }
        }
    }
    return array_unique($links);
}

// Recursive crawl for subpages and folders
function crawl_and_collect_links($folder, $start_files = ['index.html', 'index.php'], &$visited = [], &$all_links = [], &$sources = [], &$external_links = []) {
    foreach ($start_files as $file) {
        $path = rtrim($folder, '/') . '/' . $file;
        if (file_exists($path) && !in_array($path, $visited)) {
            $visited[] = $path;
            $html = file_get_contents($path);
            $links = get_local_links($html, $folder, $external_links);
            foreach ($links as $l) {
                if (!in_array($l, $all_links)) {
                    $all_links[] = $l;
                    $sources[$l] = $file;
                }
                // If it's a local HTML/PHP page, crawl it too
                if (preg_match('/\.(html?|php)$/i', $l)) {
                    $sub_path = $folder . '/' . ltrim($l, '/');
                    if (file_exists($sub_path) && !in_array($sub_path, $visited)) {
                        crawl_and_collect_links($folder, [ltrim($l, '/')], $visited, $all_links, $sources, $external_links);
                    }
                }
                // If it's a folder (ends with /), crawl its index.html and index.php, and only mark as OK if one exists
                if (substr($l, -1) === '/') {
                    $subfolder = $folder . '/' . ltrim($l, '/');
                    $found_index = false;
                    foreach (['index.html', 'index.php'] as $subfile) {
                        $subfile_path = $subfolder . $subfile;
                        if (file_exists($subfile_path)) {
                            $found_index = true;
                            if (!in_array($subfile_path, $visited)) {
                                crawl_and_collect_links($folder, [ltrim($l, '/') . $subfile], $visited, $all_links, $sources, $external_links);
                            }
                        }
                    }
                    // If no index file, treat as missing (handled in check_resources)
                }
            }
        }
    }
}

function check_resources($folder) {
    $all_folders = array_filter(glob('[0-9][0-9][0-9][0-9]', GLOB_ONLYDIR), function($f) { return is_dir($f); });
    $all_years = array_map('intval', array_map('basename', $all_folders));
    sort($all_years);
    $year = (int)basename($folder);
    $checked_files = [];
    $links = [];
    $sources = [];
    $external_links = [];
    // Check both index.html and index.php
    foreach (['index.html', 'index.php'] as $index_file) {
        $index = rtrim($folder, '/') . '/' . $index_file;
        if (file_exists($index)) {
            $html = file_get_contents($index);
            $these_links = get_local_links($html, $folder, $external_links);
            foreach ($these_links as $l) {
                if (!in_array($l, $links)) {
                    $links[] = $l;
                    $sources[$l] = $index_file;
                }
            }
        }
    }
    // Navigation buttons for previous/next year (now above the table, aligned)
    $current_year = (int)basename($folder);
    $prev_year = null;
    $next_year = null;
    foreach ($all_years as $y) {
        if ($y < $current_year) $prev_year = $y;
        if ($y > $current_year && $next_year === null) $next_year = $y;
    }
    echo "<div style='display:flex;justify-content:space-between;align-items:center;margin:18px 0 8px 0;width:100%;'>";
    if ($prev_year !== null) {
        echo "<a href='?dir=$prev_year' style='display:inline-block;padding:7px 18px;background:#eee;border-radius:5px;text-decoration:none;color:#2a7ae2;font-weight:bold;border:1px solid #ddd;'>← $prev_year</a>";
    } else {
        echo "<span></span>";
    }
    if ($next_year !== null) {
        echo "<a href='?dir=$next_year' style='display:inline-block;padding:7px 18px;background:#eee;border-radius:5px;text-decoration:none;color:#2a7ae2;font-weight:bold;border:1px solid #ddd;'>$next_year →</a>";
    } else {
        echo "<span></span>";
    }
    echo "</div>";
    
    echo "<h2>Checking resources in <span style='color:#2a7ae2'>$folder/index.html</span> & <span style='color:#2a7ae2'>$folder/index.php</span></h2>\n";
    echo "<table style='width:100%; border-collapse:collapse; margin-bottom:20px;'>\n<tr><th style='text-align:left;padding:6px 8px;border-bottom:2px solid #eee;'>Status</th><th style='text-align:left;padding:6px 8px;border-bottom:2px solid #eee;'>Resource</th></tr>";
    // Add CSS for arrows
    echo '<style>.arrow { display:inline-block; width:1em; text-align:center; color:#888; font-size:1em; user-select:none; } .arrow-root { color:#2a7ae2; font-weight:bold; } </style>';
    foreach ($links as $link) {
        $resource = $folder . '/' . ltrim($link, '/');
        // Calculate indent and arrow based on folder depth
        $depth = substr_count(trim($link, '/'), '/');
        $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $depth);
        $arrow = $depth === 0 ? '<span class="arrow arrow-root">&#9679;</span>' : '<span class="arrow">&#8594;</span>';
        // Special handling for folder links
        if (substr($link, -1) === '/') {
            $has_index = false;
            foreach (["index.html", "index.php"] as $subfile) {
                if (file_exists($resource . $subfile)) {
                    $has_index = true;
                    break;
                }
            }
            if ($has_index) {
                echo "<tr><td><span class='badge ok'>OK</span></td><td>$indent$arrow $link</td></tr>\n";
            } else {
                echo "<tr><td><span class='badge missing'>MISSING</span></td><td>$indent$arrow $link</td></tr>\n";
            }
            continue;
        }
        if (file_exists($resource)) {
            echo "<tr><td><span class='badge ok'>OK</span></td><td>$indent$arrow $link</td></tr>\n";
            continue;
        }
        // Not found, check previous two years
        $found = false;
        $found_year = null;
        for ($i = 1; $i <= 2; $i++) {
            $prev_year = $year - $i;
            if (in_array($prev_year, $all_years)) {
                $try = $prev_year . '/' . ltrim($link, '/');
                if (file_exists($try)) {
                    $found = true;
                    $found_year = $prev_year;
                    break;
                }
            }
        }
        // If not found, check subsequent years
        if (!$found) {
            foreach ($all_years as $next_year) {
                if ($next_year <= $year) continue;
                $try = $next_year . '/' . ltrim($link, '/');
                if (file_exists($try)) {
                    $found = true;
                    $found_year = $next_year;
                    break;
                }
            }
        }
        if ($found) {
            // Restore form/button with AJAX
            $form_id = 'restore_' . md5($link . $found_year . $year);
            echo "<tr id='row_$form_id'><td><span class='badge found'>FOUND in $found_year</span> ";
            echo "<form method='post' class='restore-form' id='$form_id' style='display:inline;margin:0;padding:0;'>";
            echo "<input type='hidden' name='restore' value='1'>";
            echo "<input type='hidden' name='resource' value='".htmlspecialchars($link, ENT_QUOTES)."'>";
            echo "<input type='hidden' name='from_year' value='$found_year'>";
            echo "<input type='hidden' name='to_year' value='$year'>";
            echo "<button type='submit' style='margin-left:8px;padding:2px 10px;border-radius:5px;border:1px solid #bbb;background:#fff;color:#222;cursor:pointer;'>Restore</button>";
            echo "</form></td><td>$indent$arrow $link</td></tr>\n";
        } else {
            echo "<tr><td><span class='badge missing'>MISSING</span></td><td>$indent$arrow $link</td></tr>\n";
        }
    }
    echo "</table>";
    // After the table, show external links if any
    if (!empty($external_links)) {
        echo "<h3>External Links Found</h3><ul style='margin-bottom:24px;'>";
        foreach ($external_links as $elink) {
            $is_austnet = preg_match('#^https?://(www\\.)?austnet\\.org/#i', $elink);
            echo "<li style='word-break:break-all;'>";
            echo "<a href='".htmlspecialchars($elink)."' target='_blank'>".htmlspecialchars($elink)."</a>";
            if ($is_austnet) {
                echo " <form method='post' style='display:inline;margin-left:10px;' class='remove-austnet-form'>";
                echo "<input type='hidden' name='remove_austnet' value='1'>";
                echo "<input type='hidden' name='link' value='".htmlspecialchars($elink, ENT_QUOTES)."'>";
                echo "<input type='hidden' name='dir' value='".htmlspecialchars($folder, ENT_QUOTES)."'>";
                echo "<button type='submit' style='padding:2px 10px;border-radius:5px;border:1px solid #bbb;background:#fff;color:#222;cursor:pointer;'>Remove Prefix</button>";
                echo "</form>";
            }
            echo "</li>";
        }
        echo "</ul>";
    }
}

// UI header and CSS
echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Resource Checker</title>';
echo '<style>
body { font-family: Arial, sans-serif; background: #f4f6fa; margin: 0; padding: 0; }
.container { max-width: 700px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 12px #0001; padding: 32px 40px 24px 40px; }
h1 { color: #2a3a4a; margin-top: 0; }
form { margin-bottom: 24px; }
input[type="text"], input[type="number"] { padding: 7px 10px; border: 1px solid #bbb; border-radius: 4px; font-size: 1em; }
input[type="submit"] { background: #2a7ae2; color: #fff; border: none; border-radius: 4px; padding: 8px 18px; font-size: 1em; cursor: pointer; transition: background 0.2s; }
input[type="submit"]:hover { background: #185bb5; }
ul { list-style: none; padding-left: 0; }
li { margin-bottom: 7px; }
.badge { display: inline-block; min-width: 60px; padding: 2px 10px; border-radius: 12px; font-size: 0.95em; font-weight: bold; color: #fff; margin-left: 10px; }
.ok { background: #3bb54a; }
.missing { background: #e23a2a; }
.found { background: #f7b731; color: #222; }
.info { color: #555; font-size: 1.05em; margin-bottom: 18px; }
table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
th, td { padding: 8px 12px; border: 1px solid #ddd; text-align: left; }
th { background: #f4f4f9; }
.badge { display: inline-block; min-width: 60px; padding: 2px 10px; border-radius: 12px; font-size: 0.95em; font-weight: bold; color: #fff; }
</style>';
echo '<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>';
echo '<script>
$(function() {
  $(".restore-form").on("submit", function(e) {
    e.preventDefault();
    var $form = $(this);
    var $row = $("#row_" + $form.attr("id"));
    $.post("", $form.serialize(), function(data) {
      var newRow = $(data).filter("tr").add($(data).find("tr")).first();
      if (newRow.length) {
        $row.replaceWith(newRow);
      } else {
        location.reload();
      }
    });
  });
  $(".remove-austnet-form").on("submit", function(e) {
    e.preventDefault();
    var $form = $(this);
    $.post("", $form.serialize(), function(data) {
      $(".container").prepend(data);
      setTimeout(function(){ location.reload(); }, 1200);
    });
  });
});
</script>';
echo '</head><body><div class="container">';
echo '<h1>Website Resource Checker</h1>';

$dir = isset($_GET['dir']) ? $_GET['dir'] : '';
echo '<form method="get" action="">';
echo '  <label for="dir">Check resources in folder: </label>';
echo '  <input type="text" name="dir" id="dir" value="' . htmlspecialchars($dir ?: '1996') . '" maxlength="4" size="6" pattern="[0-9]{4}" required> ';
echo '  <input type="submit" value="Check">';
echo '</form>';
echo '<div class="info">Enter a four-digit folder name to check its index.html and linked resources.</div>';

if ($dir && preg_match('/^[0-9]{4}$/', $dir) && is_dir($dir)) {
    check_resources($dir);
}

// Handle restore POST
if (
    isset($_POST['restore'], $_POST['resource'], $_POST['from_year'], $_POST['to_year']) &&
    preg_match('/^[0-9]{4}$/', $_POST['from_year']) &&
    preg_match('/^[0-9]{4}$/', $_POST['to_year']) &&
    isset($_POST['resource'])
) {
    $from = $_POST['from_year'] . '/' . ltrim($_POST['resource'], '/');
    $to = $_POST['to_year'] . '/' . ltrim($_POST['resource'], '/');
    $form_id = 'restore_' . md5($_POST['resource'] . $_POST['from_year'] . $_POST['to_year']);
    // Output the row with all classes and inline styles for consistency
    if (file_exists($from)) {
        if (is_dir($from)) {
            // Recursively copy directory
            $copy_result = copy_directory_recursive($from, $to);
            if ($copy_result) {
                echo "<tr id='row_$form_id><td><span class='badge ok'>OK</span></td><td style='padding:6px 8px;'>".htmlspecialchars($_POST['resource'])."</td></tr>";
            } else {
                echo "<tr id='row_$form_id><td><span class='badge missing'>ERROR (dir)</span></td><td style='padding:6px 8px;'>".htmlspecialchars($_POST['resource'])."</td></tr>";
            }
        } else {
            $to_dir = dirname($to);
            if (!is_dir($to_dir)) {
                mkdir($to_dir, 0777, true);
            }
            if (copy($from, $to)) {
                echo "<tr id='row_$form_id><td><span class='badge ok'>OK</span></td><td style='padding:6px 8px;'>".htmlspecialchars($_POST['resource'])."</td></tr>";
            } else {
                echo "<tr id='row_$form_id><td><span class='badge missing'>ERROR</span></td><td style='padding:6px 8px;'>".htmlspecialchars($_POST['resource'])."</td></tr>";
            }
        }
    } else {
        echo "<tr id='row_$form_id><td><span class='badge missing'>ERROR</span></td><td style='padding:6px 8px;'>".htmlspecialchars($_POST['resource'])."</td></tr>";
    }
    exit;
}

// Handle remove_austnet POST
if (
    isset($_POST['remove_austnet'], $_POST['link'], $_POST['dir']) &&
    preg_match('/^[0-9]{4}$/', $_POST['dir'])
) {
    $folder = $_POST['dir'];
    $updated = false;
    foreach (['index.html', 'index.php'] as $file) {
        $path = rtrim($folder, '/') . '/' . $file;
        if (remove_austnet_prefix_in_file($path)) {
            $updated = true;
        }
    }
    if ($updated) {
        echo "<div style='background:#d4f7d4;color:#185b18;padding:10px 18px;border-radius:6px;margin-bottom:18px;'>Prefix removed from austnet.org links in $folder/index.html and/or index.php. <script>setTimeout(function(){location.reload();}, 800);</script></div>";
    } else {
        echo "<div style='background:#fbe3e4;color:#b94a48;padding:10px 18px;border-radius:6px;margin-bottom:18px;'>No changes made to $folder/index.html or index.php.</div>";
    }
    exit;
}

echo '</div></body></html>';
return; // Prevent old output

// Helper function to recursively copy directories
function copy_directory_recursive($src, $dst) {
    $dir = opendir($src);
    if (!is_dir($dst)) {
        if (!mkdir($dst, 0777, true)) return false;
    }
    while(false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            $src_path = "$src/$file";
            $dst_path = "$dst/$file";
            if (is_dir($src_path)) {
                if (!copy_directory_recursive($src_path, $dst_path)) return false;
            } else {
                if (!copy($src_path, $dst_path)) return false;
            }
        }
    }
    closedir($dir);
    return true;
}

// Add this helper to update austnet.org links in a file
function remove_austnet_prefix_in_file($file) {
    if (!file_exists($file)) return false;
    $content = file_get_contents($file);
    $pattern = '#https?://(www\\.)?austnet\\.org/#i';
    $new_content = preg_replace($pattern, '/', $content);
    if ($new_content !== null && $new_content !== $content) {
        return file_put_contents($file, $new_content) !== false;
    }
    return false;
}
