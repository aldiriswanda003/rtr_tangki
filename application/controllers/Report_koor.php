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


    public function cetak_rep_tangki()
    {
        $data['tangki'] = $this->M_admin->select('tb_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Tangki';
        $this->load->view('admin/report/tangki/rep_tangki', $data);
    }

    ##### END REPORT TANGKI ######
    ##### END REPORT TANGKI ######
    ##### END REPORT TANGKI ######

    public function tabel_rep_surat_tangki()
    {
        $data['surat_tangki'] = $this->M_admin->get_surat_tangki('table_surat_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Surat-Surat Kendaraan Truk Tangki';
        $this->load->view('admin/report/surat_tangki/tampilan_rep_surat_tangki', $data);
    }

    public function cetak_rep_surat_tangki()
    {
        $data['surat_tangki'] = $this->M_admin->get_surat_tangki('table_surat_tangki');

        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Report Surat Tangki';
        $this->load->view('admin/report/surat_tangki/rep_surat_tangki', $data);
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
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['perbaikan'] = $this->M_admin->select_perbaikan('tb_perbaikan');
            $data['total_data'] = $this->M_admin->sum_perbaikan('tb_perbaikan');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['perbaikan'] = $this->M_admin->perbaikan_periode('tb_perbaikan', $bulan, $tahun);
            $data['total_data'] = $this->M_admin->sum_perbaikan_periode('tb_perbaikan', $bulan, $tahun);
            $label = 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;

        // $data['perbaikan'] = $this->M_admin->select_perbaikan('tb_perbaikan');        

        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Perbaikan';
        $this->load->view('admin/report/perbaikan/tampilan2_rep_perbaikan', $data);
    }

    public function cetak_rep_perbaikan()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['perbaikan'] = $this->M_admin->select_perbaikan('tb_perbaikan');
            $data['total_data'] = $this->M_admin->sum_perbaikan('tb_perbaikan');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['perbaikan'] = $this->M_admin->perbaikan_periode('tb_perbaikan', $bulan, $tahun);
            $data['total_data'] = $this->M_admin->sum_perbaikan_periode('tb_perbaikan', $bulan, $tahun);
            $label = 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;

        // $data['perbaikan'] = $this->M_admin->select_perbaikan('tb_perbaikan');        

        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Perbaikan';
        $this->load->view('admin/report/perbaikan/print_rep_perbaikan', $data);
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
        $this->load->view('koor/report/supir_tangki/tampilan_supir_tangki', $data);
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
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['pengeluaran'] = $this->M_admin->select('tb_pengeluaran');
            $data['total_data'] = $this->M_admin->sum_pengeluaran('tb_pengeluaran');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['pengeluaran'] = $this->M_admin->pengeluaran_periode('tb_pengeluaran', $bulan, $tahun);
            $data['total_data'] = $this->M_admin->sum_penngeluaranPeriode('tb_pengeluaran', $bulan, $tahun);
            $label = 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;

        // $data['list_data'] = $this->M_admin->select('tb_pengeluaran');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pengeluaran Lain-lain';
        $this->load->view('admin/report/pengeluaran/tampilan_rep_pengeluaran', $data);
    }

    public function cetak_rep_pengeluaran()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
            $data['pengeluaran'] = $this->M_admin->select('tb_pengeluaran');
            $data['total_data'] = $this->M_admin->sum_pengeluaran('tb_pengeluaran');
            $label = 'Bulan ke ...' . ' Tahun ...';
        } else {
            $data['pengeluaran'] = $this->M_admin->pengeluaran_periode('tb_pengeluaran', $bulan, $tahun);
            $data['total_data'] = $this->M_admin->sum_penngeluaranPeriode('tb_pengeluaran', $bulan, $tahun);
            $label = 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
        }
        $data['label'] = $label;

        // $data['list_data'] = $this->M_admin->select('tb_pengeluaran');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Pengeluaran Lain-lain';
        $this->load->view('admin/report/pengeluaran/print_rep_pengeluaran', $data);
    }
}
