<?php
$dataPath = __DIR__ . '/data/grievances.json';
$grievances = file_exists($dataPath) ? json_decode(file_get_contents($dataPath), true) ?: [] : [];

// Status update handling
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $id = trim($_POST['id'] ?? '');
    $newStatus = trim($_POST['status'] ?? '');
    $notes = trim($_POST['notes'] ?? '');

    foreach ($grievances as &$g) {
        if ($g['id'] === $id) {
            $g['status'] = $newStatus;
            if (!empty($notes)) {
                $g['notes'] = $notes;
            }
            $message = "Status for {$id} updated to '{$newStatus}'.";
            break;
        }
    }
    file_put_contents($dataPath, json_encode($grievances, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Summary stats
$total = count($grievances);
$received = count(array_filter($grievances, fn($g) => ($g['status'] ?? '') === 'Received'));
$inProgress = count(array_filter($grievances, fn($g) => in_array($g['status'] ?? '', ['In Progress', 'Action Initiated'])));
$resolved = count(array_filter($grievances, fn($g) => ($g['status'] ?? '') === 'Resolved'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praja Vani Portal - Vegesna Rohini Office Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Sans+Telugu:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "Inter", sans-serif; }
    </style>
</head>
<body class="bg-[#f5f5f7] text-[#1d1d1f] min-h-screen">
    
    <!-- Top Nav -->
    <header class="apple-nav sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 py-3.5 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="index.php" class="flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-full bg-[#1d1d1f] flex items-center justify-center font-bold text-white text-xs">VR</span>
                    <div>
                        <h1 class="text-sm font-semibold text-[#1d1d1f] leading-tight">Vegesna Rohini | వేగేశ్న రోహిణి</h1>
                        <p class="text-[11px] text-[#86868b]">Bhimavaram Praja Vani Office Dashboard</p>
                    </div>
                </a>
            </div>
            <div class="flex items-center gap-3">
                <a href="index.php" class="apple-btn-secondary px-3.5 py-1.5 text-xs">← Back to Portal</a>
                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">System Live</span>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <?php if (!empty($message)): ?>
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 text-xs font-medium">
                <span>✓</span> <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="apple-card p-6">
                <p class="text-[11px] font-semibold text-[#86868b] uppercase tracking-wider">Total Grievances</p>
                <p class="text-3xl font-semibold text-[#1d1d1f] mt-1"><?= $total ?></p>
                <p class="text-xs text-[#86868b] mt-1">Across 39 Bhimavaram Wards</p>
            </div>
            <div class="apple-card p-6">
                <p class="text-[11px] font-semibold text-[#d97706] uppercase tracking-wider">New / Received</p>
                <p class="text-3xl font-semibold text-[#d97706] mt-1"><?= $received ?></p>
                <p class="text-xs text-[#86868b] mt-1">Awaiting preliminary review</p>
            </div>
            <div class="apple-card p-6">
                <p class="text-[11px] font-semibold text-[#0071e3] uppercase tracking-wider">In Action / Progress</p>
                <p class="text-3xl font-semibold text-[#0071e3] mt-1"><?= $inProgress ?></p>
                <p class="text-xs text-[#86868b] mt-1">Under field team inspection</p>
            </div>
            <div class="apple-card p-6">
                <p class="text-[11px] font-semibold text-emerald-600 uppercase tracking-wider">Resolved</p>
                <p class="text-3xl font-semibold text-emerald-600 mt-1"><?= $resolved ?></p>
                <p class="text-xs text-[#86868b] mt-1">Verified with citizen feedback</p>
            </div>
        </div>

        <!-- Table of Grievances -->
        <div class="apple-card overflow-hidden">
            <div class="p-6 border-b border-[#f0f0f2] flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-base font-semibold text-[#1d1d1f]">Registered Citizen Grievances (ప్రజా సమస్యల జాబితా)</h2>
                    <p class="text-xs text-[#86868b]">Direct reports submitted through Vegesna Rohini's official public portal</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-[#424245]">
                    <thead class="bg-[#f5f5f7] text-[11px] uppercase text-[#86868b] border-b border-[#e5e5ea]">
                        <tr>
                            <th class="px-5 py-3.5 font-semibold">Tracking ID</th>
                            <th class="px-5 py-3.5 font-semibold">Citizen & Phone</th>
                            <th class="px-5 py-3.5 font-semibold">Ward & Locality</th>
                            <th class="px-5 py-3.5 font-semibold">Category</th>
                            <th class="px-5 py-3.5 font-semibold">Description</th>
                            <th class="px-5 py-3.5 font-semibold">Status</th>
                            <th class="px-5 py-3.5 text-right font-semibold">Update Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#f0f0f2]">
                        <?php if (empty($grievances)): ?>
                            <tr>
                                <td colspan="7" class="px-5 py-8 text-center text-[#86868b]">No grievances recorded yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($grievances as $g): ?>
                                <tr class="hover:bg-[#fbfbfd] transition">
                                    <td class="px-5 py-4 font-mono font-bold text-[#0071e3] whitespace-nowrap">
                                        <?= htmlspecialchars($g['id']) ?>
                                        <div class="text-[10px] text-[#86868b] font-sans font-normal"><?= htmlspecialchars($g['timestamp'] ?? '') ?></div>
                                    </td>
                                    <td class="px-5 py-4 font-medium text-[#1d1d1f] whitespace-nowrap">
                                        <?= htmlspecialchars($g['name']) ?>
                                        <div class="text-[11px] text-[#86868b]"><?= htmlspecialchars($g['phone']) ?></div>
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <span class="text-[#1d1d1f] font-medium"><?= htmlspecialchars($g['ward']) ?></span>
                                        <div class="text-[11px] text-[#86868b]"><?= htmlspecialchars($g['locality']) ?></div>
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <span class="inline-block px-2.5 py-1 rounded-full text-[11px] font-medium bg-[#f5f5f7] text-[#1d1d1f]">
                                            <?= htmlspecialchars($g['category']) ?>
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 max-w-xs text-xs text-[#424245]">
                                        <p class="line-clamp-2"><?= htmlspecialchars($g['description']) ?></p>
                                        <?php if (!empty($g['notes'])): ?>
                                            <p class="text-[11px] text-[#0071e3] mt-1 italic">Note: <?= htmlspecialchars($g['notes']) ?></p>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <?php
                                        $s = $g['status'] ?? 'Received';
                                        $badgeClass = match ($s) {
                                            'Resolved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'In Progress', 'Action Initiated' => 'bg-sky-50 text-sky-700 border-sky-200',
                                            default => 'bg-amber-50 text-amber-700 border-amber-200',
                                        };
                                        ?>
                                        <span class="px-2.5 py-1 text-[11px] font-semibold rounded-full border <?= $badgeClass ?>">
                                            <?= htmlspecialchars($s) ?>
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-right whitespace-nowrap">
                                        <form method="POST" class="inline-flex items-center gap-2">
                                            <input type="hidden" name="action" value="update_status">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($g['id']) ?>">
                                            <select name="status" class="bg-white border border-[#d2d2d7] text-xs text-[#1d1d1f] rounded-lg px-2.5 py-1 focus:border-[#0071e3] focus:outline-none">
                                                <option value="Received" <?= $s === 'Received' ? 'selected' : '' ?>>Received</option>
                                                <option value="In Progress" <?= $s === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                                                <option value="Action Initiated" <?= $s === 'Action Initiated' ? 'selected' : '' ?>>Action Initiated</option>
                                                <option value="Resolved" <?= $s === 'Resolved' ? 'selected' : '' ?>>Resolved</option>
                                            </select>
                                            <button type="submit" class="apple-btn-primary px-3 py-1 text-xs">Save</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
