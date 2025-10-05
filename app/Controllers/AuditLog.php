<?php

namespace App\Controllers;

use App\Models\AuditLogModel;

class AuditLog extends BaseController
{
    public function index()
    {
        $model = new AuditLogModel();
        $perPage = 10;
        $page    = (int) ($this->request->getVar('page_user') ?? 1);

        $data['logs'] = $model->orderBy('performed_at', 'DESC')
                                ->paginate($perPage, 'logs');

        $data['pager'] = $model->pager;
        $data['currentPage'] = $page;
        $data['perPage'] = $perPage;

        return view('audit/index', $data);
    }

    public function detail($id)
    {
        $logModel = new \App\Models\AuditLogModel();
        $log = $logModel->find($id);

        $oldData = json_decode($log['old_data'], true) ?? [];
        $newData = json_decode($log['new_data'], true) ?? [];

        // Table View (key–value diff)
        $kvDiff = [];
        foreach (array_unique(array_merge(array_keys($oldData), array_keys($newData))) as $field) {
            $kvDiff[$field] = [
                'old' => $oldData[$field] ?? '',
                'new' => $newData[$field] ?? '',
                'changed' => ($oldData[$field] ?? '') !== ($newData[$field] ?? ''),
            ];
        }

        // GitHub Diff View (line-by-line per field)
        $lineDiff = [];
        $i = 0;
        foreach ($kvDiff as $field => $row) {
            $lineDiff[] = [
                'line' => ++$i,
                'field' => $field,
                'old' => $row['old'],
                'new' => $row['new'],
                'changed' => $row['changed'],
            ];
        }

        return view('audit/detail', [
            'log' => $log,
            'kvDiff' => $kvDiff,
            'lineDiff' => $lineDiff,
        ]);
    }
}