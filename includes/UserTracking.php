<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-20
 * Time: 17:21
 */

class UserTracking
{
    private $id, $user_id, $club_device_id, $rssi, $detected_time, $status;

    /**
     * UserTracking constructor.
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
     * UserTracking fill data.
     */
    public function fill(array $row)
    {
        $this->id = $row['id'];
        $this->user_id = $row['user_id'];
        $this->club_device_id = $row['club_device_id'];
        $this->rssi = $row['rssi'];
        $this->detected_time = $row['detected_time'];
        $this->status = $row['status'];
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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getClubDeviceId()
    {
        return $this->club_device_id;
    }

    /**
     * @param mixed $club_device_id
     */
    public function setClubDeviceId($club_device_id): void
    {
        $this->club_device_id = $club_device_id;
    }

    /**
     * @return mixed
     */
    public function getRssi()
    {
        return $this->rssi;
    }

    /**
     * @param mixed $rssi
     */
    public function setRssi($rssi): void
    {
        $this->rssi = $rssi;
    }

    /**
     * @return mixed
     */
    public function getDetectedTime()
    {
        return $this->detected_time;
    }

    /**
     * @param mixed $detected_time
     */
    public function setDetectedTime($detected_time): void
    {
        $this->detected_time = $detected_time;
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