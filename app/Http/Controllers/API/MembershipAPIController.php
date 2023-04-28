<?php
/*
 * File name: CategoryAPIController.php
 * Last modified: 2021.03.24 at 21:33:26
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2021
 */

namespace App\Http\Controllers\API;


//use App\Criteria\Memberships\NearCriteria;
//use App\Criteria\Memberships\ParentCriteria;
use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Repositories\MembershipRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API
 */
class MembershipAPIController extends Controller
{
    /** @var  MemberhipRepository */
    private $MembershipRepository;

    public function __construct(MembershipRepository $memberhipRepo)
    {
        $this->memberhipRepository = $memberhipRepo;
    }

    /**
     * Display a listing of the Category.
     * GET|HEAD /categories
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->memberhipRepository->pushCriteria(new RequestCriteria($request));
         //   $this->memberhipRepoRepository->pushCriteria(new NearCriteria($request));
         //   $this->memberhipRepoRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $memberhip = $this->memberhipRepository->all();

        return $this->sendResponse($memberhip->toArray(), 'Memberships retrieved successfully');
    }

    /**
     * Display the specified Category.
     * GET|HEAD /categories/{id}
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        /** @var Memberhip $memberhip */
        if (!empty($this->memberhipRepository)) {
            $memberhip = $this->memberhipRepository->findWithoutFail($id);
        }

        if (empty($memberhip)) {
            return $this->sendError('Membership not found');
        }

        return $this->sendResponse($memberhip->toArray(), 'Memberhip retrieved successfully');
    }
}
