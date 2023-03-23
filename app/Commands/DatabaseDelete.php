<?php

namespace App\Commands;

use CodeIgniter\CLI\CLI;

class DatabaseDelete extends BaseCommand
{

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'db:delete';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'DB.deletes_database';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'db:delete [database]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [
        'database' => 'DB.database_name',
    ];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $database = array_shift($params);

        if (empty($database)) {
            $database = CLI::prompt(lang('DB.database_name'), null, 'regex_match[\w.]');
        }

        $show = $this->db->query('SHOW DATABASES LIKE :database:', [
            'database' => $database,
        ])->getRowArray();

        if (empty($show)) {
            CLI::error(lang('DB.database_not_exists', [$database]));
            return;
        }

        $result = $this->forge->dropDatabase($database);

        if ($result) {
            CLI::write(lang('DB.database_deleted', [$database]), 'green');
            return;
        }

        CLI::error(lang('DB.database_not_deleted', [$database]));
    }
}
