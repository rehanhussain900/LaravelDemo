<?php

namespace App\Services\PestPac;

use App\Services\PestPacService;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

/**
 *
 */
class Location
{
    private $input;

    /**
     * @var Client
     */
    private $client;

    private $defaults;

    /**
     * @param PestPacService $service
     */
    public function __construct( PestPacService $service )
    {
        $this->client = $service->getGuzzleClient();
        $this->defaults = $service->getDefaultOptions();
    }// __construct

    /**
     * @param $location_id
     * @param null $include_inactive
     *
     * @return string
     * @throws GuzzleException
     */
    public function getAreas( $location_id, $include_inactive = null ) : string
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        if( !empty( $include_inactive ) ) {
            $this->defaults[ 'query' ] = [ 'includeInactive' => $include_inactive ];
        }
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/areas', $this->defaults );
        return $response->getBody()->getContents();
    }// getAreas

    /**
     * @param $location_id
     *
     * @return string
     * @throws GuzzleException
     */
    public function getCalls( $location_id ) : string
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/calls', $this->defaults );
        return $response->getBody()->getContents();
    }// getCalls

    /**
     * @param $location_id
     *
     * @return string
     * @throws GuzzleException
     */
    public function getContacts( $location_id ) : string
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/contacts', $this->defaults );
        return $response->getBody()->getContents();
    }// getContacts

    /**
     * @param $location_id
     *
     * @return string
     * @throws GuzzleException
     */
    public function getDiagrams( $location_id ) : string
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/diagrams', $this->defaults );
        return $response->getBody()->getContents();
    }

    /**
     * @param $location_id
     *
     * @return string
     * @throws GuzzleException
     */
    public function getForms( $location_id ) : string
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/diagrams', $this->defaults );
        return $response->getBody()->getContents();
    }// getForms


    /**
     * @param $location_id
     * @param null $start_date
     * @param null $end_date
     * @param null $include_documents
     * @param null $include_forms
     * @param null $include_call_documents
     * @param null $include_company_documents
     *
     * @return string
     * @throws GuzzleException
     */
    public function getDocuments(
        $location_id,
        $start_date = null,
        $end_date = null,
        $include_documents = null,
        $include_forms = null,
        $include_call_documents = null,
        $include_company_documents = null
    ) : string {
        $query = [];
        if( $start_date !== null ) {
            $query[ 'startDate' ] = $start_date;
        }
        if( $end_date !== null ) {
            $query[ 'endDate' ] = $end_date;
        }
        if( $include_documents !== null ) {
            $query[ 'includeDocuments' ] = $include_documents;
        }
        if( $include_forms !== null ) {
            $query[ 'includeForms' ] = $include_forms;
        }
        if( $include_call_documents !== null ) {
            $query[ 'includeCallDocuments' ] = $include_call_documents;
        }
        if( $include_company_documents !== null ) {
            $query[ 'includeCompanyDocuments' ] = $include_company_documents;
        }
        if( !empty( $query ) ) {
            $this->defaults[ 'query' ] = $query;
        }
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/devices', $this->defaults );
        return $response->getBody()->getContents();
    }// getDocuments

    /**
     * @param $location_id
     * @param null $active
     * @param null $area_id
     * @param null $include_orphans
     *
     * @return string
     * @throws GuzzleException
     */
    public function getDevices( $location_id, $active = null, $area_id = null, $include_orphans = null ) : string
    {
        $query = [];
        if( $active !== null ) {
            $query[ 'active' ] = $active;
        }
        if( $area_id !== null ) {
            $query[ 'areaId' ] = $area_id;
        }

        if( $include_orphans !== null ) {
            $query[ 'includeOrphans' ] = $include_orphans;
        }
        if( !empty( $query ) ) {
            $this->defaults[ 'query' ] = $query;
        }
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/devices', $this->defaults );
        return $response->getBody()->getContents();
    }// getDevices

    /**
     * @param $location_id
     * @param null $status
     * @param null $area_id
     *
     * @return string
     * @throws GuzzleException
     */
    public function getConditions( $location_id, $status = null, $area_id = null ) : string
    {
        $query = [];
        if( $status !== null ) {
            $query[ 'status' ] = $status;
        }
        if( $area_id !== null ) {
            $query[ 'locAreaId' ] = $area_id;
        }
        if( !empty( $query ) ) {
            $this->defaults[ 'query' ] = $query;
        }
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/conditions', $this->defaults );
        return $response->getBody()->getContents();
    }// getConditions

    /**
     * @param $location_id
     *
     * @return string
     * @throws GuzzleException
     */
    public function getById( $location_id ) : string
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id, $this->defaults );
        return $response->getBody()->getContents();
    }// getById

    /**
     * @param $q
     *
     * @return string
     * @throws GuzzleException
     */
    public function getByQuery( $q ) : string
    {
        $this->defaults[ 'query' ] = [ 'q' => $q ];
        $response = $this->client->request( 'GET', 'locations', $this->defaults );
        return $response->getBody()->getContents();
    }// getByQuery

    /**
     * @param $location_id
     *
     * @return string
     * @throws GuzzleException
     */
    public function getInvoices( $location_id ) : string
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/unpaidInvoices', $this->defaults );
        return $response->getBody()->getContents();
    }// getInvoices

    /**
     * @param $location_id
     *
     * @return string
     * @throws GuzzleException
     */
    public function getServiceSetups( $location_id ) : string
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/serviceSetups', $this->defaults );
        return $response->getBody()->getContents();
    }// getServiceSetups

    /**
     * @param $location_id
     *
     * @return string
     * @throws GuzzleException
     */
    public function getServiceOrders( $location_id ) : string
    {
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/serviceOrders', $this->defaults );
        return $response->getBody()->getContents();
    }// getServiceOrders

    public function getServiceHistory(
        $location_id,
        $start_date = null,
        $end_date = null,
        $skip = null,
        $top = null
    ) : string {
        $query = [];
        if( $start_date !== null ) {
            $query[ 'startDate' ] = $start_date;
        }
        if( $end_date !== null ) {
            $query[ 'endDate' ] = $end_date;
        }
        if( $skip !== null ) {
            $query[ 'skip' ] = $skip;
        }
        if( $top !== null ) {
            $query[ 'top' ] = $top;
        }
        if( !empty( $query ) ) {
            $this->defaults[ 'query' ] = $query;
        }
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/serviceHistory', $this->defaults );
        return $response->getBody()->getContents();
    }

    /**
     * @param $location_id
     * @param null $include_open
     * @param null $include_closed
     *
     * @return string
     * @throws GuzzleException
     */
    public function getTasks( $location_id, $include_open = null, $include_closed = null )
    {
        $query = [];
        if( $include_open !== null ) {
            $query[ 'includeOpen' ] = $include_open;
        }
        if( $include_closed !== null ) {
            $query[ 'includeClosed' ] = $include_closed;
        }
        $this->defaults[ 'headers' ][ 'Content-Type' ] = 'application/json';
        if( !empty( $query ) ) {
            $this->defaults[ 'query' ] = $query;
        }
        $response = $this->client->request( 'GET', 'locations/' . $location_id . '/tasks', $this->defaults );
        return $response->getBody()->getContents();
    }// getTasks


    /**
     * Gets location_id
     * @return int
     */
    public function getLocationId() : int
    {
        return $this->input[ 'location_id' ];
    }// getLocationId

    /**
     * Sets location_id
     *
     * @param int $location_id
     *
     * @return $this
     */
    public function setLocationId( $location_id )
    {
        $this->input[ 'location_id' ] = $location_id;

        return $this;
    }

    /**
     * Gets location_code
     * @return string
     */
    public function getLocationCode()
    {
        return $this->input[ 'location_code' ];
    }

    /**
     * Sets location_code
     *
     * @param string $location_code
     *
     * @return $this
     */
    public function setLocationCode( $location_code )
    {
        $this->input[ 'location_code' ] = $location_code;

        return $this;
    }

    /**
     * Gets branch
     * @return string
     */
    public function getBranch()
    {
        return $this->input[ 'branch' ];
    }

    /**
     * Sets branch
     *
     * @param string $branch
     *
     * @return $this
     */
    public function setBranch( $branch )
    {
        $this->input[ 'branch' ] = $branch;

        return $this;
    }

    /**
     * Gets branch_id
     * @return int
     */
    public function getBranchId()
    {
        return $this->input[ 'branch_id' ];
    }

    /**
     * Sets branch_id
     *
     * @param int $branch_id
     *
     * @return $this
     */
    public function setBranchId( $branch_id )
    {
        $this->input[ 'branch_id' ] = $branch_id;

        return $this;
    }

    /**
     * Gets bill_to_id
     * @return int
     */
    public function getBillToId()
    {
        return $this->input[ 'bill_to_id' ];
    }

    /**
     * Sets bill_to_id
     *
     * @param int $bill_to_id
     *
     * @return $this
     */
    public function setBillToId( $bill_to_id )
    {
        $this->input[ 'bill_to_id' ] = $bill_to_id;

        return $this;
    }

    /**
     * Gets company
     * @return string
     */
    public function getCompany()
    {
        return $this->input[ 'company' ];
    }

    /**
     * Sets company
     *
     * @param string $company
     *
     * @return $this
     */
    public function setCompany( $company )
    {
        $this->input[ 'company' ] = $company;

        return $this;
    }

    /**
     * Gets last_name
     * @return string
     */
    public function getLastName()
    {
        return $this->input[ 'last_name' ];
    }

    /**
     * Sets last_name
     *
     * @param string $last_name
     *
     * @return $this
     */
    public function setLastName( $last_name )
    {
        $this->input[ 'last_name' ] = $last_name;

        return $this;
    }

    /**
     * Gets first_name
     * @return string
     */
    public function getFirstName()
    {
        return $this->input[ 'first_name' ];
    }

    /**
     * Sets first_name
     *
     * @param string $first_name
     *
     * @return $this
     */
    public function setFirstName( $first_name )
    {
        $this->input[ 'first_name' ] = $first_name;

        return $this;
    }

    /**
     * Gets title
     * @return string
     */
    public function getTitle()
    {
        return $this->input[ 'title' ];
    }

    /**
     * Sets title
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle( $title )
    {
        $this->input[ 'title' ] = $title;

        return $this;
    }

    /**
     * Gets salutation
     * @return string
     */
    public function getSalutation()
    {
        return $this->input[ 'salutation' ];
    }

    /**
     * Sets salutation
     *
     * @param string $salutation
     *
     * @return $this
     */
    public function setSalutation( $salutation )
    {
        $this->input[ 'salutation' ] = $salutation;

        return $this;
    }

    /**
     * Gets salutation_name
     * @return string
     */
    public function getSalutationName()
    {
        return $this->input[ 'salutation_name' ];
    }

    /**
     * Sets salutation_name
     *
     * @param string $salutation_name
     *
     * @return $this
     */
    public function setSalutationName( $salutation_name )
    {
        $this->input[ 'salutation_name' ] = $salutation_name;

        return $this;
    }

    /**
     * Gets address
     * @return string
     */
    public function getAddress()
    {
        return $this->input[ 'address' ];
    }

    /**
     * Sets address
     *
     * @param string $address
     *
     * @return $this
     */
    public function setAddress( $address )
    {
        $this->input[ 'address' ] = $address;

        return $this;
    }

    /**
     * Gets address2
     * @return string
     */
    public function getAddress2()
    {
        return $this->input[ 'address2' ];
    }

    /**
     * Sets address2
     *
     * @param string $address2
     *
     * @return $this
     */
    public function setAddress2( $address2 )
    {
        $this->input[ 'address2' ] = $address2;

        return $this;
    }

    /**
     * Gets city
     * @return string
     */
    public function getCity()
    {
        return $this->input[ 'city' ];
    }

    /**
     * Sets city
     *
     * @param string $city
     *
     * @return $this
     */
    public function setCity( $city )
    {
        $this->input[ 'city' ] = $city;

        return $this;
    }

    /**
     * Gets state
     * @return string
     */
    public function getState()
    {
        return $this->input[ 'state' ];
    }

    /**
     * Sets state
     *
     * @param string $state
     *
     * @return $this
     */
    public function setState( $state )
    {
        $this->input[ 'state' ] = $state;

        return $this;
    }

    /**
     * Gets zip
     * @return string
     */
    public function getZip()
    {
        return $this->input[ 'zip' ];
    }

    /**
     * Sets zip
     *
     * @param string $zip
     *
     * @return $this
     */
    public function setZip( $zip )
    {
        $this->input[ 'zip' ] = $zip;

        return $this;
    }

    /**
     * Gets country
     * @return string
     */
    public function getCountry()
    {
        return $this->input[ 'country' ];
    }

    /**
     * Sets country
     *
     * @param string $country
     *
     * @return $this
     */
    public function setCountry( $country )
    {
        $this->input[ 'country' ] = $country;

        return $this;
    }

    /**
     * Gets phone
     * @return string
     */
    public function getPhone()
    {
        return $this->input[ 'phone' ];
    }

    /**
     * Sets phone
     *
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone( $phone )
    {
        $this->input[ 'phone' ] = $phone;

        return $this;
    }

    /**
     * Gets phone_extension
     * @return string
     */
    public function getPhoneExtension()
    {
        return $this->input[ 'phone_extension' ];
    }

    /**
     * Sets phone_extension
     *
     * @param string $phone_extension
     *
     * @return $this
     */
    public function setPhoneExtension( $phone_extension )
    {
        $this->input[ 'phone_extension' ] = $phone_extension;

        return $this;
    }

    /**
     * Gets alternate_phone
     * @return string
     */
    public function getAlternatePhone()
    {
        return $this->input[ 'alternate_phone' ];
    }

    /**
     * Sets alternate_phone
     *
     * @param string $alternate_phone
     *
     * @return $this
     */
    public function setAlternatePhone( $alternate_phone )
    {
        $this->input[ 'alternate_phone' ] = $alternate_phone;

        return $this;
    }

    /**
     * Gets alternate_phone_extension
     * @return string
     */
    public function getAlternatePhoneExtension()
    {
        return $this->input[ 'alternate_phone_extension' ];
    }

    /**
     * Sets alternate_phone_extension
     *
     * @param string $alternate_phone_extension
     *
     * @return $this
     */
    public function setAlternatePhoneExtension( $alternate_phone_extension )
    {
        $this->input[ 'alternate_phone_extension' ] = $alternate_phone_extension;

        return $this;
    }

    /**
     * Gets fax
     * @return string
     */
    public function getFax()
    {
        return $this->input[ 'fax' ];
    }

    /**
     * Sets fax
     *
     * @param string $fax
     *
     * @return $this
     */
    public function setFax( $fax )
    {
        $this->input[ 'fax' ] = $fax;

        return $this;
    }

    /**
     * Gets fax_extension
     * @return string
     */
    public function getFaxExtension()
    {
        return $this->input[ 'fax_extension' ];
    }

    /**
     * Sets fax_extension
     *
     * @param string $fax_extension
     *
     * @return $this
     */
    public function setFaxExtension( $fax_extension )
    {
        $this->input[ 'fax_extension' ] = $fax_extension;

        return $this;
    }

    /**
     * Gets mobile_phone
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->input[ 'mobile_phone' ];
    }

    /**
     * Sets mobile_phone
     *
     * @param string $mobile_phone
     *
     * @return $this
     */
    public function setMobilePhone( $mobile_phone )
    {
        $this->input[ 'mobile_phone' ] = $mobile_phone;

        return $this;
    }

    /**
     * Gets mobile_phone_extension
     * @return string
     */
    public function getMobilePhoneExtension()
    {
        return $this->input[ 'mobile_phone_extension' ];
    }

    /**
     * Sets mobile_phone_extension
     *
     * @param string $mobile_phone_extension
     *
     * @return $this
     */
    public function setMobilePhoneExtension( $mobile_phone_extension )
    {
        $this->input[ 'mobile_phone_extension' ] = $mobile_phone_extension;

        return $this;
    }

    /**
     * Gets e_mail
     * @return string
     */
    public function getEMail()
    {
        return $this->input[ 'e_mail' ];
    }

    /**
     * Sets e_mail
     *
     * @param string $e_mail
     *
     * @return $this
     */
    public function setEMail( $e_mail )
    {
        $this->input[ 'e_mail' ] = $e_mail;

        return $this;
    }

    /**
     * Gets website
     * @return string
     */
    public function getWebsite()
    {
        return $this->input[ 'website' ];
    }

    /**
     * Sets website
     *
     * @param string $website
     *
     * @return $this
     */
    public function setWebsite( $website )
    {
        $this->input[ 'website' ] = $website;

        return $this;
    }

    /**
     * Gets active
     * @return bool
     */
    public function getActive()
    {
        return $this->input[ 'active' ];
    }

    /**
     * Sets active
     *
     * @param bool $active
     *
     * @return $this
     */
    public function setActive( $active )
    {
        $this->input[ 'active' ] = $active;

        return $this;
    }

    /**
     * Gets include_in_mailings
     * @return bool
     */
    public function getIncludeInMailings()
    {
        return $this->input[ 'include_in_mailings' ];
    }

    /**
     * Sets include_in_mailings
     *
     * @param bool $include_in_mailings
     *
     * @return $this
     */
    public function setIncludeInMailings( $include_in_mailings )
    {
        $this->input[ 'include_in_mailings' ] = $include_in_mailings;

        return $this;
    }

    /**
     * Gets prospect
     * @return bool
     */
    public function getProspect()
    {
        return $this->input[ 'prospect' ];
    }

    /**
     * Sets prospect
     *
     * @param bool $prospect
     *
     * @return $this
     */
    public function setProspect( $prospect )
    {
        $this->input[ 'prospect' ] = $prospect;

        return $this;
    }

    /**
     * Gets entered_date
     * @return DateTime
     */
    public function getEnteredDate()
    {
        return $this->input[ 'entered_date' ];
    }

    /**
     * Sets entered_date
     *
     * @param DateTime $entered_date
     *
     * @return $this
     */
    public function setEnteredDate( $entered_date )
    {
        $this->input[ 'entered_date' ] = $entered_date;

        return $this;
    }

    /**
     * Gets contact_date
     * @return DateTime
     */
    public function getContactDate()
    {
        return $this->input[ 'contact_date' ];
    }

    /**
     * Sets contact_date
     *
     * @param DateTime $contact_date
     *
     * @return $this
     */
    public function setContactDate( $contact_date )
    {
        $this->input[ 'contact_date' ] = $contact_date;

        return $this;
    }

    /**
     * Gets contact_code
     * @return string
     */
    public function getContactCode()
    {
        return $this->input[ 'contact_code' ];
    }

    /**
     * Sets contact_code
     *
     * @param string $contact_code
     *
     * @return $this
     */
    public function setContactCode( $contact_code )
    {
        $this->input[ 'contact_code' ] = $contact_code;

        return $this;
    }

    /**
     * Gets county
     * @return string
     */
    public function getCounty()
    {
        return $this->input[ 'county' ];
    }

    /**
     * Sets county
     *
     * @param string $county
     *
     * @return $this
     */
    public function setCounty( $county )
    {
        $this->input[ 'county' ] = $county;

        return $this;
    }

    /**
     * Gets division
     * @return string
     */
    public function getDivision()
    {
        return $this->input[ 'division' ];
    }

    /**
     * Sets division
     *
     * @param string $division
     *
     * @return $this
     */
    public function setDivision( $division )
    {
        $this->input[ 'division' ] = $division;

        return $this;
    }

    /**
     * Gets source
     * @return string
     */
    public function getSource()
    {
        return $this->input[ 'source' ];
    }

    /**
     * Sets source
     *
     * @param string $source
     *
     * @return $this
     */
    public function setSource( $source )
    {
        $this->input[ 'source' ] = $source;

        return $this;
    }

    /**
     * Gets tax_code
     * @return string
     */
    public function getTaxCode()
    {
        return $this->input[ 'tax_code' ];
    }

    /**
     * Sets tax_code
     *
     * @param string $tax_code
     *
     * @return $this
     */
    public function setTaxCode( $tax_code )
    {
        $this->input[ 'tax_code' ] = $tax_code;

        return $this;
    }

    /**
     * Gets tax_rate
     * @return double
     */
    public function getTaxRate()
    {
        return $this->input[ 'tax_rate' ];
    }

    /**
     * Sets tax_rate
     *
     * @param double $tax_rate
     *
     * @return $this
     */
    public function setTaxRate( $tax_rate )
    {
        $this->input[ 'tax_rate' ] = $tax_rate;

        return $this;
    }

    /**
     * Gets type
     * @return string
     */
    public function getType()
    {
        return $this->input[ 'type' ];
    }

    /**
     * Sets type
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType( $type )
    {
        $this->input[ 'type' ] = $type;

        return $this;
    }

    /**
     * Gets account_type
     * @return string
     */
    public function getAccountType()
    {
        return $this->input[ 'account_type' ];
    }

    /**
     * Sets account_type
     *
     * @param string $account_type
     *
     * @return $this
     */
    public function setAccountType( $account_type )
    {
        $allowed_values = [ 'Residential', 'Commercial', 'Unknown' ];
        if( !in_array( $account_type, $allowed_values ) ) {
            throw new InvalidArgumentException( "Invalid value for 'account_type', must be one of 'Residential', 'Commercial', 'Unknown'" );
        }
        $this->input[ 'account_type' ] = $account_type;

        return $this;
    }

    /**
     * Gets map_code
     * @return string
     */
    public function getMapCode()
    {
        return $this->input[ 'map_code' ];
    }

    /**
     * Sets map_code
     *
     * @param string $map_code
     *
     * @return $this
     */
    public function setMapCode( $map_code )
    {
        $this->input[ 'map_code' ] = $map_code;

        return $this;
    }

    /**
     * Gets comment
     * @return string
     */
    public function getComment()
    {
        return $this->input[ 'comment' ];
    }

    /**
     * Sets comment
     *
     * @param string $comment
     *
     * @return $this
     */
    public function setComment( $comment )
    {
        $this->input[ 'comment' ] = $comment;

        return $this;
    }

    /**
     * Gets instructions
     * @return string
     */
    public function getInstructions()
    {
        return $this->input[ 'instructions' ];
    }

    /**
     * Sets instructions
     *
     * @param string $instructions
     *
     * @return $this
     */
    public function setInstructions( $instructions )
    {
        $this->input[ 'instructions' ] = $instructions;

        return $this;
    }

    /**
     * Gets latitude
     * @return double
     */
    public function getLatitude()
    {
        return $this->input[ 'latitude' ];
    }

    /**
     * Sets latitude
     *
     * @param double $latitude
     *
     * @return $this
     */
    public function setLatitude( $latitude )
    {
        $this->input[ 'latitude' ] = $latitude;

        return $this;
    }

    /**
     * Gets longitude
     * @return double
     */
    public function getLongitude()
    {
        return $this->input[ 'longitude' ];
    }

    /**
     * Sets longitude
     *
     * @param double $longitude
     *
     * @return $this
     */
    public function setLongitude( $longitude )
    {
        $this->input[ 'longitude' ] = $longitude;

        return $this;
    }

    /**
     * Gets gl_code
     * @return string
     */
    public function getGlCode()
    {
        return $this->input[ 'gl_code' ];
    }

    /**
     * Sets gl_code
     *
     * @param string $gl_code
     *
     * @return $this
     */
    public function setGlCode( $gl_code )
    {
        $this->input[ 'gl_code' ] = $gl_code;

        return $this;
    }

    /**
     * Gets do_not_geocode
     * @return bool
     */
    public function getDoNotGeocode()
    {
        return $this->input[ 'do_not_geocode' ];
    }

    /**
     * Sets do_not_geocode
     *
     * @param bool $do_not_geocode
     *
     * @return $this
     */
    public function setDoNotGeocode( $do_not_geocode )
    {
        $this->input[ 'do_not_geocode' ] = $do_not_geocode;

        return $this;
    }

    /**
     * Gets builder
     * @return string
     */
    public function getBuilder()
    {
        return $this->input[ 'builder' ];
    }

    /**
     * Sets builder
     *
     * @param string $builder
     *
     * @return $this
     */
    public function setBuilder( $builder )
    {
        $this->input[ 'builder' ] = $builder;

        return $this;
    }

    /**
     * Gets subdivision
     * @return string
     */
    public function getSubdivision()
    {
        return $this->input[ 'subdivision' ];
    }

    /**
     * Sets subdivision
     *
     * @param string $subdivision
     *
     * @return $this
     */
    public function setSubdivision( $subdivision )
    {
        $this->input[ 'subdivision' ] = $subdivision;

        return $this;
    }

    /**
     * Gets tax_exempt_number
     * @return string
     */
    public function getTaxExemptNumber()
    {
        return $this->input[ 'tax_exempt_number' ];
    }

    /**
     * Sets tax_exempt_number
     *
     * @param string $tax_exempt_number
     *
     * @return $this
     */
    public function setTaxExemptNumber( $tax_exempt_number )
    {
        $this->input[ 'tax_exempt_number' ] = $tax_exempt_number;

        return $this;
    }

    /**
     * Gets purchase_order_number
     * @return string
     */
    public function getPurchaseOrderNumber()
    {
        return $this->input[ 'purchase_order_number' ];
    }

    /**
     * Sets purchase_order_number
     *
     * @param string $purchase_order_number
     *
     * @return $this
     */
    public function setPurchaseOrderNumber( $purchase_order_number )
    {
        $this->input[ 'purchase_order_number' ] = $purchase_order_number;

        return $this;
    }

    /**
     * Gets purchase_order_expiration_date
     * @return DateTime
     */
    public function getPurchaseOrderExpirationDate()
    {
        return $this->input[ 'purchase_order_expiration_date' ];
    }

    /**
     * Sets purchase_order_expiration_date
     *
     * @param DateTime $purchase_order_expiration_date
     *
     * @return $this
     */
    public function setPurchaseOrderExpirationDate( $purchase_order_expiration_date )
    {
        $this->input[ 'purchase_order_expiration_date' ] = $purchase_order_expiration_date;

        return $this;
    }

    /**
     * Gets show_on_log_book
     * @return bool
     */
    public function getShowOnLogBook()
    {
        return $this->input[ 'show_on_log_book' ];
    }

    /**
     * Sets show_on_log_book
     *
     * @param bool $show_on_log_book
     *
     * @return $this
     */
    public function setShowOnLogBook( $show_on_log_book )
    {
        $this->input[ 'show_on_log_book' ] = $show_on_log_book;

        return $this;
    }

    /**
     * Gets internal_identifier
     * @return string
     */
    public function getInternalIdentifier()
    {
        return $this->input[ 'internal_identifier' ];
    }

    /**
     * Sets internal_identifier
     *
     * @param string $internal_identifier
     *
     * @return $this
     */
    public function setInternalIdentifier( $internal_identifier )
    {
        $this->input[ 'internal_identifier' ] = $internal_identifier;

        return $this;
    }

    /**
     * Gets user_defined_fields
     * @return UserDefinedField[]
     */
    public function getUserDefinedFields()
    {
        return $this->input[ 'user_defined_fields' ];
    }

    /**
     * Sets user_defined_fields
     *
     * @param UserDefinedField[] $user_defined_fields
     *
     * @return $this
     */
    public function setUserDefinedFields( $user_defined_fields )
    {
        $this->input[ 'user_defined_fields' ] = $user_defined_fields;

        return $this;
    }

    /**
     * Gets automated_emails
     * @return map[string,bool]
     */
    public function getAutomatedEmails()
    {
        return $this->input[ 'automated_emails' ];
    }

    /**
     * Sets automated_emails
     *
     * @param map[string,bool] $automated_emails
     *
     * @return $this
     */
    public function setAutomatedEmails( $automated_emails )
    {
        $this->input[ 'automated_emails' ] = $automated_emails;

        return $this;
    }
}