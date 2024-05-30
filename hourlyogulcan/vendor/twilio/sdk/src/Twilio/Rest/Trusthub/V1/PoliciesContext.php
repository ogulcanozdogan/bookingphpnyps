<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Trusthub
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Trusthub\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\Version;
use Twilio\InstanceContext;


class PoliciesContext extends InstanceContext
    {
    /**
     * Initialize the PoliciesContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid The unique string that identifies the Policy resource.
     */
    public function __construct(
        Version $version,
        $sid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'sid' =>
            $sid,
        ];

        $this->uri = '/Policies/' . \rawurlencode($sid)
        .'';
    }

    /**
     * Fetch the PoliciesInstance
     *
     * @return PoliciesInstance Fetched PoliciesInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): PoliciesInstance
    {

        $payload = $this->version->fetch('GET', $this->uri, [], []);

        return new PoliciesInstance(
            $this->version,
            $payload,
            $this->solution['sid']
        );
    }


    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Trusthub.V1.PoliciesContext ' . \implode(' ', $context) . ']';
    }
}
