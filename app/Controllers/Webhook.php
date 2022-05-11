<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Webhook extends ResourceController
{
    public function __construct()
    {
    }

    public function index()
    {
        $clientid = $_SERVER['HTTP_X_ADOBESIGN_CLIENTID'];
        $data = json_decode(file_get_contents('php://input'), true);
        if ($clientid == "CBJCHBCAABAAJdfJuT2XEsqkCULtOiBOv8F5Zhdc3_AH" or true) {
            //Return it in response header
            header("X-AdobeSign-ClientId:$clientid");
            header("HTTP/1.1 200 OK"); // default value
            header("Content-Type: application/json");
            $logFile = is_file(WRITEPATH . "logs/events.txt") ? fopen(WRITEPATH . "logs/events.txt", "a") :  fopen(WRITEPATH . "logs/events.txt", "w");
            $text = sprintf("time: %s - data: %s \n", date("Y-m-d H:i:s"), json_encode($data));
            fwrite($logFile, $text);
            fclose($logFile);
            $body = array('xAdobeSignClientId' => $clientid);
            return $this->respond($body, 200);
        }
    }

    public function show($id = null)
    {

        echo readfile(WRITEPATH . "logs/events.txt");
    }

    public function new()
    {
    }

    public function create()
    {
        $clientid = $_SERVER['HTTP_X_ADOBESIGN_CLIENTID'];
        $data = json_decode(file_get_contents('php://input'), true);
        if ($clientid == "CBJCHBCAABAAJdfJuT2XEsqkCULtOiBOv8F5Zhdc3_AH" or true) {
            //Return it in response header
            header("X-AdobeSign-ClientId:$clientid");
            header("HTTP/1.1 200 OK"); // default value
            header("Content-Type: application/json");
            $logFile = is_file(WRITEPATH . "logs/events.txt") ? fopen(WRITEPATH . "logs/events.txt", "a") :  fopen(WRITEPATH . "logs/events.txt", "w");
            $text = sprintf("time: %s - data: %s \n", date("Y-m-d H:i:s"), json_encode($data));
            fwrite($logFile, $text);
            fclose($logFile);
            $body = array('xAdobeSignClientId' => $clientid);
            return $this->respond($body, 200);
        }
    }

    public function edit($id = null)
    {
    }

    public function update($id = null)
    {
    }

    public function delete($id = null)
    {
    }
}
