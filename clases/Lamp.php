<?php

//require_once("Connection.php");

class Lamp extends Connection
{
    private $lampId;
    private $lampName;
    private $lampOn;
    private $lampModel;
    private $modelWattage;
    private $zoneName;

    public function __construct(array $data)
    {
        $this->lampId = $data['lamp_id'];
        $this->lampName = $data['lamp_name'];
        $this->lampOn = $data['lamp_on'];
        $this->lampModel = $data['model_part_number'];
        $this->modelWattage = $data['model_wattage'];
        $this->zoneName = $data['zone_name'];
    }

    /**
     * Get the value of lampId
     */
    public function getLampId()
    {
        return $this->lampId;
    }


    /**
     * Get the value of lampName
     */
    public function getLampName()
    {
        return $this->lampName;
    }


    /**
     * Get the value of lampOn
     */
    public function getLampOn()
    {
        return $this->lampOn;
    }


    /**
     * Get the value of lampModel
     */
    public function getLampModel()
    {
        return $this->lampModel;
    }

    /**
     * Get the value of modelWattage
     */
    public function getModelWattage()
    {
        return $this->modelWattage;
    }


    /**
     * Get the value of zoneName
     */
    public function getLampZone()
    {
        return $this->zoneName;
    }
}
