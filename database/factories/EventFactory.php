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
        $random_date = fake()->dateTimeBetween('-1 week', '+1 week');

        return [
            'start_datetime' => $random_date,
            'end_datetime' => $random_date->add(new DateInterval("PT30M")),
            'title' => fake()->sentence(2, false),
            'event_type_id' => EventType::all()->random()->id()

        ];
    }
}
