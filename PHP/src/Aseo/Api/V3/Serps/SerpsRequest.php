<?php
namespace Aseo\Api\V3\Serps;

/**
* Search Engine Results Page Request.
*
* This class emulates the api request you can make, it will try to validate as much of the data as possible
* before the request is sent to the api
*
* @version 3
*
* @author Nuno Franco da Costa <nuno@francodacosta.com>
* @copyright 2014 Analytics SEO ltd
* @license http://www.opensource.org/licenses/mit-license.php MIT
* @link https://github.com/analyticsseo/api-client/
*/

class SerpsRequest
{
    /**
     * Internal search engine name
     * @var string
     */
    private $search_engine;

    /**
     * Region code
     * @var string
     */
    private $region;

    /**
     * town name
     * @var string
     */
    private $town;

    /**
     * The search type
     * @var string
     */
    private $search_type ;

    /**
     * Language code
     * @var string
     */
    private $language;

    /**
     * Maximun number of results to return
     * @var integer
     */
    private $max_results;

    /**
     * The phrase to search for.
     * @var string
     */
    private $phrase;

    /**
     * return universal search results
     * @var boolean
     */
    private $universal;

    /**
     * Set to use a specific strategy
     * @var string
     */
    private $strategy;

    /**
     * strategy configuration
     * @var object
     */
    private $parameters;

    /**
     * list of supported search engines
     *
     * @var string[]
     */
    private $supportedSearchEngines = array('bing', 'google', 'yahoo', 'yandex');

    public function __construct(array $data)
    {
        $this->populate($data);
    }

    /**
     * Populates this class with the values provided in the associative array.
     * the key must match one of the class properties
     *
     * @param  string[]  $data
     *
     * @return void
     */
    public function populate(array $data)
    {
        foreach ($data as $key => $value) {
            $this->populateField($key, $value);
        }
    }

    /**
     * Populates a class propertie.
     * This is done by calling the appropriate class setter
     *
     * @param string $field
     * @param mixed $value
     *
     * @return void
     */
    public function populateField($field, $value)
    {

        if ("search_engine" == $field) {
            return $this->setSearchEngine($value);
        }

        if ("region" == $field) {
            return $this->setRegion($value);
        }

        if ("town" == $field) {
            return $this->setTown($value);
        }

        if ("search_type " == $field) {
            return $this->setSearchType($value);
        }

        if ("language" == $field) {
            return $this->setLanguage($value);
        }

        if ("max_results" == $field) {
            return $this->setMaxResults($value);
        }

        if ("phrase" == $field) {
            return $this->setPhrase($value);
        }

        if ("universal" == $field) {
            return $this->setUniversal($value);
        }

        if ("strategy" == $field) {
            return $this->setStrategy($value);
        }

        if ("parameters" == $field) {
            return $this->setParameters($value);
        }

        throw new \OutOfBoundsException('SERPS call does not support the parameter ' . $field);

    }

    public function __toString()
    {
        $json = array();

        foreach (get_object_vars($this) as $variable => $value) {
            // supportedSearchEngines is internal, should not be present in the request
            if ("supportedSearchEngines" == $variable) {
                continue;
            }

            if (null != $value) {
                $json[$variable] = $value;
            }
        }
        return json_encode($json);
    }

    /**
     * Set the value of Internal search engine name
     *
     * @param string search_engine
     *
     * @return self
     */
    public function setSearchEngine($search_engine)
    {

        if (false === in_array($search_engine, $this->getSupportedSearchEngines())) {
            throw new \InvalidArgumentException('Search Engine is not supported');
        }

        $this->search_engine = $search_engine;

        return $this;
    }

    /**
     * Set the value of Region code
     *
     * @param string region
     *
     * @return self
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Set the value of town name
     *
     * @param string town
     *
     * @return self
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Set the value of The search type
     *
     * @param string search_type
     *
     * @return self
     */
    public function setSearchType($search_type)
    {
        $this->search_type = $search_type;

        return $this;
    }

    /**
     * Set the value of Language code
     *
     * @param string language
     *
     * @return self
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Set the value of Maximun number of results to return
     *
     * @param integer max_results
     *
     * @return self
     */
    public function setMaxResults($max_results)
    {
        $this->max_results = $max_results;

        return $this;
    }

    /**
     * Set the value of The phrase to search for.
     *
     * @param string phrase
     *
     * @return self
     */
    public function setPhrase($phrase)
    {
        $this->phrase = $phrase;

        return $this;
    }

    /**
     * Set the value of return universal search results
     *
     * @param boolean universal
     *
     * @return self
     */
    public function setUniversal($universal)
    {
        $this->universal = $universal;

        return $this;
    }

    /**
     * Set the value of Set to use a specific strategy
     *
     * @param string strategy
     *
     * @return self
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * Set the value of strategy configuration
     *
     * @param string[] parameters an associative array with the parameters for the specific strategy
     *
     * @return self
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Get the value of list of supported search engines
     *
     * @return string[]
     */
    public function getSupportedSearchEngines()
    {
        return $this->supportedSearchEngines;
    }

    /**
     * Set the value of list of supported search engines
     *
     * @param string[] supportedSearchEngines
     *
     * @return self
     */
    public function setSupportedSearchEngines(array $supportedSearchEngines)
    {
        $this->supportedSearchEngines = $supportedSearchEngines;

        return $this;
    }
}
