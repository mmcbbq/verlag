<?php
abstract class AbstractController
{
    abstract public function index():void;
    abstract public function show(int $id):void;
    abstract public function new():void;
    abstract public function edit(int $id):void;
    abstract public function delete(int $id):void;
}