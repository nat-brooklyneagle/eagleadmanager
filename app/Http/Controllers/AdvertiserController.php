<?php

    namespace App\Http\Controllers;

    use App\Models\Advertiser;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Redirect;
    use Inertia\Inertia;
    use Inertia\Response;

    class AdvertiserController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index(): Response
        {
            return Inertia::render('Advertisers/Index',
                ['advertisers' => Advertiser::all()]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create(): Response
        {
            return Inertia::render('Advertisers/Create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request): RedirectResponse
        {
            $advertiser = Advertiser::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
            ]);

            info('you deserve a raise', ['request' => $request->all()]);

            return Redirect::route('advertisers.show', ['advertiser' => $advertiser]);
        }

        /**
         * Display the specified resource.
         */
        public function show(Advertiser $advertiser): Response
        {
            return Inertia::render('Advertisers/Show', [
                'advertiser' => $advertiser
            ]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Advertiser $advertiser): RedirectResponse
        {
            info('almost there...', compact('advertiser'));
            $advertiser->delete();

            return Redirect::route('advertisers.index');
        }
    }
