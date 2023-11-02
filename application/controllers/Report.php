<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    // public function index()
    // {
    // 	$this->load->view('welcome_message');
    // }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        $this->load->library('Pdf');
    }

    public function tabel_rep_tangki()
    {
        $data['tangki'] = $this->M_admin->select('tb_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Tangki';
        $this->load->view('admin/report/tangki/tampilan_rep_tangki', $data);
    }


    public function cetak_print_tangki()
    {
        $data['tangki'] = $this->M_admin->select('tb_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Tangki';
        $this->load->view('admin/report/tangki/print_tangki', $data);
    }

    public function cetak_detail_tangki()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_tangki' => $uri);

        $data['tangki'] = $this->M_admin->get_data('tb_tangki', $where);
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Tangki';
        $this->load->view('admin/report/tangki/print_detail_tangki', $data);
    }

    public function control_detail_tangki()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_tangki' => $uri);
        $data['tangki'] = $this->M_admin->get_data('tb_tangki', $where);
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Tangki';
        $this->load->view('admin/report/tangki/detail_tangki', $data);
    }


    ##### END REPORT TANGKI ######
    ##### END REPORT TANGKI ######
    ##### END REPORT TANGKI ######

    public function tabel_rep_surat_tangki()
    {
        $data['list_tangki'] = $this->M_admin->select('tb_tangki');

        $data['surat_tangki'] = $this->M_admin->get_surat_tangki('table_surat_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Surat-Surat Kendaraan Truk Tangki';
        $this->load->view('admin/report/surat_tangki/tampilan_rep_surat_tangki', $data);
    }

    public function cetak_rep_surat_tangki()
    {
        $nopol = $this->input->post('nopol');

        if (empty($nopol)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :          
            $data['surat_tangki'] = $this->M_admin->get_surat_tangki('table_surat_tangki');
        } else {
            $data['surat_tangki'] = $this->M_admin->filter_nopol_surat('table_surat_tangki', $nopol);
        }
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Report Surat Tangki';
        $this->load->view('admin/report/surat_tangki/print_surat_tangki-tcp', $data);
    }

    public function cetak_nopol_surat_tangki()
    {
        $nopol = $this->input->post('nopol');

        if (empty($nopol)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :          
            $data['surat_tangki'] = $this->M_admin->get_surat_tangki('table_surat_tangki');
        } else {
            $data['surat_tangki'] = $this->M_admin->filter_nopol_surat('table_surat_tangki', $nopol);
        }
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Report Surat Tangki';
        $this->load->view('admin/report/surat_tangki/print_detail_surat_tangki-tcp', $data);
    }


    ######################
    public function cetak_info_service_unit()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_service_masuk' => $uri);


        $data['list_service_masuk'] = $this->M_admin->get_service_masuk('tb_service_masuk', $where);

        // $data['tangki'] = $this->M_admin->select('tb_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Tangki';
        $this->load->view('admin/report/service_masuk/info_service_unit', $data);
    }

    ################################
    ################################
    ################################
    public function tabel2_rep_perbaikan()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $nopol = $this->input->get('nopol');

        if (empty($bulan) or empty($tahun) or empty($nopol)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['perbaikan'] = $this->M_admin->select_perbaikan('tb_perbaikan');
            $data['total_data'] = $this->M_admin->sum_perbaikan('tb_perbaikan');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['perbaikan'] = $this->M_admin->perbaikan_periode('tb_perbaikan', $bulan, $tahun, $nopol);
            $data['total_data'] = $this->M_admin->sum_perbaikan_periode('tb_perbaikan', $bulan, $tahun, $nopol);
            $label = 'Nopol ' . $nopol . ' Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;

        // $data['perbaikan'] = $this->M_admin->select_perbaikan('tb_perbaikan');        
        $data['tangki'] = $this->M_admin->get_sp_tangki('tb_supir_tangki');

        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Perbaikan';
        $this->load->view('admin/report/perbaikan/tampilan2_rep_perbaikan', $data);
    }

    public function cetak_rep_perbaikan()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $nopol = $this->input->get('nopol');

        if (empty($bulan) or empty($tahun) or empty($nopol)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['perbaikan'] = $this->M_admin->select_perbaikan('tb_perbaikan');
            $data['total_data'] = $this->M_admin->sum_perbaikan('tb_perbaikan');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['perbaikan'] = $this->M_admin->perbaikan_periode('tb_perbaikan', $bulan, $tahun, $nopol);
            $data['total_data'] = $this->M_admin->sum_perbaikan_periode('tb_perbaikan', $bulan, $tahun, $nopol);
            $label = 'Nopol ' . $nopol . ' Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;

        // $data['perbaikan'] = $this->M_admin->select_perbaikan('tb_perbaikan');        

        $data['tangki'] = $this->M_admin->get_sp_tangki('tb_supir_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Perbaikan';
        $this->load->view('admin/report/perbaikan/print_rep_perbaikan', $data);
    }

#######################
public function cetak_rep_perbaikanbulan1tahun()
    {
        $tahun = $this->input->get('tahun');
        $nopol = $this->input->get('nopol');

        if (empty($tahun) or empty($nopol)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['perbaikan'] = $this->M_admin->select_perbaikanbulan1tahun('tb_perbaikan');
            $data['total_data'] = $this->M_admin->sum_perbaikan('tb_perbaikan');
            $label = ' Tahun ...';
        } else {
            $data['perbaikan'] = $this->M_admin->perbaikan_bulan1tahun('tb_perbaikan', $tahun, $nopol);
            $data['total_data'] = $this->M_admin->sum_perbaikan_bulan1tahun('tb_perbaikan', $tahun, $nopol);
            $label = 'Nopol ' . $nopol . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;

        // $data['perbaikan'] = $this->M_admin->select_perbaikan('tb_perbaikan');        

        $data['tangki'] = $this->M_admin->get_sp_tangki('tb_supir_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Perbaikan';
        $this->load->view('admin/report/perbaikan/print_rep_perbaikanbulan1tahun', $data);
    }   



    #############################
    // SUPIR TANKI
    #############################

    public function tabel_rep_supir_tangki()
    {
        // $data['supir_tangki'] = $this->M_admin->select('tb_supir_tangki');
        $data['supir_tangki'] = $this->M_admin->get_supir_tangki('tb_supir_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Supir Tangki';
        $this->load->view('admin/report/supir_tangki/tampilan_supir_tangki', $data);
    }

    public function cetak_rep_supir_tangki()
    {
        // $data['supir_tangki'] = $this->M_admin->select('tb_supir_tangki');
        $data['supir_tangki'] = $this->M_admin->get_supir_tangki('tb_supir_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Supir Tangki';
        $this->load->view('admin/report/supir_tangki/print_supir_tangki', $data);
    }


    #############################
    // SUPIR 
    #############################
    public function tabel_rep_supir()
    {
        $data['supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Supir';
        $this->load->view('admin/report/supir/tampilan_rep_supir', $data);
    }

    public function cetak_rep_supir()
    {
        $data['supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Supir';
        $this->load->view('admin/report/supir/print_rep_supir', $data);
    }

    public function info_rep_supir()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_supir' => $uri);
        $data['supir'] = $this->M_admin->get_data('tb_supir', $where);
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Info Report Supir';
        $this->load->view('admin/report/supir/info_supir', $data);
    }

    public function cetak_info_supir()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_supir' => $uri);
        $data['supir'] = $this->M_admin->get_data('tb_supir', $where);
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Supir';
        $this->load->view('admin/report/supir/print_info_supir', $data);
    }




    #############################
    //PENGELUARAN
    #############################
    public function tabel_rep_pengeluaran()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $nopol = $this->input->get('nopol');
        if (empty($bulan) or empty($tahun) or empty($nopol)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['pengeluaran'] = $this->M_admin->select_pengeluaran('tb_pengeluaran');
            $data['total_data'] = $this->M_admin->sum_pengeluaran('tb_pengeluaran');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['pengeluaran'] = $this->M_admin->pengeluaran_periode('tb_pengeluaran', $bulan, $tahun,$nopol);
            $data['total_data'] = $this->M_admin->sum_penngeluaranPeriode('tb_pengeluaran', $bulan, $tahun,$nopol);
            $label = 'Nopol ' . $nopol . 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;

        // $data['list_data'] = $this->M_admin->select('tb_pengeluaran');
        $data['tangki'] = $this->M_admin->select('tb_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pengeluaran Lain-lain';
        $this->load->view('admin/report/pengeluaran/tampilan_rep_pengeluaran', $data);
    }

    public function cetak_rep_pengeluaran()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $nopol = $this->input->get('nopol');
        if (empty($bulan) or empty($tahun) or empty($nopol)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['pengeluaran'] = $this->M_admin->select_pengeluaran('tb_pengeluaran');
            $data['total_data'] = $this->M_admin->sum_pengeluaran('tb_pengeluaran');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['pengeluaran'] = $this->M_admin->pengeluaran_periode('tb_pengeluaran', $bulan, $tahun,$nopol);
            $data['total_data'] = $this->M_admin->sum_pengeluaranPeriode('tb_pengeluaran', $bulan, $tahun,$nopol);
            $label = 'Nopol ' . $nopol . 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;

        // $data['list_data'] = $this->M_admin->select('tb_pengeluaran');
        $data['tangki'] = $this->M_admin->select('tb_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pengeluaran Lain-lain';
        $this->load->view('admin/report/pengeluaran/print_rep_pengeluaran', $data);
    }






    public function tabel_rep_service_masuk()
    {
        $data['service_masuk'] = $this->M_admin->select_service_masuk('tb_service_masuk');

        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'REP Service masuk';
        $this->load->view('admin/report/form_service_masuk/service_masuk', $data);
    }



    public function tabel_exp_surat()
    {
        $data['exp_surat'] = $this->M_admin->tabel_exp_surat('tb_exp_surat');
        $data['total_data'] = $this->M_admin->sum_biaya_exp('tb_exp_surat');



        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Exp Surat Tangki';
        $this->load->view('admin/report/exp_surat/tampilan_exp_surat', $data);
    }

    public function cetak_exp_surat()
    {
        $data['exp_surat'] = $this->M_admin->tabel_exp_surat('tb_exp_surat');
        $data['total_data'] = $this->M_admin->sum_biaya_exp('tb_exp_surat');



        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Exp Surat Tangki';
        $this->load->view('admin/report/exp_surat/print_exp_surat', $data);
    }

    ################################################
    ################################################
    ################################################

    public function tabel_angkutan()
    {
        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $nopol = $this->input->get('nopol');

        // $label = 'Periode Tanggal ' . date('d-m-Y', strtotime($tgl_awal)) . ' s/d ' .  date('d-m-Y', strtotime($tgl_akhir));
        if (empty($tgl_awal) or empty($tgl_akhir) or empty($nopol)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['angkutan'] = $this->M_admin->get_angkutan('tb_angkutan');
            $data['total_data'] = $this->M_admin->sum_angkutan('tb_angkutan');

            $label = 'Nopol........ Dari Tanggal .... Sampai Tanggal ...';
        } else {

            $data['angkutan'] = $this->M_admin->angkutan_periode($tgl_awal, $tgl_akhir, $nopol);
            $data['total_data'] = $this->M_admin->hitung_kilo($tgl_awal, $tgl_akhir, $nopol);
            $label = 'Nopol ' . $nopol . ', Dari Tanggal :' . $tgl_awal . '. Sampai Tanggal : ' .  $tgl_akhir;
        }
        $data['label'] = $label;
        // $data = $this->M_admin->angkutan_periode($tgl_awal, $tgl_akhir);


        $data['tangki'] = $this->M_admin->get_sp_tangki('tb_supir_tangki');
        // $data['angkutan'] = $this->M_admin->get_angkutan('tb_angkutan');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Angkutan RTR';
        $this->load->view('admin/report/angkutan/angkutan', $data);
    }




    public function cetak_angkutan()
    {
        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $nopol = $this->input->get('nopol');

        // $label = 'Periode Tanggal ' . date('d-m-Y', strtotime($tgl_awal)) . ' s/d ' .  date('d-m-Y', strtotime($tgl_akhir));
        if (empty($tgl_awal) or empty($tgl_akhir) or empty($nopol)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['angkutan'] = $this->M_admin->get_angkutan('tb_angkutan');
            $data['total_data'] = $this->M_admin->sum_angkutan('tb_angkutan');

            $label = 'Nopol........ Dari Tanggal .... Sampai Tanggal ...';
        } else {

            $data['angkutan'] = $this->M_admin->angkutan_periode($tgl_awal, $tgl_akhir, $nopol);
            $data['total_data'] = $this->M_admin->hitung_kilo($tgl_awal, $tgl_akhir, $nopol);
            $label = 'Nopol ' . $nopol . ', Dari Tanggal :' . $tgl_awal . '. Sampai Tanggal : ' .  $tgl_akhir;
        }
        $data['label'] = $label;
        // $data = $this->M_admin->angkutan_periode($tgl_awal, $tgl_akhir);


        $data['tangki'] = $this->M_admin->get_sp_tangki('tb_supir_tangki');
        // $data['angkutan'] = $this->M_admin->get_angkutan('tb_angkutan');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Angkutan RTR';
        $this->load->view('admin/report/angkutan/print_angkutan', $data);
    }

    ########################################

    public function tabel_rep_seri_ban()
    {
        $nopol = $this->input->get('nopol');



        if (empty($nopol)) {
            $data['seri_ban'] = $this->M_admin->get_seri_ban('tb_seri_ban');
        } else {

            $data['seri_ban'] = $this->M_admin->nopol_seri_ban($nopol);
        }


        $data['tangki'] = $this->M_admin->get_sp_tangki('tb_supir_tangki');

        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Seri Ban';
        $this->load->view('admin/report/form_seri_ban/tampilan_rep_seri_ban', $data);
    }

    public function cetak_seri_ban()
    {
        $nopol = $this->input->get('nopol');



        if (empty($nopol)) {
            $data['seri_ban'] = $this->M_admin->get_seri_ban('tb_seri_ban');
        } else {

            $data['seri_ban'] = $this->M_admin->nopol_seri_ban($nopol);
        }


        $data['tangki'] = $this->M_admin->get_sp_tangki('tb_supir_tangki');

        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Seri Ban';
        $this->load->view('admin/report/form_seri_ban/print_seri_ban', $data);
    }
}
