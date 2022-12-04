<?php

    namespace Tests\Feature;

    use App\Http\Controllers\AdvertiserController;
    use App\Models\Advertiser;
    use App\Models\EmailAddress;
    use App\Models\Team;
    use App\Models\User;
    use Illuminate\Foundation\Testing\DatabaseTransactions;
    use Inertia\Testing\AssertableInertia as Assert;
    use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
    use Tests\TestCase;

    class AdvertiserTest extends TestCase
    {
        use DatabaseTransactions;
//        use RefreshDatabase;

        public function setUp(): void
        {
            parent::setUp();

            $this->advertiser_create_url = action([AdvertiserController::class, 'create']);
            $this->advertiser_index_url = action([AdvertiserController::class, 'index']);
            $this->advertiser_store_url = action([AdvertiserController::class, 'store']);
        }

        /**
         * @test
         */
        public function cannot_view_advertiser_create_page_if_not_logged_in(): void
        {
            $login_url = action([AuthenticatedSessionController::class, 'create']);
            $this->get($this->advertiser_create_url)
                ->assertRedirect($login_url);
        }

        /**
         * @test
         */
        public function cannot_view_advertiser_create_page_if_user_doesnt_have_a_current_team(): void
        {
            $this->be(User::factory()->create());
            $this->get($this->advertiser_create_url)
                ->assertForbidden();
        }

        /**
         * @test
         */
        public function can_create_advertiser(): void
        {
            $team = Team::factory()->create([
                'personal_team' => false,
            ]);

            $this->be(User::findOrFail($team->user_id));
            auth()->user()->current_team_id = $team->id;
            $this->get($this->advertiser_create_url)
                ->assertSuccessful()
                ->assertInertia(fn(Assert $page) => $page
                    ->component('Advertisers/Create')
                    ->where('user.current_team.id', $team->id)
                );

            /** @var Advertiser $advertiser_model */
            $advertiser_model = Advertiser::factory()->make();

            /** @var EmailAddress $email_address_model */
            $email_address_model = EmailAddress::factory()->make();

            $data = [
                'first_name'    => $advertiser_model->first_name,
                'last_name'     => $advertiser_model->last_name,
                'email_address' => $email_address_model->email_address,
            ];
            $response = $this->post($this->advertiser_store_url, $data)->assertRedirect();

            $advertiser = Advertiser::latest()->first();

            $advertiser_show_url = action([AdvertiserController::class, 'show'], $advertiser);

            $response->assertRedirect($advertiser_show_url);

            $this->assertDatabaseHas('email_addresses', ['email_address' => $email_address_model->email_address]);

            $email_address = EmailAddress::latest()->first();

            $this->assertDatabaseHas('advertiser_email_addresses',
                ['advertiser_id' => $advertiser->id, 'email_address_id' => $email_address->id]);

            $this->get($this->advertiser_index_url)
                ->assertSuccessful()
                ->assertInertia(fn(Assert $page) => $page
                    ->component('Advertisers/Index')
                    ->has('advertisers', fn(Assert $page) => $page
                        ->where('0.id', $advertiser->id)
                    )
                );

            $this->get($advertiser_show_url)
                ->assertSuccessful()
                ->assertInertia(fn(Assert $page) => $page
                    ->component('Advertisers/Show')
                    ->has('email_addresses', fn(Assert $page) => $page
                        ->where('0.id', $email_address->id)
                    )
                );
        }
    }
