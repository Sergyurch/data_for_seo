<?php

namespace App\Http\Controllers;

use DFSClientV3\DFSClient;
use DFSClientV3\Models\SerpApi\Languages;
use DFSClientV3\Models\SerpApi\SettingSerpLiveRegular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class SerpController extends Controller
{
    private $client;
    public function __construct() {
        $this->client = new DFSClient();
        $this->client->setConfig(config('dataforseo'));
    }
    public function index() {
        $model = new Languages();
        $model->setSe("google");
        
        $result = $model->get();
        
        if (empty($result->tasks[0]->result)) {
            $errors = new MessageBag(['Внутрішня помилка сервера. Неможливо отримати список мов. Спробуйте пізніше.']);
        } else {
            $languages = $result->tasks[0]->result;
        }
        
        return view('serp.index', [
            'languages' => $languages ?? [],
            'errors' => $errors ?? new MessageBag()
        ]);
    }

    public function search(Request $request) {
        $validator = Validator::make($request->all(), [
            'keyword' => 'required|string',
            'site' => 'required|string',
            'location' => 'required|string',
            'language' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $model = new SettingSerpLiveRegular();
        $model->setSe('google');
        $model->setSeType("organic");
        $model->setKeyword($request->input('keyword'));
        $model->setTarget($request->input('site') . '*');
        $model->setLocationName($request->input('location'));
        $model->setLanguageCode($request->input('language'));
        $result = $model->get();

        $status_message = $result->tasks[0]->status_message ?? 'Невідома помилка.';

        if ($result->tasks_error == 1) {
            return response()->json([
                'errors' => [$status_message]
            ], 422);
        }

        $rank_absolute = $result->tasks[0]->result[0]->items[0]->rank_absolute ?? null;
        $check_url = $result->tasks[0]->result[0]->check_url ?? null;    
        
        return response()->json([
            'status_message' => $status_message,
            'rank_absolute' => $rank_absolute,
            'check_url' => $check_url
        ]);
    }
}
