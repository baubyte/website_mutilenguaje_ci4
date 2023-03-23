<?php

namespace App\Commands;

use CodeIgniter\CLI\CLI;
use Throwable;

class DatabaseClean extends BaseCommand
{

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'db:clean';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'DB.clean_database';

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

        $tables = $this->db->listTables(); 

        if ($tables === []) {
            CLI::error(lang('DB.database_no_tables', [$database]));
            return;
        }
        try {
            $result = [];
            CLI::write(lang('DB.database_cleaned_start', [$database]), 'green');
            foreach ($tables as $table) {
                $result[] = $this->forge->dropTable($table,true,true);
                CLI::write("\t".lang('DB.table_deleted', [$table]).' ...', 'yellow');
            }

            CLI::write(lang('DB.database_cleaned', [$database]), 'green');
            return;
        } catch (Throwable $e) {
            $this->showError($e);
        }
    }
}
