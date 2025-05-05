<?php

//require_once("Connection.php");

class Lamp extends Connection
{
    private $lamp_id;
    private $lamp_name;
    private $lamp_on;
    private $lamp_model;
    private $model_wattage;
    private $zone_name;

    public function __construct(array $data)
    {
        $this->lamp_id = $data['lamp_id'];
        $this->lamp_name = $data['lamp_name'];
        $this->lamp_on = $data['lamp_on'];
        $this->lamp_model = $data['model_part_number'];
        $this->model_wattage = $data['model_wattage'];
        $this->zone_name = $data['zone_name'];
    }

    /**
     * Get the value of lamp_id
     */
    public function getLampId()
    {
        return $this->lamp_id;
    }


    /**
     * Get the value of lamp_name
     */
    public function getLampName()
    {
        return $this->lamp_name;
    }


    /**
     * Get the value of lamp_on
     */
    public function getLampOn()
    {
        return $this->lamp_on;
    }


    /**
     * Get the value of lamp_model
     */
    public function getLampModel()
    {
        return $this->lamp_model;
    }

    /**
     * Get the value of model_wattage
     */
    public function getModelWattage()
    {
        return $this->model_wattage;
    }


    /**
     * Get the value of zone_name
     */
    public function getLampZone()
    {
        return $this->zone_name;
    }
}
