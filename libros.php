<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=libreria", "root", "Reyna200");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT titulo, tipo, DATE(fecha_pub) as fecha_pub FROM titulos");
    $stmt->execute();
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Libros</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <section id = "librosbody" class="page-section bg-light" id="libros">
        <?php include 'templates/topMenu.php'; ?>

            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase text-light">Libros</h2>
                    <h3 class="section-subheading text-light">Tu próximo libro, a un clic de distancia.</h3>
                </div>
                <div class="row">
                    <?php foreach ($libros as $libro) : ?>
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <div class="card h-100 rounded-3">
                                <div class="card-header text-uppercase fw-bold"><?= htmlspecialchars($libro['titulo']) ?></div>
                                <div class="card-body">
                                    <p class="card-text text-light text-uppercase">
                                        <strong>Tipo:</strong> <?= htmlspecialchars($libro['tipo']) ?> | 
                                        <strong>Publicación:</strong> <?= htmlspecialchars($libro['fecha_pub']) ?>
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