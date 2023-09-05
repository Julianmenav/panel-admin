<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\EventType;
use DateInterval;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $random_date = fake()->dateTimeBetween('-1 week', '+2 week');

        $minutes = rand(10,60);
        $random_duration = new DateInterval("PT{$minutes}M");

        return [
            'start_datetime' => $random_date,
            'end_datetime' => $random_date->add($random_duration),
            'title' => fake()->sentence(4),
            'event_type_id' => EventType::all()->random()->id()

        ];
    }
}
