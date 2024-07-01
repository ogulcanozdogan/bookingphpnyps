<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Conversations
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Conversations\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Version;
use Twilio\InstanceContext;
use Twilio\Rest\Conversations\V1\Service\UserList;
use Twilio\Rest\Conversations\V1\Service\BindingList;
use Twilio\Rest\Conversations\V1\Service\ParticipantConversationList;
use Twilio\Rest\Conversations\V1\Service\ConversationList;
use Twilio\Rest\Conversations\V1\Service\RoleList;
use Twilio\Rest\Conversations\V1\Service\ConfigurationList;


/**
 * @property UserList $users
 * @property BindingList $bindings
 * @property ParticipantConversationList $participantConversations
 * @property ConversationList $conversations
 * @property RoleList $roles
 * @property ConfigurationList $configuration
 * @method \Twilio\Rest\Conversations\V1\Service\UserContext users(string $sid)
 * @method \Twilio\Rest\Conversations\V1\Service\RoleContext roles(string $sid)
 * @method \Twilio\Rest\Conversations\V1\Service\ConfigurationContext configuration()
 * @method \Twilio\Rest\Conversations\V1\Service\BindingContext bindings(string $sid)
 * @method \Twilio\Rest\Conversations\V1\Service\ConversationContext conversations(string $sid)
 */
class ServiceContext extends InstanceContext
    {
    protected $_users;
    protected $_bindings;
    protected $_participantConversations;
    protected $_conversations;
    protected $_roles;
    protected $_configuration;

    /**
     * Initialize the ServiceContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid A 34 character string that uniquely identifies this resource.
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

        $this->uri = '/Services/' . \rawurlencode($sid)
        .'';
    }

    /**
     * Delete the ServiceInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        return $this->version->delete('DELETE', $this->uri);
    }


    /**
     * Fetch the ServiceInstance
     *
     * @return ServiceInstance Fetched ServiceInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): ServiceInstance
    {

        $payload = $this->version->fetch('GET', $this->uri, [], []);

        return new ServiceInstance(
            $this->version,
            $payload,
            $this->solution['sid']
        );
    }


    /**
     * Access the users
     */
    protected function getUsers(): UserList
    {
        if (!$this->_users) {
            $this->_users = new UserList(
                $this->version,
                $this->solution['sid']
            );
        }

        return $this->_users;
    }

    /**
     * Access the bindings
     */
    protected function getBindings(): BindingList
    {
        if (!$this->_bindings) {
            $this->_bindings = new BindingList(
                $this->version,
                $this->solution['sid']
            );
        }

        return $this->_bindings;
    }

    /**
     * Access the participantConversations
     */
    protected function getParticipantConversations(): ParticipantConversationList
    {
        if (!$this->_participantConversations) {
            $this->_participantConversations = new ParticipantConversationList(
                $this->version,
                $this->solution['sid']
            );
        }

        return $this->_participantConversations;
    }

    /**
     * Access the conversations
     */
    protected function getConversations(): ConversationList
    {
        if (!$this->_conversations) {
            $this->_conversations = new ConversationList(
                $this->version,
                $this->solution['sid']
            );
        }

        return $this->_conversations;
    }

    /**
     * Access the roles
     */
    protected function getRoles(): RoleList
    {
        if (!$this->_roles) {
            $this->_roles = new RoleList(
                $this->version,
                $this->solution['sid']
            );
        }

        return $this->_roles;
    }

    /**
     * Access the configuration
     */
    protected function getConfiguration(): ConfigurationList
    {
        if (!$this->_configuration) {
            $this->_configuration = new ConfigurationList(
                $this->version,
                $this->solution['sid']
            );
        }

        return $this->_configuration;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get(string $name): ListResource
    {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments): InstanceContext
    {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
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
        return '[Twilio.Conversations.V1.ServiceContext ' . \implode(' ', $context) . ']';
    }
}