<?php
namespace ViniciusCavilha\Taredas\Service;
 
class TarefaService
{
    private $filePath = __DIR__ . '../../../data.json';
 
    private function readData()
    {
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([]));
        }
        $json = file_get_contents($this->filePath);
        return json_decode($json, true);
    }
 
    private function writeData($data)
    {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }
 
    public function createTarefa($tarefa)
    {
        $data = $this->readData();
        $tarefa['id'] = uniqid();
        $data[] = $tarefa;
        $this->writeData($data);
    }
 
    public function getAllTarefas()
    {
        return $this->readData();
    }
 
    public function getTarefasById($id)
    {
        $data = $this->readData();
        foreach ($data as $tarefa) {
            if ($tarefa['id'] == $id) {
                return $tarefa;
            }
        }
        return null;
    }
}