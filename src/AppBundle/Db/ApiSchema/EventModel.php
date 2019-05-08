<?php

namespace AppBundle\Db\ApiSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use AppBundle\Db\ApiSchema\AutoStructure\Event as EventStructure;
use AppBundle\Db\ApiSchema\Event;

/**
 * EventModel
 *
 * Model class for table event.
 *
 * @see Model
 */
class EventModel extends Model
{
    use WriteQueries;

    /**
     * __construct()
     *
     * Model constructor
     *
     * @access public
     */
    public function __construct()
    {
        $this->structure = new EventStructure;
        $this->flexible_entity_class = '\AppBundle\Db\ApiSchema\Event';
    }

    public function find($id)
    {
        $sql = <<<SQL
                    SELECT 
                        :projection
                    FROM :event event
                    LEFT JOIN :entry entry USING (event_id)
                    WHERE event_id = :id
                    GROUP BY event_id
SQL;

        $projection = $this->createProjection()
            ->setField('entry', 'array_agg(entry)', '\AppBundle\Db\ApiSchema\Entry[]');

        $sql = strtr($sql,
            [
                ':id' => $id,
                ':projection' => $projection->formatFieldsWithFieldAlias('event'),
                ':event' => $this->getStructure()->getRelation(),
                ':entry' => $this->getSession()
                    ->getModel(EntryModel::class)
                    ->getStructure()
                    ->getRelation()
            ]
        );

        return $this->query($sql, [], $projection);

    }
}
