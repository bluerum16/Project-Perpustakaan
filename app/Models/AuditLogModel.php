<?php namespace App\Models;

use CodeIgniter\Model;

class AuditLogModel extends Model
{
    protected $table = 'audit_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'table_name', 'record_id', 'action',
        'old_data', 'new_data',
        'session_id', 'performed_by', 'performed_at'
    ];
}