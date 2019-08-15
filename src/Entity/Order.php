<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ApiResource
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=255)
     */
    private $uid;

    /**
     * @var string Required. ID of the Account associated with this order. Can only be updated when the order’s StatusCode value is Draft.
     * @ORM\Column(type="string", length=255)
     */
    private $AccountId;

    /**
     * @var string Required. Picklist of values that indicate order status. Each value is within one of two status categories defined in StatusCode. For example, the status picklist might contain Draft, Ready for Review, and Ready for Activation values with a StatusCode of Draft.
     * @ORM\Column(type="string", length=255)
     */
    private $Status;

    /**
     * @var string Required. Date at which the order becomes effective. Label is Order Start Date.
     * @ORM\Column(type="string", length=255)
     */
    private $EffectiveDate;

    /**
     * @var string ID of the User or queue that owns this order.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $OwnerId;

    /**
     * @var string ID of the price book associated with this order.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Pricebook2Id;

    /**
     * @var string ID of the User who activated this order.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ActivatedById;

    /**
     * @var string Date and time when the order was activated.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ActivatedDate;

    /**
     * @var string City for the billing address for this order. Maximum size is 40 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingCity;

    /**
     * @var string Country for the billing address for this order. Maximum size is 80 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingCountry;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingGeocodeAccuracy;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $BillingLatitude;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $BillingLongitude;

    /**
     * @var string Postal code for the billing address for this order. Maximum size is 20 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingPostalCode;

    /**
     * @var string State for the billing address for this order. Maximum size is 80 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingState;

    /**
     * @var string Street address for the billing address.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingStreet;

    /**
     * @var string ID of the user who authorized the account associated with the order.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CompanyAuthorizedById;

    /**
     * @var string ID of the contract associated with this order. Can only be updated when the order’s StatusCode value is Draft.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ContractId;

    /**
     * @var string ID of the contact who authorized the order.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CustomerAuthorizedById;

    /**
     * @var string Description of the order.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $EndDate;

    /**
     * @var string City of the shipping address. Maximum size is 40 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingCity;

    /**
     * @var string Country of the shipping address. Maximum size is 80 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingCountry;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingGeocodeAccuracy;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $ShippingLatitude;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $ShippingLongitude;

    /**
     * @var string Postal code of the shipping address. Maximum size is 20 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingPostalCode;

    /**
     * @var string State of the shipping address. Maximum size is 80 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingState;

    /**
     * @var string Street address of the shipping address. Maximum of 255 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingStreet;

    /**
     * @var string The status category for the order. An order can be either Draft or Activated. Label is Status Category.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $StatusCode;

    /**
     * @var string The type of order.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Type;

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getAccountId(): ?string
    {
        return $this->AccountId;
    }

    /**
     * @param string $AccountId
     */
    public function setAccountId(string $AccountId)
    {
        $this->AccountId = $AccountId;
    }

    /**
     * @return string
     */
    public function getOwnerId(): ?string
    {
        return $this->OwnerId;
    }

    /**
     * @param string $OwnerId
     */
    public function setOwnerId(string $OwnerId)
    {
        $this->OwnerId = $OwnerId;
    }

    /**
     * @return string
     */
    public function getPricebook2Id(): ?string
    {
        return $this->Pricebook2Id;
    }

    /**
     * @param string $Pricebook2Id
     */
    public function setPricebook2Id(string $Pricebook2Id)
    {
        $this->Pricebook2Id = $Pricebook2Id;
    }

    /**
     * @return string
     */
    public function getActivatedById(): ?string
    {
        return $this->ActivatedById;
    }

    /**
     * @param string $ActivatedById
     */
    public function setActivatedById(string $ActivatedById)
    {
        $this->ActivatedById = $ActivatedById;
    }

    /**
     * @return string
     */
    public function getActivatedDate(): ?string
    {
        return $this->ActivatedDate;
    }

    /**
     * @param string $ActivatedDate
     */
    public function setActivatedDate(string $ActivatedDate)
    {
        $this->ActivatedDate = $ActivatedDate;
    }

    /**
     * @return string
     */
    public function getBillingCity(): ?string
    {
        return $this->BillingCity;
    }

    /**
     * @param string $BillingCity
     */
    public function setBillingCity(string $BillingCity)
    {
        $this->BillingCity = $BillingCity;
    }

    /**
     * @return string
     */
    public function getBillingCountry(): ?string
    {
        return $this->BillingCountry;
    }

    /**
     * @param string $BillingCountry
     */
    public function setBillingCountry(string $BillingCountry)
    {
        $this->BillingCountry = $BillingCountry;
    }

    /**
     * @return string
     */
    public function getBillingGeocodeAccuracy(): ?string
    {
        return $this->BillingGeocodeAccuracy;
    }

    /**
     * @param string $BillingGeocodeAccuracy
     */
    public function setBillingGeocodeAccuracy(string $BillingGeocodeAccuracy)
    {
        $this->BillingGeocodeAccuracy = $BillingGeocodeAccuracy;
    }

    /**
     * @return float
     */
    public function getBillingLatitude(): ?float
    {
        return $this->BillingLatitude;
    }

    /**
     * @param float $BillingLatitude
     */
    public function setBillingLatitude(float $BillingLatitude)
    {
        $this->BillingLatitude = $BillingLatitude;
    }

    /**
     * @return float
     */
    public function getBillingLongitude(): ?float
    {
        return $this->BillingLongitude;
    }

    /**
     * @param float $BillingLongitude
     */
    public function setBillingLongitude(float $BillingLongitude)
    {
        $this->BillingLongitude = $BillingLongitude;
    }

    /**
     * @return string
     */
    public function getBillingPostalCode(): ?string
    {
        return $this->BillingPostalCode;
    }

    /**
     * @param string $BillingPostalCode
     */
    public function setBillingPostalCode(string $BillingPostalCode)
    {
        $this->BillingPostalCode = $BillingPostalCode;
    }

    /**
     * @return string
     */
    public function getBillingState(): ?string
    {
        return $this->BillingState;
    }

    /**
     * @param string $BillingState
     */
    public function setBillingState(string $BillingState)
    {
        $this->BillingState = $BillingState;
    }

    /**
     * @return string
     */
    public function getBillingStreet(): ?string
    {
        return $this->BillingStreet;
    }

    /**
     * @param string $BillingStreet
     */
    public function setBillingStreet(string $BillingStreet)
    {
        $this->BillingStreet = $BillingStreet;
    }

    /**
     * @return string
     */
    public function getCompanyAuthorizedById(): ?string
    {
        return $this->CompanyAuthorizedById;
    }

    /**
     * @param string $CompanyAuthorizedById
     */
    public function setCompanyAuthorizedById(string $CompanyAuthorizedById)
    {
        $this->CompanyAuthorizedById = $CompanyAuthorizedById;
    }

    /**
     * @return string
     */
    public function getContractId(): ?string
    {
        return $this->ContractId;
    }

    /**
     * @param string $ContractId
     */
    public function setContractId(string $ContractId)
    {
        $this->ContractId = $ContractId;
    }

    /**
     * @return string
     */
    public function getCustomerAuthorizedById(): ?string
    {
        return $this->CustomerAuthorizedById;
    }

    /**
     * @param string $CustomerAuthorizedById
     */
    public function setCustomerAuthorizedById(string $CustomerAuthorizedById)
    {
        $this->CustomerAuthorizedById = $CustomerAuthorizedById;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     */
    public function setDescription(string $Description)
    {
        $this->Description = $Description;
    }

    /**
     * @return string
     */
    public function getEffectiveDate(): ?string
    {
        return $this->EffectiveDate;
    }

    /**
     * @param string $EffectiveDate
     */
    public function setEffectiveDate(string $EffectiveDate)
    {
        $this->EffectiveDate = $EffectiveDate;
    }

    /**
     * @return string
     */
    public function getEndDate(): ?string
    {
        return $this->EndDate;
    }

    /**
     * @param string $EndDate
     */
    public function setEndDate(string $EndDate)
    {
        $this->EndDate = $EndDate;
    }

    /**
     * @return string
     */
    public function getShippingCity(): ?string
    {
        return $this->ShippingCity;
    }

    /**
     * @param string $ShippingCity
     */
    public function setShippingCity(string $ShippingCity)
    {
        $this->ShippingCity = $ShippingCity;
    }

    /**
     * @return string
     */
    public function getShippingCountry(): ?string
    {
        return $this->ShippingCountry;
    }

    /**
     * @param string $ShippingCountry
     */
    public function setShippingCountry(string $ShippingCountry)
    {
        $this->ShippingCountry = $ShippingCountry;
    }

    /**
     * @return string
     */
    public function getShippingGeocodeAccuracy(): ?string
    {
        return $this->ShippingGeocodeAccuracy;
    }

    /**
     * @param string $ShippingGeocodeAccuracy
     */
    public function setShippingGeocodeAccuracy(string $ShippingGeocodeAccuracy)
    {
        $this->ShippingGeocodeAccuracy = $ShippingGeocodeAccuracy;
    }

    /**
     * @return float
     */
    public function getShippingLatitude(): ?float
    {
        return $this->ShippingLatitude;
    }

    /**
     * @param float $ShippingLatitude
     */
    public function setShippingLatitude(float $ShippingLatitude)
    {
        $this->ShippingLatitude = $ShippingLatitude;
    }

    /**
     * @return float
     */
    public function getShippingLongitude(): ?float
    {
        return $this->ShippingLongitude;
    }

    /**
     * @param float $ShippingLongitude
     */
    public function setShippingLongitude(float $ShippingLongitude)
    {
        $this->ShippingLongitude = $ShippingLongitude;
    }

    /**
     * @return string
     */
    public function getShippingPostalCode(): ?string
    {
        return $this->ShippingPostalCode;
    }

    /**
     * @param string $ShippingPostalCode
     */
    public function setShippingPostalCode(string $ShippingPostalCode)
    {
        $this->ShippingPostalCode = $ShippingPostalCode;
    }

    /**
     * @return string
     */
    public function getShippingState(): ?string
    {
        return $this->ShippingState;
    }

    /**
     * @param string $ShippingState
     */
    public function setShippingState(string $ShippingState)
    {
        $this->ShippingState = $ShippingState;
    }

    /**
     * @return string
     */
    public function getShippingStreet(): ?string
    {
        return $this->ShippingStreet;
    }

    /**
     * @param string $ShippingStreet
     */
    public function setShippingStreet(string $ShippingStreet)
    {
        $this->ShippingStreet = $ShippingStreet;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->Status;
    }

    /**
     * @param string $Status
     */
    public function setStatus(string $Status)
    {
        $this->Status = $Status;
    }

    /**
     * @return string
     */
    public function getStatusCode(): ?string
    {
        return $this->StatusCode;
    }

    /**
     * @param string $StatusCode
     */
    public function setStatusCode(string $StatusCode)
    {
        $this->StatusCode = $StatusCode;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->Type;
    }

    /**
     * @param string $Type
     */
    public function setType(string $Type)
    {
        $this->Type = $Type;
    }


}