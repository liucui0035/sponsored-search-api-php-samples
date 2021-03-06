<?php
require_once (dirname(__FILE__) . '/../../conf/api_config.php');
require_once (dirname(__FILE__) . '/../util/SoapUtils.class.php');

/**
 * Sample Program for FeedItemServiceSample.
 * Copyright (C) 2012 Yahoo Japan Corporation. All Rights Reserved.
 */
class FeedItemServiceSample{

    /**
     * Sample Program for FeedItemService(AD_CUSTOMIZER) ADD.
     *
     * @param string $accountId Account ID
     * @param string $campaignId Campaign ID
     * @param string $adGroupId AdGroup ID
     * @param string $feedFolderId FeedFolder ID
     * @param array $feedAttributeId FeedAttributeId ID
     * @return array FeedItemValues entity
     * @throws Exception
     */
    public function addFeedItem($accountId, $campaignId, $adGroupId, $feedFolderId, $feedAttributeId){
        // Set Operand
        $operand = array(
            // Set AdCustomizer
            array(
                'accountId' => $accountId,
                'feedFolderId' => $feedFolderId,
                'feedItemAttribute' => array(
                    array(
                        'feedAttributeId' => $feedAttributeId['AD_CUSTOMIZER_INTEGER'],
                        'feedAttributeValue' => '1234567890'
                    ),
                    array(
                        'feedAttributeId' => $feedAttributeId['AD_CUSTOMIZER_PRICE'],
                        'feedAttributeValue' => '9,999,999.99'
                    ),
                    array(
                        'feedAttributeId' => $feedAttributeId['AD_CUSTOMIZER_DATE'],
                        'feedAttributeValue' => '20151231 235959'
                    ),
                    array(
                        'feedAttributeId' => $feedAttributeId['AD_CUSTOMIZER_STRING'],
                        'feedAttributeValue' => 'sample Value'
                    )
                ),
                'placeholderType' => 'AD_CUSTOMIZER',
                'startDate' => '20161215',
                'endDate' => '20181215',
                'scheduling' => array(
                    'schedules' => array(
                        array(
                            'dayOfWeek' => 'SUNDAY',
                            'startHour' => 14,
                            'startMinute' => 'ZERO',
                            'endHour' => 15,
                            'endMinute' => 'THIRTY'
                        ),
                        array(
                            'dayOfWeek' => 'MONDAY',
                            'startHour' => 14,
                            'startMinute' => 'ZERO',
                            'endHour' => 15,
                            'endMinute' => 'THIRTY'
                        )
                    )
                ),
                'targetingCampaign' => array(
                    'targetingCampaignId' => $campaignId
                ),
                'targetingAdGroup' => array(
                    'targetingAdGroupId' => $adGroupId
                ),
                'targetingKeyword' => array(
                    'text' => 'sample keyword',
                    'matchType' => 'EXACT'
                )
            )
        );

        // Set Request
        $feedItemRequest = array(
            'operations' => array(
                'operator' => 'ADD',
                'accountId' => $accountId,
                'placeholderType' => 'AD_CUSTOMIZER',
                'operand' => $operand
            )
        );

        // Call API
        $feedItemService = SoapUtils::getService('FeedItemService');
        $feedItemResponse = $feedItemService->invoke('mutate', $feedItemRequest);

        // Response
        if(isset($feedItemResponse->rval->values)){
            if(is_array($feedItemResponse->rval->values)){
                $feedItemReturnValues = $feedItemResponse->rval->values;
            }else{
                $feedItemReturnValues = array(
                    $feedItemResponse->rval->values
                );
            }
        }else{
            throw new Exception("No response of add FeedItemService(AD_CUSTOMIZER).");
        }

        // Error
        foreach($feedItemReturnValues as $feedItemReturnValue){
            if(!isset($feedItemReturnValue->feedItem)){
                throw new Exception("Fail to add FeedItemService(AD_CUSTOMIZER).");
            }
        }

        return $feedItemReturnValues;
    }

    /**
     * Sample Program for FeedItemService(AD_CUSTOMIZER) Set.
     *
     * @param string $accountId Account ID
     * @param array $feedAttributeId FeedAttributeId ID
     * @param array $feedItemValues FeedItemValues entity for set.
     * @return array FeedItemValues entity
     * @throws Exception
     */
    public function setFeedItem($accountId, $feedAttributeId, $feedItemValues){
        // Set Operand
        $operand = array();
        foreach($feedItemValues as $feedItemValue){

            $operand = array(
                // Set Callextension
                array(
                    'accountId' => $accountId,
                    'feedItemId' => $feedItemValue->feedItem->feedItemId,
                    'feedItemAttribute' => array(
                        array(
                            'feedAttributeId' => $feedAttributeId['AD_CUSTOMIZER_INTEGER'],
                            'feedAttributeValue' => '2345678901'
                        ),
                        array(
                            'feedAttributeId' => $feedAttributeId['AD_CUSTOMIZER_PRICE'],
                            'feedAttributeValue' => '1,111,111.11'
                        ),
                        array(
                            'feedAttributeId' => $feedAttributeId['AD_CUSTOMIZER_DATE'],
                            'feedAttributeValue' => '20160101 235959'
                        ),
                        array(
                            'feedAttributeId' => $feedAttributeId['AD_CUSTOMIZER_STRING'],
                            'feedAttributeValue' => 'sample edit value'
                        )
                    ),
                    'placeholderType' => 'AD_CUSTOMIZER',
                    'startDate' => '',
                    'endDate' => '',
                    'scheduling' => ''
                )
            );
        }

        // Set Request
        $feedItemRequest = array(
            'operations' => array(
                'operator' => 'SET',
                'accountId' => $accountId,
                'placeholderType' => 'AD_CUSTOMIZER',
                'operand' => $operand
            )
        );

        // Call API
        $feedItemService = SoapUtils::getService('FeedItemService');
        $feedItemResponse = $feedItemService->invoke('mutate', $feedItemRequest);

        // Response
        if(isset($feedItemResponse->rval->values)){
            if(is_array($feedItemResponse->rval->values)){
                $feedItemReturnValues = $feedItemResponse->rval->values;
            }else{
                $feedItemReturnValues = array(
                    $feedItemResponse->rval->values
                );
            }
        }else{
            throw new Exception("No response of set FeedItemService(AD_CUSTOMIZER).");
        }

        // Error
        foreach($feedItemReturnValues as $feedItemReturnValue){
            if(!isset($feedItemReturnValue->feedItem)){
                throw new Exception("Fail to set FeedItemService(AD_CUSTOMIZER).");
            }
        }

        return $feedItemReturnValues;
    }

    /**
     * Sample Program for FeedItemService Remove.
     *
     * @param string $accountId Account ID
     * @param array $feedItemValues FeedItemValues entity for set.
     * @return array FeedFolderValues entity
     * @throws Exception
     */
    public function removeFeedItem($accountId, $feedItemValues){
        // Set Operand
        $operand = array();
        foreach($feedItemValues as $feedItemValue){
            $operand = array(
                array(
                    'accountId' => $accountId,
                    'feedItemId' => $feedItemValue->feedItem->feedItemId,
                    'placeholderType' => $feedItemValue->feedItem->placeholderType
                )
            );
            $placeholderType = $feedItemValue->feedItem->placeholderType;
        }

        // Set Request
        $feedItemRequest = array(
            'operations' => array(
                'operator' => 'REMOVE',
                'accountId' => $accountId,
                'placeholderType' => $placeholderType,
                'operand' => $operand
            )
        );

        // Call API
        $feedItemService = SoapUtils::getService('FeedItemService');
        $feedItemResponse = $feedItemService->invoke('mutate', $feedItemRequest);

        // Response
        if(isset($feedItemResponse->rval->values)){
            if(is_array($feedItemResponse->rval->values)){
                $feedItemReturnValues = $feedItemResponse->rval->values;
            }else{
                $feedItemReturnValues = array(
                    $feedItemResponse->rval->values
                );
            }
        }else{
            throw new Exception("No response of set FeedItemService.");
        }

        // Error
        foreach($feedItemReturnValues as $feedItemReturnValue){
            if(!isset($feedItemReturnValue->feedItem)){
                throw new Exception("Fail to set FeedItemService.");
            }
        }

        return $feedItemReturnValues;
    }

    /**
     * Sample Program for FeedItemService Get.
     *
     * @param string $accountId Account ID
     * @param array $feedItemValues FeedItemValues entity for set.
     * @return array FeedItemValues entity
     * @throws Exception
     */
    public function getFeedItem($accountId, $feedItemValues){
        // Set feedItemIds
        $feedItemIds = array();
        foreach($feedItemValues as $feedItemValue){
            $feedItemIds[] = $feedItemValue->feedItem->feedItemId;
        }

        // Set Selector
        $feedItemRequest = array(
            'selector' => array(
                'accountId' => $accountId,
                'feedItemIds' => $feedItemIds,
                'placeholderTypes' => array(
                    'QUICKLINK',
                    'CALLEXTENSION',
                    'AD_CUSTOMIZER'
                ),
                'approvalStatuses' => array(
                    'APPROVED',
                    'REVIEW',
                    'PRE_DISAPPROVED',
                    'APPROVED_WITH_REVIEW',
                    'POST_DISAPPROVED'
                ),
                'advanced' => 'FALSE',
                'paging' => array(
                    'startIndex' => 1,
                    'numberResults' => 20
                )
            )
        );

        // Call API
        $feedItemService = SoapUtils::getService('FeedItemService');
        $feedItemResponse = $feedItemService->invoke('get', $feedItemRequest);

        // Response
        if(isset($feedItemResponse->rval->values)){
            if(is_array($feedItemResponse->rval->values)){
                $feedItemReturnValues = $feedItemResponse->rval->values;
            }else{
                $feedItemReturnValues = array(
                    $feedItemResponse->rval->values
                );
            }
        }else{
            throw new Exception("No response of get FeedItemService.");
        }

        // Error
        foreach($feedItemReturnValues as $feedItemReturnValue){
            if(!isset($feedItemReturnValue->feedItem)){
                throw new Exception("Fail to get FeedItemService.");
            }
        }

        return $feedItemResponse;
    }
}

if(__FILE__ != realpath($_SERVER['PHP_SELF'])){
    return;
}

/**
 * FeedItemServiceSample
 */
try{
    $feedItemServiceSample = new FeedItemServiceSample();

    $accountId = SoapUtils::getAccountId();
    $campaignId = SoapUtils::getCampaignId();
    $adGroupId = SoapUtils::getAdGroupId();
    $feedFolderId = SoapUtils::getFeedFolderId();
    $feedAttributeIds = array(
        'AD_CUSTOMIZER_INTEGER' => SoapUtils::getIntegerFeedAttributeId(),
        'AD_CUSTOMIZER_PRICE' => SoapUtils::getPriceFeedAttributeId(),
        'AD_CUSTOMIZER_DATE' => SoapUtils::getDateFeedAttributeId(),
        'AD_CUSTOMIZER_STRING' => SoapUtils::getStringFeedAttributeId()
    );

    // FeedItemServiceSample(AD_CUSTOMIZER) ADD
    $feedItemValues = $feedItemServiceSample->addFeedItem($accountId, $campaignId, $adGroupId, $feedFolderId, $feedAttributeIds);

    // FeedItemServiceSample GET
    $feedItemServiceSample->getFeedItem($accountId, $feedItemValues);

    // waiting for sandbox review process
    sleep(20);

    // FeedItemServiceSample(AD_CUSTOMIZER) SET
    $feedItemServiceSample->setFeedItem($accountId, $feedAttributeIds, $feedItemValues);

    // FeedItemServiceSample REMOVE
    $feedItemServiceSample->removeFeedItem($accountId, $feedItemValues);

}catch(Exception $e){
    printf($e->getMessage() . "\n");
}