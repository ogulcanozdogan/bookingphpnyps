<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Content
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Content\V1\Content;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Version;


class ApprovalCreateList extends ListResource
    {
    /**
     * Construct the ApprovalCreateList
     *
     * @param Version $version Version that contains the resource
     * @param string $contentSid 
     */
    public function __construct(
        Version $version,
        string $contentSid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'contentSid' =>
            $contentSid,
        
        ];

        $this->uri = '/Content/' . \rawurlencode($contentSid)
        .'/ApprovalRequests/whatsapp';
    }

    /**
     * Create the ApprovalCreateInstance
     *
     * @param ContentApprovalRequest $contentApprovalRequest
     * @return ApprovalCreateInstance Created ApprovalCreateInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(ContentApprovalRequest $contentApprovalRequest): ApprovalCreateInstance
    {

        $data = $contentApprovalRequest->toArray();
        $headers['Content-Type'] = 'application/json';
        $payload = $this->version->create('POST', $this->uri, [], $data, $headers);

        return new ApprovalCreateInstance(
            $this->version,
            $payload,
            $this->solution['contentSid']
        );
    }


    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.Content.V1.ApprovalCreateList]';
    }
}
