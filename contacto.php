<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=libreria", "root", "Reyna200");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexión fallida: ' . $e->getMessage();
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $comentario = $_POST['comentario'];

        // VALIDACIONES
        if (empty($nombre)) {
            $errors['nombre'] = "El nombre es requerido.";
        }
        if (empty($correo)) {
            $errors['correo'] = "El correo es requerido.";
        }
        if (empty($asunto)) {
            $errors['asunto'] = "El asunto es requerido.";
        }
        if (empty($comentario)) {
            $errors['comentario'] = "El comentario es requerido.";
        }

        if (empty($errors)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO contacto (fecha, nombre, correo, asunto, comentario) VALUES (NOW(), ?, ?, ?, ?)");
                $stmt->execute([$nombre, $correo, $asunto, $comentario]);
                $success_message = "Gracias por contactarnos. Hemos recibido tu mensaje.";
            } catch (PDOException $e) {
                echo 'Error al guardar la información: ' . $e->getMessage();
            }
        }
}
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Contáctanos</title>
        <link href="css/style.css" rel="stylesheet" />
        <script src="js/manejo_errores.js"></script>
    </head>

    <body>
        <section class="page-section" id="contact">
            <?php include 'templates/topMenu.php'; ?>
                <div class="container">
                    <div class="text-center">
                        <h2 class="section-heading text-uppercase">Contáctanos</h2>
                        <h3 class="section-subheading text-muted text-uppercase">A un click de distancia</h3>
                    </div>
                    <?php if (!empty($success_message)) : ?>
                        <p class="success">
                            <?php echo $success_message; ?>
                        </p>
                    <?php endif; ?>
                    <form id="contactForm" action="contacto.php" method="POST">
                        <div class="row align-items-stretch mb-5">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- Name input-->
                                    <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre ?? ''); ?>" placeholder="Su nombre *">
                                    <span class="invalid-feedback d-none" data-sb-feedback="nombre:required">El nombre es requerido.</span>
                                    </div>
                                <div class="form-group">
                                    <!-- Email address input-->
                                    <input class="form-control" type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($correo ?? ''); ?>" placeholder="Su correo *">
                                    <span class="invalid-feedback d-none" data-sb-feedback="correo:required">El correo es requerido.</span>
                                    <div class="invalid-feedback is-invalid" data-sb-feedback="correo:email">El correo no es válido.</div>
                                </div>
                                <div class="form-group mb-md-0">
                                    <!-- Asunto input-->
                                    <input class="form-control" type="text" name="asunto" id="asunto" value="<?php echo htmlspecialchars($asunto ?? ''); ?>" placeholder="Asunto *">
                                    <span class="invalid-feedback d-none" data-sb-feedback="asunto:required">El asunto es requerido.</span>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-textarea mb-md-0">
                                    <!-- Message input-->
                                    <textarea class="form-control" name="comentario" id="comentario" placeholder="Comentario *"><?php echo htmlspecialchars($comentario ?? ''); ?></textarea>
                                    <span class="invalid-feedback d-none" data-sb-feedback="comentario:required">El comentario es requerido.</span>
                                </div>
                            </div>
                        </div>
                       
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center text-white mb-3">
                                <div class="fw-bolder">¡El mensaje ha sido enviado con éxito!</div>
                            </div>
                        </div>

                        <div class="d-none" id="submitErrorMessage">
                            <div class="text-center text-danger mb-3">No se ha podido completar el envío. Intente nuevamente.</div>
                        </div>

                    <!-- Submit Button-->
                    <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Enviar mensaje</button></div>
                </form>
            </div>
        </section>
        <?php include 'templates/footer.php'; ?>
    </body>
</html>