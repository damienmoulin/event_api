<?php

namespace AppBundle\Db\ApiSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use AppBundle\Db\ApiSchema\AutoStructure\Entry as EntryStructure;
use AppBundle\Db\ApiSchema\Entry;

/**
 * EntryModel
 *
 * Model class for table entry.
 *
 * @see Model
 */
class EntryModel extends Model
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
        $this->structure = new EntryStructure;
        $this->flexible_entity_class = '\AppBundle\Db\ApiSchema\Entry';
    }
}
