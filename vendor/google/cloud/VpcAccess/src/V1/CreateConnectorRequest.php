<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/vpcaccess/v1/vpc_access.proto

namespace Google\Cloud\VpcAccess\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request for creating a Serverless VPC Access connector.
 *
 * Generated from protobuf message <code>google.cloud.vpcaccess.v1.CreateConnectorRequest</code>
 */
class CreateConnectorRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The project and location in which the configuration should be created,
     * specified in the format `projects/&#42;&#47;locations/&#42;`.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    private $parent = '';
    /**
     * Required. The ID to use for this connector.
     *
     * Generated from protobuf field <code>string connector_id = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $connector_id = '';
    /**
     * Required. Resource to create.
     *
     * Generated from protobuf field <code>.google.cloud.vpcaccess.v1.Connector connector = 3 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $connector = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $parent
     *           Required. The project and location in which the configuration should be created,
     *           specified in the format `projects/&#42;&#47;locations/&#42;`.
     *     @type string $connector_id
     *           Required. The ID to use for this connector.
     *     @type \Google\Cloud\VpcAccess\V1\Connector $connector
     *           Required. Resource to create.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Vpcaccess\V1\VpcAccess::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The project and location in which the configuration should be created,
     * specified in the format `projects/&#42;&#47;locations/&#42;`.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Required. The project and location in which the configuration should be created,
     * specified in the format `projects/&#42;&#47;locations/&#42;`.
     *
     * Generated from protobuf field <code>string parent = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setParent($var)
    {
        GPBUtil::checkString($var, True);
        $this->parent = $var;

        return $this;
    }

    /**
     * Required. The ID to use for this connector.
     *
     * Generated from protobuf field <code>string connector_id = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getConnectorId()
    {
        return $this->connector_id;
    }

    /**
     * Required. The ID to use for this connector.
     *
     * Generated from protobuf field <code>string connector_id = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setConnectorId($var)
    {
        GPBUtil::checkString($var, True);
        $this->connector_id = $var;

        return $this;
    }

    /**
     * Required. Resource to create.
     *
     * Generated from protobuf field <code>.google.cloud.vpcaccess.v1.Connector connector = 3 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\VpcAccess\V1\Connector|null
     */
    public function getConnector()
    {
        return isset($this->connector) ? $this->connector : null;
    }

    public function hasConnector()
    {
        return isset($this->connector);
    }

    public function clearConnector()
    {
        unset($this->connector);
    }

    /**
     * Required. Resource to create.
     *
     * Generated from protobuf field <code>.google.cloud.vpcaccess.v1.Connector connector = 3 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\VpcAccess\V1\Connector $var
     * @return $this
     */
    public function setConnector($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\VpcAccess\V1\Connector::class);
        $this->connector = $var;

        return $this;
    }

}

