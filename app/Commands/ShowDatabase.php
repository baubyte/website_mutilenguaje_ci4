<?php

namespace App\Commands;

use CodeIgniter\CLI\CLI;

class ShowDatabase extends BaseCommand
{

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'db:show';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'DB.shows_database';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'db:show [database]';

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
            $group    = $this->getDatabaseGroup();
            $default  = config('Database')->{$group}['database'] ?? null;
            $database = CLI::prompt(lang('DB.database_name'), $default, 'regex_match[\w.]');
            CLI::newLine();
        }

        $show = $this->db->query('SHOW DATABASES LIKE :database:', [
            'database' => $database,
        ])->getRowArray();

        if (empty($show)) {
            CLI::beep();
            CLI::error(lang('DB.database_not_found', [$database]));
            return;
        }

        $list = $this->getTableList($database);

        if ($list) {
            CLI::write(
                CLI::color(lang('DB.database') . ': ', 'white') . CLI::color($database, 'yellow')
            );
            CLI::table($list, array_keys($list[0]));
            CLI::write(lang('DB.total') . ': ' . count($list));
            return;
        }

        CLI::write(lang('DB.database_no_tables', [$database]));
    }

    /**
     * Get table list
     *
     * @param string $database
     * @return array
     */
    public function getTableList(string $database): array
	{
		$sql = 'SELECT
                    TABLE_NAME,
                    ENGINE,
                    TABLE_COLLATION,
                    DATA_LENGTH,
                    INDEX_LENGTH,
                    DATA_FREE,
                    AUTO_INCREMENT,
                    TABLE_ROWS,
                    TABLE_COMMENT
                FROM
                    information_schema.TABLES
                WHERE TABLE_SCHEMA = :database:
                ORDER BY TABLE_NAME';

		$tables = $this->db->query($sql, ['database' => $database])
		                   ->getResultArray();

		$list = [];

		helper('number');

		foreach ($tables as $table)
		{
			$list[] = [
				lang('DB.table_name')       => $table['TABLE_NAME'],
				lang('DB.engine')           => $table['ENGINE'],
				lang('DB.collation')        => $table['TABLE_COLLATION'],
				lang('DB.data_length')      => number_to_size($table['DATA_LENGTH']),
				lang('DB.index_length')     => number_to_size($table['INDEX_LENGTH']),
				lang('DB.data_free')        => number_to_size($table['DATA_FREE']),
				lang('DB.auto_increment')   => $table['AUTO_INCREMENT'],
				lang('DB.rows')             => $table['TABLE_ROWS'],
				lang('DB.comment')          => $table['TABLE_COMMENT'],
			];
		}

		return $list;
	}
}
