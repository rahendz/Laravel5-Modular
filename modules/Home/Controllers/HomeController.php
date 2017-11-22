<?php

namespace Modules\Home\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        return 'joss';
    }

    public function test() {
        return 'test web routes';
    }

    public function testneh() {
        return 'test api routes';
    }
}
