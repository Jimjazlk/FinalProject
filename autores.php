<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=libreria", "root", "Reyna200");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT nombre, apellido, ciudad, estado, pais FROM autores");
    $stmt->execute();
    $autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Autores</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
          <?php include 'templates/topMenu.php'; ?>
        <section id = "librosbody" class="page-section bg-light">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase text-light">Autores</h2>
                </div>
                <div class="row">
                    <?php foreach ($autores as $autor) : ?>
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <div class="card h-100 rounded-3">
                                <div class="card-header text-uppercase fw-bolder"><?= htmlspecialchars($autor['nombre'] . ' ' . $autor['apellido']) ?></div>
                                <div class="card-body">
                                    <p class="card-text text-light text-uppercase">
                                        <?= htmlspecialchars($autor['ciudad'] . ' ' . $autor['estado']) ?><br>
                                        <strong>País:</strong> <?= htmlspecialchars($autor['pais']) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php include 'templates/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


    </body>
</html>