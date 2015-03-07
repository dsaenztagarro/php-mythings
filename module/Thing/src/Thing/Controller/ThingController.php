<?php

namespace Thing\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ThingController extends AbstractActionController
{
    protected $thingTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'things' => $this->getThingTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }

    public function getThingTable()
    {
        if (!$this->thingTable) {
            $sm = $this->getServiceLocator();
            $this->thingTable = $sm->get('Thing\Model\ThingTable');
        }
        return $this->thingTable;
    }
}
