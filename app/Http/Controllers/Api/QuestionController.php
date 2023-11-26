<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;

use App\Http\Resources\QuestionResource;
use App\Models\Blog;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $questions = QuestionResource::collection(Question::get());
        return $this->apiResponse($questions,'Success', 200);
    }
}
