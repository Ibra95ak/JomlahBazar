<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/video/transcoder/v1beta1/resources.proto

namespace Google\Cloud\Video\Transcoder\V1beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Encryption settings.
 *
 * Generated from protobuf message <code>google.cloud.video.transcoder.v1beta1.Encryption</code>
 */
class Encryption extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. 128 bit encryption key represented as lowercase hexadecimal digits.
     *
     * Generated from protobuf field <code>string key = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $key = '';
    /**
     * Required. 128 bit Initialization Vector (IV) represented as lowercase hexadecimal
     * digits.
     *
     * Generated from protobuf field <code>string iv = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $iv = '';
    protected $encryption_mode;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $key
     *           Required. 128 bit encryption key represented as lowercase hexadecimal digits.
     *     @type string $iv
     *           Required. 128 bit Initialization Vector (IV) represented as lowercase hexadecimal
     *           digits.
     *     @type \Google\Cloud\Video\Transcoder\V1beta1\Encryption\Aes128Encryption $aes_128
     *           Configuration for AES-128 encryption.
     *     @type \Google\Cloud\Video\Transcoder\V1beta1\Encryption\SampleAesEncryption $sample_aes
     *           Configuration for SAMPLE-AES encryption.
     *     @type \Google\Cloud\Video\Transcoder\V1beta1\Encryption\MpegCommonEncryption $mpeg_cenc
     *           Configuration for MPEG Common Encryption (MPEG-CENC).
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Video\Transcoder\V1Beta1\Resources::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. 128 bit encryption key represented as lowercase hexadecimal digits.
     *
     * Generated from protobuf field <code>string key = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Required. 128 bit encryption key represented as lowercase hexadecimal digits.
     *
     * Generated from protobuf field <code>string key = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setKey($var)
    {
        GPBUtil::checkString($var, True);
        $this->key = $var;

        return $this;
    }

    /**
     * Required. 128 bit Initialization Vector (IV) represented as lowercase hexadecimal
     * digits.
     *
     * Generated from protobuf field <code>string iv = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getIv()
    {
        return $this->iv;
    }

    /**
     * Required. 128 bit Initialization Vector (IV) represented as lowercase hexadecimal
     * digits.
     *
     * Generated from protobuf field <code>string iv = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setIv($var)
    {
        GPBUtil::checkString($var, True);
        $this->iv = $var;

        return $this;
    }

    /**
     * Configuration for AES-128 encryption.
     *
     * Generated from protobuf field <code>.google.cloud.video.transcoder.v1beta1.Encryption.Aes128Encryption aes_128 = 3;</code>
     * @return \Google\Cloud\Video\Transcoder\V1beta1\Encryption\Aes128Encryption|null
     */
    public function getAes128()
    {
        return $this->readOneof(3);
    }

    public function hasAes128()
    {
        return $this->hasOneof(3);
    }

    /**
     * Configuration for AES-128 encryption.
     *
     * Generated from protobuf field <code>.google.cloud.video.transcoder.v1beta1.Encryption.Aes128Encryption aes_128 = 3;</code>
     * @param \Google\Cloud\Video\Transcoder\V1beta1\Encryption\Aes128Encryption $var
     * @return $this
     */
    public function setAes128($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Video\Transcoder\V1beta1\Encryption\Aes128Encryption::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * Configuration for SAMPLE-AES encryption.
     *
     * Generated from protobuf field <code>.google.cloud.video.transcoder.v1beta1.Encryption.SampleAesEncryption sample_aes = 4;</code>
     * @return \Google\Cloud\Video\Transcoder\V1beta1\Encryption\SampleAesEncryption|null
     */
    public function getSampleAes()
    {
        return $this->readOneof(4);
    }

    public function hasSampleAes()
    {
        return $this->hasOneof(4);
    }

    /**
     * Configuration for SAMPLE-AES encryption.
     *
     * Generated from protobuf field <code>.google.cloud.video.transcoder.v1beta1.Encryption.SampleAesEncryption sample_aes = 4;</code>
     * @param \Google\Cloud\Video\Transcoder\V1beta1\Encryption\SampleAesEncryption $var
     * @return $this
     */
    public function setSampleAes($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Video\Transcoder\V1beta1\Encryption\SampleAesEncryption::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * Configuration for MPEG Common Encryption (MPEG-CENC).
     *
     * Generated from protobuf field <code>.google.cloud.video.transcoder.v1beta1.Encryption.MpegCommonEncryption mpeg_cenc = 5;</code>
     * @return \Google\Cloud\Video\Transcoder\V1beta1\Encryption\MpegCommonEncryption|null
     */
    public function getMpegCenc()
    {
        return $this->readOneof(5);
    }

    public function hasMpegCenc()
    {
        return $this->hasOneof(5);
    }

    /**
     * Configuration for MPEG Common Encryption (MPEG-CENC).
     *
     * Generated from protobuf field <code>.google.cloud.video.transcoder.v1beta1.Encryption.MpegCommonEncryption mpeg_cenc = 5;</code>
     * @param \Google\Cloud\Video\Transcoder\V1beta1\Encryption\MpegCommonEncryption $var
     * @return $this
     */
    public function setMpegCenc($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Video\Transcoder\V1beta1\Encryption\MpegCommonEncryption::class);
        $this->writeOneof(5, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getEncryptionMode()
    {
        return $this->whichOneof("encryption_mode");
    }

}
