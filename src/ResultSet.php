<?php

namespace YiiElasticSearch;

/**
 * Represents the response of a query from elastic search
 *
 * @author Charles Pick <charles.pick@gmail.com>
 * @licence MIT
 * @package YiiElasticSearch
 */
class ResultSet
{
    /**
     * @var array the raw response from elastic search
     */
    protected $_raw;

    /**
     * @var Search the search that was used in the query
     */
    protected $_search;

    /**
     * Initialize the result set
     * @param Search $search parameters
     * @param array $raw
     */
    public function __construct(Search $search, array $raw)
    {
        $this->_search = $search;
        $this->_raw = $raw;
    }

    /**
     * @return array the facets
     */
    public function getFacets()
    {
        return $this->_raw['facets'];
    }


    /**
     * @return SearchResult[] the search results
     */
    public function getResults()
    {
        $hits = array();
        foreach($this->_raw['hits']['hits'] as $hit) {
            $hits[] = new SearchResult($this, $hit);
        }
        return $hits;
    }

    /**
     * @return int the number of returned results
     */
    public function countResults()
    {
        return count($this->_raw['hits']['hits']);
    }

    /**
     * @return int the total number of results
     */
    public function getTotal()
    {
        return $this->_raw['hits']['total'];
    }

    public function getRaw()
    {
        return $this->_raw;
    }
}
