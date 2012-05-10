<?php

namespace CdliTwoStageSignupTest\Framework;

use Zend\Db\Adapter\Adapter;

class MapperTestCase extends TestCase
{

    public function setUp()
    {
        $this->db = $this->getLocator()->get('Zend\Db\Adapter\Adapter');
        $this->dbSchemaDown();
        $this->dbSchemaUp();
    }

    protected function dbSchemaDown()
    {
        $this->db->query('DROP TABLE IF EXISTS user_signup_email_verification;')->execute();
    }

    protected function dbSchemaUp()
    {
        $sqlfile = explode(';',file_get_contents(__DIR__ . '/../../../data/schema.sqlite.sql'));
        foreach ( $sqlfile as $sqlStmt ) {
            $sqlStmt = trim($sqlStmt);
            if ( !empty($sqlStmt) ) {
                $this->db->query($sqlStmt)->execute();
            }
        }
    }

}
