<?php

return [
    'interfaces' => [
        'google.cloud.asset.v1.AssetService' => [
            'ExportAssets' => [
                'longRunning' => [
                    'operationReturnType' => '\Google\Cloud\Asset\V1\ExportAssetsResponse',
                    'metadataReturnType' => '\Google\Cloud\Asset\V1\ExportAssetsRequest',
                    'initialPollDelayMillis' => '500',
                    'pollDelayMultiplier' => '1.5',
                    'maxPollDelayMillis' => '5000',
                    'totalPollTimeoutMillis' => '300000',
                ],
            ],
            'AnalyzeIamPolicyLongrunning' => [
                'longRunning' => [
                    'operationReturnType' => '\Google\Cloud\Asset\V1\AnalyzeIamPolicyLongrunningResponse',
                    'metadataReturnType' => '\Google\Cloud\Asset\V1\AnalyzeIamPolicyLongrunningRequest',
                    'initialPollDelayMillis' => '500',
                    'pollDelayMultiplier' => '1.5',
                    'maxPollDelayMillis' => '5000',
                    'totalPollTimeoutMillis' => '300000',
                ],
            ],
            'SearchAllResources' => [
                'pageStreaming' => [
                    'requestPageTokenGetMethod' => 'getPageToken',
                    'requestPageTokenSetMethod' => 'setPageToken',
                    'requestPageSizeGetMethod' => 'getPageSize',
                    'requestPageSizeSetMethod' => 'setPageSize',
                    'responsePageTokenGetMethod' => 'getNextPageToken',
                    'resourcesGetMethod' => 'getResults',
                ],
            ],
            'SearchAllIamPolicies' => [
                'pageStreaming' => [
                    'requestPageTokenGetMethod' => 'getPageToken',
                    'requestPageTokenSetMethod' => 'setPageToken',
                    'requestPageSizeGetMethod' => 'getPageSize',
                    'requestPageSizeSetMethod' => 'setPageSize',
                    'responsePageTokenGetMethod' => 'getNextPageToken',
                    'resourcesGetMethod' => 'getResults',
                ],
            ],
        ],
    ],
];
