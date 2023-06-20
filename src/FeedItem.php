<?php

namespace Cyclonecode\Cision;

use Cyclonecode\Cision\Traits\Serialize;

class FeedItem
{
    use Serialize;

    private string $HtmlBody;
    private string $HtmlCompanyInformation;
    private string $HtmlContact;
    private string $HtmlTitle;
    private string $HtmlHeader;
    private string $HtmlIntro;
    private string $Body;
    private array $ServiceCategories;
    private int $MainJobId;
    private int $SourceId;
    private bool $SourceIsListed;
    private string $SourceName;
    private string $LogoUrl;
    private string $CompanyInformation;
    private string $Contact;
    private string $Header;
    private array $Keywords;
    private array $QuickFacts;
    private array $Categories;
    private array $Videos;
    private array $Files;
    private array $Quotes;
    private array $ExternalLinks;
    private array $EmbeddedItems;
    private int $Id;
    private string $EncryptedId;
    private bool $IsRegulatory;
    private bool $SuppressImageOnCisionWire;
    private \DateTime $PublishDate;
    private \DateTime $LastChangeDate;
    private string $Title;
    private string $Intro;
    private string $IptcCode;
    private string $InformationType;
    private string $LanguageCode;
    private string $CountryCode;
    private string $CanonicalUrl;
    private string $CisionWireUrl;
    private string $RawHtmlUrl;
    private array $LanguageVersions;
    /**
     * @var FeedImage[]
     */
    private array $Images;
    private array $Tickers;

    /**
     * @return string
     */
    public function getHtmlBody(): string
    {
        return $this->HtmlBody;
    }

    /**
     * @param string $HtmlBody
     */
    public function setHtmlBody(string $HtmlBody): void
    {
        $HtmlBody = \strip_tags($HtmlBody, ['p','b','i','br', 'em', 'ul', 'li', 'ol', 'table', 'strong']);
        $HtmlBody = preg_replace('/ style=("|\')(.*?)("|\')/', '', $HtmlBody);
        $this->HtmlBody = $HtmlBody;
    }

    /**
     * @return string
     */
    public function getHtmlCompanyInformation(): string
    {
        return $this->HtmlCompanyInformation;
    }

    /**
     * @param string $HtmlCompanyInformation
     */
    public function setHtmlCompanyInformation(string $HtmlCompanyInformation): void
    {
        $this->HtmlCompanyInformation = $HtmlCompanyInformation;
    }

    /**
     * @return string
     */
    public function getHtmlContact(): string
    {
        return $this->HtmlContact;
    }

    /**
     * @param string $HtmlContact
     */
    public function setHtmlContact(string $HtmlContact): void
    {
        $this->HtmlContact = $HtmlContact;
    }

    /**
     * @return string
     */
    public function getHtmlTitle(): string
    {
        return $this->HtmlTitle;
    }

    /**
     * @param string $HtmlTitle
     */
    public function setHtmlTitle(string $HtmlTitle): void
    {
        $this->HtmlTitle = $HtmlTitle;
    }

    /**
     * @return string
     */
    public function getHtmlHeader(): string
    {
        return $this->HtmlHeader;
    }

    /**
     * @param string $HtmlHeader
     */
    public function setHtmlHeader(string $HtmlHeader): void
    {
        $this->HtmlHeader = $HtmlHeader;
    }

    /**
     * @return string
     */
    public function getHtmlIntro(): string
    {
        return $this->HtmlIntro;
    }

    /**
     * @param string $HtmlIntro
     */
    public function setHtmlIntro(string $HtmlIntro): void
    {
        $this->HtmlIntro = $HtmlIntro;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->Body;
    }

    /**
     * @param string $Body
     */
    public function setBody(string $Body): void
    {
        $this->Body = $Body;
    }

    /**
     * @return array
     */
    public function getServiceCategories(): array
    {
        return $this->ServiceCategories;
    }

    /**
     * @param array $ServiceCategories
     */
    public function setServiceCategories(array $ServiceCategories): void
    {
        $this->ServiceCategories = $ServiceCategories;
    }

    /**
     * @return int
     */
    public function getMainJobId(): int
    {
        return $this->MainJobId;
    }

    /**
     * @param int $MainJobId
     */
    public function setMainJobId(int $MainJobId): void
    {
        $this->MainJobId = $MainJobId;
    }

    /**
     * @return int
     */
    public function getSourceId(): int
    {
        return $this->SourceId;
    }

    /**
     * @param int $SourceId
     */
    public function setSourceId(int $SourceId): void
    {
        $this->SourceId = $SourceId;
    }

    /**
     * @return bool
     */
    public function isSourceIsListed(): bool
    {
        return $this->SourceIsListed;
    }

    /**
     * @param bool $SourceIsListed
     */
    public function setSourceIsListed(bool $SourceIsListed): void
    {
        $this->SourceIsListed = $SourceIsListed;
    }

    /**
     * @return string
     */
    public function getSourceName(): string
    {
        return $this->SourceName;
    }

    /**
     * @param string $SourceName
     */
    public function setSourceName(string $SourceName): void
    {
        $this->SourceName = $SourceName;
    }

    /**
     * @return string
     */
    public function getLogoUrl(): string
    {
        return $this->LogoUrl;
    }

    /**
     * @param string $LogoUrl
     */
    public function setLogoUrl(string $LogoUrl): void
    {
        $this->LogoUrl = $LogoUrl;
    }

    /**
     * @return string
     */
    public function getCompanyInformation(): string
    {
        return $this->CompanyInformation;
    }

    /**
     * @param string $CompanyInformation
     */
    public function setCompanyInformation(string $CompanyInformation): void
    {
        $this->CompanyInformation = $CompanyInformation;
    }

    /**
     * @return string
     */
    public function getContact(): string
    {
        return $this->Contact;
    }

    /**
     * @param string $Contact
     */
    public function setContact(string $Contact): void
    {
        $this->Contact = $Contact;
    }

    /**
     * @return string
     */
    public function getHeader(): string
    {
        return $this->Header;
    }

    /**
     * @param string $Header
     */
    public function setHeader(string $Header): void
    {
        $this->Header = $Header;
    }

    /**
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->Keywords;
    }

    /**
     * @param array $Keywords
     */
    public function setKeywords(array $Keywords): void
    {
        $this->Keywords = $Keywords;
    }

    /**
     * @return array
     */
    public function getQuickFacts(): array
    {
        return $this->QuickFacts;
    }

    /**
     * @param array $QuickFacts
     */
    public function setQuickFacts(array $QuickFacts): void
    {
        $this->QuickFacts = $QuickFacts;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->Categories;
    }

    /**
     * @param array $Categories
     */
    public function setCategories(array $Categories): void
    {
        $this->Categories = $Categories;
    }

    /**
     * @return array
     */
    public function getVideos(): array
    {
        return $this->Videos;
    }

    /**
     * @param array $Videos
     */
    public function setVideos(array $Videos): void
    {
        $this->Videos = $Videos;
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->Files;
    }

    /**
     * @param array $Files
     */
    public function setFiles(array $Files): void
    {
        $this->Files = $Files;
    }

    /**
     * @return array
     */
    public function getQuotes(): array
    {
        return $this->Quotes;
    }

    /**
     * @param array $Quotes
     */
    public function setQuotes(array $Quotes): void
    {
        $this->Quotes = $Quotes;
    }

    /**
     * @return array
     */
    public function getExternalLinks(): array
    {
        return $this->ExternalLinks;
    }

    /**
     * @param array $ExternalLinks
     */
    public function setExternalLinks(array $ExternalLinks): void
    {
        $this->ExternalLinks = $ExternalLinks;
    }

    /**
     * @return array
     */
    public function getEmbeddedItems(): array
    {
        return $this->EmbeddedItems;
    }

    /**
     * @param array $EmbeddedItems
     */
    public function setEmbeddedItems(array $EmbeddedItems): void
    {
        $this->EmbeddedItems = $EmbeddedItems;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->Id;
    }

    /**
     * @param int $Id
     */
    public function setId(int $Id): void
    {
        $this->Id = $Id;
    }

    /**
     * @return string
     */
    public function getEncryptedId(): string
    {
        return $this->EncryptedId;
    }

    /**
     * @param string $EncryptedId
     */
    public function setEncryptedId(string $EncryptedId): void
    {
        $this->EncryptedId = $EncryptedId;
    }

    /**
     * @return bool
     */
    public function isIsRegulatory(): bool
    {
        return $this->IsRegulatory;
    }

    /**
     * @param bool $IsRegulatory
     */
    public function setIsRegulatory(bool $IsRegulatory): void
    {
        $this->IsRegulatory = $IsRegulatory;
    }

    /**
     * @return bool
     */
    public function isSuppressImageOnCisionWire(): bool
    {
        return $this->SuppressImageOnCisionWire;
    }

    /**
     * @param bool $SuppressImageOnCisionWire
     */
    public function setSuppressImageOnCisionWire(bool $SuppressImageOnCisionWire): void
    {
        $this->SuppressImageOnCisionWire = $SuppressImageOnCisionWire;
    }

    /**
     * @return \DateTime
     */
    public function getPublishDate(): \DateTime
    {
        return $this->PublishDate;
    }

    /**
     * @param \DateTime $PublishDate
     */
    public function setPublishDate(\DateTime $PublishDate): void
    {
        $this->PublishDate = $PublishDate;
    }

    /**
     * @return \DateTime
     */
    public function getLastChangeDate(): \DateTime
    {
        return $this->LastChangeDate;
    }

    /**
     * @param \DateTime $LastChangeDate
     */
    public function setLastChangeDate(\DateTime $LastChangeDate): void
    {
        $this->LastChangeDate = $LastChangeDate;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->Title;
    }

    /**
     * @param string $Title
     */
    public function setTitle(string $Title): void
    {
        $this->Title = $Title;
    }

    /**
     * @return string
     */
    public function getIntro(): string
    {
        return $this->Intro;
    }

    /**
     * @param string $Intro
     */
    public function setIntro(string $Intro): void
    {
        $this->Intro = $Intro;
    }

    /**
     * @return string
     */
    public function getIptcCode(): string
    {
        return $this->IptcCode;
    }

    /**
     * @param string $IptcCode
     */
    public function setIptcCode(string $IptcCode): void
    {
        $this->IptcCode = $IptcCode;
    }

    /**
     * @return string
     */
    public function getInformationType(): string
    {
        return $this->InformationType;
    }

    /**
     * @param string $InformationType
     */
    public function setInformationType(string $InformationType): void
    {
        $this->InformationType = $InformationType;
    }

    /**
     * @return string
     */
    public function getLanguageCode(): string
    {
        return $this->LanguageCode;
    }

    /**
     * @param string $LanguageCode
     */
    public function setLanguageCode(string $LanguageCode): void
    {
        $this->LanguageCode = $LanguageCode;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->CountryCode;
    }

    /**
     * @param string $CountryCode
     */
    public function setCountryCode(string $CountryCode): void
    {
        $this->CountryCode = $CountryCode;
    }

    /**
     * @return string
     */
    public function getCanonicalUrl(): string
    {
        return $this->CanonicalUrl;
    }

    /**
     * @param string $CanonicalUrl
     */
    public function setCanonicalUrl(string $CanonicalUrl): void
    {
        $this->CanonicalUrl = $CanonicalUrl;
    }

    /**
     * @return string
     */
    public function getCisionWireUrl(): string
    {
        return $this->CisionWireUrl;
    }

    /**
     * @param string $CisionWireUrl
     */
    public function setCisionWireUrl(string $CisionWireUrl): void
    {
        $this->CisionWireUrl = $CisionWireUrl;
    }

    /**
     * @return string
     */
    public function getRawHtmlUrl(): string
    {
        return $this->RawHtmlUrl;
    }

    /**
     * @param string $RawHtmlUrl
     */
    public function setRawHtmlUrl(string $RawHtmlUrl): void
    {
        $this->RawHtmlUrl = $RawHtmlUrl;
    }

    /**
     * @return array
     */
    public function getLanguageVersions(): array
    {
        return $this->LanguageVersions;
    }

    /**
     * @param array $LanguageVersions
     */
    public function setLanguageVersions(array $LanguageVersions): void
    {
        $this->LanguageVersions = $LanguageVersions;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->Images;
    }

    /**
     * @param array $Images
     */
    public function setImages(array $Images): void
    {
        $this->Images = $Images;
    }

    /**
     * @return array
     */
    public function getTickers(): array
    {
        return $this->Tickers;
    }

    /**
     * @param array $Tickers
     */
    public function setTickers(array $Tickers): void
    {
        $this->Tickers = $Tickers;
    }
}
