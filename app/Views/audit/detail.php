<!DOCTYPE html>
<html>
<head>
    <title>Audit Log Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .diff-table {
            width: 100%;
            border-collapse: collapse;
            font-family: monospace;
        }
        .diff-table th, .diff-table td {
            border: 1px solid #ddd;
            padding: 6px 10px;
            vertical-align: top;
        }
        .line-num {
            width: 40px;
            text-align: right;
            color: #666;
            background: #f8f9fa;
        }
        .removed { background-color: #f8d7da; }
        .added   { background-color: #d4edda; }
        .unchanged { background-color: #fff; }
    </style>
</head>
<body class="p-4">

    <h2>Audit Log #<?= esc($log['id']) ?></h2>
    <p><strong>Table:</strong> <?= esc($log['table_name']) ?></p>
    <p><strong>Record ID:</strong> <?= esc($log['record_id']) ?></p>
    <p><strong>Action:</strong> <?= esc($log['action']) ?></p>
    <p><strong>Performed By:</strong> <?= esc($log['performed_by']) ?></p>
    <p><strong>Session ID:</strong> <?= esc($log['session_id']) ?></p>
    <p><strong>Performed At:</strong> <?= esc($log['performed_at']) ?></p>

    <!-- Toggle Buttons -->
    <div class="mb-3">
        <button class="btn btn-outline-primary btn-sm" onclick="showView('tableView')">Table View</button>
        <button class="btn btn-outline-success btn-sm" onclick="showView('diffView')">GitHub Diff View</button>
    </div>

    <!-- View 1: Table Key-Value -->
    <div id="tableView" class="mt-3" style="display: none;">
        <h4>Table Comparison</h4>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Field</th>
                    <th>Old Value</th>
                    <th>New Value</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kvDiff as $field => $row): ?>
                    <tr>
                        <td><strong><?= esc($field) ?></strong></td>
                        <td class="<?= $row['changed'] ? 'text-danger' : '' ?>">
                            <?= esc($row['old']) ?>
                        </td>
                        <td class="<?= $row['changed'] ? 'text-success' : '' ?>">
                            <?= esc($row['new']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- View 2: GitHub Diff Side-by-Side -->
    <div id="diffView" class="mt-3">
        <h4>Side-by-Side GitHub Diff</h4>
        <table class="diff-table table-sm">
            <thead class="table-light">
                <tr>
                    <th>Line</th>
                    <th>Field</th>
                    <th>Old Value</th>
                    <th>Line</th>
                    <th>Field</th>
                    <th>New Value</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lineDiff as $row): ?>
                    <tr>
                        <td class="line-num"><?= $row['line'] ?></td>
                        <td><?= esc($row['field']) ?></td>
                        <td class="<?= $row['changed'] ? 'removed' : 'unchanged' ?>">
                            <?= esc($row['old']) ?>
                        </td>
                        <td class="line-num"><?= $row['line'] ?></td>
                        <td><?= esc($row['field']) ?></td>
                        <td class="<?= $row['changed'] ? 'added' : 'unchanged' ?>">
                            <?= esc($row['new']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="<?= site_url('auditlog') ?>" class="btn btn-secondary mt-3">Back</a>

    <script>
        function showView(viewId) {
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('diffView').style.display = 'none';
            document.getElementById(viewId).style.display = 'block';
        }
    </script>
</body>
</html>