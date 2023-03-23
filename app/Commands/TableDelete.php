<?php

namespace App\Commands;


use CodeIgniter\CLI\CLI;

class TableDelete extends BaseCommand
{
    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'db:delete_table';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'DB.deletes_table';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'db:delete_table [table]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [
        'table' => 'DB.table_name',
    ];


    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $table = array_shift($params);

        if (empty($table)) {
            $table = CLI::prompt(lang('DB.table_name'), null, 'regex_match[\w.]');
        }

        if (strpos($table, '.') !== false) {
            [$database, $table] = explode('.', $table, 2);

            $this->db->setDatabase($database);
        }

        $show = $this->db->query('SHOW TABLES LIKE :table:', [
            'table' => $table,
        ])->getRowArray();

        if (empty($show)) {
            CLI::error(lang('DB.table_not_exists', [$table]));
            return;
        }

        $result = $this->forge->dropTable($table);

        if ($result) {
            CLI::write(lang('DB.table_deleted', [$table]), 'green');
            return;
        }

        CLI::error(lang('DB.table_not_deleted', [$table]));
    }
}
