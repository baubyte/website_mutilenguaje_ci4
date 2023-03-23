<?php

namespace App\Commands;

use App\Models\Settings\MaintenanceModel;
use CodeIgniter\CLI\CLI;

class MaintenanceModeStatus extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Maintenance mode';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'mm:status';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'MM.status_description';

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $maintenanceModel = new MaintenanceModel();
        try {
            $status = ($maintenanceModel->getMaintenanceStatus() == 1) ? lang('MM.status_active') : lang('MM.status_inactive') ;
            if ($status === null) {
                CLI::write(lang('MM.switch_error') , 'red');
                return;
            }
            CLI::write(lang('MM.status').CLI::color($status, 'yellow') , 'green');
        } catch (\Exception $e) {
            CLI::write(lang('MM.switch_failed', [$status]) . $e->getMessage(), 'red');
        }
    }

}
