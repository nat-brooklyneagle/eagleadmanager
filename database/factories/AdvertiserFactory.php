<?php

    namespace Database\Factories;

    use App\Models\Advertiser;
    use App\Models\Team;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Laravel\Jetstream\Features;

    class AdvertiserFactory extends Factory
    {
        /**
         * The name of the factory's corresponding model.
         *
         * @var string
         */
        protected $model = Advertiser::class;

        /**
         * Define the model's default state.
         */
        public function definition(): array
        {
            return [
                'first_name' => $this->faker->firstName(),
                'last_name'  => $this->faker->lastName(),
                'created_by' => User::factory()
                ,
            ];
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
