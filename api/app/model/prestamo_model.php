<?php

namespace App\Model;

use App\Lib\Database;
use App\Lib\Response;

class PrestamosModel
{
    private $db;
    private $response;

    public function __CONSTRUCT()
    {
        $this->db = Database::StartUp();
        $this->response = new Response();
    }

    public function get()
    {
        try {
            $stm = $this->db->prepare("SELECT e.*,p.*,c.tipo as tipo_cliente, c.nombre as nombre_cliente,c.*,t.tipo as nombre
FROM equipo e, prestamo p, cliente c, tipo_equipo t
WHERE e.id_equipo = p.id_equipo 
AND p.id_cliente = c.id_cliente
AND t.id_tipo_equipo = e.id_tipo_equipo");
            $stm->execute();
            $this->response->setResponse(true);
            $this->response->result = $stm->fetchAll();
        } catch (\Exception $e) {
            $this->response->setResponse(false, $e->getMessage());
        }
        return $this->response;
    }

    public function insert($data)
    {
        $id_cliente = $data['id_cliente'];
        $id_equipo = $data['id_equipo'];
        $fecha_solicitud = $data['fecha_solicitud'];
        $fecha_devolucion = $data['fecha_devolucion'];
        $fecha_prevista = $data['fecha_prevista'];
        $id_solicitud_adecuacion = $data['id_solicitud_adecuacion'];

        $query = "call prestar_equipo(:id_cliente, :id_equipo, :fecha_solicitud, :fecha_devolucion, :fecha_prevista, :id_solicitud_adecuacion)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam("id_cliente", $id_cliente);
            $stmt->bindParam("id_equipo", $id_equipo);
            $stmt->bindParam("fecha_solicitud", $fecha_solicitud);
            $stmt->bindParam("fecha_devolucion", $fecha_devolucion);
            $stmt->bindParam("fecha_prevista", $fecha_prevista);
            $stmt->bindParam("id_solicitud_adecuacion", $id_solicitud_adecuacion);
            $stmt->execute();
            $this->response->setResponse(true, 'Successfully Insertion');
            $this->response->result = "";
        } catch (\Exception $e) {
            $this->response->setResponse(false, $e->getMessage());
        }
        return $this->response;
    }

    public function terminar($data)
    {
        $id_prestamo = $data['id_prestamo'];
        $id_equipo = $data['id_equipo'];

        $query = "call terminar_prestamo(:id_equipo, :id_prestamo)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam("id_prestamo", $id_prestamo);
            $stmt->bindParam("id_equipo", $id_equipo);
            $stmt->execute();
            $this->response->setResponse(true, 'Successfully Insertion');
            $this->response->result = "";
        } catch (\Exception $e) {
            $this->response->setResponse(false, $e->getMessage());
        }
        return $this->response;
    }
}
