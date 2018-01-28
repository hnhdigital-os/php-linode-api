<?php

namespace HnhDigital\LinodeApi\Foundation;

/*
 * This file is part of the PHP Linode API.
 *
 * (c) H&H|Digital <hello@hnh.digital>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use GuzzleHttp\Client as Guzzle;

/**
 * This is the API Search class.
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class ApiSearch implements \Iterator, \Countable
{
    use ApiRequestTrait;

    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * Is factory.
     *
     * @var bool
     */
    protected $is_factory = false;

    /**
     * Factory class.
     *
     * @var array
     */
    protected $factory_class;

    /**
     * Factory class parameters.
     *
     * @var array
     */
    protected $factory_parameters;

    /**
     * Total number of requests made.
     *
     * @var integer
     */
    private $request_count = 0;

    /**
     * Results by page.
     *
     * @var array
     */
    private $page_results = [];

    /**
     * Total pages in result.
     *
     * @var integer
     */
    private $result_total_pages = 0;

    /**
     * Total books in result.
     *
     * @var integer
     */
    private $result_total_count = 0;

    /**
     * Total records per page.
     *
     * @var integer
     */
    private $result_records_per_page = 10;

    /**
     * Current page.
     *
     * @var integer
     */
    private $current_page = 1;

    /**
     * Current record.
     *
     * @var integer
     */
    private $current_record = 1;

    /**
     * Current result.
     *
     * @var integer
     */
    private $current_result = [];

    /**
     * API call had an error.
     *
     * @var integer
     */
    private $had_error = false;

    /**
     * Start a search.
     */
    public function __construct($endpoint, $factory_settings = [])
    {
        $this->endpoint = $endpoint;

        if (isset($factory_settings['class'])) {
            $this->is_factory = true;
            $this->factory_class_name = 'HnhDigital\\LinodeApi\\'.$factory_settings['class'];
            $this->factory_class_parameters = $factory_settings['parameters'];
        }
    }

    /**
     * Start a search.
     *
     * @return $this
     */
    private function get()
    {        
        // Return cached results for this page.
        if (isset($this->page_results[$this->current_page])) {
            $this->current_result = $this->page_results[$this->current_page];
            return $this;
        }

        $current_result = $this->apiCall('get', '?page='.$this->current_page);

        $this->result_total_count = intval($current_result['results']);
        $this->result_total_pages = intval($current_result['pages']);

        foreach ($current_result['data'] as $entry) {

            // Is factory.
            if ($this->is_factory) {
                $parameters = [];
                foreach ($this->factory_class_parameters as $key) {
                    $parameters[] = $entry[$key];
                }
                $class_name = $this->factory_class_name;
                $parameters[] = $entry;
                $entry = new $class_name(...$parameters);
            }

            $this->current_result[] = $entry;
        }

        $this->page_results[$this->current_page] = $this->current_result;
        $this->request_count++;

        return $this;
    }

    /**
     * Get the first result.
     *
     * @return array|null
     */
    public function first()
    {
        $this->limit(1);

        $this->rewind();

        if (count($this->current_result)) {
            return $this->current_result[0];
        }

        return null;
    }

    /**
     * Get all the result.
     *
     * @return array|null
     */
    public function all()
    {
        $this->rewind();

        $result = [];

        foreach ($this as $record) {
            $result[] = $record;
        }

        return $result;
    }

    /**
     * Most recent query failed.
     *
     * @return boolean
     */
    public function error()
    {
        return $this->had_error;
    }

    /**
     * Rewind the result.
     *
     * @return array
     */
    public function rewind()
    {
        $this->current_page = 1;
        $this->current_record = 0;
        $this->get();

        return $this->current();
    }

    /**
     * Get the current result.
     *
     * @return array|null
     */
    public function current()
    {
        if ($this->request_count == 0) {
            $this->get();
        }

        if (isset($this->current_result[$this->current_record])) {
            return $this->current_result[$this->current_record];
        }

        return null;
    }

    /**
     * Get the row key.
     *
     * @return integer
     */
    public function key() 
    {
        return (($this->current_page - 1) * $this->result_records_per_page) + $this->current_record;
    }

    /**
     * Rewind the result.
     *
     * @return array
     */
    public function next()
    {
        $this->current_record++;

        if ($this->current_record >= $this->result_records_per_page) {
            $this->current_page++;
            $this->current_record = 0;
            $this->get();
        }

        return $this->current();
    }

    /**
     * Return the count of results.
     *
     * @return integer
     */
    public function count()
    {
        if ($this->request_count == 0) {
            $this->rewind();
        }

        return $this->result_total_count;
    }

    /**
     * Return the total pages.
     *
     * @return integer
     */
    public function totalPages()
    {
        if ($this->request_count == 0) {
            $this->rewind();
        }

        return $this->result_total_pages;
    }

    /**
     * Has results.
     *
     * @return boolean
     */
    public function valid()
    {
        if ($this->request_count == 0) {
            return true;
        }

        return !$this->error()
            && ((($this->current_page - 1) * $this->result_records_per_page) + $this->current_record) < $this->result_total_count;
    }

}
