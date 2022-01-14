<?php

namespace Boa;


class Connect
{
    public function __construct()
    {
        /**
         * Driver name	  Supported databases
         * PDO_CUBRID	  Cubrid
         * PDO_DBLIB	  FreeTDS / Microsoft SQL Server / Sybase
         * PDO_FIREBIRD	  Firebird
         * PDO_IBM	      IBM DB2
         * PDO_INFORMIX	  IBM Informix Dynamic Server
         * PDO_MYSQL	  MySQL 3.x/4.x/5.x
         * PDO_OCI	      Oracle Call Interface
         * PDO_ODBC	      ODBC v3 (IBM DB2, unixODBC and win32 ODBC)
         * PDO_PGSQL	 PostgreSQL
         * PDO_SQLITE	 SQLite 3 and SQLite 2
         * PDO_SQLSRV	 Microsoft SQL Server / SQL Azure
         */
        $boa_config = array (
            'db_driver' => 'PDO_MYSQL',
            'db_hostname' => 'hostname'
        );
    }
}