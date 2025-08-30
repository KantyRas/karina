@php
    $raw = isset($status) ? $status : 'en_attente';
    $intMap = [
        0 => 'en_attente',
        1 => 'valide',
        2 => 'rejete',
    ];
    if (is_numeric($raw)) {
        $key = $intMap[(int)$raw] ?? 'en_attente';
    } else {
        $key = strtolower(trim($raw));
        $key = str_replace([' ', '-', '/'], '_', $key);
    }
    $statusMap = [
        'valide'     => ['class' => 'label label-success', 'icon' => 'fa-check', 'text' => 'Validé'],
        'rejete'     => ['class' => 'label label-danger',  'icon' => 'fa-times', 'text' => 'Rejeté'],
        'en_attente' => ['class' => 'label label-warning',   'icon' => 'fa-refresh fa-spin', 'text' => 'En attente'],
    ];

    $current = $statusMap[$key] ?? $statusMap['en_attente'];
@endphp

<span class="{{ $current['class'] }}" style="padding:6px 10px; border-radius:20px;">
    <i class="fa {{ $current['icon'] }}"></i> {{ $current['text'] }}
</span>
