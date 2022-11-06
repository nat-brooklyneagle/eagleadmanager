<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Laravel\Jetstream\TeamInvitation;

class TeamInvitationController extends Controller
{
    /**
     * Accept a team invitation.
     * @noinspection PhpUndefinedFieldInspection
     * @noinspection PhpUnusedParameterInspection
     */
    public function accept(Request $request, TeamInvitation $invitation): RedirectResponse
    {
        app(AddsTeamMembers::class)->add(
            $invitation->team->owner,
            $invitation->team,
            $invitation->email,
            $invitation->role
        );

        $invitedTeam = $invitation->team;

        info($invitedTeam);
        // Since the user just accepted invite to this team, set that as the current.
        Auth::user()->switchTeam($invitedTeam);

        $invitation->delete();

        return redirect(config('fortify.home'))->banner(
            __('Great! You have accepted the invitation to join the :team team.', ['team' => $invitation->team->name]),
        );
    }

    /**
     * Cancel the given team invitation.
     * @throws AuthorizationException
     * @noinspection PhpUndefinedFieldInspection
     */
    public function destroy(Request $request, TeamInvitation $invitation): RedirectResponse
    {
        if (! Gate::forUser($request->user())->check('removeTeamMember', $invitation->team)) {
            throw new AuthorizationException;
        }

        $invitation->delete();

        return back(303);
    }
}
