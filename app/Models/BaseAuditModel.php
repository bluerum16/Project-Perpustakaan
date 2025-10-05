<?php namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class BaseAuditModel extends Model
{
    protected $audit = true; // flag untuk audit
    protected $primaryKey = 'id';

    protected function logAudit($action, $id, $oldData = null, $newData = null)
    {
        if (!$this->audit) {
            return;
        }

        $auditModel = new \App\Models\AuditLogModel();

        $auditModel->insert([
            'table_name'   => $this->table,
            'record_id'    => $id,
            'action'       => $action,
            'old_data'     => $oldData ? json_encode($oldData) : null,
            'new_data'     => $newData ? json_encode($newData) : null,
            'session_id'   => session_id() ?? 'no session',
            'performed_by' => Services::session()->get('username') ?? 'system',
        ]);
    }

    public function insert($data = null, bool $returnID = true)
    {
        $id = parent::insert($data, $returnID);
        $this->logAudit('INSERT', $id, null, $data);
        return $id;
    }

    public function update($id = null, $data = null): bool
    {
        $oldData = $this->find($id);
        $result = parent::update($id, $data);
        $this->logAudit('UPDATE', $id, $oldData, $data);
        return $result;
    }

    public function delete($id = null, bool $purge = false)
    {
        $oldData = $this->find($id);
        $result = parent::delete($id, $purge);
        $this->logAudit('DELETE', $id, $oldData, null);
        return $result;
    }
}