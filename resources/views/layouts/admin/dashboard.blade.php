@extends('layouts.admin')
@section('title', 'Dashboard')

<div class="space-y-8">
    <x-admin.stats-grid />
    <x-admin.revenue-chart />
    <x-admin.recent-orders :recent-orders="$recentOrders ?? []" />
</div>
