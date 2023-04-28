<?php
/*
 * File name: CategoryController.php
 * Last modified: 2022.03.09 at 21:10:28
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2022
 */

namespace App\Http\Controllers;
use App\DataTables\MembershipDataTable;
use App\Http\Requests\CreateMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Repositories\MembershipRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\UploadRepository;
use Exception;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Models\Membership;

class MembershipController extends Controller
{
    /** @var  MembershipRepository */
    private $membershipRepository;
    //private $membershipRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
     * @var UploadRepository
     */
    private $uploadRepository;

    public function __construct(MembershipRepository $membershipRepo, CustomFieldRepository $customFieldRepo, UploadRepository $uploadRepo)
    {
        parent::__construct();
        $this->membershipRepository = $membershipRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->uploadRepository = $uploadRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param MembershipDataTable $membershipDataTable
     * @return Response
     */
    public function index(MembershipDataTable $MembershipDataTable)
    {
        return $MembershipDataTable->render('memberships.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        
      //   $parentCategory= Membership::pluck('id','title');
        //$typeMembership = $this->membershipRepository->get('type', 'id');
        $hasCustomField = in_array($this->membershipRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->membershipRepository->model());
            $html = generateCustomField($customFields);
        }  
        return view('memberships.create')->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateMembershipRequest $request
     * 
     * @return Response
     */
    public function store(CreateMembershipRequest $request)
    {
     
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->membershipRepository->model());
        try {
            $membership = $this->membershipRepository->create($input);
            $membership->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));
            if (isset($input['thumbnail']) && $input['thumbnail']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['thumbnail']);
                $mediaItem = $cacheUpload->getMedia('thumbnail')->first();
                $mediaItem = $mediaItem->forgetCustomProperty('generated_conversions');
                $mediaItem->copy($membership, 'thumbnail'); 
            }
        } 
        catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.category')]));

        return redirect(route('memberships.index'));  
    }  

    /**
     * Display the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $membership = $this->membershipRepository->findWithoutFail($id);

        if (empty($membership)) {
            Flash::error('Membership not found');

            return redirect(route('memberships.index'));
        }

        return view('memberships.show')->with('membership', $membership);
    }

    /**
     * Show the form for editing the specified Membership.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $membership = $this->membershipRepository->findWithoutFail($id);
       // $parentCategory = $this->membershipRepository->pluck('title', 'id')->prepend(__('lang.membership_parent_id_placeholder'), '');

        if (empty($membership)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.membership')]));

            return redirect(route('memberships.index'));
        }
        $customFieldsValues = $membership->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->membershipRepository->model());
        $hasCustomField = in_array($this->membershipRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('memberships.edit')->with('membership', $membership)->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param int $id
     * @param UpdateMembershipRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMembershipRequest $request)
    {
        $membership = $this->membershipRepository->findWithoutFail($id);

        if (empty($membership)) {
            Flash::error('Category not found');
            return redirect(route('memberships.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->membershipRepository->model());
        try {
            $membership = $this->membershipRepository->update($input, $id);

            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem = $mediaItem->forgetCustomProperty('generated_conversions');
                $mediaItem->copy($membership, 'image');
            }
            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $membership->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.category')]));

        return redirect(route('memberships.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $membership = $this->membershipRepository->findWithoutFail($id);

        if (empty($membership)) {
            Flash::error('Category not found');

            return redirect(route('memberships.index'));
        }

        $this->membershipRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.category')]));

        return redirect(route('memberships.index'));
    }

    /**
     * Remove Media of Category
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $membership = $this->membershipRepository->findWithoutFail($input['id']);
        try {
            if ($membership->hasMedia($input['collection'])) {
                $membership->getFirstMedia($input['collection'])->delete();
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
