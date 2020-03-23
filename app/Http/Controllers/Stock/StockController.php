<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function index() {
        return view('stock.stock');
    }
    public function create() {
        return view('stock.stock_create');
    }
    public function view() {
        return view('stock.stock_show');
    }
    public function edit() {
        return view('stock.stock_edit');
    }
    public function update() {
        return view('stock.stock');
    }
    public function destroy() {
        return view('stock.stock');
    }
}
