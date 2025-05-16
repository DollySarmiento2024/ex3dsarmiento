<?php

//require_once("Connection.php");
//require_once("Lamp.php");


class Lighting extends Connection
{
    private $currentFilter = "all"; //filtro zonas

    /**
     * Get the value of currentFilter
     */
    public function getCurrentFilter()
    {
        return $this->currentFilter;
    }

    /**
     * Set the value of currentFilter
     */
    public function setCurrentFilter($currentFilter): self
    {
        $this->currentFilter = $currentFilter;

        return $this;
    }


    /*  devuelve todas las filas de la tabla"lamps" en un array, 
    encapsulando cada fila en un objeto de tipo "Lamp"*/
    public function getAllLamps()
    {
        $lamps = [];
        $query = "SELECT lamps.lamp_id, lamps.lamp_name, lamp_on, lamp_models.model_part_number,lamp_models.model_wattage,
        zones.zone_name FROM lamps INNER JOIN lamp_models ON lamps.lamp_model=lamp_models.model_id INNER JOIN zones ON
        lamps.lamp_zone = zones.zone_id ORDER BY lamps.lamp_id";
        $result = $this->getConn()->query($query);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            //var_dump ($row);
            $lamp = new Lamp($row);
            $lamps[] = $lamp;
        }
        return $lamps;
    }

    /*  devuelve  las filas de la tabla "lamps" filtrando por una zona en un array, 
    encapsulando cada fila en un objeto de tipo "Lamp"*/
    public function getAllLampsFilter()
    {
        $lamps = [];
        $zoneId = $this->getCurrentFilter();
        $query = "SELECT lamps.lamp_id, lamps.lamp_name, lamp_on, lamp_models.model_part_number,lamp_models.model_wattage, zones.zone_name 
        FROM lamps INNER JOIN lamp_models ON lamps.lamp_model=lamp_models.model_id 
        INNER JOIN zones ON lamps.lamp_zone = zones.zone_id WHERE zones.zone_id = $zoneId 
        ORDER BY lamps.lamp_id";
        $result = $this->getConn()->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            //var_dump ($row);
            $lamp = new Lamp($row);
            $lamps[] = $lamp;
        }
        return $lamps;
    }

    /*  Muestra el listado de lámparas  */
    public function drawLampsList()
    {
        if (strtolower($this->currentFilter) == "all") { //mostrar lamparas de todas las zonas
            $lamps = $this->getAllLamps();
        } else { //filtrar por zonas
            $lamps = $this->getAllLampsFilter();
        }

        if (empty($lamps)) {
            echo "No hay lamparas registradas";
            return;
        }
        foreach ($lamps as $lamp) {
            //var_dump($row);
            $lampOn = $lamp->getLampOn();
            $lampId = $lamp->getLampId();
            $lampName = $lamp->getLampName();
            $modelWattage = $lamp->getModelWattage();
            $zoneName = $lamp->getLampZone();

            if ($lampOn == 0) { //lampara apagada -> podemos cambiar estado a "on"
                echo "<div class='element off'>";
                echo "<h4><a href='changestatus.php?lampId=$lampId&status=on'><img src='img/bulb-icon-off.png'></a>$lampName</h4>";
            } else { //lampara encendida -> podemos cambiar estado a "off"
                echo "<div class='element on'>";
                echo "<h4><a href='changestatus.php?lampId=$lampId&status=off'><img src='img/bulb-icon-on.png'></a>$lampName</h4>";
            }
            echo "<h1>$modelWattage</h1>";
            echo "<h4>$zoneName</h4>";
            echo "</div>";
        }
    }


    /* Devuelve el total de la potencia por zona (solo de las lámparas encendidas)
     */
    public function getPowerPerZones()
    {
        $query = "SELECT SUM(lamp_models.model_wattage) as power FROM `lamps` INNER JOIN lamp_models on
        lamp_model=lamp_models.model_id WHERE lamp_on = 1";
        $result = $this->getConn()->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row["power"];
    }

    /* Mostrar el total de la potencia por zona (solo de las lámparas encendidas)
     */
    public function drawMonitor()
    {
        $power = $this->getPowerPerZones();
        echo "<h2>Total: $power W</h2>";
    }

    /* Modificar el estado de una lámpara
     */
    public function changeStatus($id, $status)
    {
        if ($id != null) {
            $stmt = $this->getConn()->prepare("UPDATE `lamps` SET `lamp_on`= ? WHERE `lamp_id`=?");
            $stmt->execute([$status, $id]);
        }
    }

    /* Devuelve en un array todas las zonas
     */
    public function getAllZones()
    {
        $zones = [];
        $query = "SELECT * FROM `zones`";
        $result = $this->getConn()->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $zones[] = $row;
        }
        return $zones;
    }

    /* Mostrar desplegable con la información de las zonas disponible */
    public function drawZonesOptions()
    {
        $zones = $this->getAllZones();
        echo "<option value='all'>All</option>";

        foreach ($zones as $row) {
            $zoneId = $row["zone_id"];
            $zoneName = $row["zone_name"];
            echo "<option value=$zoneId>$zoneName</option>";
        }
    }
}
