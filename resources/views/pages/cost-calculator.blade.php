@extends('layouts.app')

@push('tracking_data')
<script>window.__trackingData = { page_type: 'cost_calculator', content_name: 'cost_calculator' };</script>
@endpush

@section('title', 'NYC Renovation Cost Calculator | Blue Draft')
@section('meta_description', 'Estimate your renovation costs in New York City. Kitchen, bathroom, basement, and commercial remodeling cost ranges. Borough-adjusted pricing.')

@push('meta')
    <link rel="canonical" href="{{ route('cost-calculator') }}">
    <meta property="og:title" content="NYC Renovation Cost Calculator | Blue Draft">
    <meta property="og:description" content="Estimate your renovation costs in NYC. Kitchen, bathroom, basement, and more. Borough-adjusted pricing.">
    <meta property="og:url" content="{{ route('cost-calculator') }}">
    <meta property="og:type" content="website">
@endpush

@push('schema')
<x-schema-breadcrumb :items="[
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Cost Calculator', 'url' => route('cost-calculator')],
]" />
@endpush

@section('content')
<section class="py-24 bg-gradient-to-br from-[#003366] to-[#336699]">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
        <nav class="text-sm text-white/80 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            <span class="mx-2">/</span>
            <span>Cost Calculator</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-4">
            NYC Renovation Cost Calculator
        </h1>
        <p class="text-xl text-white/90">
            Get a quick estimate for your renovation project. Prices are adjusted for the NYC market.
        </p>
    </div>
</section>

@php
    $config = [
        'priceRanges' => $priceRanges ?? [],
        'typeBoroughMultipliers' => $typeBoroughMultipliers ?? [],
        'boroughMultipliers' => $boroughMultipliers ?? [],
        'finishMultipliers' => $finishMultipliers ?? [],
        'sqftAdjustments' => $sqftAdjustments ?? [],
        'timelines' => $timelines ?? [],
        'confidenceText' => $confidenceText ?? '',
        'urgencyText' => $urgencyText ?? '',
        'breakdownPct' => $breakdownPct ?? [],
        'lockQuoteUrl' => $lockQuoteUrl ?? '',
        'algorithmVersion' => $algorithmVersion ?? '2.1',
    ];
@endphp
<script type="text/javascript">
    window.__costCalculatorConfig = @json($config);
</script>
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8" x-data="costCalculator()">
        <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 shadow-lg">
            {{-- Step indicator --}}
            <div class="flex items-center justify-center gap-2 mb-8">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Step <span x-text="step"></span> of 2</span>
                <div class="flex gap-1">
                    <div class="w-8 h-1 rounded-full transition-colors" :class="step >= 1 ? 'bg-[#003366]' : 'bg-gray-300 dark:bg-gray-600'"></div>
                    <div class="w-8 h-1 rounded-full transition-colors" :class="step >= 2 ? 'bg-[#003366]' : 'bg-gray-300 dark:bg-gray-600'"></div>
                </div>
            </div>

            {{-- Step 1: sqft + type --}}
            <div x-show="step === 1" class="space-y-6">
                <div>
                    <label for="sqft" class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Square footage (sq ft)</label>
                    <input type="number" id="sqft" min="1" max="10000" step="1"
                           x-model.number="sqft"
                           @input="calculate()"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-[#003366] dark:text-gray-100 focus:ring-2 focus:ring-[#336699] focus:border-transparent"
                           placeholder="e.g. 150">
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Type of renovation</label>
                    <select id="type"
                            x-model="type"
                            @change="calculate()"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-[#003366] dark:text-gray-100 focus:ring-2 focus:ring-[#336699] focus:border-transparent">
                        <option value="kitchen">Kitchen Remodeling</option>
                        <option value="bathroom">Bathroom Renovation</option>
                        <option value="basement">Basement Finishing</option>
                        <option value="whole_house">Whole House Renovation</option>
                        <option value="commercial">Commercial</option>
                    </select>
                </div>
                <button type="button" @click="step = 2; calculate(); trackStep1Complete()"
                        :disabled="sqft < 1"
                        class="w-full py-3 px-6 bg-[#003366] dark:bg-[#336699] text-white rounded-lg font-medium hover:bg-[#004080] disabled:opacity-50 disabled:cursor-not-allowed transition-all">
                    Continue to refine estimate →
                </button>
            </div>

            {{-- Step 2: borough + finish --}}
            <div x-show="step === 2" x-cloak class="space-y-6">
                <button type="button" @click="step = 1" class="text-sm text-[#336699] hover:underline mb-2">← Back</button>
                <div>
                    <label for="borough" class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Location</label>
                    <select id="borough"
                            x-model="borough"
                            @change="calculate()"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-[#003366] dark:text-gray-100 focus:ring-2 focus:ring-[#336699] focus:border-transparent">
                        <option value="manhattan">Manhattan</option>
                        <option value="brooklyn">Brooklyn</option>
                        <option value="queens">Queens</option>
                        <option value="bronx">The Bronx</option>
                        <option value="nj">New Jersey</option>
                    </select>
                </div>
                <div>
                    <label for="finish" class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Finish level</label>
                    <select id="finish"
                            x-model="finish"
                            @change="calculate()"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-[#003366] dark:text-gray-100 focus:ring-2 focus:ring-[#336699] focus:border-transparent">
                        <option value="basic">Basic</option>
                        <option value="standard">Standard</option>
                        <option value="premium">Premium</option>
                    </select>
                </div>
            </div>

            {{-- Estimate result (shown when step 2 and sqft > 0) --}}
            <div x-show="step === 2 && sqft > 0" x-cloak
                 class="mt-8 p-6 bg-[#003366]/10 dark:bg-[#336699]/20 rounded-xl border border-[#336699]/30">
                <h3 class="text-lg font-semibold text-[#003366] dark:text-white mb-2">Estimated Total</h3>
                <p class="text-2xl font-bold text-[#003366] dark:text-white">
                    <span x-text="formatCurrency(minEstimate)"></span>
                    –
                    <span x-text="formatCurrency(maxEstimate)"></span>
                </p>
                <div class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                    <strong>Includes:</strong>
                    <div class="mt-1 grid grid-cols-2 gap-x-4 gap-y-0.5 text-xs" x-show="breakdownPct && Object.keys(breakdownPct).length">
                        <span x-show="breakdownPct.labor">Labor ~<span x-text="breakdownPct.labor"></span>%</span>
                        <span x-show="breakdownPct.materials">Materials ~<span x-text="breakdownPct.materials"></span>%</span>
                        <span x-show="breakdownPct.permits">Permits ~<span x-text="breakdownPct.permits"></span>%</span>
                        <span x-show="breakdownPct.management">Management ~<span x-text="breakdownPct.management"></span>%</span>
                    </div>
                    <p class="mt-1" x-show="!breakdownPct || !Object.keys(breakdownPct || {}).length">Labor • Materials • Permits • Project management</p>
                </div>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Based on <span x-text="sqft"></span> sq ft at $<span x-text="Math.round(range.min)"></span>–$<span x-text="Math.round(range.max)"></span> per sq ft.
                    <span x-text="boroughLabel"></span> pricing.
                </p>
                <p class="mt-1 text-xs text-[#336699] dark:text-[#4a90e2] font-medium">
                    Estimates adjusted for local NYC market conditions.
                </p>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400" x-show="timeline">
                    <strong>Average timeline:</strong> <span x-text="timeline"></span>
                </p>
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-500" x-show="confidenceText">
                    <span x-text="confidenceText"></span>
                </p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400" x-show="urgencyText">
                    <span x-text="urgencyText"></span>
                </p>
                <a :href="lockEstimateUrl()"
                   @click="trackCtaClick()"
                   class="mt-4 inline-flex items-center bg-[#003366] dark:bg-[#336699] text-white px-6 py-3 rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium text-sm">
                    {{ $hero['cta_lock_estimate'] ?? 'Lock This Estimate — Send to Our Project Manager' }}
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>
        </div>

        <div class="mt-12 text-center">
            <p class="text-gray-600 dark:text-gray-400 mb-4">For a detailed, custom quote tailored to your project:</p>
            <a href="{{ route('home') }}#quote" class="inline-flex items-center bg-[#003366] dark:bg-[#336699] text-white px-8 py-4 rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium text-lg">
                {{ $hero['cta_text'] }}
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>

        <p class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
            <a href="{{ route('lead-magnet.show') }}" class="text-[#336699] hover:underline">Download our free renovation guide</a> for more tips.
        </p>
    </div>
</section>

<script>
function costCalculator() {
    const cfg = window.__costCalculatorConfig || {};
    const priceRanges = cfg.priceRanges || {};
    const typeBoroughMultipliers = cfg.typeBoroughMultipliers || {};
    const boroughMultipliers = cfg.boroughMultipliers || { manhattan: 1.3, brooklyn: 1.15, queens: 1.05, bronx: 0.95, nj: 1.0 };
    const finishMultipliers = cfg.finishMultipliers || { basic: 0.9, standard: 1.0, premium: 1.25 };
    const sqftAdj = cfg.sqftAdjustments || { small_threshold: 150, small_multiplier: 1.10, large_threshold: 800, large_multiplier: 0.92 };
    const typeToService = { kitchen: 'renovation', bathroom: 'renovation', basement: 'renovation', whole_house: 'residential', commercial: 'commercial' };
    const boroughLabels = { manhattan: 'Manhattan', brooklyn: 'Brooklyn', queens: 'Queens', bronx: 'Bronx', nj: 'New Jersey' };
    const typeToBudget = (min, max) => {
        if (max <= 25000) return 'under-25k';
        if (min >= 100000) return 'over-100k';
        if (min >= 50000) return '50k-100k';
        return '25k-50k';
    };
    return {
        priceRanges,
        typeBoroughMultipliers,
        boroughMultipliers,
        finishMultipliers,
        sqftAdjustments: sqftAdj,
        timelines: cfg.timelines || {},
        confidenceText: cfg.confidenceText || '',
        urgencyText: cfg.urgencyText || '',
        breakdownPct: cfg.breakdownPct || {},
        baseQuoteUrl: cfg.lockQuoteUrl || (window.location.origin + '/#quote'),
        algorithmVersion: cfg.algorithmVersion || '2.1',
        step: 1,
        sqft: 150,
        type: 'kitchen',
        borough: 'manhattan',
        finish: 'standard',
        minEstimate: 0,
        maxEstimate: 0,
        range: { min: 0, max: 0 },
        timeline: '',
        boroughLabel: '',
        estimateTracked: false,
        step1Tracked: false,
        step2Tracked: false,
        ctaTracked: false,
        init() {
            this.calculate();
            this.$watch('step', (val) => { if (val === 2) this.trackStep2Complete(); });
        },
        getBoroughMult() {
            const typeMatrix = this.typeBoroughMultipliers[this.type];
            if (typeMatrix && typeMatrix[this.borough] != null) return typeMatrix[this.borough];
            return this.boroughMultipliers[this.borough] ?? 1.0;
        },
        getSqftMult(sq) {
            const adj = this.sqftAdjustments || {};
            if (sq < (adj.small_threshold || 150)) return adj.small_multiplier || 1.10;
            if (sq > (adj.large_threshold || 800)) return adj.large_multiplier || 0.92;
            return 1.0;
        },
        trackStep1Complete() {
            if (!this.step1Tracked && typeof window.trackEvent === 'function') {
                this.step1Tracked = true;
                window.trackEvent('calculator_step_1_completed', { sqft: this.sqft, type: this.type });
            }
        },
        trackStep2Complete() {
            if (!this.step2Tracked && typeof window.trackEvent === 'function') {
                this.step2Tracked = true;
                window.trackEvent('calculator_step_2_completed', { borough: this.borough, finish: this.finish });
            }
        },
        trackCtaClick() {
            if (!this.ctaTracked && typeof window.trackEvent === 'function') {
                this.ctaTracked = true;
                window.trackEvent('calculator_cta_clicked', {
                    min: this.minEstimate, max: this.maxEstimate,
                    sqft: this.sqft, type: this.type, borough: this.borough, finish: this.finish
                });
            }
        },
        calculate() {
            const r = this.priceRanges[this.type] || this.priceRanges.kitchen || { min: 150, max: 350 };
            const bMult = this.getBoroughMult();
            const fMult = this.finishMultipliers[this.finish] ?? 1.0;
            const sq = Math.max(0, parseInt(this.sqft) || 0);
            const sqftMult = this.getSqftMult(sq);
            this.range = {
                min: r.min * bMult * fMult * sqftMult,
                max: r.max * bMult * fMult * sqftMult
            };
            this.minEstimate = Math.round(sq * this.range.min);
            this.maxEstimate = Math.round(sq * this.range.max);
            this.timeline = this.timelines[this.type] || '';
            this.boroughLabel = boroughLabels[this.borough] ? boroughLabels[this.borough] + '-adjusted' : '';
            if (sq > 0 && !this.estimateTracked && typeof window.trackEvent === 'function') {
                this.estimateTracked = true;
                window.trackEvent('calculator_estimate', {
                    sqft: sq, type: this.type, borough: this.borough, finish: this.finish,
                    min: this.minEstimate, max: this.maxEstimate
                });
            }
        },
        calcHash() {
            const input = [this.sqft, this.type, this.borough, this.finish, this.algorithmVersion].join('|');
            let h = 5381;
            for (let i = 0; i < input.length; i++) h = ((h << 5) + h) + input.charCodeAt(i);
            return (h >>> 0).toString(16) + (Math.abs((h * 31) >>> 0)).toString(16).slice(0, 8);
        },
        lockEstimateUrl() {
            const base = this.baseQuoteUrl.split('#')[0];
            const sep = base.includes('?') ? '&' : '?';
            const mid = Math.round((this.minEstimate + this.maxEstimate) / 2);
            const params = new URLSearchParams({
                budget: typeToBudget(this.minEstimate, this.maxEstimate),
                service: typeToService[this.type],
                budget_min: this.minEstimate,
                budget_max: this.maxEstimate,
                estimated_value: mid,
                calc_sqft: this.sqft,
                calc_type: this.type,
                calc_borough: this.borough,
                calc_finish: this.finish,
                calc_version: this.algorithmVersion,
                calc_hash: this.calcHash()
            });
            return base + sep + params.toString() + '#quote';
        },
        formatCurrency(n) {
            return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 }).format(n);
        }
    };
}
</script>
@endsection
