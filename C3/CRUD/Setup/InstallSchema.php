<?php

namespace C3\CRUD\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $dbConnection            = $setup->getConnection();
        $validatedNotesTableName = $setup->getTable('notes');

        $notesTable = $dbConnection->newTable($validatedNotesTableName)
                                    // ID
                                   ->addColumn('note_id', Table::TYPE_INTEGER, null, [
                                       'identity' => true,
                                       'unsigned' => true,
                                       'nullable' => false,
                                       'primary'  => true
                                   ], 'Notes ID')

                                    // Notes title
                                   ->addColumn('title', Table::TYPE_TEXT, 250, ['nullable' => false], 'Note Title')

                                    // Notes Content
                                   ->addColumn('content', Table::TYPE_TEXT, 1000, ['nullable' => false], 'Note Content')

                                    // Created at
                                   ->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [
                                       'default'  => Table::TIMESTAMP_INIT,
                                       'nullable' => false
                                   ], 'Created At')

                                    // Updated At
                                   ->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [
                                       'default'  => Table::TIMESTAMP_INIT_UPDATE,
                                       'nullable' => false
                                   ], 'Updated At');

        $dbConnection->createTable($notesTable);

        $setup->endSetup();
    }
}