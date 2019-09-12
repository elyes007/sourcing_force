<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(itemOperations={})
 */
class OAuth
{
    private $placeHolder;

    /**
     * @return mixed
     */
    public function getPlaceHolder()
    {
        return $this->placeHolder;
    }

    /**
     * @param mixed $placeHolder
     */
    public function setPlaceHolder($placeHolder)
    {
        $this->placeHolder = $placeHolder;
    }


}