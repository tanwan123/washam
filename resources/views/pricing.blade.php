@extends('layouts.app')

@section('title', 'Pricing - Washam Laundry')

@section('content')
<h2 class="text-3xl font-bold text-primary text-center mb-8">Affordable Pricing Plans</h2>
<div class="grid md:grid-cols-3 gap-8">
    <div class="bg-white shadow rounded-2xl p-8 text-center hover:shadow-lg transition">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Basic</h3>
        <p class="text-primary text-4xl font-bold mb-4">$10</p>
        <ul class="text-gray-500 space-y-2">
            <li>5kg of clothes</li>
            <li>Fold only</li>
            <li>2-day delivery</li>
        </ul>
    </div>
    <div class="bg-primary text-white shadow rounded-2xl p-8 text-center transform scale-105">
        <h3 class="text-2xl font-semibold mb-4">Standard</h3>
        <p class="text-4xl font-bold mb-4">$20</p>
        <ul class="space-y-2">
            <li>10kg of clothes</li>
            <li>Wash & Fold</li>
            <li>Next-day delivery</li>
        </ul>
    </div>
    <div class="bg-white shadow rounded-2xl p-8 text-center hover:shadow-lg transition">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Premium</h3>
        <p class="text-primary text-4xl font-bold mb-4">$30</p>
        <ul class="text-gray-500 space-y-2">
            <li>Unlimited clothes</li>
            <li>Wash, Fold & Iron</li>
            <li>Same-day delivery</li>
        </ul>
    </div>
</div>
@endsection
