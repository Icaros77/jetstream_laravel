<?php

namespace Database\Factories;

use App\Models\ShoppingList;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;


class UserFactory extends Factory
{
    protected const COUNTRIES = [
        'Italy',
        'Germany',
        'French',
        'Norway',
        'Gran Britain',
        'America',
        'Mexico'
    ];

    protected const ADDRESS = [
        'via palermo, 47',
        'via mexico, 465',
        'via yulia, 55',
        'via asdad, 44',
        'via hello, 34',
        'via granprix, 22',
        'via moto, 1',
        'via yesterday, 422',
    ];

    protected const CITIES = [
        'milano',
        'Paris',
        'Roma',
        'Berlin',
        'Stuttgart',
        'Mùnchen',
        'Bologna',
    ];
    
    protected const POSTAL_CODES = [
        '29011',
        '29010',
        '29018',
        '29017',
        '29013',
        '29014',
        '29015',
    ];
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            // 'address' => $this::fake("ADDRESS"),
            // 'country' => $this::fake("COUNTRIES"),
            // 'postal_code' => $this::fake("POSTAL_CODES"),
            // 'city' => $this::fake("CITIES"),

        ];
    }

    protected function fake($string)
    {
        return constant("self::$string")[rand(0, count(constant("self::$string")) - 1)];
    }
    
    public function addCart()
    {
        return $this->afterCreating(function(User $user) {
            ShoppingList::create(['cart' => [], 'client_id' => $user->id]);
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (!Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name . '\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
