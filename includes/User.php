<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-20
 * Time: 11:32
 */

class User
{
    private $id, $firstname, $lastname, $username, $password, $birthday, $cellphone, $email, $address, $gender, $reg_date;

    public const TABLE_NAME = "users";
    public const COL_ID = "id";
    public const COL_CLUB_ID = "club_id";
    public const COL_MAC_ADDRESS = "mac_address";
    public const COL_LOCATION = "location";
    public const COL_REG_DATE = "reg_date";
    public const COL_TYPE = "type";
    public const COL_STATUS = "status";

    /**
     * user constructor.
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
     * User fill data.
     */
    public function fill(array $row)
    {
        $this->id = $row['id'];
        $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname'];
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->birthday = $row['birthday'];
        $this->cellphone = $row['cellphone'];
        $this->email = $row['email'];
        $this->address = $row['address'];
        $this->gender = $row['gender'];
        $this->reg_date = $row['reg_date'];
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
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * @param mixed $cellphone
     */
    public function setCellphone($cellphone): void
    {
        $this->cellphone = $cellphone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
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

}