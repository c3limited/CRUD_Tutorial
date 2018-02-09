<?php

namespace C3\CRUD\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use C3\CRUD\Model\ResourceModel\Note as ResourceNote;

class Note extends AbstractModel implements IdentityInterface
{

    //The table name for our notes model.
    const CACHE_TAG = 'notes';

    // Specify which resource model this model links to.
    protected function _construct()
    {
        $this->_init(ResourceNote::class);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}