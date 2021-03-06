<?php

use App\Model\BodegaModel;

$app->group('/bodegas/', function () {

    $this->get('', function ($req, $res, $args) {
        $um = new BodegaModel();

        $res->write(
            json_encode($um->getAll(), JSON_UNESCAPED_UNICODE)
        );

        return $res;
    });

    $this->get('{id}', function ($req, $res, $args) {
        $um = new BodegaModel();

        return $res
            ->getBody()
            ->write(
                json_encode($um->get($args['id']), JSON_UNESCAPED_UNICODE)
            );
    });
    $this->get('armarios/{id}', function ($req, $res, $args) {
        $um = new BodegaModel();

        return $res
            ->getBody()
            ->write(
                json_encode($um->getArmarios($args['id']), JSON_UNESCAPED_UNICODE)
            );
    });

    $this->post('', function ($req, $res) {
        $um = new BodegaModel();

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

    $this->post('delete/', function ($req, $res) {
        $um = new BodegaModel();

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

    $this->put('', function ($req, $res) {
        $um = new BodegaModel();
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
