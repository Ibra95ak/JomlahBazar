<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/accessapproval/v1/accessapproval.proto

namespace Google\Cloud\AccessApproval\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Represents the enrollment of a cloud resource into a specific service.
 *
 * Generated from protobuf message <code>google.cloud.accessapproval.v1.EnrolledService</code>
 */
class EnrolledService extends \Google\Protobuf\Internal\Message
{
    /**
     * The product for which Access Approval will be enrolled. Allowed values are
     * listed below (case-sensitive):
     * - all
     * - appengine.googleapis.com
     * - bigquery.googleapis.com
     * - bigtable.googleapis.com
     * - cloudkms.googleapis.com
     * - compute.googleapis.com
     * - dataflow.googleapis.com
     * - iam.googleapis.com
     * - pubsub.googleapis.com
     * - storage.googleapis.com
     *
     * Generated from protobuf field <code>string cloud_product = 1;</code>
     */
    private $cloud_product = '';
    /**
     * The enrollment level of the service.
     *
     * Generated from protobuf field <code>.google.cloud.accessapproval.v1.EnrollmentLevel enrollment_level = 2;</code>
     */
    private $enrollment_level = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $cloud_product
     *           The product for which Access Approval will be enrolled. Allowed values are
     *           listed below (case-sensitive):
     *           - all
     *           - appengine.googleapis.com
     *           - bigquery.googleapis.com
     *           - bigtable.googleapis.com
     *           - cloudkms.googleapis.com
     *           - compute.googleapis.com
     *           - dataflow.googleapis.com
     *           - iam.googleapis.com
     *           - pubsub.googleapis.com
     *           - storage.googleapis.com
     *     @type int $enrollment_level
     *           The enrollment level of the service.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Accessapproval\V1\Accessapproval::initOnce();
        parent::__construct($data);
    }

    /**
     * The product for which Access Approval will be enrolled. Allowed values are
     * listed below (case-sensitive):
     * - all
     * - appengine.googleapis.com
     * - bigquery.googleapis.com
     * - bigtable.googleapis.com
     * - cloudkms.googleapis.com
     * - compute.googleapis.com
     * - dataflow.googleapis.com
     * - iam.googleapis.com
     * - pubsub.googleapis.com
     * - storage.googleapis.com
     *
     * Generated from protobuf field <code>string cloud_product = 1;</code>
     * @return string
     */
    public function getCloudProduct()
    {
        return $this->cloud_product;
    }

    /**
     * The product for which Access Approval will be enrolled. Allowed values are
     * listed below (case-sensitive):
     * - all
     * - appengine.googleapis.com
     * - bigquery.googleapis.com
     * - bigtable.googleapis.com
     * - cloudkms.googleapis.com
     * - compute.googleapis.com
     * - dataflow.googleapis.com
     * - iam.googleapis.com
     * - pubsub.googleapis.com
     * - storage.googleapis.com
     *
     * Generated from protobuf field <code>string cloud_product = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setCloudProduct($var)
    {
        GPBUtil::checkString($var, True);
        $this->cloud_product = $var;

        return $this;
    }

    /**
     * The enrollment level of the service.
     *
     * Generated from protobuf field <code>.google.cloud.accessapproval.v1.EnrollmentLevel enrollment_level = 2;</code>
     * @return int
     */
    public function getEnrollmentLevel()
    {
        return $this->enrollment_level;
    }

    /**
     * The enrollment level of the service.
     *
     * Generated from protobuf field <code>.google.cloud.accessapproval.v1.EnrollmentLevel enrollment_level = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setEnrollmentLevel($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\AccessApproval\V1\EnrollmentLevel::class);
        $this->enrollment_level = $var;

        return $this;
    }

}
