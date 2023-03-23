<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\Settings\MaintenanceModel;

class MaintenanceController extends BaseController
{
    /**
     * Retorno de la vista de mantenimiento
     *
	 * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function index()
    {
        $status = cache("maintenance_status");
        if (!is_null($status) && $status === 1){
            return view('Website/maintenance/maintenance_mode');
        }
        return redirect()->route('home');
    }

    /**
     * Actualizar el estado del mantenimiento
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function maintenance_update(){
        $maintenanceModel = new MaintenanceModel();
        $maintenanceModel->updateMaintenanceStatus();
        return redirect()->route('dashboard');
    }
}

