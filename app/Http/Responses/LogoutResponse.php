<?php

    namespace App\Http\Responses;

    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
    use Laravel\Fortify\Fortify;
    use Symfony\Component\HttpFoundation\Response;

    class LogoutResponse implements LogoutResponseContract
    {
        /**
         * Create an HTTP response that represents the object.
         *
         * @param Request $request
         *//**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request
     */
        public function toResponse($request): JsonResponse|Response
        {
            return $request->wantsJson()
                ? new JsonResponse('', 204)
                : redirect(Fortify::redirects('logout', '/'))->banner('Logged out');
        }
    }
