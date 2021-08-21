<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/monitoring/v3/service.proto

namespace Google\Cloud\Monitoring\V3\BasicSli;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Parameters for a latency threshold SLI.
 *
 * Generated from protobuf message <code>google.monitoring.v3.BasicSli.LatencyCriteria</code>
 */
class LatencyCriteria extends \Google\Protobuf\Internal\Message
{
    /**
     * Good service is defined to be the count of requests made to this service
     * that return in no more than `threshold`.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration threshold = 3;</code>
     */
    private $threshold = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Protobuf\Duration $threshold
     *           Good service is defined to be the count of requests made to this service
     *           that return in no more than `threshold`.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Monitoring\V3\Service::initOnce();
        parent::__construct($data);
    }

    /**
     * Good service is defined to be the count of requests made to this service
     * that return in no more than `threshold`.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration threshold = 3;</code>
     * @return \Google\Protobuf\Duration
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * Good service is defined to be the count of requests made to this service
     * that return in no more than `threshold`.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration threshold = 3;</code>
     * @param \Google\Protobuf\Duration $var
     * @return $this
     */
    public function setThreshold($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Duration::class);
        $this->threshold = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(LatencyCriteria::class, \Google\Cloud\Monitoring\V3\BasicSli_LatencyCriteria::class);

