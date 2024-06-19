<?php

namespace App\Repositry;

use Illuminate\Http\Request;

interface CategoryInterface
{
    public function index();
    public function store(Request $request);
    public function show(string $id);
    public function update(Request $request, string $id);
    public function destroy(string $id);
}
