<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Numbers
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Numbers\V2;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Version;


class BulkHostedNumberOrderList extends ListResource
    {
    /**
     * Construct the BulkHostedNumberOrderList
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

        $this->uri = '/HostedNumber/Orders/Bulk';
    }

    /**
     * Create the BulkHostedNumberOrderInstance
     *
     * @return BulkHostedNumberOrderInstance Created BulkHostedNumberOrderInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(): BulkHostedNumberOrderInstance
    {

        $data = $body->toArray();
        $headers['Content-Type'] = 'application/json';
        $payload = $this->version->create('POST', $this->uri, [], $data, $headers);

        return new BulkHostedNumberOrderInstance(
            $this->version,
            $payload
        );
    }


    /**
     * Constructs a BulkHostedNumberOrderContext
     *
     * @param string $bulkHostingSid A 34 character string that uniquely identifies this BulkHostedNumberOrder.
     */
    public function getContext(
        string $bulkHostingSid
        
    ): BulkHostedNumberOrderContext
    {
        return new BulkHostedNumberOrderContext(
            $this->version,
            $bulkHostingSid
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.Numbers.V2.BulkHostedNumberOrderList]';
    }
}