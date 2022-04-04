<?php

namespace app\repository;

interface irepository
{
    public function get($id);
    public function get_all();
    public function save($model);
}