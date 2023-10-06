<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $table = 'archive';
    public $timestamps = false;

    private $id;
    private $userName;
    private $phone;
    private $email;
    private $noIn;
    private $noOut;
    private $otz;
    private $userInfo;
    private $total;
    private $pay;
    private $infoPay;
    private $confirmed;
    private $createdAt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }



    /**
     * @return mixed
     */
    public function getNoIn()
    {
        return $this->noIn;
    }

    /**
     * @return mixed
     */
    public function getNoOut()
    {
        return $this->noOut;
    }

    /**
     * @return mixed
     */
    public function getOtz()
    {
        return $this->otz;
    }


    /**
     * @return mixed
     */
    public function getUserInfo()
    {
        return $this->userInfo;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return mixed
     */
    public function getPay()
    {
        return $this->pay;
    }

    /**
     * @return mixed
     */
    public function getInfoPay()
    {
        return $this->infoPay;
    }

    /**
     * @return mixed
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @param mixed $noIn
     */
    public function setNoIn($noIn): void
    {
        $this->noIn = $noIn;
    }

    /**
     * @param mixed $noOut
     */
    public function setNoOut($noOut): void
    {
        $this->noOut = $noOut;
    }

    /**
     * @param mixed $otz
     */
    public function setOtz($otz): void
    {
        $this->otz = $otz;
    }


    /**
     * @param mixed $userInfo
     */
    public function setUserInfo($userInfo): void
    {
        $this->userInfo = $userInfo;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }

    /**
     * @param mixed $pay
     */
    public function setPay($pay): void
    {
        $this->pay = $pay;
    }

    /**
     * @param mixed $infoPay
     */
    public function setInfoPay($infoPay): void
    {
        $this->infoPay = $infoPay;
    }

    /**
     * @param mixed $confirmed
     */
    public function setConfirmed($confirmed): void
    {
        $this->confirmed = $confirmed;
    }







}
