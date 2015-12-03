<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class skp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $data['parameter'] = "";
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
		
		$this->load->model('model_jabatan');
		$this->load->model('model_pegawai');
		$this->load->model('model_kegiatan_tugas_jabatan');
		$this->load->model('model_penilaian_skp');
		$this->load->model('model_realisasi_skp');
		$this->load->model('model_penilaian_prestasi_kerja');
		$this->load->helper('pusdiklat');
    }

	public function perencanaan() {
		$data['title'] = "SKP - Perencanaan";
        $data['menu'] = "perencanaan";

		$nip = $this->session->userdata('nip');
		
		// Inisialisasi data pegawai
		$data['nip'] = $nip;
		$data['nama'] = "";
		$data['pangkat'] = "";
		$data['jabatan'] = "";
		$data['unit_kerja'] = "";

		// Inisialisasi data atasan (pejabat penilai)
		$data['nip_atasan'] = "";
		$data['nama_atasan'] = "";
		$data['pangkat_atasan'] = "";
		$data['jabatan_atasan'] = "";
		$data['unit_kerja_atasan'] = "";

		// Get data pegawai
		$pegawai = $this->model_pegawai->get($nip);
		$data['id_jabatan'] = $pegawai->id_jabatan;
		
		// Get data nama dan pangkat pegawai
		if($detail_pegawai = $this->model_pegawai->get_detail($nip)){
			$data['nama'] = $detail_pegawai->peg_nm;
			$data['pangkat'] = $detail_pegawai->peg_gol_pangkat;
		}
		
		// Get deskripsi dan unit kerja pegawai
		if($jabatan = $this->model_jabatan->get($pegawai->id_jabatan)){
			$data['jabatan'] = $jabatan->deskripsi;
			$data['unit_kerja'] = $jabatan->unit_kerja;
		}

		// Get nip atasan
		if($atasan_pegawai = $this->model_pegawai->get_where(array('id_jabatan'=>$jabatan->id_atasan))) {				
			$data['nip_atasan'] = $atasan_pegawai->nip;
		}
		
		// Get deskripsi dan unit kerja atasan
		if($atasan_pegawai && $jabatan_atasan = $this->model_jabatan->get($atasan_pegawai->id_jabatan)){
			$data['jabatan_atasan'] = $jabatan_atasan->deskripsi;
			$data['unit_kerja_atasan'] = $jabatan_atasan->unit_kerja;
		}
		
		// Get nama dan golongang pangkat atasan
		if($atasan_pegawai && $detail_atasan_pegawai = $this->model_pegawai->get_detail($atasan_pegawai->nip)) {
			$data['nama_atasan'] = $detail_atasan_pegawai->peg_nm;
			$data['pangkat_atasan'] = $detail_atasan_pegawai->peg_gol_pangkat;
		}

		switch($this->input->post('status')) {
			case 1:
				$tahun = $this->input->post('tahun');
				$input = array('nip'=>$nip,'tahun'=>$tahun);
				$jumlah_skp = $this->model_penilaian_prestasi_kerja->get_count($input);
				$awal_penilaian = $jumlah_skp == 0 ? $tahun . "-01-01" : date("Y-m-d"); 	
				$akhir_penilaian = $tahun . "-12-31";

				// Get NIP atasan pejabat penilai
				if($atasan_pejabat_penilai = $this->model_pegawai->get_where(array('id_jabatan'=>$jabatan_atasan->id_atasan))) {				
					$nip_atasan_pejabat_penilai = $atasan_pejabat_penilai->nip;
				} else { $nip_atasan_pejabat_penilai = ""; }
				
				// Get nama atasan pejabat penilai
				if($atasan_pejabat_penilai && $detail_atasan_pejabat_penilai = $this->model_pegawai->get_detail($atasan_pejabat_penilai->nip)) {
					$nama_atasan_pejabat_penilai = $detail_atasan_pejabat_penilai->peg_nm;
				} else { $nama_atasan_pejabat_penilai = ""; }
				
				$input2 = array('nip' => $nip,
							'tahun' => $tahun,
							'awal_penilaian' => $awal_penilaian,
							'akhir_penilaian' => $akhir_penilaian,
							'penilaian_ke' => $jumlah_skp + 1,
							'nip_pejabat_penilai' => $data['nip_atasan'],
							'nama_pejabat_penilai' => $data['nama_atasan'],
							'nip_atasan_pejabat_penilai' => $nip_atasan_pejabat_penilai,
							'nama_atasan_pejabat_penilai' => $nama_atasan_pejabat_penilai
						);
				$this->model_penilaian_prestasi_kerja->insert($input2);
				if($jumlah_skp > 0) {
					$skp_terakhir = $this->model_penilaian_prestasi_kerja->get_last_record($input);	
					$this->model_penilaian_prestasi_kerja->update($skp_terakhir->id,array('akhir_penilaian'=>date("Y-m-d")));
				}
				break;
		}
		
		$record = $this->model_penilaian_prestasi_kerja->get_status_lt7($nip);
		if($record) {
			$data['status'] = $record->status;
			$data['id_prestasi_kerja'] = $record->id;
						
			$skp = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$record->id));
			$data['skp'] = $this->buildHTMLString($record->status,$skp);
			$data['kegiatan_tugas_jabatan'] = $this->model_kegiatan_tugas_jabatan->get_where(array('id_jabatan'=>$pegawai->id_jabatan));
			$data['pk'] = $record;
			$this->load->view('skp/perencanaan',$data);			
		} else {
			$this->load->view('skp/buat_perencanaan_baru',$data);
		}
	}
	
	public function add_kegiatan_tugas_jabatan() {
		$id_prestasi_kerja = $this->input->post('id_prestasi_kerja',TRUE);
		$kegiatan = $this->model_kegiatan_tugas_jabatan->get($this->input->post('kegiatan_tugas_jabatan',TRUE));
		$pk = $this->model_penilaian_prestasi_kerja->get($id_prestasi_kerja);
		$data = array('id_prestasi_kerja'=> $id_prestasi_kerja,
					'nip' => $pk->nip,
					'tahun' => $pk->tahun,
					'kegiatan' => $kegiatan->kegiatan,
					'jenis_kegiatan' => '1',
					'target_angka_kredit' => $this->input->post('target_angka_kredit',TRUE),
					'target_kuantitas' => $this->input->post('target_kuantitas',TRUE),
					'satuan_kuantitas' => $this->input->post('satuan_kuantitas',TRUE),
					'target_kualitas' => $this->input->post('target_kualitas',TRUE),
					'target_waktu' => $this->input->post('target_waktu',TRUE),
					'satuan_waktu' => $this->input->post('satuan_waktu',TRUE),
					'target_biaya' => $this->input->post('target_biaya',TRUE),
				);
		$this->model_penilaian_skp->insert($data);
		
		$skp = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=> $id_prestasi_kerja));
		$htmlString = $this->buildHTMLString(0,$skp);
		$response = array("html" => $htmlString);
		echo json_encode($response);
	}
	
	public function delete_kegiatan_tugas_jabatan($id) {
		$id_prestasi_kerja = $this->input->post('id_prestasi_kerja',TRUE);
		$this->model_penilaian_skp->delete(array('id'=>$id));
		
		$skp = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=> $id_prestasi_kerja));
		$htmlString = $this->buildHTMLString(0,$skp);
		$response = array("html" => $htmlString);
		echo json_encode($response);
	}
	
	public function update_status() {
		$id_prestasi_kerja = $this->input->post('id_prestasi_kerja');
		$status = $this->input->post('status');
		$data = array('status'=> $status);
		$this->model_penilaian_prestasi_kerja->update($id_prestasi_kerja,$data);
		
		$skp = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=> $id_prestasi_kerja));
		$htmlString = $this->buildHTMLString($status,$skp);
		$response = array("html" => $htmlString);
		echo json_encode($response);
	}

	public function penilaian_bawahan2($nip="",$tahun=0) {
		$data['title'] = "SKP - Penilaian Bawahan";
		$data['tahun'] = $tahun > 0 ? $tahun : date("Y");
		$data['nip'] = $nip;
		$data['nama'] = "";
		$data['pangkat'] = "";
		$data['jabatan'] = "";
		$data['unit_kerja'] = "";
		$data['nama_pejabat_penilai'] = "";

		// Get data pegawai
		$pegawai = $this->model_pegawai->get($nip);
		if(!$pegawai) {
			$data['error'] = "NIP $nip tidak terdaftar.";
			$this->load->view('error',$data);
			return;
		}
		
		// Get data nama dan pangkat pegawai
		$detail_pegawai = $this->model_pegawai->get_detail($nip);
		if($detail_pegawai) {
			$data['nama'] = $detail_pegawai->peg_nm;
			$data['pangkat'] = $detail_pegawai->peg_gol_pangkat;
		}
		
		// Get deskripsi dan unit kerja pegawai
		if($pegawai && $jabatan = $this->model_jabatan->get($pegawai->id_jabatan)){
			$data['jabatan'] = $jabatan->deskripsi;
			$data['unit_kerja'] = $jabatan->unit_kerja;
		}
		
		// Get nama atasan/pejabat penilai
		$atasan_pegawai = $this->model_pegawai->get_where(array('id_jabatan'=>$jabatan->id_atasan));				
		if($atasan_pegawai && $detail_atasan_pegawai = $this->model_pegawai->get_detail($atasan_pegawai->nip)) {
			$data['nama_pejabat_penilai'] = $detail_atasan_pegawai->peg_nm;
		}
		
		if($this->session->userdata('nip') != $this->nip_atasan($atasan_pegawai->nip)) {
			$data['error'] = "Anda tidak memiliki hak untuk mengakses pegawai dengan NIP $nip";
			$this->load->view('error',$data);
			return;
		}
		
		$skp = $this->model_penilaian_prestasi_kerja->get_where(array('tahun'=> $data['tahun'],'nip'=>$nip));
		$i = 0;
		foreach($skp as $item) {
			switch($item->status) {
				case 0 :
					$skp[$i]->status = 'Perencanaan';
					break;
				case 1 :
					$skp[$i]->status = 'Persetujuan';
					break;
				case 2 :
					$skp[$i]->status = "Eksekusi";
					break;
				case 3 :
					$skp[$i]->status = "Evaluasi";
					break;
				case 4 :
					$skp[$i]->status = "Review Hasil";
					break;
				case 5 :
					$skp[$i]->status = "Selesai";
					break;
			}
			$skp[$i]->awal_penilaian = date_format(date_create($skp[$i]->awal_penilaian),"d/m/Y");
			$skp[$i]->akhir_penilaian = date_format(date_create($skp[$i]->akhir_penilaian),"d/m/Y");
			$i++;
		}
		$data['skp'] = $skp;
		$this->load->view('skp/penilaian_bawahan2',$data);	
	}
	
	public function penilaian_bawahan($nip="",$tahun=0) {
		$data['title'] = "SKP - Penilaian Bawahan";
		$data['tahun'] = $tahun > 0 ? $tahun : date("Y");
		$data['nip'] = $nip;
		$data['nama'] = "";
		$data['pangkat'] = "";
		$data['jabatan'] = "";
		$data['unit_kerja'] = "";
		$data['nama_pejabat_penilai'] = "";

		// Get data pegawai
		$pegawai = $this->model_pegawai->get($nip);
		if(!$pegawai) {
			$data['error'] = "NIP $nip tidak terdaftar.";
			$this->load->view('error',$data);
			return;
		}
		
		// Get data nama dan pangkat pegawai
		$detail_pegawai = $this->model_pegawai->get_detail($nip);
		if($detail_pegawai) {
			$data['nama'] = $detail_pegawai->peg_nm;
			$data['pangkat'] = $detail_pegawai->peg_gol_pangkat;
		}
		
		// Get deskripsi dan unit kerja pegawai
		if($pegawai && $jabatan = $this->model_jabatan->get($pegawai->id_jabatan)){
			$data['jabatan'] = $jabatan->deskripsi;
			$data['unit_kerja'] = $jabatan->unit_kerja;
		}
		
		// Get nama atasas/pejabat penilai
		$atasan_pegawai = $this->model_pegawai->get_where(array('id_jabatan'=>$jabatan->id_atasan));				
		if($atasan_pegawai && $detail_atasan_pegawai = $this->model_pegawai->get_detail($atasan_pegawai->nip)) {
			$data['nama_pejabat_penilai'] = $detail_atasan_pegawai->peg_nm;
		}
		
		if($this->session->userdata('nip') != $atasan_pegawai->nip) {
			$data['error'] = "Anda tidak memiliki hak untuk mengakses pegawai dengan NIP $nip";
			$this->load->view('error',$data);
			return;
		}
		
		$skp = $this->model_penilaian_prestasi_kerja->get_where(array('tahun'=> $data['tahun'],'nip'=>$nip));
		$i = 0;
		foreach($skp as $item) {
			switch($item->status) {
				case 0 :
					$skp[$i]->status = 'Perencanaan';
					break;
				case 1 :
					$skp[$i]->status = 'Persetujuan';
					break;
				case 2 :
					$skp[$i]->status = "Eksekusi";
					break;
				case 3 :
					$skp[$i]->status = "Evaluasi";
					break;
				case 4 :
					$skp[$i]->status = "Review Hasil";
					break;
				case 5 :
					$skp[$i]->status = "Selesai";
					break;
			}
			$skp[$i]->awal_penilaian = date_format(date_create($skp[$i]->awal_penilaian),"d/m/Y");
			$skp[$i]->akhir_penilaian = date_format(date_create($skp[$i]->akhir_penilaian),"d/m/Y");
			$i++;
		}
		$data['skp'] = $skp;
		$this->load->view('skp/penilaian_bawahan',$data);	
	}
	
	public function nip_atasan($nip) {
		$pegawai = $this->model_pegawai->get($nip);
		if(!$pegawai)
			return NULL;
		$jabatan = $this->model_jabatan->get($pegawai->id_jabatan);
		if(!$jabatan)
			return NULL;
		$atasan_pegawai = $this->model_pegawai->get_where(array('id_jabatan'=>$jabatan->id_atasan));				
		if(!$atasan_pegawai)
			return NULL;
		return($atasan_pegawai->nip);
	}
	
	public function hasil_penilaian($tahun=0) {
		$data['title'] = "SKP - Hasil Penilaian";
        $data['menu'] = "penilaian";

		$nip = $this->session->userdata('nip');
		$data['tahun'] = $tahun > 0 ? $tahun : date("Y");
		$data['nip'] = $nip;
		$data['nama'] = "";
		$data['pangkat'] = "";
		$data['jabatan'] = "";
		$data['unit_kerja'] = "";
		$data['nama_pejabat_penilai'] = "";

		// Get data pegawai
		$pegawai = $this->model_pegawai->get($nip);
		
		// Get data nama dan pangkat pegawai
		$detail_pegawai = $this->model_pegawai->get_detail($nip);
		if($detail_pegawai) {
			$data['nama'] = $detail_pegawai->peg_nm;
			$data['pangkat'] = $detail_pegawai->peg_gol_pangkat;
		}
		
		// Get deskripsi dan unit kerja pegawai
		if($pegawai && $jabatan = $this->model_jabatan->get($pegawai->id_jabatan)){
			$data['jabatan'] = $jabatan->deskripsi;
			$data['unit_kerja'] = $jabatan->unit_kerja;
		}
		
		// Get nama atasas/pejabat penilai
		$atasan_pegawai = $this->model_pegawai->get_where(array('id_jabatan'=>$jabatan->id_atasan));				
		if($atasan_pegawai && $detail_atasan_pegawai = $this->model_pegawai->get_detail($atasan_pegawai->nip)) {
			$data['nama_pejabat_penilai'] = $detail_atasan_pegawai->peg_nm;
		}
		
		$skp = $this->model_penilaian_prestasi_kerja->get_where(array('tahun'=> $data['tahun'],'nip'=>$nip));
		$i = 0;
		foreach($skp as $item) {
			switch($item->status) {
				case 0 :
					$skp[$i]->status = 'Perencanaan';
					break;
				case 1 :
					$skp[$i]->status = 'Persetujuan';
					break;
				case 2 :
					$skp[$i]->status = "Eksekusi";
					break;
				case 3 :
					$skp[$i]->status = "Evaluasi";
					break;
				case 4 :
					$skp[$i]->status = "Review Hasil";
					break;
				case 5 :
					$skp[$i]->status = "Selesai";
					break;
			}
			$skp[$i]->awal_penilaian = date_format(date_create($skp[$i]->awal_penilaian),"d/m/Y");
			$skp[$i]->akhir_penilaian = date_format(date_create($skp[$i]->akhir_penilaian),"d/m/Y");
			$i++;
		}
		$data['skp'] = $skp;
		$this->load->view('skp/hasil_penilaian',$data);	
	}
	
	public function detail_penilaian($id) {
		$data['title'] = "SKP - Hasil Penilaian - Detail Penilaian";
        $data['menu'] = "hasil";
		
		$pk = $this->model_penilaian_prestasi_kerja->get($id);
		$data['pk'] = $pk;
		$skp = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$id));
		$data['skp'] = $skp;
		$data['tugas_jabatan'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>1));
		$data['tugas_tambahan'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>2));
		$data['kreatifitas'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>3));
		$data['skp'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id));
		foreach($data['skp'] as $skp) {	
			$data['realisasi'][$skp->id] = $this->model_realisasi_skp->get_where(array('id_skp'=>$skp->id));
		}
		if($pk->status == 4 &&  $pk->tanggal_diterima_yang_dinilai == NULL) {
			$this->model_penilaian_prestasi_kerja->update($id,array('tanggal_diterima_yang_dinilai' => date("Y-m-d H:i:s")));
		}
		
		$this->load->view('skp/detail_penilaian',$data);
	}
	
	public function detail_penilaian_bawahan($id) {
		$pk = $this->model_penilaian_prestasi_kerja->get($id);
		$data['pk'] = $pk;
		$data['tugas_jabatan'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>1));
		$data['tugas_tambahan'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>2));
		$data['kreatifitas'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>3));
		$data['skp'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id));
		foreach($data['skp'] as $skp) {	
			$data['realisasi'][$skp->id] = $this->model_realisasi_skp->get_where(array('id_skp'=>$skp->id));
		}
		$this->load->view('skp/detail_penilaian_bawahan',$data);
	}
	
	public function detail_penilaian_bawahan2($id) {
		$pk = $this->model_penilaian_prestasi_kerja->get($id);
		$data['pk'] = $pk;
		$data['tugas_jabatan'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>1));
		$data['tugas_tambahan'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>2));
		$data['kreatifitas'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>3));
		$data['skp'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id));
		foreach($data['skp'] as $skp) {	
			$data['realisasi'][$skp->id] = $this->model_realisasi_skp->get_where(array('id_skp'=>$skp->id));
		}
		if($pk->status == 4 &&  $pk->tanggal_diterima_atasan_penilai == NULL) {
			$this->model_penilaian_prestasi_kerja->update($id,array('tanggal_diterima_atasan_penilai' => date("Y-m-d H:i:s")));
		}
		$this->load->view('skp/detail_penilaian_bawahan2',$data);
	}
	
	public function submit_nilai_perilaku($id) {
		$pk = $this->model_penilaian_prestasi_kerja->get($id);
		$jumlah_perilaku_kerja = $this->input->post('nilai_orientasi_pelayanan') + 
								$this->input->post('nilai_integritas') +
								$this->input->post('nilai_komitmen') +
								$this->input->post('nilai_disiplin') +
								$this->input->post('nilai_kerjasama') +
								$this->input->post('nilai_kepemimpinan');
		$rata_perilaku_kerja = $jumlah_perilaku_kerja/6;
		$nilai_perilaku_kerja = 0.4 * $rata_perilaku_kerja;						
		$nilai_prestasi_kerja = $pk->nilai_capaian_skp + $nilai_perilaku_kerja;
		
		$data = array('nilai_orientasi_pelayanan'=>$this->input->post('nilai_orientasi_pelayanan'),
					'nilai_integritas' => $this->input->post('nilai_integritas'),
					'nilai_komitmen' => $this->input->post('nilai_komitmen'),
					'nilai_disiplin' => $this->input->post('nilai_disiplin'),
					'nilai_kerjasama' => $this->input->post('nilai_kerjasama'),
					'nilai_kepemimpinan' => $this->input->post('nilai_kepemimpinan'),
					'jumlah_perilaku_kerja' => $jumlah_perilaku_kerja,
					'rata_perilaku_kerja' => $rata_perilaku_kerja,
					'nilai_perilaku_kerja' => $nilai_perilaku_kerja,
					'nilai_prestasi_kerja' => $nilai_prestasi_kerja,
				);
		$this->model_penilaian_prestasi_kerja->update($id,$data);
		$response = array();
		echo json_encode($response);
		return;
	}
	
	public function submit_nilai_realisasi($id) {
		$data = array(
						'realisasi_kualitas' => $this->input->post('realisasi_kualitas')
					);
		$this->model_penilaian_skp->update($this->input->post('id_kegiatan_tugas_jabatan'),$data);
		$this->hitung_skp($id);
		$response = array();
		echo json_encode($response);
		return;
	}

	public function submit_nilai_ttk($id) {
		$data = array(
						'nilai_capaian_skp' => $this->input->post('nilai_tugas_tambahan_kreatifitas')
					);
		$this->model_penilaian_skp->update($this->input->post('id_tugas_tambahan_kreatifitas'),$data);
		$this->hitung_skp($id);
		$response = array();
		echo json_encode($response);
		return;
	}

	
	private function hitung_skp($id) {
		if($pk = $this->model_penilaian_prestasi_kerja->get($id)){
			$skp = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$id));
			$tugas_tambahan_kreatifitas = 0;
			$tugas_jabatan = 0;
			$i = 0;
			foreach($skp as $item) {
				if($item->jenis_kegiatan == '1') {
					$kuantitas = ($item->realisasi_kuantitas / $item->target_kuantitas) * 100;
					$kualitas = ($item->realisasi_kualitas / $item->target_kualitas) * 100;
				
					$prosentase_waktu = 100 - ($item->realisasi_waktu/$item->target_waktu) * 100;
					$waktu = ($item->realisasi_waktu == 0) ? 0 : ($prosentase_waktu <= 24 ? ((1.76*$item->target_waktu-$item->realisasi_waktu)/$item->target_waktu)*100 : 76-((((1.76*$item->target_waktu-$item->realisasi_waktu)/$item->target_waktu)*100)-100));
				
					$prosentase_biaya = ($item->target_biaya == 0) ? 0 : (100 - ($item->realisasi_biaya/$item->target_biaya) * 100); 
					$biaya = ($item->realisasi_biaya == 0) ? 0 : ($prosentase_biaya <= 24 ? ((1.76*$item->target_biaya-$item->realisasi_biaya)/$item->target_biaya)*100 : 76-((((1.76*$item->target_biaya-$item->realisasi_biaya)/$item->target_biaya)*100)-100));
					$input['penghitungan'] = $kuantitas + $kualitas + $waktu + $biaya;
					$input['nilai_capaian_skp'] = ($item->target_biaya == 0) ? $input['penghitungan'] / 3 : $input['penghitungan'] / 4; 
					$this->model_penilaian_skp->update($item->id,$input);
					$tugas_jabatan += $input['nilai_capaian_skp'];
					$i++;
				} else {
					 $tugas_tambahan_kreatifitas += $item->nilai_capaian_skp;
				}
			}
			$input2['rata_capaian_skp'] = ($tugas_jabatan / $i) + $tugas_tambahan_kreatifitas;
			$input2['nilai_capaian_skp'] = 0.6 * $input2['rata_capaian_skp'];
			$input2['nilai_prestasi_kerja'] = $input2['nilai_capaian_skp'] + $pk->nilai_perilaku_kerja;
			$this->model_penilaian_prestasi_kerja->update($id,$input2);
		}	
	}
	
	public function selesai_evaluasi($id) {
		$data = array('tanggal_dibuat_penilai' => date("Y-m-d H:i:s"),
						'status'=>4
					);
		$this->model_penilaian_prestasi_kerja->update($id,$data);
		$response = array();
		echo json_encode($response);
	}
	
	public function submit_koreksi($id) {
		$data = array('koreksi' => $this->input->post('input_koreksi'),
						'tanggal_koreksi' => date("Y-m-d H:i:s"),
						'status' => '0'
					);
		$this->model_penilaian_prestasi_kerja->update($id,$data);
		$response = array();
		echo json_encode($response);
	}
	
	public function submit_koreksi_realisasi($id) {
		$data = array('koreksi_realisasi' => $this->input->post('input_koreksi_realisasi'),
						'tanggal_koreksi_realisasi' => date("Y-m-d H:i:s"),
						'status' => '2'
					);
		$this->model_penilaian_prestasi_kerja->update($id,$data);
		$response = array();
		echo json_encode($response);
	}
			
	public function setujui_skp($id) {
		$data = array('status' => '2',
						'tanggal_persetujuan' => date("Y-m-d H:i:s")
					);
		$this->model_penilaian_prestasi_kerja->update($id,$data);
		$response = array();
		echo json_encode($response);
	}
	
	public function submit_rekomendasi($id) {
		$data = array('rekomendasi' => $this->input->post('rekomendasi'),
						'tanggal_rekomendasi' => date("Y-m-d H:i:s"),
					);
		$this->model_penilaian_prestasi_kerja->update($id,$data);
		$response = array();
		echo json_encode($response);
	}

	public function submit_keberatan($id) {
		$data = array('keberatan' => $this->input->post('input_keberatan'),
						'tanggal_keberatan' => date("Y-m-d H:i:s"),
					);
		$this->model_penilaian_prestasi_kerja->update($id,$data);
		$response = array();
		echo json_encode($response);
	}
	
	public function submit_tanggapan($id) {
		$data = array('tanggapan' => $this->input->post('input_tanggapan'),
						'tanggal_tanggapan' => date("Y-m-d H:i:s"),
					);
		$this->model_penilaian_prestasi_kerja->update($id,$data);
		$response = array();
		echo json_encode($response);
	}
	
	public function submit_keputusan($id) {
		$data = array('keputusan' => $this->input->post('input_keputusan'),
						'tanggal_keputusan' => date("Y-m-d H:i:s"),
					);
		$this->model_penilaian_prestasi_kerja->update($id,$data);
		$response = array();
		echo json_encode($response);
	}
	
	public function selesai_skp($id) {
		$data = array(
						'status' => 5,
						'tanggal_selesai_skp' => date("Y-m-d H:i:s"),
					);
		$this->model_penilaian_prestasi_kerja->update($id,$data);
		$response = array();
		echo json_encode($response);
	}

	public function realisasi() {
		$data['title'] = "SKP - Pelaporan Realisasi";
        $data['menu'] = "realisasi";
	
		$nip = $this->session->userdata('nip');
		$pk = $this->model_penilaian_prestasi_kerja->get_status_lt5($nip);
		if($pk) {
			if(isset($_POST['id_kegiatan_tugas_jabatan'])){
				$id_tugas_jabatan = $this->input->post('id_kegiatan_tugas_jabatan');
				list($y,$m,$d,$h,$i,$s) = explode(" ",date("y m d H i s"));
				$filename = sprintf("%'.08d", $id_tugas_jabatan) . $y.$m.$d.$h.$i.$s;
				
				// Upload file
				$config['upload_path'] = FILE_PATH;
				$config['file_name'] = $filename;
				$config['allowed_types'] = 'pdf|zip|rar|gz|tar|doc|docx|ppt|pptx';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('inputfilerealisasi')) {
					$upload_data = $this->upload->data();
					$data = array('id_skp' => $id_tugas_jabatan,
								'kuantitas' => $this->input->post('kuantitas'),
								'biaya' => $this->input->post('biaya'),
								'ak' => $this->input->post('ak'),
								'dokumen' => $upload_data['file_name'],
								'created_on' => "$y-$m-$d $h:$i:$s"
							);	
					$this->model_realisasi_skp->update_realisasi($data,$pk->awal_penilaian);
				}
			} else if(isset($_POST['btnLaporTambahan'])) {	
				$this->db->trans_begin();

				$input1 = array('id_prestasi_kerja'=> $pk->id,
							'nip' => $pk->nip,
							'tahun' => $pk->tahun,
							'kegiatan' => $this->input->post('kegiatan'),
							'jenis_kegiatan' =>$this->input->post('jenis_kegiatan')		
						);
				$id_skp = $this->model_penilaian_skp->insert($input1);
				list($y,$m,$d,$h,$i,$s) = explode(" ",date("y m d H i s"));
				$filename = sprintf("%'.08d", $id_skp) . $y.$m.$d.$h.$i.$s;
								
				// Upload file
				$config['upload_path'] = FILE_PATH;
				$config['file_name'] = $filename;
				$config['allowed_types'] = 'pdf|zip|rar|gz|tar|doc|docx|ppt|pptx';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('inputfilerealisasitambahan')){
					$upload_data = $this->upload->data();
					$input2 = array('id_skp' => $id_skp,
						'dokumen' => $upload_data['file_name'],
						'created_on' => "$y-$m-$d $h:$i:$s"
					);	
					$this->model_realisasi_skp->insert($input2);						
					if($this->db->trans_status() === FALSE)
						$this->db_trans_rollback();
					else 
						$this->db->trans_commit();
				} else $this->db_trans_rollback();
			} 
			
			if(strlen($pk->koreksi_realisasi) > 0) {
				$data['error'] = $pk->koreksi_realisasi;
			}

			$data['tugas_jabatan'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>1));
			$data['tugas_tambahan'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>2));
			$data['kreatifitas'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>3));
			$data['skp'] = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id));
			foreach($data['skp'] as $skp) {	
				$data['realisasi'][$skp->id] = $this->model_realisasi_skp->get_where(array('id_skp'=>$skp->id));
			}
			$data['id_tugas_jabatan'] = $pk->id;
			$data['status'] = $pk->status;
			$this->load->view('skp/realisasi',$data);		
		} else {
			$this->load->view('skp/buat_perencanaan_baru',$data);
		}
	}
	
	public function laporkan_realisasi($id) {
		$data = array('status' => '3',
						'tanggal_selesai_realisasi' => date("Y-m-d H:i:s")
					);
		$this->model_penilaian_prestasi_kerja->update($id,$data);
		$message = "Pelaporan kegiatan tugas jabatan, tugas tambahan, dan kreatifitas berhasil.";
		$this->flash_success($message);
		$response = array();
		echo json_encode($response);
	}
	
	public function delete_realisasi($id) {
		$realisasi = $this->model_realisasi_skp->get($id);
		if($realisasi) {
			$status = $this->model_realisasi_skp->delete_realisasi($realisasi);
			if($status) {
				$file = FILE_PATH . $realisasi->dokumen;
				unlink($file);
				$message = "Penghapusan realisasi SKP berhasil.";
				$this->flash_success($message);
			} else {
				$message = "Penghapusan realisasi SKP gagal.";
				$this->flash_error($message);
			}
		} else {
			$message = "Penghapusan realisasi SKP gagal.";
			$this->flash_error($message);
		}
		$response = array();
		echo json_encode($response);
	}
	
	public function delete_ttk($id) {
		$realisasi = $this->model_realisasi_skp->get_where(array('id_skp'=>$id));
		if($realisasi) {
			$status = $this->model_realisasi_skp->delete_ttk($id);
			if($status) {
				$file = FILE_PATH . $realisasi[0]->dokumen;
				unlink($file);
				$message = "Penghapusan tugas tambahan/kreatifitas berhasil.";
				$this->flash_success($message);
			} else {
				$message = "Penghapusan tugas tambahan/kreatifitas gagal.";
				$this->flash_error($message);
			}
		} else {
			$message = "Penghapusan tugas tambahan/kreatifitas gagal.";
			$this->flash_error($message);
		}
		$response = array();
		echo json_encode($response);
	}
	
	// Download Dokumen Realisasi Pekerjaan Tugas Jabatan
	public function download_dokumen($filename){
		if($this->verify_access($filename)) {
			$this->load->helper('download');
			$data = file_get_contents(FILE_PATH . $filename);
			force_download($filename, $data);
		} else echo "Access Denied";
	}
	
	// Download Dokumen Tugas Tambahan dan Kreatifitas
	public function download_dokumen_ttk($id_skp){
		$realisasi = $this->model_realisasi_skp->get_where(array('id_skp'=>$id_skp));
		if($realisasi) 
			$this->download_dokumen($realisasi[0]->dokumen);
		else echo "Access Denied";
	}
	
	// Verifikasi akses terhadapa file yang akan didownload. File hanya bisa diakses oleh pegawai yang bersangkutan, pejabat penilai, dan atasan pejabat penilai
	private function verify_access($filename) {
		$nip = $this->session->userdata('nip');
		$authorized = $this->model_realisasi_skp->get_authorized_nips($filename);
		return $authorized ? (($nip == $authorized->nip || $nip == $authorized->nip_pejabat_penilai || $nip == $authorized->nip_atasan_pejabat_penilai) ? true : false) : false; 	
	}
	
	private function flash_success($message) {
		$data = '<div class="alert alert-block alert-success">' .
				'<button type="button" class="close" data-dismiss="alert">' .
				'<i class="icon-remove"></i>' .
				'</button>' .
				'<p>' .
				'<strong>' .
				'<i class="icon-ok"></i>' .
				'</strong>' .
				'&nbsp;' . $message .
				'</p>'.
				'</div>';
		$this->session->set_flashdata('message', $data);
	}
	
	private function flash_error($message) {
		$data = '<div class="alert alert-block alert-danger">' .
				'<button type="button" class="close" data-dismiss="alert">' .
				'<i class="icon-remove"></i>' .
				'</button>' .
				'<p>' .
				'<strong>' .
				'<i class="icon-remove"></i>' .
				'</strong>' .
				'&nbsp;' . $message .
				'</p>'.
				'</div>';
		$this->session->set_flashdata('message', $data);
	}

	
	private	function buildHTMLString($status,$data) {
		$htmlString = "";
		foreach($data as $item) {
			$htmlString .= '<tr>' .
							'<td><input type="text" size="40"  value="' . $item->kegiatan . '" readonly /></td>'.
							'<td><input style="text-align: center;" type="text" size="5" value="' . number_format($item->target_angka_kredit,0,",",".") . '" readonly /></td>'.
							'<td><input style="text-align: center;" type="text" size="5" value="' . number_format($item->target_kuantitas,0,",",".") . '"  readonly /></td>'.
							'<td><input style="text-align: center;" type="text" size="5" value="' . $item->satuan_kuantitas . '" readonly /></td>'.
							'<td><input style="text-align: center;" type="text" size="5" value="' . number_format($item->target_kualitas,0,",",".") . '"  readonly /></td>'.
							'<td><input style="text-align: center;" type="text" size="5" value="' . number_format($item->target_waktu,0,",",".") . '"  readonly /></td>'.
							'<td><input style="text-align: center;" type="text" size="5" value="' . $item->satuan_waktu . '"  readonly /></td>'.
							'<td><input style="text-align: center;" type="text" size="10" value="' . number_format($item->target_biaya,0,",",".") . '"  readonly /></td>'.
							'<td>';
			switch($status) {
				case 0:
					$htmlString .=
							'	<div id="delete">'.
							'		<button class="btn btn-sm btn-danger" rel="tooltip" id="btn-delete" value="' . $item->id . '">'.
							'			<i class="icon-remove"></i>'.
							'		</button>'.
							'	</div>';
					break;
				case 1:
					break;
			}
			$htmlString .= 	'</td>'.
							'</tr>';
		}
		return $htmlString;
	}
	
	public function unduh_pdf($id){
		$pk = $this->model_penilaian_prestasi_kerja->get($id);
		$tugas_jabatan = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>1));
		$tugas_tambahan = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>2));
		$kreatifitas = $this->model_penilaian_skp->get_where(array('id_prestasi_kerja'=>$pk->id,'jenis_kegiatan'=>3));
		
		$pegawai = $this->model_pegawai->get($pk->nip);
		$detail_pegawai = $this->model_pegawai->get_detail($pk->nip);
		$jabatan_pegawai = $this->model_jabatan->get($pegawai->id_jabatan);
		
		$pejabat_penilai = $this->model_pegawai->get($pk->nip_pejabat_penilai);
		$detail_pejabat_penilai = $this->model_pegawai->get_detail($pk->nip_pejabat_penilai);
		$jabatan_pejabat_penilai = $this->model_jabatan->get($pejabat_penilai->id_jabatan);
		
		$atasan_pejabat_penilai = $this->model_pegawai->get($pk->nip_atasan_pejabat_penilai);
		$detail_atasan_pejabat_penilai = $this->model_pegawai->get_detail($pk->nip_atasan_pejabat_penilai);
        $jabatan_atasan_pejabat_penilai = $this->model_jabatan->get($atasan_pejabat_penilai->id_jabatan);
		
		$this->load->library('fpdf');
        $this->fpdf->FPDF('L','cm', 'A4');
        $this->fpdf->Open();
        $this->fpdf->SetMargins(0.5,1,1,0.5);
		//Menambahkan Halaman 
        $this->fpdf->AddPage();
		//font 
        $this->fpdf->SetFont('Arial','B',16); 
		//cetak text PDF
        $teks = 'FORMULIR SASARAN KERJA';
        $teks2 = 'PEGAWAI NEGERI SIPIL';
        $this->fpdf->Cell(0,0, $teks ,0,0,'C');
		//pindah baris
        $this->fpdf->Ln(0.7);
        $this->fpdf->Cell(0,0, $teks2 ,2,0,'C');
               
		//tabel  
        $this->fpdf->ln(1);
        $x = 1;       //lebar
        $x_merger= 15;    
        $tb = 0.5;   // tinggi tabel
        
        $this->fpdf->SetX($x);
        $this->fpdf->SetFont('Arial','',8); 
        $this->fpdf->Cell(1,$tb, 'No' ,1,0,'C');
        $this->fpdf->Cell(12,$tb, 'I. PEJABAT PENILAI' ,1,0,'C');
        $this->fpdf->Cell(1,$tb, 'No' ,1,0,'C');
        $this->fpdf->Cell(14,$tb, 'II.PEGAWAI NEGERI SIPIL YANG DINILAI' ,1,0,'C');
		//ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(1,$tb, '1' ,1,0,'C');
        $this->fpdf->Cell(4,$tb, 'Nama' ,1,0,'L');
        $this->fpdf->Cell(8,$tb, $pk->nama_pejabat_penilai,1,0,'L');
        $this->fpdf->Cell(1,$tb, '1' ,1,0,'C');
        $this->fpdf->Cell(4,$tb, 'Nama' ,1,0,'L');
        $this->fpdf->Cell(10,$tb, $pk->nama_atasan_pejabat_penilai ,1,0,'L');
		//ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(1,$tb, '2' ,1,0,'C');
        $this->fpdf->Cell(4,$tb, 'NIP' ,1,0,'L');
        $this->fpdf->Cell(8,$tb, $pk->nip_pejabat_penilai ,1,0,'L');
        $this->fpdf->Cell(1,$tb, '2' ,1,0,'C');
        $this->fpdf->Cell(4,$tb, 'NIP' ,1,0,'L');
        $this->fpdf->Cell(10,$tb, $pk->nip_atasan_pejabat_penilai ,1,0,'L');
		//ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(1,$tb, '3' ,1,0,'C');
        $this->fpdf->Cell(4,$tb, 'Pangkat/Gol.Ruang' ,1,0,'L');
        $this->fpdf->Cell(8,$tb, $detail_pejabat_penilai->peg_gol_pangkat ,1,0,'L');
        $this->fpdf->Cell(1,$tb, '3' ,1,0,'C');
        $this->fpdf->Cell(4,$tb, 'Pangkat/Gol.Ruang' ,1,0,'L');
        $this->fpdf->Cell(10,$tb, $detail_atasan_pejabat_penilai->peg_gol_pangkat ,1,0,'L');
		//ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(1,$tb, '4' ,1,0,'C');
        $this->fpdf->Cell(4,$tb, 'Jabatan' ,1,0,'L');
        $this->fpdf->Cell(8,$tb, $jabatan_pejabat_penilai->deskripsi ,1,0,'L');
        $this->fpdf->Cell(1,$tb, '4' ,1,0,'C');
        $this->fpdf->Cell(4,$tb, 'Jabatan' ,1,0,'L');
        $this->fpdf->Cell(10,$tb, $jabatan_atasan_pejabat_penilai->deskripsi ,1,0,'L');
		//ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(1,1, 'NO' ,1,0,'C');
        $this->fpdf->Cell(12,1, 'III. KEGIATAN TUGAS JABATAN' ,1,0,'C');
        $this->fpdf->Cell(1,1, 'AK' ,1,0,'C');
        $this->fpdf->Cell(14,$tb, 'TARGET' ,1,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->SetX($x_merger);
        $this->fpdf->Cell(4,$tb, 'Kuant/Output' ,1,0,'C');
        $this->fpdf->Cell(3,$tb, 'Kual/Mutu' ,1,0,'C');
        $this->fpdf->Cell(4,$tb, 'Waktu' ,1,0,'C');
        $this->fpdf->Cell(3,$tb, 'Biaya' ,1,0,'C');
        
		//ganti garis
		// lopping database
		$no = 1;	
        foreach($tugas_jabatan as $tj):
		$this->fpdf->Ln();
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(1,$tb, $no ,1,0,'C');
        $this->fpdf->Cell(12,$tb, $tj->kegiatan ,1,0,'L');
        $this->fpdf->Cell(1,$tb, $tj->target_angka_kredit ,1,0,'C');
        $this->fpdf->Cell(2,$tb, $tj->target_kuantitas ,1,0,'C');
        $this->fpdf->Cell(2,$tb, $tj->satuan_kuantitas ,1,0,'C');
        $this->fpdf->Cell(3,$tb, $tj->target_kualitas ,1,0,'C');
        $this->fpdf->Cell(2,$tb, $tj->target_waktu ,1,0,'C');
        $this->fpdf->Cell(2,$tb, $tj->satuan_waktu ,1,0,'L');
        $this->fpdf->Cell(3,$tb, number_format($tj->target_biaya,0,",",".") ,1,0,'C');
        $no++;
		endforeach;
        //ganti baris
        $this->fpdf->Ln(1);
        $this->fpdf->SetX(22);
        $this->fpdf->Cell(1,0, 'Cepu,' . date_format(date_create($pk->tanggal_persetujuan),"d-m-Y") ,0,0,'C');
        
        $this->fpdf->Ln(0.5);
        $this->fpdf->SetX(8);
        $this->fpdf->Cell(1,0, 'Pejabat Penilai,' ,0,0,'C');
        $this->fpdf->SetX(21.5);
        $this->fpdf->Cell(2,0, 'Pegawai Negeri Sipil Yang dinilai,' ,0,0,'C');
        
        //ganti baris
        $this->fpdf->Ln(2);
        $this->fpdf->SetX(8);
        $this->fpdf->Cell(1,0, $pk->nama_pejabat_penilai ,0,0,'C');
        $this->fpdf->SetX(22);
        $this->fpdf->Cell(1,0, $detail_pegawai->peg_nm ,0,0,'C');
        
         //ganti baris
        $this->fpdf->Ln(0.5);
        $this->fpdf->SetX(8);
        $this->fpdf->Cell(1,0, $pk->nip_pejabat_penilai ,0,0,'C');
        $this->fpdf->SetX(22);
        $this->fpdf->Cell(1,0, $pk->nip ,0,0,'C');
        
		//buat halaman baru Pengukuran
        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(0.5,1,1,0.5);
		//font 
        $this->fpdf->SetFont('Arial','B',16); 
		//cetak text PDF
        $teks = 'PEGAWAI NEGERI SIPIL';
        $this->fpdf->Cell(0,0, $teks ,0,0,'C');
        
		//tabel pengukuran
        $this->fpdf->ln(1);
        $x = 0.5;       //lebar
        $y = 2;
        $x_merger= 8;    
        $tb = 0.5;   // tinggi tabel
        $tb_warna = 0.25;   // tinggi tabel
        $tb_merger =1; // tinggi tabel merger
        
        $this->fpdf->SetX($x);
        $this->fpdf->SetFont('Arial','',8); 
        $this->fpdf->Cell(1,$tb_merger, 'No' ,1,0,'C');
        $this->fpdf->Cell(5.5,$tb_merger, 'KEGIATAN TUGAS JABATAN' ,1,0,'C');
        $this->fpdf->Cell(1,$tb_merger, 'AK' ,1,0,'C');
        $this->fpdf->Cell(8,$tb, 'TARGET' ,1,0,'C');
        $this->fpdf->ln();
        $this->fpdf->SetX($x_merger);
        $this->fpdf->Cell(2,$tb, 'Kuant/Output' ,1,0,'C');
        $this->fpdf->Cell(2,$tb, 'Kual/Mutu' ,1,0,'C');
        $this->fpdf->Cell(2,$tb, 'Waktu' ,1,0,'C');
        $this->fpdf->Cell(2,$tb, 'Biaya' ,1,0,'C');
        $this->fpdf->SetY($y);
        $this->fpdf->SetX(16);
        $this->fpdf->Cell(1,$tb_merger, 'AK' ,1,0,'C');
        $this->fpdf->Cell(8,$tb, 'REALISASI' ,1,0,'C');
        $this->fpdf->ln();
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(2,$tb, 'Kuant/Output' ,1,0,'C');
        $this->fpdf->Cell(2,$tb, 'Kual/Mutu' ,1,0,'C');
        $this->fpdf->Cell(2,$tb, 'Waktu' ,1,0,'C');
        $this->fpdf->Cell(2,$tb, 'Biaya' ,1,0,'C');
        $this->fpdf->SetY($y);
        $this->fpdf->SetX(25);
        $this->fpdf->Cell(2.5,$tb_merger, 'PENGHITUNGAN' ,1,0,'C');
        $this->fpdf->Cell(1.5,$tb_merger, 'NILAI SKP' ,1,0,'C');
        
        //ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX($x);
        $this->fpdf->SetFont('Arial','',7); 
        $this->fpdf->SetFillColor(192,192,192);
        $this->fpdf->Cell(1,$tb_warna, '1' ,1,0,'C', true);
        $this->fpdf->Cell(5.5,$tb_warna, '2' ,1,0,'C',true);
        $this->fpdf->Cell(1,$tb_warna, '3' ,1,0,'C', true);
        $this->fpdf->Cell(2,$tb_warna, '4' ,1,0,'C', true);
        $this->fpdf->Cell(2,$tb_warna, '5' ,1,0,'C', true);
        $this->fpdf->Cell(2,$tb_warna, '6' ,1,0,'C', true);
        $this->fpdf->Cell(2,$tb_warna, '7' ,1,0,'C', true);
        $this->fpdf->Cell(1,$tb_warna, '8' ,1,0,'C', true);
        $this->fpdf->Cell(2,$tb_warna, '9' ,1,0,'C', true);
        $this->fpdf->Cell(2,$tb_warna, '10' ,1,0,'C', true);
        $this->fpdf->Cell(2,$tb_warna, '11' ,1,0,'C', true);
        $this->fpdf->Cell(2,$tb_warna, '12' ,1,0,'C', true);
        $this->fpdf->Cell(2.5,$tb_warna, '13' ,1,0,'C', true);
        $this->fpdf->Cell(1.5,$tb_warna, '14' ,1,0,'C', true);
        
		$no = 1;
		foreach($tugas_jabatan as $tj) :
        $this->fpdf->Ln();
        $this->fpdf->SetFont('Arial','',8); 
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(1,$tb, $no ,1,0,'C');
        $this->fpdf->Cell(5.5,$tb, $tj->kegiatan ,1,0,'L');
        $this->fpdf->Cell(1,$tb, $tj->target_angka_kredit ,1,0,'C');
        $this->fpdf->Cell(1,$tb, $tj->target_kuantitas ,1,0,'C');
        $this->fpdf->Cell(1,$tb, $tj->satuan_kuantitas ,1,0,'C');
        $this->fpdf->Cell(2,$tb, $tj->target_kualitas ,1,0,'C');
        $this->fpdf->Cell(1,$tb, $tj->target_waktu ,1,0,'C');
        $this->fpdf->Cell(1,$tb, $tj->satuan_waktu ,1,0,'C');
        $this->fpdf->Cell(2,$tb, number_format($tj->target_biaya,0,",",".") ,1,0,'C');
        $this->fpdf->Cell(1,$tb, $tj->realisasi_angka_kredit ,1,0,'C');
        $this->fpdf->Cell(1,$tb, $tj->realisasi_kuantitas ,1,0,'C');
        $this->fpdf->Cell(1,$tb, $tj->satuan_kuantitas ,1,0,'C');
        $this->fpdf->Cell(2,$tb, $tj->realisasi_kualitas ,1,0,'C');
        $this->fpdf->Cell(1,$tb, $tj->realisasi_waktu ,1,0,'C');
        $this->fpdf->Cell(1,$tb, $tj->satuan_waktu ,1,0,'C');
        $this->fpdf->Cell(2,$tb, number_format($tj->realisasi_biaya,0,",",".") ,1,0,'C');
        $this->fpdf->Cell(2.5,$tb, $tj->penghitungan ,1,0,'C');
        $this->fpdf->Cell(1.5,$tb, $tj->nilai_capaian_skp ,1,0,'C');
        $no++;
		endforeach;
		
        $this->fpdf->Ln();
        $angka_tmbhan=1;
        $this->fpdf->SetFont('Arial','',8); 
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(1,$angka_tmbhan, '' ,1,0,'C');
        $this->fpdf->MultiCell(5.5,0.5, 'II. TUGAS TAMBAHAN DAN KREATIFITAS' ,'LTRB','L',false);
        $this->fpdf->SetY(3.75);
        $this->fpdf->SetX(7);
        $this->fpdf->Cell(1,$angka_tmbhan, '' ,1,0,'C');
        $this->fpdf->Cell(8,$angka_tmbhan, '' ,1,0,'C');
        $this->fpdf->Cell(1,$angka_tmbhan, '' ,1,0,'C');
        $this->fpdf->Cell(8,$angka_tmbhan, '' ,1,0,'C');
        $this->fpdf->Cell(2.5,$angka_tmbhan, '' ,1,0,'C');
        $this->fpdf->Cell(1.5,$angka_tmbhan, '' ,1,0,'C');
        
		//ganti baris
		//looping database
		$i = 0;
		foreach($tugas_tambahan as $tt) :
        $this->fpdf->Ln();
        $angka_tmbhan=1;
        $this->fpdf->SetFont('Arial','',8); 
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(1,$tb, $i == 0 ? 1 : '' ,1,0,'C');
        $this->fpdf->Cell(5.5,$tb, $tt->kegiatan ,1,0,'L');
        $this->fpdf->Cell(1,$tb, '' ,1,0,'C');
        $this->fpdf->Cell(8,$tb, '' ,1,0,'C');
        $this->fpdf->Cell(1,$tb, '' ,1,0,'C');
        $this->fpdf->Cell(8,$tb, '' ,1,0,'C');
        $this->fpdf->Cell(2.5,$tb, '' ,1,0,'C');
        $this->fpdf->Cell(1.5,$tb, $tt->nilai_capaian_skp ,1,0,'C');
        $i++;
		endforeach;
		
		$i = 0;
		foreach($kreatifitas as $kr) :
        $this->fpdf->Ln();
        $angka_tmbhan=1;
        $this->fpdf->SetFont('Arial','',8); 
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(1,$tb, $i == 0 ? 2 : '' ,1,0,'C');
        $this->fpdf->Cell(5.5,$tb, $kr->kegiatan ,1,0,'L');
        $this->fpdf->Cell(1,$tb, '' ,1,0,'C');
        $this->fpdf->Cell(8,$tb, '' ,1,0,'C');
        $this->fpdf->Cell(1,$tb, '' ,1,0,'C');
        $this->fpdf->Cell(8,$tb, '' ,1,0,'C');
        $this->fpdf->Cell(2.5,$tb, '' ,1,0,'C');
        $this->fpdf->Cell(1.5,$tb, $kr->nilai_capaian_skp ,1,0,'C');
        $i++;
		endforeach;
		
		//ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(27,$tb, '' ,1,0,'C');
        $this->fpdf->Cell(1.5,$tb, '' ,1,0,'C');
		//ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(27,$angka_tmbhan, 'Nilai Capaian SKP' ,1,0,'C');
        $this->fpdf->Cell(1.5,$tb, $pk->rata_capaian_skp ,1,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->SetX(27.5);
        $this->fpdf->Cell(1.5,$tb, keterangan_nilai($pk->rata_capaian_skp) ,1,0,'C');
        
		//ganti baris
        $this->fpdf->Ln(1);
        $this->fpdf->SetX(24);
		$this->fpdf->Cell(1.5,$tb, 'Cepu, '. date_format(date_create($pk->tanggal_dibuat_penilai),"d-m-Y") ,2,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->SetX(24);
        $this->fpdf->Cell(1.5,$tb, 'Pejabat Penilai' ,2,0,'C');
        $this->fpdf->Ln(2);
        $this->fpdf->SetX(24);
        $this->fpdf->Cell(1.5,$tb, $pk->nama_pejabat_penilai ,2,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->SetX(24);
        $this->fpdf->Cell(1.5,$tb, 'NIP ' .$pk->nip_pejabat_penilai ,2,0,'C');

		//ganti page halaman Penilaian
		//buat halaman baru Pengukuran
        $this->fpdf->SetMargins(0.5,0.5,0,0);
        $this->fpdf->AddPage();        
		//font 
        $this->fpdf->SetFont('Arial','B',8); 
        $x = 0.5;       //lebar
        $y = 2;
        $x_merger= 8;    
        $tb1 = 0.75;   // tinggi tabel
        $tb = 1;   // tinggi tabel
        $tb_merger =8.75; // tinggi tabel merger
        
        $this->fpdf->SetX($x);
        $this->fpdf->SetFont('Arial','B',10); 
        $this->fpdf->Cell(1,$tb_merger, '4.' ,1,0,'C');
        $this->fpdf->Cell(12,$tb, 'UNSUR YANG DINILAI' ,1,0,'L');
        $this->fpdf->Cell(2,$tb, 'Jumlah' ,1,0,'C');
        
		//ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetFont('Arial','B',8);
        $this->fpdf->SetX(1.5);
        $this->fpdf->Cell(12,$tb, 'a. Sasaran Kerja Pegawai (SKP)' ,1,0,'L');
        $this->fpdf->Cell(2,$tb, $pk->nilai_capaian_skp ,1,0,'C');
        //ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX(1.5);
        $this->fpdf->Cell(3,6.75, 'b. Perilaku Kerja' ,1,0,'L');
        $this->fpdf->SetFont('Arial','',8);
        $this->fpdf->Cell(5,$tb1, '1. Orientasi Pelayanan' ,1,0,'L');
        $this->fpdf->Cell(2,$tb1, $pk->nilai_orientasi_pelayanan ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, keterangan_nilai($pk->nilai_orientasi_pelayanan) ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, '' ,1,0,'C');
        //ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX(4.5);
        $this->fpdf->Cell(5,$tb1, '2. Integritas' ,1,0,'L');
        $this->fpdf->Cell(2,$tb1, $pk->nilai_integritas ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, keterangan_nilai($pk->nilai_integritas) ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, '' ,1,0,'C');
        //ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX(4.5);
        $this->fpdf->Cell(5,$tb1, '3. Komitmen' ,1,0,'L');
        $this->fpdf->Cell(2,$tb1, $pk->nilai_komitmen ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, keterangan_nilai($pk->nilai_komitmen) ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, '' ,1,0,'C');
        //ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX(4.5);
        $this->fpdf->Cell(5,$tb1, '4. Disiplin' ,1,0,'L');
        $this->fpdf->Cell(2,$tb1, $pk->nilai_disiplin ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, keterangan_nilai($pk->nilai_disiplin) ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, '' ,1,0,'C');
        //ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX(4.5);
        $this->fpdf->Cell(5,$tb1, '5. Kerjasama' ,1,0,'L');
        $this->fpdf->Cell(2,$tb1, $pk->nilai_kerjasama ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, keterangan_nilai($pk->nilai_kerjasama) ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, '' ,1,0,'C');
        //ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX(4.5);
        $this->fpdf->Cell(5,$tb1, '6. Kepemimpinan' ,1,0,'L');
        $this->fpdf->Cell(2,$tb1, $pk->nilai_kepemimpinan ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, keterangan_nilai($pk->nilai_kepemimpinan) ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, '' ,1,0,'C');
        //ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX(4.5);
        $this->fpdf->Cell(5,$tb1, 'Jumlah' ,1,0,'L');
        $this->fpdf->Cell(2,$tb1, $pk->jumlah_perilaku_kerja ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, '' ,1,0,'L');
        $this->fpdf->Cell(2,$tb1, '' ,1,0,'C');
        //ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX(4.5);
        $this->fpdf->Cell(5,$tb1, 'Nilai Rata-rata' ,1,0,'L');
        $this->fpdf->Cell(2,$tb1, $pk->rata_perilaku_kerja ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, keterangan_nilai($pk->rata_perilaku_kerja) ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, '' ,1,0,'C');
		//ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX(4.5);
        $this->fpdf->Cell(5,$tb1, 'Nilai Perilaku Kerja' ,1,0,'L');
        $this->fpdf->Cell(2,$tb1, $pk->rata_perilaku_kerja ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, 'x 40%' ,1,0,'C');
        $this->fpdf->Cell(2,$tb1, $pk->nilai_perilaku_kerja ,1,0,'C');
		//ganti baris
        $this->fpdf->Ln();
        $this->fpdf->SetX(0.5);
        $this->fpdf->Cell(13,$tb, 'NILAI PRESTASI KERJA' ,1,0,'C');
        $this->fpdf->Cell(2,0.5, $pk->nilai_prestasi_kerja ,1,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->SetX(13.5);
        $this->fpdf->Cell(2,0.5, keterangan_nilai($pk->nilai_prestasi_kerja) ,1,0,'C');
		//GANTI BARIS
        $this->fpdf->Ln();
        $this->fpdf->SetX(0.5); 
		//isian Keberatan
        $this->fpdf->MultiCell(15,8.25, $pk->keberatan ,'LTRB','L',false);
        $this->fpdf->SetY(8.5);
        $this->fpdf->SetX(0.5);
        $this->fpdf->Cell(13,6, '5. KEBERATAN DARI PEGAWAI NEGERI L YANG DINILAI (APABILA ADA)' ,0,0,'L');
        $this->fpdf->SetY(16);
        $this->fpdf->SetX(7);
		//isi tanggal
		$tanggal_keberatan = $pk->keberatan == NULL ? '' : date_format(date_create($pk->tanggal_keberatan),"d-m-Y");
        $this->fpdf->Cell(4,2, 'Tanggal, ' . $tanggal_keberatan ,0,0,'L');
        
		//PENILAIAN Prestasi KERJA
        $x = 0.5;       //lebar
        $y = 2;
        $x_merger= 8;    
        $tb = 0.5;   // tinggi tabel
        $tb1 = 0.75;
        $tb_merger =4.5; // tinggi tabel merger
        
        $this->fpdf->SetFont('Arial','B','10');
        $this->fpdf->Image('assets/images/garuda.jpg',22,0.5,2);
        
        $this->fpdf->SetY(2.75);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(12,$tb, 'PENILAIAN PRESTASI KERJA' ,0,0,'C');
        $this->fpdf->SetY(3.25);
        $this->fpdf->SetX(22);
        $this->fpdf->Cell(2,$tb, 'PEGAWAI NEGERI SIPIL' ,0,0,'C');
        $this->fpdf->SetFont('Arial','','8');
        $this->fpdf->SetY(4);
        $this->fpdf->SetX(16);
        $this->fpdf->Cell(2,$tb, 'KEMENTRIAN ESDM' ,0,0,'l');
        $this->fpdf->SetX(25);
        $this->fpdf->Cell(2,$tb, 'JANGKA WAKTU PENILAIAN' ,0,0,'l');
        $this->fpdf->SetY(4.5);
        $this->fpdf->SetX(16);
        $this->fpdf->Cell(2,$tb, 'PUSDIKLAT MIGAS' ,0,0,'l');
        $this->fpdf->SetX(25);
		//ISIAN PERIODE
        $this->fpdf->Cell(2,$tb, 'BULAN : ' . date_format(date_create($pk->awal_penilaian),"d-m") . ' s.d ' . date_format(date_create($pk->akhir_penilaian),"d-m-Y") ,0,0,'l');
		//TABLE
        $this->fpdf->SetY(5);
        $this->fpdf->SetX(16);
        $this->fpdf->SetFont('Arial','B',8); 
        $this->fpdf->Cell(1,$tb_merger, '1.' ,1,0,'C');
        $this->fpdf->SetY(5);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(12,0.75, 'UNSUR YANG DINILAI' ,1,0,'L');
        $this->fpdf->SetFont('Arial','',8); 
        $this->fpdf->SetY(5.75);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'a. Nama.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $detail_pegawai->peg_nm ,1,0,'L');
        $this->fpdf->SetY(6.5);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'b. NIP.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $pegawai->nip ,1,0,'L');
        $this->fpdf->SetY(7.25);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'c. Pangkat, Golongan ruang, TMT.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $detail_pegawai->peg_gol_pangkat ,1,0,'L');
        $this->fpdf->SetY(8);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'd. Jabatan/Pekerjaan.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $jabatan_pegawai->deskripsi ,1,0,'L');
        $this->fpdf->SetY(8.75);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'e. Unit Organisasi.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $jabatan_pegawai->unit_kerja ,1,0,'L');
		
		//tabel no 2
        $this->fpdf->SetY(9.5);
        $this->fpdf->SetX(16);
        $this->fpdf->SetFont('Arial','B',8); 
        $this->fpdf->Cell(1,$tb_merger, '2.' ,1,0,'C');
        $this->fpdf->SetY(9.5);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(12,0.75, 'PEJABAT PENILAI' ,1,0,'L');
        $this->fpdf->SetFont('Arial','',8); 
        $this->fpdf->SetY(10.25);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'a. Nama.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $pk->nama_pejabat_penilai ,1,0,'L');
        $this->fpdf->SetY(11);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'b. NIP.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $pk->nip_pejabat_penilai ,1,0,'L');
        $this->fpdf->SetY(11.75);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'c. Pangkat, Golongan ruang, TMT.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $detail_pejabat_penilai->peg_gol_pangkat ,1,0,'L');
        $this->fpdf->SetY(12.5);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'd. Jabatan/Pekerjaan.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $jabatan_pejabat_penilai->deskripsi ,1,0,'L');
        $this->fpdf->SetY(13.25);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'e. Unit Organisasi.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $jabatan_pejabat_penilai->unit_kerja ,1,0,'L');
        
		//tabel no 3
        $this->fpdf->SetY(14);
        $this->fpdf->SetX(16);
        $this->fpdf->SetFont('Arial','B',8); 
        $this->fpdf->Cell(1,$tb_merger, '3.' ,1,0,'C');
        $this->fpdf->SetY(14);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(12,0.75, 'ATASAN PEJABAT PENILAI' ,1,0,'L');
        $this->fpdf->SetFont('Arial','',8); 
        $this->fpdf->SetY(14.75);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'a. Nama.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $pk->nama_atasan_pejabat_penilai ,1,0,'L');
        $this->fpdf->SetY(15.5);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'b. NIP.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $pk->nip_atasan_pejabat_penilai ,1,0,'L');
        $this->fpdf->SetY(16.25);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'c. Pangkat, Golongan ruang, TMT.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $detail_atasan_pejabat_penilai->peg_gol_pangkat ,1,0,'L');
        $this->fpdf->SetY(17);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'd. Jabatan/Pekerjaan.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $jabatan_atasan_pejabat_penilai->deskripsi ,1,0,'L');
        $this->fpdf->SetY(17.75);
        $this->fpdf->SetX(17);
        $this->fpdf->Cell(6,$tb1, 'e. Unit Organisasi.' ,1,0,'L');
        $this->fpdf->Cell(6,$tb1, $jabatan_atasan_pejabat_penilai->unit_kerja ,1,0,'L');
        
        
        //ganti page halaman Penilaian
        //buat halaman baru 
        $this->fpdf->SetMargins(0.5,0.5,0,0);
        $this->fpdf->AddPage();        
         //font 
        $this->fpdf->SetFont('Arial','B',8); 
        $x = 0.5;       //lebar
        $y = 9.25;
        $x_merger= 8;    
        $tb = 1;   // tinggi tabel
        $tb_merger =8.75; // tinggi tabel merger
        
        $this->fpdf->SetX($x);
        $this->fpdf->SetFont('Arial','B',8); 
        $this->fpdf->Cell(15,$tb_merger, '8. REKOMENDASI: ' . $pk->rekomendasi ,1,0,'C');
        $this->fpdf->SetY($y);
        $this->fpdf->Cell(15,$tb_merger, '' ,1,0,'L');
        $this->fpdf->SetY(9.5);
        $this->fpdf->SetX(7.5);
        $this->fpdf->Cell(6,$tb, '9. DIBUAT TANGGAL, ' .date_format(date_create($pk->tanggal_dibuat_penilai),"d-m-Y") ,0,0,'L');
        $this->fpdf->SetY(10);
        $this->fpdf->SetX(8.5);
        $this->fpdf->Cell(7,$tb, 'PEJABAT PENILAI,' ,0,0,'C');
        $this->fpdf->SetY(11.5);
        $this->fpdf->SetX(8.5);
        $this->fpdf->Cell(7,$tb, $pk->nama_pejabat_penilai ,0,0,'C');
        $this->fpdf->SetY(13);
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(6,$tb, '10. DITERIMA TANGGAL, ' . date_format(date_create($pk->tanggal_diterima_yang_dinilai),"d-m-Y") ,0,0,'L');
        $this->fpdf->SetY(13.5);
        $this->fpdf->SetX(1);
        $this->fpdf->Cell(6,$tb, 'PEGAWAI NEGERI SIPIL YANG DINILAI,' ,0,0,'l');
        $this->fpdf->SetY(15);
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(7,$tb, $detail_pegawai->peg_nm ,0,0,'C');
    
		// Nomor NIP
        $this->fpdf->SetFont('Arial','',8); 
        $this->fpdf->SetY(12);
        $this->fpdf->SetX(8.5);
        $this->fpdf->Cell(7,$tb, 'NIP, '.$pk->nip_pejabat_penilai ,0,0,'C');
        $this->fpdf->SetFont('Arial','',8); 
        $this->fpdf->SetY(15.5);
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(7,$tb, 'NIP, ' .$pk->nip ,0,0,'C');
              
        
		//HALAMAN TANGGAPAN PEJABAT PENILAI
        //font 
        $this->fpdf->SetFont('Arial','B',8); 
        $x = 16;       //lebar
        $x1 = 16.5;       //lebar
        $y = 0.5;
        $y1 = 9.25;
        $y2 = 9.75; 
        $tb = 1;   // tinggi tabel
        $tb_merger =8.75; // tinggi tabel merger

		//TABEL HALAMAN TANGGAPAN PEJABAT PENILAI 
		//FONT        
        $this->fpdf->SetFont('Arial','B',8);
        $this->fpdf->SetY($y);
        $this->fpdf->SetX($x);
        $this->fpdf->MultiCell(13,$tb_merger, '' ,'LTRB','L',false);
        $this->fpdf->SetY($y);
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(10,$tb, '6. TANGGAPAN PEJABAT PENILAI' ,0,0,'L');
        $this->fpdf->SetY(1);
        $this->fpdf->SetX($x1);        
        $this->fpdf->Cell(10,$tb, 'ATAS KEBERATAN' ,0,0,'L');
        $this->fpdf->SetY(7.5);
        $this->fpdf->SetX(19);
		$tanggal_tanggapan = $pk->tanggapan == NULL ? '' : date_format(date_create($pk->tanggal_tanggapan),"d-m-Y");
        $this->fpdf->Cell(5,1, 'Tanggal, '.$tanggal_tanggapan ,0,0,'C');
        $this->fpdf->SetFont('Arial','',8);
        $this->fpdf->SetY(3);
        $this->fpdf->SetX(17);        
        $this->fpdf->MultiCell(11.5,0.5, $pk->tanggapan ,'','L',false);
		
		//ganti halaman
        $this->fpdf->SetFont('Arial','B',8);
        $this->fpdf->SetY($y1);
        $this->fpdf->SetX($x);
        $this->fpdf->MultiCell(13,$tb_merger, '' ,'LTRB','L',false);
        $this->fpdf->SetY($y1);
        $this->fpdf->SetX($x);
        $this->fpdf->Cell(10,$tb, '7. KEPUTUSAN ATASAN PEJABAT' ,0,0,'L');
        $this->fpdf->SetY($y2);
        $this->fpdf->SetX(16.5);        
        $this->fpdf->Cell(10,$tb, 'PENILAI ATAS KEBERATAN' ,0,0,'L');
        $this->fpdf->SetY(16.5);
        $this->fpdf->SetX(19);        
		$tanggal_keputusan = $pk->keputusan == NULL ? '' : date_format(date_create($pk->tanggal_keputusan),"d-m-Y");	
        $this->fpdf->Cell(5,$tb, 'Tanggal, '.$tanggal_keputusan ,0,0,'C');
        $this->fpdf->SetFont('Arial','',8);
        $this->fpdf->SetY(11.5);
        $this->fpdf->SetX(17);        
        $this->fpdf->MultiCell(11.5,0.5, $pk->keputusan ,'','L',false);
       
		//output
        $this->fpdf->Ln();
        $this->fpdf->Output();
    }

}
?>
