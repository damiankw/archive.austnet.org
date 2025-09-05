<?php
$dirs = array_filter(glob('*'), 'is_dir');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Directory Listing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <style>
    .zoom-hover {
      transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
    }
    .zoom-hover:hover {
      transform: scale(1.50);
      z-index: 2;
      position: relative;
    }
  </style>
  <div class="container py-5">
    <h1 class="mb-4">AustNet Archive</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($dirs as $dir): ?>
        <div class="col">
          <a href="<?php echo htmlspecialchars($dir); ?>" class="text-decoration-none text-dark">
            <div class="card h-100 text-center">
              <?php 
                $imgPath = "images/{$dir}.png";
                if (file_exists($imgPath)) {
                  echo "<img src='" . htmlspecialchars($imgPath) . "' class='card-img-top img-fluid mx-auto zoom-hover' alt='" . htmlspecialchars($dir) . "' style='max-height:20vw; min-height:80px; width:auto; object-fit:contain;'>";
                } else {
                  echo "<div style='height:150px; display:flex; align-items:center; justify-content:center; background:#eee;'>No Image</div>";
                }
              ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($dir); ?></h5>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>
