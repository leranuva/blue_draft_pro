<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Quote extends Model
{
    use HasFactory;
    public const STAGE_NEW = 'new';
    public const STAGE_CONTACTED = 'contacted';
    public const STAGE_QUALIFIED = 'qualified';
    public const STAGE_PROPOSAL_SENT = 'proposal_sent';
    public const STAGE_WON = 'won';
    public const STAGE_LOST = 'lost';

    protected $fillable = [
        'client_name',
        'email',
        'phone',
        'address',
        'borough',
        'service_type',
        'estimated_budget',
        'estimated_value',
        'internal_cost_estimate',
        'expected_margin',
        'closed_value',
        'closed_at',
        'message',
        'status',
        'stage',
        'is_partial',
        'step',
        'lead_score',
        'abandoned_at',
        'source_url',
        'user_agent',
        'ip_address',
        'lead_source',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'gclid',
        'fbclid',
        'last_contacted_at',
        'first_contacted_at',
        'proposal_sent_at',
        'assigned_to',
        'timeline',
        'property_type',
        'calculator_budget_min',
        'calculator_budget_max',
        'calculator_sqft',
        'calculator_type',
        'calculator_borough',
        'calculator_finish_level',
        'calculator_algorithm_version',
        'calculation_hash',
    ];

    protected $casts = [
        'is_partial' => 'boolean',
        'abandoned_at' => 'datetime',
        'closed_at' => 'datetime',
        'last_contacted_at' => 'datetime',
        'first_contacted_at' => 'datetime',
        'proposal_sent_at' => 'datetime',
        'estimated_value' => 'decimal:2',
        'internal_cost_estimate' => 'decimal:2',
        'expected_margin' => 'decimal:2',
        'closed_value' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (Quote $quote) {
            if ($quote->isDirty('stage')) {
                $quote->syncStatusFromStage();
                if (in_array($quote->stage, [self::STAGE_CONTACTED, self::STAGE_QUALIFIED, self::STAGE_PROPOSAL_SENT])) {
                    if (!$quote->last_contacted_at) {
                        $quote->last_contacted_at = now();
                    }
                    if (!$quote->first_contacted_at) {
                        $quote->first_contacted_at = now();
                    }
                }
                if ($quote->stage === self::STAGE_PROPOSAL_SENT && !$quote->proposal_sent_at) {
                    $quote->proposal_sent_at = now();
                }
                if (in_array($quote->stage, [self::STAGE_WON, self::STAGE_LOST]) && !$quote->closed_at) {
                    $quote->closed_at = now();
                }
            }
            if ($quote->isDirty('address') && !$quote->borough) {
                $quote->borough = self::inferBoroughFromAddress($quote->address);
            }
            if (!$quote->exists && !$quote->assigned_to) {
                $assigned = self::resolveAutoAssignment($quote->borough, $quote->service_type);
                if ($assigned) {
                    $quote->assigned_to = $assigned;
                }
            }
        });

        static::saved(function (Quote $quote) {
            if ($quote->wasChanged('stage')) {
                QuoteStage::create([
                    'quote_id' => $quote->id,
                    'stage' => $quote->stage,
                    'entered_at' => now(),
                ]);
            }
        });

        static::deleting(function (Quote $quote) {
            // Delete related records before parent (avoids FK constraint errors if DB cascades are missing)
            try {
                $quote->attachments()->delete();
            } catch (\Throwable $e) {
                // Ignore if table doesn't exist or other DB issues
            }
            try {
                $quote->stageHistory()->delete();
            } catch (\Throwable $e) {
                // Ignore if table doesn't exist or other DB issues
            }
            try {
                if (Schema::hasTable('quote_email_sequence_log')) {
                    DB::table('quote_email_sequence_log')->where('quote_id', $quote->id)->delete();
                }
            } catch (\Throwable $e) {
                // Ignore
            }
        });
    }

    public static function getBoroughs(): array
    {
        return [
            'manhattan' => 'Manhattan',
            'brooklyn' => 'Brooklyn',
            'queens' => 'Queens',
            'bronx' => 'The Bronx',
            'staten_island' => 'Staten Island',
            'other' => 'Other / Outside NYC',
        ];
    }

    /**
     * Infer borough from address (simple keyword match).
     */
    public static function inferBoroughFromAddress(?string $address): ?string
    {
        if (!$address) {
            return null;
        }
        $addr = strtolower($address);
        if (str_contains($addr, 'manhattan') || str_contains($addr, 'nyc') && str_contains($addr, '100')) {
            return 'manhattan';
        }
        if (str_contains($addr, 'brooklyn') || str_contains($addr, 'bk')) {
            return 'brooklyn';
        }
        if (str_contains($addr, 'queens') || str_contains($addr, 'flushing') || str_contains($addr, 'astoria')) {
            return 'queens';
        }
        if (str_contains($addr, 'bronx') || str_contains($addr, 'bx')) {
            return 'bronx';
        }
        if (str_contains($addr, 'staten island') || str_contains($addr, 'si')) {
            return 'staten_island';
        }
        return null;
    }

    public static function getStages(): array
    {
        return [
            self::STAGE_NEW => 'New',
            self::STAGE_CONTACTED => 'Contacted',
            self::STAGE_QUALIFIED => 'Qualified',
            self::STAGE_PROPOSAL_SENT => 'Proposal Sent',
            self::STAGE_WON => 'Won',
            self::STAGE_LOST => 'Lost',
        ];
    }

    /**
     * Extract UTM and lead_source from request (query, input, or session).
     */
    public static function extractTrackingFromRequest(\Illuminate\Http\Request $request): array
    {
        $utmSource = $request->query('utm_source') ?? $request->input('utm_source') ?? $request->session()->get('utm_source');
        $utmMedium = $request->query('utm_medium') ?? $request->input('utm_medium') ?? $request->session()->get('utm_medium');
        $utmCampaign = $request->query('utm_campaign') ?? $request->input('utm_campaign') ?? $request->session()->get('utm_campaign');
        $utmContent = $request->query('utm_content') ?? $request->input('utm_content') ?? $request->session()->get('utm_content');
        $leadSource = $request->query('lead_source') ?? $request->input('lead_source') ?? $request->session()->get('lead_source')
            ?? ($utmSource ?: ($request->header('Referer') ? 'website' : null));
        $gclid = $request->query('gclid') ?? $request->input('gclid') ?? $request->session()->get('gclid');
        $fbclid = $request->query('fbclid') ?? $request->input('fbclid') ?? $request->session()->get('fbclid');

        return array_filter([
            'utm_source' => $utmSource ? (string) Str::limit($utmSource, 100) : null,
            'utm_medium' => $utmMedium ? (string) Str::limit($utmMedium, 100) : null,
            'utm_campaign' => $utmCampaign ? (string) Str::limit($utmCampaign, 100) : null,
            'utm_content' => $utmContent ? (string) Str::limit($utmContent, 100) : null,
            'lead_source' => $leadSource ? (string) Str::limit($leadSource, 100) : null,
            'gclid' => $gclid ? (string) Str::limit($gclid, 100) : null,
            'fbclid' => $fbclid ? (string) Str::limit($fbclid, 100) : null,
        ]);
    }

    /**
     * Calculate lead score based on rules (max 12):
     * Presupuesto alto (50k-100k) → +2, over-100k → +3
     * Comercial → +2
     * Adjunta fotos → +2
     * Mensaje largo (>200 chars) → +1
     * Teléfono completo → +1
     * Dirección completa → +1
     * Borough específico NYC → +1
     */
    public static function calculateLeadScore(array $data, bool $hasPhotos = false): int
    {
        $score = 0;
        $budget = $data['estimated_budget'] ?? null;
        if ($budget === 'over-100k') {
            $score += 3;
        } elseif ($budget === '50k-100k') {
            $score += 2;
        } elseif (in_array($budget, ['25k-50k', '10k-25k'])) {
            $score += 1;
        }
        if (($data['service_type'] ?? '') === 'commercial') {
            $score += 2;
        }
        if ($hasPhotos) {
            $score += 2;
        }
        $messageLen = strlen($data['message'] ?? '');
        if ($messageLen > 200) {
            $score += 1;
        }
        if (!empty($data['phone']) && strlen(preg_replace('/\D/', '', $data['phone'])) >= 10) {
            $score += 1;
        }
        if (!empty($data['address']) && strlen($data['address']) >= 10) {
            $score += 1;
        }
        if (!empty($data['borough']) && $data['borough'] !== 'other') {
            $score += 1;
        }
        // Dynamic calculator scoring (replaces flat +3)
        if (!empty($data['calculator_budget_min']) && !empty($data['calculator_budget_max'])) {
            $score += 2; // Base: from calculator
            if (($data['calculator_borough'] ?? '') === 'manhattan') {
                $score += 2;
            }
            if (($data['calculator_finish_level'] ?? '') === 'premium') {
                $score += 2;
            }
            $sqft = (int) ($data['calculator_sqft'] ?? 0);
            if ($sqft > 500) {
                $score += 1;
            }
            $maxBudget = (float) ($data['calculator_budget_max'] ?? 0);
            if ($maxBudget >= 100000) {
                $score += 1;
            }
            $calcType = $data['calculator_type'] ?? null;
            if ($calcType === 'whole_house') {
                $score += 2;
            }
            if ($calcType === 'commercial') {
                $score += 1;
            }
        }
        return min($score, 12);
    }

    /**
     * Get human-readable score label (Lead Temperature) for display.
     * Cold 0-4, Warm 5-8, Hot 9-12
     */
    public static function getScoreLabel(int $score): string
    {
        return match (true) {
            $score >= 9 => 'Hot',
            $score >= 5 => 'Warm',
            default => 'Cold',
        };
    }

    /**
     * Get badge color for lead temperature in Filament.
     */
    public static function getScoreColor(int $score): string
    {
        return match (true) {
            $score >= 9 => 'danger',   // Hot = red
            $score >= 5 => 'warning',  // Warm = amber
            default => 'gray',         // Cold
        };
    }

    /**
     * Resolve assigned_to from config (borough or service_type mapping).
     */
    public static function resolveAutoAssignment(?string $borough, ?string $serviceType): ?int
    {
        $mapping = config('quotes.auto_assignment', []);
        if (empty($mapping)) {
            return null;
        }
        if ($borough && isset($mapping['by_borough'][$borough])) {
            return (int) $mapping['by_borough'][$borough];
        }
        if ($serviceType && isset($mapping['by_service'][$serviceType])) {
            return (int) $mapping['by_service'][$serviceType];
        }
        return isset($mapping['default']) ? (int) $mapping['default'] : null;
    }

    /**
     * Get the stage history for metrics (time in each stage, conversion rates).
     */
    public function stageHistory(): HasMany
    {
        return $this->hasMany(QuoteStage::class);
    }

    /**
     * Get the attachments for the quote
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(QuoteAttachment::class);
    }

    /**
     * Get the user assigned to this quote
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Sync status from stage (for backward compatibility)
     */
    public function syncStatusFromStage(): void
    {
        $this->status = match ($this->stage) {
            self::STAGE_WON, self::STAGE_LOST => 'completed',
            self::STAGE_CONTACTED, self::STAGE_QUALIFIED, self::STAGE_PROPOSAL_SENT => 'contacted',
            default => 'pending',
        };
    }

    /**
     * Get the status options
     */
    public static function getStatuses(): array
    {
        return ['pending', 'contacted', 'completed'];
    }
}
