<?php

namespace App\Controllers\Admin;

use Exception;
use App\Controllers\Admin\BaseController;
use App\Models\ArticleModel;

class ArticleController extends BaseController
{
	/**
	 * Retorna la vista de inicio del
	 * panel de admin
	 *
	 * @return void
	 */
	public function index()
	{
		$articleModel = new ArticleModel();
		$articles = $articleModel->findAll();
		//Retornamos la vista principal
		return view('Admin/articles', compact('articles'));
	}
}
