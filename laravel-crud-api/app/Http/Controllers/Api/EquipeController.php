<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use App\Repositories\EquipeRepository;
use App\Models\Equipe;

class EquipeController extends AppBaseController
{
        /** @var  EquipeRepository */
    private $equipeRepository;

    public function __construct(EquipeRepository $equipeRepo)
    {
        $this->equipeRepository = $equipeRepo;
    }

     /**
     * Display a listing of the Equipe.
     * GET|HEAD /equipes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$equipes = Equipe::with("Match")->get();
        $equipes = Equipe::all();
        return $this->sendResponse($equipes,"Success", 200);
    }


        public function getTeamsWithUpcomingMatch(Request $request)
    {
        //$equipes = Equipe::with("Match")->get();
        $equipes = Equipe::all();
        $equipes = $equipes->map(function ($item, $key) {
                        return $item->setAttribute("UpComingMatch",$item->UpComingMatch);
                    });
        return $this->sendResponse($equipes,"Success", 200);
    }

    /**
     * Store a newly created Equipe in storage.
     * POST /equipes
     *
     * @param Create Equipe API Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Equipe::$rules);
        if ($validator->fails()) {
            $errorString = implode(",", $validator->messages()->all());
            return $this->sendError($errorString, 400);
        }
        $input = $request->all();

        $equipe = $this->equipeRepository->create($input);
        return $this->sendResponse($equipe,"Success", 200);
    }

    /**
     * Display the specified Equipe.
     * GET|HEAD /equipes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Equipe $equipe */
        $equipe = $this->equipeRepository->find($id);

        if (empty($equipe)) {
            return $this->sendError('Business Unit not found');
        }

        return $this->sendResponse($equipe,"Success", 200);
    }


    /**
     * Update the specified Equipe in storage.
     * PUT/PATCH /equipes/{id}
     *
     * @param int $id
     * @param UpdateEquipeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        /** @var Equipe $equipe */
        $equipe = $this->equipeRepository->find($id);

        if (empty($equipe)) {
            return $this->sendError('Business Unit not found');
        }

        $equipe = $this->equipeRepository->update($input, $id);

        return $this->sendResponse($equipe,"Success", 200);
    }

    /**
     * Remove the specified Equipe from storage.
     * DELETE /equipes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Equipe $equipe */
        $equipe = $this->equipeRepository->find($id);

        if (empty($equipe)) {
            return $this->sendError('Business Unit not found');
        }

        $equipe->delete();

        return $this->sendResponse($id, 'Business Unit deleted successfully');
    }

}
