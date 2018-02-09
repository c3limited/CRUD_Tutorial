<?php

namespace C3\CRUD\Model\ResourceModel\Note;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    // Link our model, and resource model to this collection class
    protected function _construct()
    {
        $this->_init('C3\CRUD\Model\Notes', 'C3\CRUD\Model\ResourceModel\Note');
    }

}