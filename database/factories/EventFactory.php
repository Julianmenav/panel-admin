<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\EventType;
use DateInterval;
use DateTime;

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
        // Generate random dateTime between 07:00 and 19:00 for this week

        $random_day = fake()->dateTimeBetween('-1 week', '+1 week');

        $start_time = new DateTime('07:00:00');
        $end_time = new DateTime('19:00:00');

        $random_date = fake()->dateTimeBetween(
            $random_day->format('Y-m-d') . ' ' . $start_time->format('H:i:s'),
            $random_day->format('Y-m-d') . ' ' . $end_time->format('H:i:s')
        );

        return [
            'start_datetime' => $random_date,
            'end_datetime' => $random_date->add(new DateInterval("PT20M")),
            'title' => fake()->sentence(2, false),
            'event_type_id' => EventType::all()->random()->id()

        ];
    }
}
