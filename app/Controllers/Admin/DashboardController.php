<?php

namespace App\Controllers\Admin;

use Exception;
use App\Controllers\Admin\BaseController;

class DashboardController extends BaseController
{
	/**
	 * Retorna la vista de inicio del
	 * panel de admin
	 *
	 * @return void
	 */
	public function index()
	{
		//Retornamos la vista principal
		return view('Admin/dashboard');
	}

	/**
	 * Crea un enlace simbolico
	 * Retorna success, en el caso de no poder crear
	 * usar el controlador render
	 * Ej: <?= base_url(route_to('image_profile',$profile->avatar))?>
	 *
	 * @throws \Exception
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function set()
	{
		//ln -s /var/www/writable/uploads/profile/images /var/www/html/uploads/profile/images
		
		$targetFolder = WRITEPATH . "uploads";
		$linkFolder =  FCPATH . "uploads";

		try {
			 @symlink($targetFolder, $linkFolder);
			 return redirect()->route('dashboard')->with('success',"Enlace Simbolico creado correctamente.");
		} catch (Exception $e) {
			throw new \Exception($e->getMessage(), $e->getTraceAsString(), $e);
		}
	}
}
