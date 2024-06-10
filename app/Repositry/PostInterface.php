<?php

namespace App\Repositry;

use Illuminate\Http\Request;

interface PostInterface
{

    public function index();

    public function create(Request $request);

    public function show(string $id);
    public function update(Request $request, string $id);
    public function delete(string $id);
}
