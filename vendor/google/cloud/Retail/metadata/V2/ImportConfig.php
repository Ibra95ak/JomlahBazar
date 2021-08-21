<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/retail/v2/import_config.proto

namespace GPBMetadata\Google\Cloud\Retail\V2;

class ImportConfig
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\Annotations::initOnce();
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        \GPBMetadata\Google\Cloud\Retail\V2\Product::initOnce();
        \GPBMetadata\Google\Cloud\Retail\V2\UserEvent::initOnce();
        \GPBMetadata\Google\Protobuf\FieldMask::initOnce();
        \GPBMetadata\Google\Protobuf\Timestamp::initOnce();
        \GPBMetadata\Google\Rpc\Status::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
*google/cloud/retail/v2/import_config.protogoogle.cloud.retail.v2google/api/field_behavior.proto$google/cloud/retail/v2/product.proto\'google/cloud/retail/v2/user_event.proto google/protobuf/field_mask.protogoogle/protobuf/timestamp.protogoogle/rpc/status.proto"9
	GcsSource

input_uris (	B�A
data_schema (	"�
BigQuerySource

project_id (	

dataset_id (	B�A
table_id (	B�A
gcs_staging_dir (	
data_schema (	"M
ProductInlineSource6
products (2.google.cloud.retail.v2.ProductB�A"T
UserEventInlineSource;
user_events (2!.google.cloud.retail.v2.UserEventB�A"9
ImportErrorsConfig

gcs_prefix (	H B
destination"�
ImportProductsRequest
parent (	B�AE
input_config (2*.google.cloud.retail.v2.ProductInputConfigB�AA
errors_config (2*.google.cloud.retail.v2.ImportErrorsConfig/
update_mask (2.google.protobuf.FieldMask"�
ImportUserEventsRequest
parent (	B�AG
input_config (2,.google.cloud.retail.v2.UserEventInputConfigB�AA
errors_config (2*.google.cloud.retail.v2.ImportErrorsConfig"�
ProductInputConfigL
product_inline_source (2+.google.cloud.retail.v2.ProductInlineSourceH 7

gcs_source (2!.google.cloud.retail.v2.GcsSourceH B
big_query_source (2&.google.cloud.retail.v2.BigQuerySourceH B
source"�
UserEventInputConfigV
user_event_inline_source (2-.google.cloud.retail.v2.UserEventInlineSourceB�AH <

gcs_source (2!.google.cloud.retail.v2.GcsSourceB�AH G
big_query_source (2&.google.cloud.retail.v2.BigQuerySourceB�AH B
source"�
ImportMetadata/
create_time (2.google.protobuf.Timestamp/
update_time (2.google.protobuf.Timestamp
success_count (
failure_count ("�
ImportProductsResponse)
error_samples (2.google.rpc.StatusA
errors_config (2*.google.cloud.retail.v2.ImportErrorsConfig"�
ImportUserEventsResponse)
error_samples (2.google.rpc.StatusA
errors_config (2*.google.cloud.retail.v2.ImportErrorsConfigF
import_summary (2..google.cloud.retail.v2.UserEventImportSummary"T
UserEventImportSummary
joined_events_count (
unjoined_events_count (B�
com.google.cloud.retail.v2BImportConfigProtoPZ<google.golang.org/genproto/googleapis/cloud/retail/v2;retail�RETAIL�Google.Cloud.Retail.V2�Google\\Cloud\\Retail\\V2�Google::Cloud::Retail::V2bproto3'
        , true);

        static::$is_initialized = true;
    }
}

