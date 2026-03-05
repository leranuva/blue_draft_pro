@extends('layouts.app')

@push('tracking_data')
<script>window.__trackingData = { page_type: 'cost_calculator', content_name: 'cost_calculator' };</script>
@endpush

@section('title', 'NYC Renovation Cost Calculator | Blue Draft')
@section('meta_description', 'Estimate your renovation costs in NYC. Kitchen, bathroom, basement, whole house, and commercial remodeling. Borough-adjusted pricing with typical market ranges.')

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
        'timelinesDynamic' => $timelinesDynamic ?? [],
        'typicalRanges' => $typicalRanges ?? [],
        'boroughInsights' => $boroughInsights ?? [],
        'similarProjectExamples' => $similarProjectExamples ?? [],
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
            {{-- Progress bar --}}
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Step <span x-text="step"></span> of 2</span>
                    <span class="text-xs text-gray-500 dark:text-gray-500" x-text="step === 1 ? 'Basic info' : 'Refine estimate'"></span>
                </div>
                <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-[#003366] dark:bg-[#336699] transition-all duration-300" :style="'width: ' + (step * 50) + '%'"></div>
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

                {{-- Context: typical range vs your estimate --}}
                <div x-show="typicalRangeText" class="mt-4 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                    <p class="text-sm text-green-800 dark:text-green-200" x-html="typicalRangeText"></p>
                </div>

                <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                    Based on <span x-text="sqft"></span> sq ft at $<span x-text="Math.round(range.min)"></span>–$<span x-text="Math.round(range.max)"></span> per sq ft.
                    <span x-text="boroughLabel"></span> pricing.
                </p>

                {{-- Trust indicators --}}
                <div class="mt-4 space-y-1 text-sm text-gray-600 dark:text-gray-400">
                    <p class="flex items-center gap-2"><span class="text-green-600 dark:text-green-400">✔</span> Estimate based on NYC renovation data</p>
                    <p class="flex items-center gap-2"><span class="text-green-600 dark:text-green-400">✔</span> Includes labor, materials, permits</p>
                    <p class="flex items-center gap-2"><span class="text-green-600 dark:text-green-400">✔</span> Reviewed by licensed contractors</p>
                </div>

                <p class="mt-3 text-sm text-gray-500 dark:text-gray-400 italic">
                    Estimates are based on typical NYC renovation data. Final costs depend on layout, materials, and building requirements.
                </p>

                <p class="mt-3 text-sm text-gray-600 dark:text-gray-400" x-show="timeline">
                    <strong>Estimated timeline:</strong> <span x-text="timeline"></span>
                </p>

                {{-- Borough insights --}}
                <div x-show="boroughInsightText" class="mt-4 p-3 bg-[#003366]/5 dark:bg-[#336699]/10 rounded-lg border border-[#336699]/20">
                    <p class="text-xs font-semibold text-[#003366] dark:text-gray-200 uppercase tracking-wider mb-1">Renovation trends in <span x-text="boroughDisplayName"></span></p>
                    <p class="text-sm text-gray-600 dark:text-gray-300" x-html="boroughInsightText"></p>
                </div>

                <a :href="lockEstimateUrl()"
                   @click="trackCtaClick()"
                   class="mt-6 inline-flex items-center bg-[#003366] dark:bg-[#336699] text-white px-6 py-3 rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium text-sm">
                    {{ $hero['cta_lock_estimate'] ?? 'Get Exact Quote for This Estimate — Free, No Obligation' }}
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>

                {{-- Similar project example --}}
                <div x-show="similarProject" class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-xs font-semibold text-[#003366] dark:text-gray-200 uppercase tracking-wider mb-2">Similar Project</p>
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600" x-show="similarProject">
                        <p class="font-medium text-[#003366] dark:text-white" x-text="similarProject ? similarProject.title : ''"></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400" x-text="similarProject ? similarProject.location : ''"></p>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                            Project cost: <span class="font-medium" x-text="similarProject ? formatCurrency(similarProject.cost) : ''"></span>
                            <span x-show="similarProject && similarProject.timeline"> • Timeline: <span x-text="similarProject ? similarProject.timeline : ''"></span></span>
                        </p>
                    </div>
                </div>
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
        timelinesDynamic: cfg.timelinesDynamic || {},
        typicalRanges: cfg.typicalRanges || {},
        boroughInsights: cfg.boroughInsights || {},
        similarProjectExamples: cfg.similarProjectExamples || [],
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
        typicalRangeText: '',
        boroughInsightText: '',
        boroughDisplayName: '',
        similarProject: null,
        estimateTracked: false,
        step1Tracked: false,
        step2Tracked: false,
        ctaTracked: false,
        init() {
            this.calculate();
            this.$watch('step', (val) => { if (val === 2) this.trackStep2Complete(); });
        },
        getDynamicTimeline() {
            const dyn = this.timelinesDynamic[this.type];
            if (dyn && dyn[this.borough] && dyn[this.borough][this.finish]) return dyn[this.borough][this.finish];
            return this.timelines[this.type] || '';
        },
        getTypicalRangeText() {
            const tr = this.typicalRanges[this.type];
            if (!tr || !tr[this.borough]) return '';
            const [tMin, tMax] = tr[this.borough];
            const bName = boroughLabels[this.borough] || this.borough;
            const typeName = { kitchen: 'Kitchen', bathroom: 'Bathroom', basement: 'Basement', whole_house: 'Whole house', commercial: 'Commercial' }[this.type] || this.type;
            const mid = (this.minEstimate + this.maxEstimate) / 2;
            const inRange = mid >= tMin * 0.9 && mid <= tMax * 1.1;
            if (inRange) {
                return `Typical <strong>${typeName}</strong> renovation in <strong>${bName}</strong>: $${(tMin/1000).toFixed(0)}k – $${(tMax/1000).toFixed(0)}k. Your estimate falls within the typical range.`;
            }
            return `Typical <strong>${typeName}</strong> renovation in <strong>${bName}</strong>: $${(tMin/1000).toFixed(0)}k – $${(tMax/1000).toFixed(0)}k.`;
        },
        getBoroughInsightText() {
            const bi = this.boroughInsights[this.borough];
            if (!bi) return '';
            const bName = boroughLabels[this.borough] || this.borough;
            const finishLabels = { basic: 'Basic', standard: 'Standard', premium: 'Premium' };
            return `Average kitchen project: $${(bi.avg_kitchen/1000).toFixed(0)}k • Most popular finish: ${finishLabels[bi.popular_finish] || bi.popular_finish} • Average timeline: ${bi.avg_timeline}`;
        },
        getSimilarProject() {
            const examples = this.similarProjectExamples || [];
            const match = examples.find(e => e.type === this.type && e.borough === this.borough);
            return match || examples.find(e => e.type === this.type) || examples[0] || null;
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
            this.timeline = this.getDynamicTimeline();
            this.boroughLabel = boroughLabels[this.borough] ? boroughLabels[this.borough] + '-adjusted' : '';
            this.boroughDisplayName = boroughLabels[this.borough] || this.borough;
            this.typicalRangeText = this.getTypicalRangeText();
            this.boroughInsightText = this.getBoroughInsightText();
            this.similarProject = this.getSimilarProject();
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
