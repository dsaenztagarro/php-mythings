<?php

namespace Thing\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Thing\Model\Thing;
use Thing\Form\ThingForm;

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
        $form = new ThingForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $thing = new Thing();
            $form->setInputFilter($thing->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $thing->exchangeArray($form->getData());
                $this->getThingTable()->saveThing($thing);

                // Redirect to list of things
                return $this->redirect()->toRoute('thing');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('thing', array(
                'action' => 'add'
            ));
        }

        // Get the Thing with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $thing = $this->getThingTable()->getThing($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('thing', array(
                'action' => 'index'
            ));
        }

        $form  = new ThingForm();
        $form->bind($thing);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($thing->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getThingTable()->saveThing($thing);

                // Redirect to list of things
                return $this->redirect()->toRoute('thing');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('thing');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getThingTable()->deleteThing($id);
             }

             // Redirect to list of things
             return $this->redirect()->toRoute('thing');
         }

         return array(
             'id'    => $id,
             'thing' => $this->getThingTable()->getThing($id)
         );
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
