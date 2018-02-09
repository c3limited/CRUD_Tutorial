<?php

namespace C3\CRUD\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Note extends AbstractDb
{

    /**
     *  Link our model to the notes table, and which column is the id reference.
     */
    protected function _construct()
    {
        $this->_init('notes', 'note_id');
    }

}