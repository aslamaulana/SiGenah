<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Renstra\Model_opd_program;
use App\Models\Admin\RPJMD\Model_tahun;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_program extends BaseController
{
	protected $opd_program, $satuan, $tahun;

	public function __construct()
	{
		$this->opd_program = new Model_opd_program();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_program',
				'title' => 'User | Program',
				'lok' => '<b>Program</b>',
				// 'opd_program_sasaran' => $this->opd_program->ProgramSasaran(),
				'opd_program' => $this->opd_program->program(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_program', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// -----------------------------------------------------------
	function tampilkanData()
	{
		$data = $this->opd_program->program();
		echo json_encode($data);
	}
	// -----------------------------------------------------------
	public function opd_program_add()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_program',
				'title' => 'User | Program',
				'lok' => '<a href=".">Program</a> -> <b>Tambah Program</b>',
				// 'opd_program_sasaran' => $this->opd_program->getOpdProgramSasaran(),
				'opd_sasaran' => $this->opd_program->getOpdSasaran(),
				'opd_program' => $this->opd_program->getProgram(),
				'satuan' => $this->satuan->satuan(),
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_program_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'program' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'indikator_program' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_program->save([
				'opd_program_n' => $this->request->getVar('program'),
				'opd_sasaran_n' => $this->request->getVar('sasaran'),
				'opd_program_sasaran_n' => $this->request->getVar('opd_program_sasaran'),
				'opd_indikator_program' => $this->request->getVar('indikator_program'),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_edit()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_program',
				'title' => 'User | Program',
				'lok' => '<a href=".">Program</a> -> <b>Tambah Program</b>',
				'opd_program_sasaran' => $this->opd_program->getOpdProgramSasaran(),
				'opd_program' => $this->opd_program->getProgram(),
				'opd_sasaran' => $this->opd_program->getOpdSasaran(),
				'program' => $_GET['p'],
				'sasaran' => $_GET['a'],
				'sasaran_program' => $_GET['m'],
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_program_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'program' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$data = [
				'opd_program_n' => $this->request->getVar('program'),
				'opd_sasaran_n' => $this->request->getVar('sasaran'),
				'opd_program_sasaran_n' => $this->request->getVar('opd_program_sasaran'),
				'updated_by' => user()->full_name,
			];
			$dataw = [
				'opd_program_n' => $this->request->getVar('program_old'),
				'opd_sasaran_n' => $this->request->getVar('sasaran_old'),
				'opd_program_sasaran_n' => $this->request->getVar('opd_program_sasaran_old'),
				'perubahan' => $_SESSION['perubahan'],
				'opd_id' => user()->opd_id,
			];
			$this->opd_program->set($data)->where($dataw)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------

	public function opd_program_indik_add()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_program',
				'title' => 'User | Program',
				'lok' => '<a onclick="history.back(-1)" href="#">Program</a> -> <b>Tambah Indikator Program</b>',
				'validation' => \Config\Services::validation(),
				'satuan' => $this->satuan->satuan(),
				'program' => $_GET['p'],
				'sasaran' => $_GET['a'],
				'sasaran_program' => $_GET['m'],
			];
			echo view('user/Renstra/opd_program_indik_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_indik_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'program' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'indikator_program' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_program->save([
				'opd_program_n' => $this->request->getVar('program'),
				'opd_sasaran_n' => $this->request->getVar('sasaran'),
				'opd_program_sasaran_n' => $this->request->getVar('sasaran_program'),
				'opd_indikator_program' => $this->request->getVar('indikator_program'),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_indik_edit($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_program',
				'title' => 'User | Program',
				'lok' => '<a onclick="history.back(-1)" href="#">Program</a> -> <b>Tambah Indikator Program</b>',
				'validation' => \Config\Services::validation(),
				'indik' => $this->opd_program->find($id),
				'satuan' => $this->satuan->satuan(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_program_indik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_indik_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'indikator_program' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_program->save([
				'id_opd_program' => $this->request->getVar('id'),
				'opd_indikator_program' => $this->request->getVar('indikator_program'),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_indik_hapus($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			try {
				$this->opd_program->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/renstra/opd_program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------------------------------
	public function import()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_program',
				'title' => 'User | Program',
				'lok' => '<a onclick="history.back(-1)" href="#">Program</a> -> <b>Import Data</b>',
			];
			echo view('user/Renstra/opd_program_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function export()
	{
		$sisw = $this->opd_program->getOpdSasaran();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Sasaran')
			->setCellValue('B1', 'Program')
			->setCellValue('C1', 'Sasaran Program')
			->setCellValue('D1', 'Indikator Program')
			->setCellValue('E1', 'Satuan')
			->setCellValue('F1', 't_2021')
			->setCellValue('G1', 't_2022')
			->setCellValue('H1', 't_2023')
			->setCellValue('I1', 't_2024')
			->setCellValue('J1', 't_2025')
			->setCellValue('K1', 't_2026');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['opd_sasaran']);

			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Program - ' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
	public function simpanExcel()
	{
		$file_excel = $this->request->getFile('fileexcel');
		$ext = $file_excel->getClientExtension();
		if ($ext == 'xls') {
			$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else {
			$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $render->load($file_excel);

		$data = $spreadsheet->getActiveSheet()->toArray();
		foreach ($data as $x => $row) {
			if ($x == 0) {
				continue;
			}
			$simpandata = [
				'opd_sasaran_n' => $row[0],
				'opd_program_n' => $row[1],
				'opd_program_sasaran_n' => $row[2],
				'opd_indikator_program' => $row[3],
				'satuan' => $row[4],
				't_2021' => $row[5],
				't_2022' => $row[6],
				't_2023' => $row[7],
				't_2024' => $row[8],
				't_2025' => $row[9],
				't_2026' => $row[10],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			];

			$this->opd_program->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra/opd_program/');
	}
	// ----------------------------------------------------------------------
	public function export_edit()
	{
		$sisw = $this->opd_program->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->findAll();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:L1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Sasaran')
			->setCellValue('C1', 'Program')
			->setCellValue('D1', 'Sasaran Program')
			->setCellValue('E1', 'Indikator Program')
			->setCellValue('F1', 'Satuan')
			->setCellValue('G1', 't_2021')
			->setCellValue('H1', 't_2022')
			->setCellValue('I1', 't_2023')
			->setCellValue('J1', 't_2024')
			->setCellValue('K1', 't_2025')
			->setCellValue('L1', 't_2026');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['id_opd_program'])
				->setCellValue('B' . $column, $sisdata['opd_sasaran_n'])
				->setCellValue('C' . $column, $sisdata['opd_program_n'])
				->setCellValue('D' . $column, $sisdata['opd_program_sasaran_n'])
				->setCellValue('E' . $column, $sisdata['opd_indikator_program'])
				->setCellValue('F' . $column, $sisdata['satuan'])
				->setCellValue('G' . $column, $sisdata['t_2021'])
				->setCellValue('H' . $column, $sisdata['t_2022'])
				->setCellValue('I' . $column, $sisdata['t_2023'])
				->setCellValue('J' . $column, $sisdata['t_2024'])
				->setCellValue('K' . $column, $sisdata['t_2025'])
				->setCellValue('L' . $column, $sisdata['t_2026']);


			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Program-Edit-' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
	public function simpanExcel_edit()
	{
		$file_excel = $this->request->getFile('fileexcel');
		$ext = $file_excel->getClientExtension();
		if ($ext == 'xls') {
			$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else {
			$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $render->load($file_excel);

		$data = $spreadsheet->getActiveSheet()->toArray();
		foreach ($data as $x => $row) {
			if ($x == 0) {
				continue;
			}

			$simpandata = [
				'opd_sasaran_n' => $row[1],
				'opd_program_n' => $row[2],
				'opd_program_sasaran_n' => $row[3],
				'opd_indikator_program' => $row[4],
				'satuan' => $row[5],
				't_2021' => $row[6],
				't_2022' => $row[7],
				't_2023' => $row[8],
				't_2024' => $row[9],
				't_2025' => $row[10],
				't_2026' => $row[11],
				'updated_by' => user()->full_name,
			];

			$id = [
				'id_opd_program' => $row[0],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
			];
			$this->opd_program->set($simpandata)->where($id)->update();

			// $this->opd_sasaran->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra/opd_program/');
	}
	// ===========================================Perubahan=====================================
	public function export_perubahan()
	{
		$sisw = $this->opd_program->where(['perubahan' => 'Murni', 'opd_id' => user()->opd_id])->findAll();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Sasaran')
			->setCellValue('B1', 'Program')
			->setCellValue('C1', 'Sasaran Program')
			->setCellValue('D1', 'Indikator Program')
			->setCellValue('E1', 'Satuan')
			->setCellValue('F1', 't_2021')
			->setCellValue('G1', 't_2022')
			->setCellValue('H1', 't_2023')
			->setCellValue('I1', 't_2024')
			->setCellValue('J1', 't_2025')
			->setCellValue('K1', 't_2026');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['opd_sasaran_n'])
				->setCellValue('B' . $column, $sisdata['opd_program_n'])
				->setCellValue('C' . $column, $sisdata['opd_program_sasaran_n'])
				->setCellValue('D' . $column, $sisdata['opd_indikator_program'])
				->setCellValue('E' . $column, $sisdata['satuan'])
				->setCellValue('F' . $column, $sisdata['t_2021'])
				->setCellValue('G' . $column, $sisdata['t_2022'])
				->setCellValue('H' . $column, $sisdata['t_2023'])
				->setCellValue('I' . $column, $sisdata['t_2024'])
				->setCellValue('J' . $column, $sisdata['t_2025'])
				->setCellValue('K' . $column, $sisdata['t_2026']);

			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Program Murni- ' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
}
