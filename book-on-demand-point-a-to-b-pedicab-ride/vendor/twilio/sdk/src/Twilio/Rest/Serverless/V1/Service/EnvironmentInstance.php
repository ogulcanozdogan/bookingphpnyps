<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Serverless
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Serverless\V1\Service;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;
use Twilio\Rest\Serverless\V1\Service\Environment\LogList;
use Twilio\Rest\Serverless\V1\Service\Environment\DeploymentList;
use Twilio\Rest\Serverless\V1\Service\Environment\VariableList;


/**
 * @property string|null $sid
 * @property string|null $accountSid
 * @property string|null $serviceSid
 * @property string|null $buildSid
 * @property string|null $uniqueName
 * @property string|null $domainSuffix
 * @property string|null $domainName
 * @property \DateTime|null $dateCreated
 * @property \DateTime|null $dateUpdated
 * @property string|null $url
 * @property array|null $links
 */
class EnvironmentInstance extends InstanceResource
{
    protected $_logs;
    protected $_deployments;
    protected $_variables;

    /**
     * Initialize the EnvironmentInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid The SID of the Service to create the Environment resource under.
     * @param string $sid The SID of the Environment resource to delete.
     */
    public function __construct(Version $version, array $payload, string $serviceSid, string $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'buildSid' => Values::array_get($payload, 'build_sid'),
            'uniqueName' => Values::array_get($payload, 'unique_name'),
            'domainSuffix' => Values::array_get($payload, 'domain_suffix'),
            'domainName' => Values::array_get($payload, 'domain_name'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'url' => Values::array_get($payload, 'url'),
            'links' => Values::array_get($payload, 'links'),
        ];

        $this->solution = ['serviceSid' => $serviceSid, 'sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return EnvironmentContext Context for this EnvironmentInstance
     */
    protected function proxy(): EnvironmentContext
    {
        if (!$this->context) {
            $this->context = new EnvironmentContext(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Delete the EnvironmentInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        return $this->proxy()->delete();
    }

    /**
     * Fetch the EnvironmentInstance
     *
     * @return EnvironmentInstance Fetched EnvironmentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): EnvironmentInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Access the logs
     */
    protected function getLogs(): LogList
    {
        return $this->proxy()->logs;
    }

    /**
     * Access the deployments
     */
    protected function getDeployments(): DeploymentList
    {
        return $this->proxy()->deployments;
    }

    /**
     * Access the variables
     */
    protected function getVariables(): VariableList
    {
        return $this->proxy()->variables;
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
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
        return '[Twilio.Serverless.V1.EnvironmentInstance ' . \implode(' ', $context) . ']';
    }
}
