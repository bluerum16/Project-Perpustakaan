<!DOCTYPE html>
<html>
<head>
    <title>Audit Logs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Audit Logs</h2>
        <div>
            <a href="<?= site_url('/') ?>" class="btn btn-sm btn-outline-secondary">Kembali</a>
        </div>
    </div>
    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Table</th>
                <th>Record</th>
                <th>Action</th>
                <th>User</th>
                <th>Session</th>
                <th>Time</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $row): ?>
                <tr>
                    <td><?= esc($row['id']) ?></td>
                    <td><?= esc($row['table_name']) ?></td>
                    <td><?= esc($row['record_id']) ?></td>
                    <td><span class="badge bg-info"><?= esc($row['action']) ?></span></td>
                    <td><?= esc($row['performed_by']) ?></td>
                    <td><?= esc($row['session_id']) ?></td>
                    <td><?= esc($row['performed_at']) ?></td>
                    <td><a href="<?= site_url('auditlog/detail/'.$row['id']) ?>" class="btn btn-sm btn-primary">Detail</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pager -->
    <?php if (! empty($logs)): ?>
    <nav class="d-flex justify-content-center mt-3" aria-label="Page navigation">
        <?= $pager->links('logs', 'bootstrap_full') ?>
    </nav>
    <?php endif; ?>
</body>
</html>