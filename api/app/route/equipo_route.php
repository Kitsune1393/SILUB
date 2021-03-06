<?php

use App\Model\EquiposModel;

$app->group('/equipos/', function () {

    $this->get('', function ($req, $res, $args) {
        $um = new EquiposModel();

        $res->write(
            json_encode($um->getAll(), JSON_UNESCAPED_UNICODE)
        );

        return $res;            
    });

    $this->get('{id}', function ($req, $res, $args) {
        $um = new EquiposModel();

        return $res            
            ->getBody()
            ->write(
                json_encode($um->get($args['id']), JSON_UNESCAPED_UNICODE)
            );
    });

    $this->get('serial/{id}', function ($req, $res, $args) {
        $um = new EquiposModel();

        return $res
            ->getBody()
            ->write(
                json_encode($um->getSerial($args['id']), JSON_UNESCAPED_UNICODE)
            );
    });

    $this->post('', function ($req, $res) {
        $um = new EquiposModel();

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
    $this->post('delete_ubicacion/', function ($req, $res) {
        $um = new EquiposModel();

        return $res
            ->getBody()
            ->write(
                json_encode(
                    $um->deleteUbicacion(
                        $req->getParsedBody()
                    )
                    , JSON_UNESCAPED_UNICODE)
            );
    });

    $this->post('delete/', function ($req, $res) {
        $um = new EquiposModel();
        return $res
            ->getBody()
            ->write(
                json_encode(
                    $um->delete(
                        $req->getParsedBody()
                    )
                    , JSON_UNESCAPED_UNICODE)
            );
    });

    $this->post('baja/', function ($req, $res) {
        $um = new EquiposModel();
        return $res
            ->getBody()
            ->write(
                json_encode(
                    $um->darDeBaja(
                        $req->getParsedBody()
                    )
                    , JSON_UNESCAPED_UNICODE)
            );
    });

    $this->put('', function ($req, $res) {
        $um = new EquiposModel();
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
