<?php

    namespace App\Http\Controllers;

    use App\Models\Advertiser;
    use Illuminate\Auth\Access\AuthorizationException;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Redirect;
    use Inertia\Inertia;
    use Inertia\Response;

    class AdvertiserController extends Controller
    {
        /**
         * Display a listing of the resource.
         * @throws AuthorizationException
         */
        public function index(): Response
        {
            $this->authorize('viewAny', Advertiser::class);
            /** @noinspection PhpUndefinedFieldInspection */
            $currentTeam = Auth::user()->currentTeam;
            $advertisers = $currentTeam?->advertisers()->get();
            $canCreateAdvertiser = false;
            if(!is_null($currentTeam)) {
                $canCreateAdvertiser = $this->authorize('create', Advertiser::class);
            }
            $permissions =  compact('canCreateAdvertiser');
            /*[
                    'canAddTeamMembers' => Gate::check('addTeamMember', $team),
                    'canDeleteTeam' => Gate::check('delete', $team),
                    'canRemoveTeamMembers' => Gate::check('removeTeamMember', $team),
                    'canUpdateTeam' => Gate::check('update', $team),
            ];*/
            return Inertia::render('Advertisers/Index', compact(
                'advertisers',
                'permissions'
            ));
        }

        /**
         * Show the form for creating a new resource.
         * @throws AuthorizationException
         */
        public function create(): Response
        {
            $this->authorize('create', Advertiser::class);

            return Inertia::render('Advertisers/Create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request): RedirectResponse
        {
            $team_id = auth()->user()->current_team_id;
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            /** @noinspection PhpUndefinedMethodInspection */
            $advertiser = Advertiser::create(compact('first_name',
            'last_name', 'team_id'));

            return Redirect::route('advertisers.show', ['advertiser' => $advertiser]);
        }

        /**
         * Display the specified resource.
         * @throws AuthorizationException
         */
        public function show(Advertiser $advertiser): Response
        {
            /** @noinspection PhpUndefinedFieldInspection */
            $currentTeam = Auth::user()->currentTeam;
            $canEditAdvertiser = false;
            if(!is_null($currentTeam)) {
                $canEditAdvertiser = $this->authorize('update', $advertiser);
            }
            $permissions =  compact('canEditAdvertiser');

            return Inertia::render('Advertisers/Show', compact(
                'advertiser',
                'permissions'
            ));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @throws AuthorizationException
         */
        public function edit(Advertiser $advertiser): Response
        {
            $this->authorize('update', $advertiser);

            return Inertia::render('Advertisers/Edit', compact('advertiser'));
        }

        /**
         * Update the specified resource in storage.
         * @throws AuthorizationException
         */
        public function update(Request $request, Advertiser $advertiser)
        {
            $this->authorize('update', $advertiser);
            $advertiser->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
            ]);

            return Redirect::route('advertisers.show', ['advertiser' => $advertiser]);
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Advertiser $advertiser): RedirectResponse
        {
            $advertiser->delete();

            return Redirect::route('advertisers.index');
        }
    }
