<?php

class Component {
	public static function add(string $component, array $cd){
		include $_SERVER['DOCUMENT_ROOT'].'/'.$component;
	}
}