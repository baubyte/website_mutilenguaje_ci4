<?php

namespace App\Commands;

use CodeIgniter\CLI\CLI;

class ListDatabases extends BaseCommand
{

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'db:list';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'DB.lists_databases';

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $sql = 'SELECT
                    SCHEMA_NAME AS "database",
                    DEFAULT_COLLATION_NAME AS "collation"
                FROM
                    information_schema.SCHEMATA
                ORDER BY SCHEMA_NAME';

        $databases = $this->db->query($sql)->getResultArray();

        if (!$databases) {
            CLI::write(lang('DB.no_databases'));
            return;
        }

        $sql = 'SELECT
                    TABLE_SCHEMA AS "database",
                    SUM(DATA_LENGTH + INDEX_LENGTH) AS "size",
                    COUNT(
                        DISTINCT CONCAT(TABLE_SCHEMA, ".", TABLE_NAME)
                    ) AS "tables"
                FROM
                    information_schema.TABLES
                GROUP BY TABLE_SCHEMA';

        $infromations = $this->db->query($sql)->getResultArray();

        helper('number');

        foreach ($databases as &$database) {
            $database['size'] = $database['tables'] = 0;

            foreach ($infromations as $information) {
                if ($information['database'] === $database['database']) {
                    $database['tables'] = $information['tables'];
                    $database['size']   = number_to_size($information['size']);
                    break;
                }
            }
        }

        CLI::table($databases, [
            lang('DB.database'),
            lang('DB.collation'),
            lang('DB.tables'),
            lang('DB.size'),
        ]);

        CLI::write(lang('DB.total') . ': ' . count($databases));
    }
}
