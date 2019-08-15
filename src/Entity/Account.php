<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ApiResource
 */
class Account
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=255)
     */
    private $uid;

    /**
     * @var string Required. Label is Account Name. Name of the account. Maximum size is 255 characters. If the account has a record type of Person Account: This value is the concatenation of the FirstName, MiddleName, LastName, and Suffix of the associated person contact. You can't modify this value.
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @var string The source of the account record. For example, Advertisement, Data.com, or Trade Show. The source is selected from a picklist of available values, which are set by an administrator. Each picklist value can have up to 40 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AccountSource;

    /**
     * @var float Estimated annual revenue of the account.
     * @ORM\Column(type="float", nullable=true)
     */
    private $AnnualRevenue;

    /**
     * @var string Details for the billing address of this account. Maximum size is 40 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingCity;

    /**
     * @var string Details for the billing address of this account. Maximum size is 80 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingCountry;

    /**
     * @var string Accuracy level of the geocode for the billing address. See Compound Field Considerations and Limitations for details on geolocation compound fields.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingGeocodeAccuracy;

    /**
     * @var float Used with BillingLongitude to specify the precise geolocation of a billing address. Acceptable values are numbers between –90 and 90 with up to 15 decimal places. See Compound Field Considerations and Limitations for details on geolocation compound fields.
     * @ORM\Column(type="float", nullable=true)
     */
    private $BillingLatitude;

    /**
     * @var float Used with BillingLatitude to specify the precise geolocation of a billing address. Acceptable values are numbers between –180 and 180 with up to 15 decimal places. See Compound Field Considerations and Limitations for details on geolocation compound fields.
     * @ORM\Column(type="float", nullable=true)
     */
    private $BillingLongitude;

    /**
     * @var string Details for the billing address of this account. Maximum size is 20 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingPostalCode;

    /**
     * @var string Details for the billing address of this account. Maximum size is 80 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingState;

    /**
     * @var string Street address for the billing address of this account.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BillingStreet;

    /**
     * @var string Text description of the account. Limited to 32,000 KB.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @var string Fax number for the account.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Fax;

    /**
     * @var string An industry associated with this account. Maximum size is 40 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Industry;

    /**
     * @var string References the ID of a company in Data.com. If an account has a value in this field, it means that the account was imported from Data.com. If the field value is null, the account was not imported from Data.com. Maximum size is 20 characters. Available in API version 22.0 and later. Label is Data.com Key.The Jigsaw field is exposed in the API to support troubleshooting for import errors and reimporting of corrected data. Do not modify the value in the Jigsaw field.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Jigsaw;

    /**
     * @var integer Label is Employees. Number of employees working at the company represented by this account. Maximum size is eight digits.
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private $NumberOfEmployees;

    /**
     * @var string The ID of the user who currently owns this account. Default value is the user logged in to the API to perform the create.If you have set up account teams in your organization, updating this field has different consequences depending on your version of the API: For API version 12.0 and later, sharing records are kept, as they are for all objects. For API version before 12.0, sharing records are deleted. For API version 16.0 and later, users must have the “Transfer Record” permission in order to update (transfer) account ownership using this field.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $OwnerId;

    /**
     * @var string ID of the parent object, if any.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ParentId;

    /**
     * @var string Phone number for this account. Maximum size is 40 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Phone;

    /**
     * @var string Details of the shipping address for this account. City maximum size is 40 characters
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingCity;

    /**
     * @var string Details of the shipping address for this account. Country maximum size is 80 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingCountry;

    /**
     * @var string Accuracy level of the geocode for the shipping address. See Compound Field Considerations and Limitations for details on geolocation compound fields.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingGeocodeAccuracy;

    /**
     * @var float Used with ShippingLongitude to specify the precise geolocation of a shipping address. Acceptable values are numbers between –90 and 90 with up to 15 decimal places. See Compound Field Considerations and Limitations for details on geolocation compound fields.
     * @ORM\Column(type="float", nullable=true)
     */
    private $ShippingLatitude;

    /**
     * @var float Used with ShippingLatitude to specify the precise geolocation of an address. Acceptable values are numbers between –180 and 180 with up to 15 decimal places. See Compound Field Considerations and Limitations for details on geolocation compound fields.
     * @ORM\Column(type="float", nullable=true)
     */
    private $ShippingLongitude;

    /**
     * @var string Details of the shipping address for this account. Postal code maximum size is 20 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingPostalCode;

    /**
     * @var string Details of the shipping address for this account. State maximum size is 80 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingState;

    /**
     * @var string The street address of the shipping address for this account. Maximum of 255 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShippingStreet;

    /**
     * @var string A brief description of an organization’s line of business, based on its SIC code. Maximum length is 80 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SicDesc;

    /**
     * @var string Type of account, for example, Customer, Competitor, or Partner.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Type;

    /**
     * @var string The website of this account. Maximum of 255 characters.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Website;

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
    public function getName(): ?string
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName(string $Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return string
     */
    public function getAccountSource(): ?string
    {
        return $this->AccountSource;
    }

    /**
     * @param string $AccountSource
     */
    public function setAccountSource(string $AccountSource)
    {
        $this->AccountSource = $AccountSource;
    }

    /**
     * @return float
     */
    public function getAnnualRevenue(): ?float
    {
        return $this->AnnualRevenue;
    }

    /**
     * @param float $AnnualRevenue
     */
    public function setAnnualRevenue(float $AnnualRevenue)
    {
        $this->AnnualRevenue = $AnnualRevenue;
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
    public function getFax(): ?string
    {
        return $this->Fax;
    }

    /**
     * @param string $Fax
     */
    public function setFax(string $Fax)
    {
        $this->Fax = $Fax;
    }

    /**
     * @return string
     */
    public function getIndustry(): ?string
    {
        return $this->Industry;
    }

    /**
     * @param string $Industry
     */
    public function setIndustry(string $Industry)
    {
        $this->Industry = $Industry;
    }

    /**
     * @return string
     */
    public function getJigsaw(): ?string
    {
        return $this->Jigsaw;
    }

    /**
     * @param string $Jigsaw
     */
    public function setJigsaw(string $Jigsaw)
    {
        $this->Jigsaw = $Jigsaw;
    }

    /**
     * @return int
     */
    public function getNumberOfEmployees(): ?int
    {
        return $this->NumberOfEmployees;
    }

    /**
     * @param int $NumberOfEmployees
     */
    public function setNumberOfEmployees(int $NumberOfEmployees)
    {
        $this->NumberOfEmployees = $NumberOfEmployees;
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
    public function getParentId(): ?string
    {
        return $this->ParentId;
    }

    /**
     * @param string $ParentId
     */
    public function setParentId(string $ParentId)
    {
        $this->ParentId = $ParentId;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    /**
     * @param string $Phone
     */
    public function setPhone(string $Phone)
    {
        $this->Phone = $Phone;
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
    public function getSicDesc(): ?string
    {
        return $this->SicDesc;
    }

    /**
     * @param string $SicDesc
     */
    public function setSicDesc(string $SicDesc)
    {
        $this->SicDesc = $SicDesc;
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

    /**
     * @return string
     */
    public function getWebsite(): ?string
    {
        return $this->Website;
    }

    /**
     * @param string $Website
     */
    public function setWebsite(string $Website)
    {
        $this->Website = $Website;
    }


}