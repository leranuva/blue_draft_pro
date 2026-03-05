<?php

namespace Database\Factories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->streetAddress() . ', Brooklyn NY',
            'service_type' => fake()->randomElement(['residential', 'commercial']),
            'estimated_budget' => fake()->randomElement(['10k-25k', '25k-50k', '50k-100k', 'over-100k']),
            'message' => fake()->paragraph(),
            'status' => 'pending',
            'stage' => Quote::STAGE_NEW,
            'is_partial' => false,
            'step' => 2,
            'lead_score' => fake()->numberBetween(0, 12),
            'borough' => fake()->randomElement(['manhattan', 'brooklyn', 'queens', 'bronx', 'staten_island', 'other']),
            'lead_source' => null,
            'utm_source' => null,
            'utm_content' => null,
            'estimated_value' => null,
            'closed_value' => null,
            'closed_at' => null,
            'first_contacted_at' => null,
            'proposal_sent_at' => null,
        ];
    }

    public function withSource(string $source): static
    {
        return $this->state(fn (array $attrs) => [
            'lead_source' => $source,
            'utm_source' => null,
        ]);
    }

    public function withUtmSource(string $utmSource): static
    {
        return $this->state(fn (array $attrs) => [
            'lead_source' => null,
            'utm_source' => $utmSource,
        ]);
    }

    public function websiteSource(): static
    {
        return $this->state(fn (array $attrs) => [
            'lead_source' => null,
            'utm_source' => null,
        ]);
    }

    public function won(float $closedValue = 50000): static
    {
        return $this->state(fn (array $attrs) => [
            'stage' => Quote::STAGE_WON,
            'status' => 'completed',
            'closed_value' => $closedValue,
            'closed_at' => now(),
        ]);
    }

    public function proposalSent(): static
    {
        return $this->state(fn (array $attrs) => [
            'stage' => Quote::STAGE_PROPOSAL_SENT,
            'status' => 'contacted',
            'estimated_value' => 45000,
            'first_contacted_at' => now()->subDays(5),
            'proposal_sent_at' => now()->subDays(2),
        ]);
    }

    public function hotScore(): static
    {
        return $this->state(fn (array $attrs) => ['lead_score' => fake()->numberBetween(9, 12)]);
    }

    public function warmScore(): static
    {
        return $this->state(fn (array $attrs) => ['lead_score' => fake()->numberBetween(5, 8)]);
    }

    public function coldScore(): static
    {
        return $this->state(fn (array $attrs) => ['lead_score' => fake()->numberBetween(0, 4)]);
    }
}
