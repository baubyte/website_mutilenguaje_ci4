<?php

namespace App\Models\Settings;

use CodeIgniter\Model;

class MaintenanceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'maintenance';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    /**
     * Get maintenance status
     *
     * @return int 1 = maintenance mode, 0 = normal mode
     */
    public function getMaintenanceStatus(){

        if (null === $status = cache("maintenance_status")) {
            $status = (int)$this->select('status')->first()->status;
            cache()->save("maintenance_status", $status, 300);
        }

        return $status;
    }

    /**
     * Update maintenance status
     *
     * @return bool
     */
    public function updateMaintenanceStatus(){
        $status = $this->getMaintenanceStatus();
        $status = $status === 1 ? 0 : 1;
        $this->set('status', $status);
        $this->update($this->select('id')->first()->id, ['status' => $status]);
        cache()->save("maintenance_status", $status, 300);
        return true;
    }
}