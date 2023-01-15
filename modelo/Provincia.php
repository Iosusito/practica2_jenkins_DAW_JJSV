<?php
include_once "Localidad.php";

class Provincia implements JsonSerializable
{
    protected $id;
    protected $active;
    protected $localidades;

    function __construct()
    {
    }
    function loadfromJSON(string $json)
    {
        $tempo = json_decode($json, true);
        $this->id = $tempo["id"];
        $this->active = $tempo["active"];
        $localidades = [];
        foreach ($tempo['localidades'] as $l) {
            array_push($localidades, $l->loadfromJSON());
        }
        $this->localidades = $localidades;
    }
    public function  jsonSerialize()
    {
        $ljson = [];
        foreach ($this->localidades as $l) {
            if ($l instanceof Localidad) {
                array_push($ljson, $l->jsonSerialize());
            }
        }
        return
            [
                'id'   => $this->getId(),
                'active' => $this->isActive(),
                'localidades' => $ljson
            ];
    }
    function getLocalidadById(int $id): Localidad
    {
        foreach ($this->localidades as $l) {
            if ($l instanceof Localidad && $l->getId() == $id) {
                return $l;
            }
        }
        return null;
    }
    function getLocalidadByName(string $name): Localidad
    {
        foreach ($this->localidades as $l) {
            if ($l instanceof Localidad && $l->getName() == $name) {
                return $l;
            }
        }
        return null;
    }
    function removeLocalidadById(int $id)
    {
        foreach ($this->localidades as $l) {
            if ($l instanceof Localidad && $l->getId() == $id) {
                unset($l);
            }
        }
    }
    function getId(): int
    {
        return $this->id;
    }
    function isActive(): bool
    {
        return $this->active;
    }
    function getLocalidades(): array
    {
        return $this->localidades;
    }
    function setId(int $id)
    {
        $this->id = $id;
    }
    function setActive(bool $active)
    {
        $this->active = $active;
    }
    function setLocalidades(array $localidades)
    {
        $this->localidades = $localidades;
    }
}
