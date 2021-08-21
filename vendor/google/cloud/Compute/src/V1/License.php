<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/compute/v1/compute.proto

namespace Google\Cloud\Compute\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Represents a License resource.
 * A License represents billing and aggregate usage data for public and marketplace images.  Caution This resource is intended for use only by third-party partners who are creating Cloud Marketplace images. (== resource_for {$api_version}.licenses ==)
 *
 * Generated from protobuf message <code>google.cloud.compute.v1.License</code>
 */
class License extends \Google\Protobuf\Internal\Message
{
    /**
     * [Output Only] Deprecated. This field no longer reflects whether a license charges a usage fee.
     *
     * Generated from protobuf field <code>bool charges_use_fee = 372412622;</code>
     */
    private $charges_use_fee = null;
    /**
     * [Output Only] Creation timestamp in RFC3339 text format.
     *
     * Generated from protobuf field <code>string creation_timestamp = 30525366;</code>
     */
    private $creation_timestamp = null;
    /**
     * An optional textual description of the resource; provided by the client when the resource is created.
     *
     * Generated from protobuf field <code>string description = 422937596;</code>
     */
    private $description = null;
    /**
     * [Output Only] The unique identifier for the resource. This identifier is defined by the server.
     *
     * Generated from protobuf field <code>string id = 3355;</code>
     */
    private $id = null;
    /**
     * [Output Only] Type of resource. Always compute#license for licenses.
     *
     * Generated from protobuf field <code>string kind = 3292052;</code>
     */
    private $kind = null;
    /**
     * [Output Only] The unique code used to attach this license to images, snapshots, and disks.
     *
     * Generated from protobuf field <code>string license_code = 1467179;</code>
     */
    private $license_code = null;
    /**
     * Name of the resource. The name must be 1-63 characters long and comply with RFC1035.
     *
     * Generated from protobuf field <code>string name = 3373707;</code>
     */
    private $name = null;
    /**
     * Generated from protobuf field <code>.google.cloud.compute.v1.LicenseResourceRequirements resource_requirements = 214292769;</code>
     */
    private $resource_requirements = null;
    /**
     * [Output Only] Server-defined URL for the resource.
     *
     * Generated from protobuf field <code>string self_link = 456214797;</code>
     */
    private $self_link = null;
    /**
     * If false, licenses will not be copied from the source resource when creating an image from a disk, disk from snapshot, or snapshot from disk.
     *
     * Generated from protobuf field <code>bool transferable = 4349893;</code>
     */
    private $transferable = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type bool $charges_use_fee
     *           [Output Only] Deprecated. This field no longer reflects whether a license charges a usage fee.
     *     @type string $creation_timestamp
     *           [Output Only] Creation timestamp in RFC3339 text format.
     *     @type string $description
     *           An optional textual description of the resource; provided by the client when the resource is created.
     *     @type string $id
     *           [Output Only] The unique identifier for the resource. This identifier is defined by the server.
     *     @type string $kind
     *           [Output Only] Type of resource. Always compute#license for licenses.
     *     @type string $license_code
     *           [Output Only] The unique code used to attach this license to images, snapshots, and disks.
     *     @type string $name
     *           Name of the resource. The name must be 1-63 characters long and comply with RFC1035.
     *     @type \Google\Cloud\Compute\V1\LicenseResourceRequirements $resource_requirements
     *     @type string $self_link
     *           [Output Only] Server-defined URL for the resource.
     *     @type bool $transferable
     *           If false, licenses will not be copied from the source resource when creating an image from a disk, disk from snapshot, or snapshot from disk.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Compute\V1\Compute::initOnce();
        parent::__construct($data);
    }

    /**
     * [Output Only] Deprecated. This field no longer reflects whether a license charges a usage fee.
     *
     * Generated from protobuf field <code>bool charges_use_fee = 372412622;</code>
     * @return bool
     */
    public function getChargesUseFee()
    {
        return isset($this->charges_use_fee) ? $this->charges_use_fee : false;
    }

    public function hasChargesUseFee()
    {
        return isset($this->charges_use_fee);
    }

    public function clearChargesUseFee()
    {
        unset($this->charges_use_fee);
    }

    /**
     * [Output Only] Deprecated. This field no longer reflects whether a license charges a usage fee.
     *
     * Generated from protobuf field <code>bool charges_use_fee = 372412622;</code>
     * @param bool $var
     * @return $this
     */
    public function setChargesUseFee($var)
    {
        GPBUtil::checkBool($var);
        $this->charges_use_fee = $var;

        return $this;
    }

    /**
     * [Output Only] Creation timestamp in RFC3339 text format.
     *
     * Generated from protobuf field <code>string creation_timestamp = 30525366;</code>
     * @return string
     */
    public function getCreationTimestamp()
    {
        return isset($this->creation_timestamp) ? $this->creation_timestamp : '';
    }

    public function hasCreationTimestamp()
    {
        return isset($this->creation_timestamp);
    }

    public function clearCreationTimestamp()
    {
        unset($this->creation_timestamp);
    }

    /**
     * [Output Only] Creation timestamp in RFC3339 text format.
     *
     * Generated from protobuf field <code>string creation_timestamp = 30525366;</code>
     * @param string $var
     * @return $this
     */
    public function setCreationTimestamp($var)
    {
        GPBUtil::checkString($var, True);
        $this->creation_timestamp = $var;

        return $this;
    }

    /**
     * An optional textual description of the resource; provided by the client when the resource is created.
     *
     * Generated from protobuf field <code>string description = 422937596;</code>
     * @return string
     */
    public function getDescription()
    {
        return isset($this->description) ? $this->description : '';
    }

    public function hasDescription()
    {
        return isset($this->description);
    }

    public function clearDescription()
    {
        unset($this->description);
    }

    /**
     * An optional textual description of the resource; provided by the client when the resource is created.
     *
     * Generated from protobuf field <code>string description = 422937596;</code>
     * @param string $var
     * @return $this
     */
    public function setDescription($var)
    {
        GPBUtil::checkString($var, True);
        $this->description = $var;

        return $this;
    }

    /**
     * [Output Only] The unique identifier for the resource. This identifier is defined by the server.
     *
     * Generated from protobuf field <code>string id = 3355;</code>
     * @return string
     */
    public function getId()
    {
        return isset($this->id) ? $this->id : '';
    }

    public function hasId()
    {
        return isset($this->id);
    }

    public function clearId()
    {
        unset($this->id);
    }

    /**
     * [Output Only] The unique identifier for the resource. This identifier is defined by the server.
     *
     * Generated from protobuf field <code>string id = 3355;</code>
     * @param string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkString($var, True);
        $this->id = $var;

        return $this;
    }

    /**
     * [Output Only] Type of resource. Always compute#license for licenses.
     *
     * Generated from protobuf field <code>string kind = 3292052;</code>
     * @return string
     */
    public function getKind()
    {
        return isset($this->kind) ? $this->kind : '';
    }

    public function hasKind()
    {
        return isset($this->kind);
    }

    public function clearKind()
    {
        unset($this->kind);
    }

    /**
     * [Output Only] Type of resource. Always compute#license for licenses.
     *
     * Generated from protobuf field <code>string kind = 3292052;</code>
     * @param string $var
     * @return $this
     */
    public function setKind($var)
    {
        GPBUtil::checkString($var, True);
        $this->kind = $var;

        return $this;
    }

    /**
     * [Output Only] The unique code used to attach this license to images, snapshots, and disks.
     *
     * Generated from protobuf field <code>string license_code = 1467179;</code>
     * @return string
     */
    public function getLicenseCode()
    {
        return isset($this->license_code) ? $this->license_code : '';
    }

    public function hasLicenseCode()
    {
        return isset($this->license_code);
    }

    public function clearLicenseCode()
    {
        unset($this->license_code);
    }

    /**
     * [Output Only] The unique code used to attach this license to images, snapshots, and disks.
     *
     * Generated from protobuf field <code>string license_code = 1467179;</code>
     * @param string $var
     * @return $this
     */
    public function setLicenseCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->license_code = $var;

        return $this;
    }

    /**
     * Name of the resource. The name must be 1-63 characters long and comply with RFC1035.
     *
     * Generated from protobuf field <code>string name = 3373707;</code>
     * @return string
     */
    public function getName()
    {
        return isset($this->name) ? $this->name : '';
    }

    public function hasName()
    {
        return isset($this->name);
    }

    public function clearName()
    {
        unset($this->name);
    }

    /**
     * Name of the resource. The name must be 1-63 characters long and comply with RFC1035.
     *
     * Generated from protobuf field <code>string name = 3373707;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.cloud.compute.v1.LicenseResourceRequirements resource_requirements = 214292769;</code>
     * @return \Google\Cloud\Compute\V1\LicenseResourceRequirements|null
     */
    public function getResourceRequirements()
    {
        return isset($this->resource_requirements) ? $this->resource_requirements : null;
    }

    public function hasResourceRequirements()
    {
        return isset($this->resource_requirements);
    }

    public function clearResourceRequirements()
    {
        unset($this->resource_requirements);
    }

    /**
     * Generated from protobuf field <code>.google.cloud.compute.v1.LicenseResourceRequirements resource_requirements = 214292769;</code>
     * @param \Google\Cloud\Compute\V1\LicenseResourceRequirements $var
     * @return $this
     */
    public function setResourceRequirements($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Compute\V1\LicenseResourceRequirements::class);
        $this->resource_requirements = $var;

        return $this;
    }

    /**
     * [Output Only] Server-defined URL for the resource.
     *
     * Generated from protobuf field <code>string self_link = 456214797;</code>
     * @return string
     */
    public function getSelfLink()
    {
        return isset($this->self_link) ? $this->self_link : '';
    }

    public function hasSelfLink()
    {
        return isset($this->self_link);
    }

    public function clearSelfLink()
    {
        unset($this->self_link);
    }

    /**
     * [Output Only] Server-defined URL for the resource.
     *
     * Generated from protobuf field <code>string self_link = 456214797;</code>
     * @param string $var
     * @return $this
     */
    public function setSelfLink($var)
    {
        GPBUtil::checkString($var, True);
        $this->self_link = $var;

        return $this;
    }

    /**
     * If false, licenses will not be copied from the source resource when creating an image from a disk, disk from snapshot, or snapshot from disk.
     *
     * Generated from protobuf field <code>bool transferable = 4349893;</code>
     * @return bool
     */
    public function getTransferable()
    {
        return isset($this->transferable) ? $this->transferable : false;
    }

    public function hasTransferable()
    {
        return isset($this->transferable);
    }

    public function clearTransferable()
    {
        unset($this->transferable);
    }

    /**
     * If false, licenses will not be copied from the source resource when creating an image from a disk, disk from snapshot, or snapshot from disk.
     *
     * Generated from protobuf field <code>bool transferable = 4349893;</code>
     * @param bool $var
     * @return $this
     */
    public function setTransferable($var)
    {
        GPBUtil::checkBool($var);
        $this->transferable = $var;

        return $this;
    }

}

