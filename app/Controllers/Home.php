<?php

namespace App\Controllers;

class Home extends BaseController
{
	protected $session;

	function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();
	}
	/*
	 * ---------------------------------------------------
	 * index Dashboard
	 * ---------------------------------------------------
	 */
	public function index()
	{
		$data = [
			'gr' => 'home',
			'mn' => 'home',
			'title' => 'SiGenah',
			'lok' => 'Dashboard',
		];
		// Pertama login jika tudak set tahun maka auto set tahun dan perubahan (tahun sekarang / murni)
		if (!isset($_SESSION['tahun']) && !isset($_SESSION['perubahan'])) {
			try {
				$this->session->set('tahun', '2022');
				$this->session->set('perubahan', 'Murni');
			} catch (\Exception $e) {
			}
			return redirect()->to(base_url('/'))->with('tahun2', '2022');
		}
		return view('dashboard', $data);
	}
	/*
	 * ---------------------------------------------------
	 * Set_Tahun
	 * fungsi untuk menetapkan tahun yang di pilih
	 * ---------------------------------------------------
	 */
	public function Set_Tahun($tahun)
	{
		$this->session->set('tahun', $tahun);

		return redirect()->to(base_url('/'))->with('tahun2', $tahun);
	}
	/*
	 * ---------------------------------------------------
	 * Set_perubahan
	 * fungsi untuk menetapkan perubahan (murni / perubahan)
	 * ---------------------------------------------------
	 */
	public function Set_perubahan($perubahan)
	{
		$i = $perubahan == 'Murni' ? 'Penetapan Ke I' : 'Penetapan Ke II';
		try {
			$this->session->set('perubahan', $perubahan);
		} catch (\Exception $e) {
		}
		return redirect()->to(base_url('/'))->with('perubahan2', $i);
	}
	/*
	 * ---------------------------------------------------
	 * Set maximun dan minimum container view
	 * ---------------------------------------------------
	 */
	public function max($id)
	{
		if ($id == 'max') {
			$this->session->set('max', 'maximized-card');
		} else {
			$this->session->remove('max');
		}

		return redirect()->back();
	}
}
