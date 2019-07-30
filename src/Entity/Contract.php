<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ApiResource
 */
class Contract
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=255)
     */
    private $uid;

    /**
     * @var string Required. ID of the Account associated with this contract. Is this field supposed to be uneditable (we know it’s supposed to be undeletable) if contract is active?
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AccountId;

    /**
     * @var string ID of the User who activated this contract.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ActivatedById;

    /**
     * @var string Date and time when this contract was activated.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ActivatedDate;

    /**
     * @var string Details for the billing address. Maximum size is 40 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingCity;

    /**
     * @var string Details for the billing address of this account. Maximum size is 80 characters.
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
     * @var string Details for the billing address of this account. Maximum size is 20 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingPostalCode;

    /**
     * @var string Details for the billing address. Maximum size is 80 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingState;

    /**
     * @var string Street address for the billing address.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingStreet;

    /**
     * @var string Date on which the contract was signed by your organization.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CompanySignedDate;

    /**
     * @var string ID of the User who signed the contract.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CompanySignedId;

    /**
     * @var integer Number of months that the contract is valid.
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private $ContractTerm;

    /**
     * @var string Date on which the customer signed the contract.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CustomerSignedDate;

    /**
     * @var string ID of the Contact who signed this contract.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CustomerSignedId;

    /**
     * @var string Title of the customer who signed the contract.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CustomerSignedTitle;

    /**
     * @var string Description of the contract.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @var string Number of days ahead of the contract end date (15, 30, 45, 60, 90, and 120). Used to notify the owner in advance that the contract is ending.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $OwnerExpirationNotice;

    /**
     * @var string ID of the user who owns the contract.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $OwnerId;

    /**
     * @var string Details of the shipping address. City maximum size is 40 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingCity;

    /**
     * @var string Details of the shipping address. Country maximum size is 80 characters.
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
     * @var string Details of the shipping address. Postal code maximum size is 20 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingPostalCode;

    /**
     * @var string Details of the shipping address. State maximum size is 80 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingState;

    /**
     * @var string The street address of the shipping address. Maximum of 255 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingStreet;

    /**
     * @var string Special terms that apply to the contract.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SpecialTerms;

    /**
     * @var string Start date for this contract. Label is Contract Start Date.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $StartDate;

    /**
     * @var string The picklist of values that indicate order status. Each value is within one of two status categories defined in StatusCode. For example, the status picklist may contain: Ready to Ship, Shipped, Received as values within the Activated StatusCode.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Status;

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
    public function getCompanySignedDate(): ?string
    {
        return $this->CompanySignedDate;
    }

    /**
     * @param string $CompanySignedDate
     */
    public function setCompanySignedDate(string $CompanySignedDate)
    {
        $this->CompanySignedDate = $CompanySignedDate;
    }

    /**
     * @return string
     */
    public function getCompanySignedId(): ?string
    {
        return $this->CompanySignedId;
    }

    /**
     * @param string $CompanySignedId
     */
    public function setCompanySignedId(string $CompanySignedId)
    {
        $this->CompanySignedId = $CompanySignedId;
    }

    /**
     * @return int
     */
    public function getContractTerm(): ?int
    {
        return $this->ContractTerm;
    }

    /**
     * @param int $ContractTerm
     */
    public function setContractTerm(int $ContractTerm)
    {
        $this->ContractTerm = $ContractTerm;
    }

    /**
     * @return string
     */
    public function getCustomerSignedDate(): ?string
    {
        return $this->CustomerSignedDate;
    }

    /**
     * @param string $CustomerSignedDate
     */
    public function setCustomerSignedDate(string $CustomerSignedDate)
    {
        $this->CustomerSignedDate = $CustomerSignedDate;
    }

    /**
     * @return string
     */
    public function getCustomerSignedId(): ?string
    {
        return $this->CustomerSignedId;
    }

    /**
     * @param string $CustomerSignedId
     */
    public function setCustomerSignedId(string $CustomerSignedId)
    {
        $this->CustomerSignedId = $CustomerSignedId;
    }

    /**
     * @return string
     */
    public function getCustomerSignedTitle(): ?string
    {
        return $this->CustomerSignedTitle;
    }

    /**
     * @param string $CustomerSignedTitle
     */
    public function setCustomerSignedTitle(string $CustomerSignedTitle)
    {
        $this->CustomerSignedTitle = $CustomerSignedTitle;
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
    public function getOwnerExpirationNotice(): ?string
    {
        return $this->OwnerExpirationNotice;
    }

    /**
     * @param string $OwnerExpirationNotice
     */
    public function setOwnerExpirationNotice(string $OwnerExpirationNotice)
    {
        $this->OwnerExpirationNotice = $OwnerExpirationNotice;
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
    public function getSpecialTerms(): ?string
    {
        return $this->SpecialTerms;
    }

    /**
     * @param string $SpecialTerms
     */
    public function setSpecialTerms(string $SpecialTerms)
    {
        $this->SpecialTerms = $SpecialTerms;
    }

    /**
     * @return string
     */
    public function getStartDate(): ?string
    {
        return $this->StartDate;
    }

    /**
     * @param string $StartDate
     */
    public function setStartDate(string $StartDate)
    {
        $this->StartDate = $StartDate;
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


}