<?php
/**
 * Copyright © 2017 iFlair Web Technologies. All rights reserved.
 */ 

namespace IFlair\Reindexing\Controller\Adminhtml\Indexer;

use \Magento\Framework\Exception\LocalizedException;
use \Magento\Framework\Controller\ResultFactory;

class Indexes extends \Magento\Backend\App\Action
{
    protected $_indexerFactory;
    
    /**
    * @var \Magento\Indexer\Model\Indexer\CollectionFactory
    */
    protected $_indexerCollectionFactory;
        
    public function __construct(\Magento\Backend\App\Action\Context $context,
        \Magento\Indexer\Model\IndexerFactory $indexerFactory,
        \Magento\Indexer\Model\Indexer\CollectionFactory $indexerCollectionFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->_indexerFactory = $indexerFactory;
        $this->_indexerCollectionFactory = $indexerCollectionFactory;
    }
    // custom function for reindexing
    public function execute()
    {
        try
        {
            $resultJson = $this->jsonFactory->create();
            $response = [];            

            $indexerCollection = $this->_indexerCollectionFactory->create();
            $allIds = $indexerCollection->getAllIds();
            $updatedIndexes = 0;
            $obj = \Magento\Framework\App\ObjectManager::getInstance();
            foreach ($allIds as $id) 
            {
                //$logger = $obj->get('\Psr\Log\LoggerInterface');
                $indexerState = $obj->get('\Magento\Indexer\Model\Indexer\State');
                //$logger->info($id);                
                $indexer = $this->_indexerFactory->create();
                if($indexer->load($id)->getStatus() == 'working')
                {
                    $indexerState->loadByIndexer($id);
                    $indexerState->setStatus(\Magento\Framework\Indexer\StateInterface::STATUS_INVALID);
                    $indexerState->save();
                }
                $indexer = $this->_indexerFactory->create();
                $indexer->load($id)->reindexAll();                
                $updatedIndexes++;                
            }         
            if ($updatedIndexes > 0) 
            {
                $response['type'] = 'success';
                $response['success'] = true;
                $response['message'] = __("%1 indexes type(s) refreshed.", $updatedIndexes);
            }
        }
        catch (LocalizedException $e) 
        {
            $response['type'] = 'error';
            $response['error'] = true;
            $response['message'] = "<b>an error in " . $id . " - </b>" . $e->getMessage();
        }
        catch (\Exception $e) 
        {
            $response['type'] = 'error';
            $response['error'] = true;
            $response['message'] = __("<b>an error in ". $id . " - </b>" . $e->getMessage());
        }
        return $resultJson->setData($response);        
    }
}