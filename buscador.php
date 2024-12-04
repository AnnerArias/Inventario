<?php
$pdo = new PDO("mysql:host=localhost;dbname=mvc_php", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $stm = $pdo->prepare("SELECT 
                            p.id, p.imagen, p.nombre, s.cantidad, p.estado, p.presentacion 
                        FROM 
                            productos p 
                        JOIN 
                            stock s 
                        ON 
                            p.id = s.id_producto 
                        WHERE 
                            p.nombre 
                        LIKE ?");
    $stm->execute(["%$query%"]);
    $result = $stm->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
}
?>
