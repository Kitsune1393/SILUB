<?php

use App\Model\ClientesModel;

$app->group('/clientes/', function () {

    $this->get('', function ($req, $res, $args) {
        $um = new ClientesModel();

        $res->write(
            json_encode($um->getAll(), JSON_UNESCAPED_UNICODE)
        );

        return $res;            
    });

    $this->get('{id}', function ($req, $res, $args) {
        $um = new ClientesModel();

        return $res            
            ->getBody()
            ->write(
                json_encode($um->get($args['id']), JSON_UNESCAPED_UNICODE)
            );
    });
    $this->get('sancionado/{id}', function ($req, $res, $args) {
        $um = new ClientesModel();

        return $res
            ->getBody()
            ->write(
                json_encode($um->getClienteSancionado($args['id']), JSON_UNESCAPED_UNICODE)
            );
    });

    $this->post('', function ($req, $res) {
        $um = new ClientesModel();

        return $res           
            ->getBody()
            ->write(
                json_encode(
                    $um->insert(
                        $req->getParsedBody()
                    )
                    , JSON_UNESCAPED_UNICODE)
            );
    });


    $this->put('', function ($req, $res) {
        $um = new ClientesModel();
        return $res            
            ->getBody()
            ->write(
                json_encode(
                    $um->update(
                        $req->getParsedBody()
                    )
                    , JSON_UNESCAPED_UNICODE)
            );
    });  
});