<?php
namespace Welcomelafayette\Lib;

use Aura\SqlQuery\QueryFactory;
use Aura\Sql\ExtendedPdo;
use WelcomeLafayette\Lib\Config;

/**
 * a Database Abstraction Layer
 */
abstract class DBAL
{
    public $DB_TYPE = '___DB_TYPE___';
    public $DB_TABLE = '___TABLE_NAME___';

    /**
     * @var Config
     */
    public $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->extendedPdo = $this->makeExtendedPdo();
    }

    /**
     * @return QueryFactory
     */
    public function makeQueryFactory()
    {
        return new QueryFactory($this->DB_TYPE);
    }

    public function makeExtendedPdo()
    {
        return new ExtendedPdo($this->config->get('db.pdo.connect')); 
    }

    public function getExtendedPdo()
    {
        return $this->extendedPdo;
    }

    /**
     * [sendQuery description]
     * @param  Aura\SqlQuery\Common\Select|Aura\SqlQuery\Common\Insert|Aura\SqlQuery\Common\Update|Aura\SqlQuery\Common\Delete $query [description]
     * @return PDOStatement
     */
    public function sendQuery($query)
    {
        // prepare the statement
        $sth = $this->extendedPdo->prepare($query->__toString());

        // execute with bound values
        $sth->execute($query->getBindValues());

        return $sth;
    }

    /**
     * return an array of rows.
     * @param  integer $limit default 10
     * @param  integer $skip default 0
     * @param  array $where an array of column/val pairs for matching
     * @return array
     * @throws Exception
     */
    public function getAll($limit = 10, $skip = 0, array $where = [])
    {
        $select = $this->makeQueryFactory()->newSelect();
        throw new Exception("Not Yet Implemented");
    }

    /**
     * returns a single record by ID
     * @param  int   $id
     * @return array
     */
    public function getById($id)
    {
        $select = $this->makeQueryFactory()->newSelect();
        $select->from($this->DB_TABLE)
            ->cols(array(
                '*',
            ))
            ->where('id = :id')
            ->bindValue('id', $id);
        $sth = $this->sendQuery($select);
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }



    abstract public function save(array $record_data);
}
