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
        $random_number = rand(7,19);
        $random_hour = new DateTime("{$random_number}:00:00");

        $random_date = new DateTime($random_day->format('Y-m-d') . ' ' . $random_hour->format('H:i:s'));
        $end_date = clone $random_date;
        $end_date->add(new DateInterval('PT30M'));

        return [
            'start_datetime' => $random_date,
            'end_datetime' => $end_date,
            'title' => fake()->sentence(2, false),
            'event_type_id' => EventType::all()->random()->id()

        ];
    }
}
