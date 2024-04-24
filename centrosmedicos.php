<?php

$centrosmedicos = array(
    array (
        "id" => 1,
        "name" => "CLINICA MONTEVIDEO",
        "addres" => "Jr. Montevideo 448, Surco",
        "create_at" => "2022-05-27 12:07:17"
    ),
    array (
        "id" => 2,
        "name" => "CLINICA JAVIER PRADO",
        "addres" => "Av. Javier Prado 708, San Isidro",
        "create_at" => "2022-08-27 12:07:17"
    )
    );

//convertir a formato json (parsear)
 $json_response = json_encode($centrosmedicos);

header('CONTENT-TYPE: application/json');

echo $json_response
?>