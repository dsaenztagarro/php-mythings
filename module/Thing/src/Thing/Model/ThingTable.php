<?php

namespace Thing\Model;

use Zend\Db\TableGateway\TableGateway;

class ThingTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getThing($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveThing(Thing $thing)
    {
        $data = array(
            'artist' => $thing->artist,
            'title'  => $thing->title,
        );

        $id = (int) $thing->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getThing($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Thing id does not exist');
            }
        }
    }

    public function deleteThing($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
