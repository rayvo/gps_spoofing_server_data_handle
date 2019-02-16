<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-20
 * Time: 12:01
 */

class ClubDevice
{

    private $id, $club_id, $mac_address, $location, $reg_date, $type, $status;
    public const TABLE_NAME = "club_devices";
    public const COL_ID = "id";
    public const COL_CLUB_ID = "club_id";
    public const COL_MAC_ADDRESS = "mac_address";
    public const COL_LOCATION = "location";
    public const COL_REG_DATE = "reg_date";
    public const COL_TYPE = "type";
    public const COL_STATUS = "status";

    /**
     * ClubDevice constructor.
     */
    public function __construct()
    {
    }

    public static function withRow(array $row) {
        $instance = new self();
        $instance->fill($row);
        return $instance;
    }


    /**
     * ClubDevice fill data.
     */
    protected function fill(array $row)
    {
        $this->id = $row['id'];
        $this->club_id = $row['club_id'];
        $this->mac_address = $row['mac_address'];
        $this->location = $row['location'];
        $this->reg_date = $row['reg_date'];
        $this->type = $row['type'];
        $this->status = $row['status'];
    }

    public function __toString()
    {
        return "ClubDevice: ID = {$this->id}, CLUBID={$this->club_id}, MAC={$this->mac_address},LOCATION={$this->location}, {$this->reg_date}, {$this->type}, {$this->status}";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getClubId()
    {
        return $this->club_id;
    }

    /**
     * @param mixed $club_id
     */
    public function setClubId($club_id): void
    {
        $this->club_id = $club_id;
    }

    /**
     * @return mixed
     */
    public function getMacAddress()
    {
        return $this->mac_address;
    }

    /**
     * @param mixed $mac_address
     */
    public function setMacAddress($mac_address): void
    {
        $this->mac_address = $mac_address;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getRegDate()
    {
        return $this->reg_date;
    }

    /**
     * @param mixed $reg_date
     */
    public function setRegDate($reg_date): void
    {
        $this->reg_date = $reg_date;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }



}