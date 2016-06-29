<?php

namespace Brightcove\API\Request;

use Brightcove\Object\ObjectBase;

class IngestRequestRetranscode extends ObjectBase {
    protected $use_archived_master;

    public function applyJSON(array $json)
    {
        parent::applyJSON($json);
        $this->applyProperty($json, 'url');
    }

    /**
     * @return string
     */
    public function getUseArchivedMaster()
    {
        return $this->getUseArchivedMaster();
    }

    /**
     * @param string $use_archived_master
     * @return $this
     */
    public function setUseArchivedMaster($bool = true)
    {
        $this->use_archived_master = $bool;
        $this->fieldChanged('use_archived_master');
        return $this;
    }
}
