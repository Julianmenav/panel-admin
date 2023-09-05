<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Event;
use \App\Models\EventType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed users table
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        
        ]);
        User::create([
            'name' => 'juli',
            'email' => 'juli@juli.com',
            'password' => bcrypt('admin123'),
            'role' => 'user'
        
        ]);
        User::factory(15)->create();

        // Seed EventTypes table
        EventType::create([
            'name' => 'Por Defecto',
            'backgroundColor' => '#4472CF',
            'borderColor' => '#93FF43',
            'textColor' => '#FFF',
        ]);
        EventType::create([
            'name' => 'Reunion',
            'backgroundColor' => '#B053AB',
            'borderColor' => '#FF8B00',
            'textColor' => '#FFF',
        ]);
        EventType::create([
            'name' => 'Cumpleaños',
            'backgroundColor' => '#D0ECE7',
            'borderColor' => '#E75DFF',
            'textColor' => '#242424',
        ]);

        // Seed Events(calendar) table
        Event::factory(10)->create();
    }
}
