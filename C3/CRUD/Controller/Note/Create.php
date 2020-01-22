<?php

namespace C3\CRUD\Controller\Note;

use C3\CRUD\Model\NoteFactory; // Factory classes are dynamically generated classes by Magento
use C3\CRUD\Model\ResourceModel\Note;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Exception\AlreadyExistsException;

class Create extends Action
{

    protected $helper;
    protected $request;
    protected $note;
    protected $noteResource;
    protected $noteFactory;

    public function __construct(
        Context $context,
        Note $noteResource,
        Http $request,
        NoteFactory $noteFactory
    ) {
        $this->request      = $request;
        $this->noteFactory  = $noteFactory;
        $this->noteResource = $noteResource;

        parent::__construct($context);
    }

    /**
     * Execute action for our controller.
     */
    public function execute()
    {

        $postData = $this->request->getPost();

        if (!empty($postData)) {

            //Probably best do some form of validation here but for tutorial purposes, we wont for now

            $title = $postData['title'];
            $issue = $postData['content'];

            $newNote = $this->note
                ->create()
                ->setData([
                  'title' => $title,
                  'issue' => $issue,
                ]);

            //Try to save the new note
            try {
                $this->noteResource->save($newNote);
                $this->messageManager->addSuccessMessage("New Ticket: $title Created");

            } catch (\Exception $e) {
                //Add a error message if we cant save the new note from some reason
                $this->messageManager->addErrorMessage('Unable to save this ticket, please call your service provider');

            }

        } else {
            // Add a helpful error message
            $this->messageManager->addErrorMessage("No data was posted");

        }

        // Return to where we came from, here we're assuming the read notes page.
        return $this->_redirect("*/*/read");
    }



}
