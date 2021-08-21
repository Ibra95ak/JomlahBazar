<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/securitycenter/v1/organization_settings.proto

namespace Google\Cloud\SecurityCenter\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * User specified settings that are attached to the Security Command
 * Center organization.
 *
 * Generated from protobuf message <code>google.cloud.securitycenter.v1.OrganizationSettings</code>
 */
class OrganizationSettings extends \Google\Protobuf\Internal\Message
{
    /**
     * The relative resource name of the settings. See:
     * https://cloud.google.com/apis/design/resource_names#relative_resource_name
     * Example:
     * "organizations/{organization_id}/organizationSettings".
     *
     * Generated from protobuf field <code>string name = 1;</code>
     */
    private $name = '';
    /**
     * A flag that indicates if Asset Discovery should be enabled. If the flag is
     * set to `true`, then discovery of assets will occur. If it is set to `false,
     * all historical assets will remain, but discovery of future assets will not
     * occur.
     *
     * Generated from protobuf field <code>bool enable_asset_discovery = 2;</code>
     */
    private $enable_asset_discovery = false;
    /**
     * The configuration used for Asset Discovery runs.
     *
     * Generated from protobuf field <code>.google.cloud.securitycenter.v1.OrganizationSettings.AssetDiscoveryConfig asset_discovery_config = 3;</code>
     */
    private $asset_discovery_config = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *           The relative resource name of the settings. See:
     *           https://cloud.google.com/apis/design/resource_names#relative_resource_name
     *           Example:
     *           "organizations/{organization_id}/organizationSettings".
     *     @type bool $enable_asset_discovery
     *           A flag that indicates if Asset Discovery should be enabled. If the flag is
     *           set to `true`, then discovery of assets will occur. If it is set to `false,
     *           all historical assets will remain, but discovery of future assets will not
     *           occur.
     *     @type \Google\Cloud\SecurityCenter\V1\OrganizationSettings\AssetDiscoveryConfig $asset_discovery_config
     *           The configuration used for Asset Discovery runs.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Securitycenter\V1\OrganizationSettings::initOnce();
        parent::__construct($data);
    }

    /**
     * The relative resource name of the settings. See:
     * https://cloud.google.com/apis/design/resource_names#relative_resource_name
     * Example:
     * "organizations/{organization_id}/organizationSettings".
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The relative resource name of the settings. See:
     * https://cloud.google.com/apis/design/resource_names#relative_resource_name
     * Example:
     * "organizations/{organization_id}/organizationSettings".
     *
     * Generated from protobuf field <code>string name = 1;</code>
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
     * A flag that indicates if Asset Discovery should be enabled. If the flag is
     * set to `true`, then discovery of assets will occur. If it is set to `false,
     * all historical assets will remain, but discovery of future assets will not
     * occur.
     *
     * Generated from protobuf field <code>bool enable_asset_discovery = 2;</code>
     * @return bool
     */
    public function getEnableAssetDiscovery()
    {
        return $this->enable_asset_discovery;
    }

    /**
     * A flag that indicates if Asset Discovery should be enabled. If the flag is
     * set to `true`, then discovery of assets will occur. If it is set to `false,
     * all historical assets will remain, but discovery of future assets will not
     * occur.
     *
     * Generated from protobuf field <code>bool enable_asset_discovery = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setEnableAssetDiscovery($var)
    {
        GPBUtil::checkBool($var);
        $this->enable_asset_discovery = $var;

        return $this;
    }

    /**
     * The configuration used for Asset Discovery runs.
     *
     * Generated from protobuf field <code>.google.cloud.securitycenter.v1.OrganizationSettings.AssetDiscoveryConfig asset_discovery_config = 3;</code>
     * @return \Google\Cloud\SecurityCenter\V1\OrganizationSettings\AssetDiscoveryConfig|null
     */
    public function getAssetDiscoveryConfig()
    {
        return isset($this->asset_discovery_config) ? $this->asset_discovery_config : null;
    }

    public function hasAssetDiscoveryConfig()
    {
        return isset($this->asset_discovery_config);
    }

    public function clearAssetDiscoveryConfig()
    {
        unset($this->asset_discovery_config);
    }

    /**
     * The configuration used for Asset Discovery runs.
     *
     * Generated from protobuf field <code>.google.cloud.securitycenter.v1.OrganizationSettings.AssetDiscoveryConfig asset_discovery_config = 3;</code>
     * @param \Google\Cloud\SecurityCenter\V1\OrganizationSettings\AssetDiscoveryConfig $var
     * @return $this
     */
    public function setAssetDiscoveryConfig($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\SecurityCenter\V1\OrganizationSettings\AssetDiscoveryConfig::class);
        $this->asset_discovery_config = $var;

        return $this;
    }

}

