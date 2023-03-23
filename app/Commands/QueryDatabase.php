<?php

namespace App\Commands;

use CodeIgniter\CLI\CLI;

class QueryDatabase extends BaseCommand
{
    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'db:query';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'DB.executes_query';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'db:query [query]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [
        'query' => 'DB.query_to_execute',
    ];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $query = array_shift($params);

        if (empty($query)) {
            $query = CLI::prompt(lang('DB.query'), null, 'required');
        }

        CLI::write(
            CLI::color(lang('DB.query') . ': ', 'white') . CLI::color($query, 'yellow')
        );

        try {
            $result = $this->db->query($query);
        } catch (\Exception $e) {
            CLI::error($e->getMessage());
            return;
        }

        if ($this->db->getLastQuery()->isWriteType()) {
            CLI::write(lang('DB.affected_rows', [$this->db->affectedRows()]));

            if ($this->db->insertID()) {
                CLI::write(
                    lang('DB.last_insert_id') . ': ' . CLI::color($this->db->insertID(), 'green')
                );
            }
            return;
        }

        $result = $result->getResultArray();

        if (empty($result)) {
            CLI::write(lang('DB.no_results'));
            return;
        }
        CLI::table($result, array_keys($result[0]));
    }
}
