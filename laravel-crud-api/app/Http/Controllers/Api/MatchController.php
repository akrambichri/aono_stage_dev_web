<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use App\Repositories\MatchRepository;
use App\Models\Match;

class MatchController extends AppBaseController
{
        /** @var  MatchRepository */
    private $matchRepository;

    public function __construct(MatchRepository $matchRepo)
    {
        $this->matchRepository = $matchRepo;
    }

     /**
     * Display a listing of the Match.
     * GET|HEAD /matchs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$matchs = Match::with("Match")->get();
        $matchs = Match::Teams()->get();

        return $this->sendResponse($matchs,"Success", 200);
    }

    /**
     * Store a newly created Match in storage.
     * POST /matchs
     *
     * @param Create Match API Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Match::$rules);
        if ($validator->fails()) {
            $errorString = implode(",", $validator->messages()->all());
            return $this->sendError($errorString, 400);
        }
        $input = $request->all();

        $match = $this->matchRepository->create($input);
        return $this->sendResponse($match,"Success", 200);
    }

    /**
     * Display the specified Match.
     * GET|HEAD /matchs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Match $match */
        $match = $this->matchRepository->find($id);

        if (empty($match)) {
            return $this->sendError('Business Unit not found');
        }

        return $this->sendResponse($match,"Success", 200);
    }


    /**
     * Update the specified Match in storage.
     * PUT/PATCH /matchs/{id}
     *
     * @param int $id
     * @param UpdateMatchAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        /** @var Match $match */
        $match = $this->matchRepository->find($id);

        if (empty($match)) {
            return $this->sendError('Business Unit not found');
        }

        $match = $this->matchRepository->update($input, $id);

        return $this->sendResponse($match,"Success", 200);
    }

    /**
     * Remove the specified Match from storage.
     * DELETE /matchs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Match $match */
        $match = $this->matchRepository->find($id);

        if (empty($match)) {
            return $this->sendError('Business Unit not found');
        }

        $match->delete();

        return $this->sendResponse($id, 'Business Unit deleted successfully');
    }

}
