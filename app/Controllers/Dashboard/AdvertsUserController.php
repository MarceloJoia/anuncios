<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Entities\Advert;
use App\Requests\AdvertRequest;
use App\Services\AdvertService;
use App\Services\CategoryService;
use App\Services\GerencianetService;
use App\Services\ImageService;
use CodeIgniter\Config\Factories;

class AdvertsUserController extends BaseController
{

    private $advertService;
    private $advertRequest;
    private $categoryService;

    public function __construct()
    {
        $this->advertService = Factories::class(AdvertService::class);
        $this->advertRequest = Factories::class(AdvertRequest::class);
        $this->categoryService = Factories::class(CategoryService::class);
    }

    public function index()
    {
        // dd($this->advertService->getAllAdverts());
        // d(get_superadmin());

        return view('Dashboard/Adverts/index');
    }


    public function getUserAdverts()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $response = [
            'data' => $this->advertService->getAllAdverts(classBtnActions: 'btn btn-sm btn-outline-primary'),
        ];

        return $this->response->setJSON($response);
    }


    public function getUserAdvert()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $advert = $this->advertService->getAdvertByID($this->request->getGetPost('id'));


        $options = [
            'class'         => 'form-control',
            'placeholder'   => lang('Categories.label_choose_category'),
            'selected'      => !(empty($advert->category_id)) ? $advert->category_id : ""
        ];

        $response = [
            'advert'        => $advert,
            'situations'    => $this->advertService->getDropdownSituations($advert->situation),
            'categories'    =>  $this->categoryService->getMultinivel('category_id', $options)
        ];

        return $this->response->setJSON($response);
    }



    public function updateUserAdvert()
    {
        $this->advertRequest->validateBeforeSave('advert');

        // echo '<pre>';
        // print_r($this->removeSpoofingFromRequest());
        // exit();

        $advert = $this->advertService->getAdvertByID($this->request->getGetPost('id'));

        $advert->fill($this->removeSpoofingFromRequest());

        $this->advertService->trySaveAdvert($advert);

        return $this->response->setJSON($this->advertRequest->respondWithMessage(message: lang('App.success_saved')));
    }

}
