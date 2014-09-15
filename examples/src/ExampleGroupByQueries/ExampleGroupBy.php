<?php

namespace DruidFamiliar\ExampleGroupByQueries;

use DruidFamiliar\BasicDruidQuery;
use DruidFamiliar\Exception;

class ExampleGroupBy extends BasicDruidQuery
{

    /**
     * As opposed to building the query body in PHP associative arrays, one could also template them.
     *
     * @var string
     */
    private $queryTemplate = <<<QUERYTEMPLATE
{
    "queryType": "groupBy",
    "dataSource": "{DATASOURCE}",
    "granularity": { "type": "period", "period": "P3M"},
    "dimensions": ["referral_id", "company_id", "patient_id", "facility_id"],
    "aggregations": [
        {"type": "count", "name": "total_entries"},
        {"type": "longSum", "name": "total_referral_countb", "fieldName": "total_referral_count"}
    ],
    "intervals": ["{STARTINTERVAL}/{ENDINTERVAL}"]
}
QUERYTEMPLATE;


    /**
     * Take parameters and return a valid Druid Query.
     *
     * @param array $params
     * @return array Druid JSON POST Body in PHP Array form
     * @throws Exception\MissingParametersException
     */
    public function generateQuery()
    {

        $query = $this->queryTemplate;

        $query = str_replace('{DATASOURCE}',    'referral-visit-old-format',$query);
        $query = str_replace('{STARTINTERVAL}', '2006-01-01T00:00',         $query);
        $query = str_replace('{ENDINTERVAL}',   '2015-06-01T00:00',         $query);

        $query = json_decode( $query );

        return $query;

    }

    /**
     * @param array $params
     * @return mixed|void
     * @throws Exception\MissingParametersException
     */
    public function validateParams(Array $params)
    {
        // TODO: Implement validateParams() method.

        return $params;
    }

    /**
     * Hook function to handle response from server.
     *
     * This hook must return the response, whether changed or not, so that the rest of the system can continue with it.
     *
     * @param array $response
     * @return mixed
     */
    public function handleResponse($response = Array())
    {
        // TODO: Implement handleResponse() method.

        return $response;
    }
}