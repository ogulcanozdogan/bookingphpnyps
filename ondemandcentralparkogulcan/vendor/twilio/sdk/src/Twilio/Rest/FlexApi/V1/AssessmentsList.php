<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Flex
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\FlexApi\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Stream;
use Twilio\Values;
use Twilio\Version;


class AssessmentsList extends ListResource
    {
    /**
     * Construct the AssessmentsList
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(
        Version $version
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        ];

        $this->uri = '/Insights/QualityManagement/Assessments';
    }

    /**
     * Create the AssessmentsInstance
     *
     * @param string $categorySid The SID of the category
     * @param string $categoryName The name of the category
     * @param string $segmentId Segment Id of the conversation
     * @param string $agentId The id of the Agent
     * @param string $offset The offset of the conversation.
     * @param string $metricId The question SID selected for assessment
     * @param string $metricName The question name of the assessment
     * @param string $answerText The answer text selected by user
     * @param string $answerId The id of the answer selected by user
     * @param string $questionnaireSid Questionnaire SID of the associated question
     * @param array|Options $options Optional Arguments
     * @return AssessmentsInstance Created AssessmentsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $categorySid, string $categoryName, string $segmentId, string $agentId, string $offset, string $metricId, string $metricName, string $answerText, string $answerId, string $questionnaireSid, array $options = []): AssessmentsInstance
    {

        $options = new Values($options);

        $data = Values::of([
            'CategorySid' =>
                $categorySid,
            'CategoryName' =>
                $categoryName,
            'SegmentId' =>
                $segmentId,
            'AgentId' =>
                $agentId,
            'Offset' =>
                $offset,
            'MetricId' =>
                $metricId,
            'MetricName' =>
                $metricName,
            'AnswerText' =>
                $answerText,
            'AnswerId' =>
                $answerId,
            'QuestionnaireSid' =>
                $questionnaireSid,
        ]);

        $headers = Values::of(['Authorization' => $options['authorization']]);

        $payload = $this->version->create('POST', $this->uri, [], $data, $headers);

        return new AssessmentsInstance(
            $this->version,
            $payload
        );
    }


    /**
     * Reads AssessmentsInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return AssessmentsInstance[] Array of results
     */
    public function read(array $options = [], int $limit = null, $pageSize = null): array
    {
        return \iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Streams AssessmentsInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, stream()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return Stream stream of results
     */
    public function stream(array $options = [], int $limit = null, $pageSize = null): Stream
    {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($options, $limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Retrieve a single page of AssessmentsInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return AssessmentsPage Page of AssessmentsInstance
     */
    public function page(
        array $options = [],
        $pageSize = Values::NONE,
        string $pageToken = Values::NONE,
        $pageNumber = Values::NONE
    ): AssessmentsPage
    {
        $options = new Values($options);

        $params = Values::of([
            'SegmentId' =>
                $options['segmentId'],
            'Authorization' =>
                $options['authorization'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ]);

        $response = $this->version->page('GET', $this->uri, $params);

        return new AssessmentsPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of AssessmentsInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return AssessmentsPage Page of AssessmentsInstance
     */
    public function getPage(string $targetUrl): AssessmentsPage
    {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new AssessmentsPage($this->version, $response, $this->solution);
    }


    /**
     * Constructs a AssessmentsContext
     *
     * @param string $assessmentSid The SID of the assessment to be modified
     */
    public function getContext(
        string $assessmentSid
        
    ): AssessmentsContext
    {
        return new AssessmentsContext(
            $this->version,
            $assessmentSid
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.FlexApi.V1.AssessmentsList]';
    }
}
