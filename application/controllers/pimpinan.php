<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pimpinan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        $this->load->library('upload');
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        if ($this->session->userdata('status') == 'login' && $this->session->userdata('level') == 1) {
            // $data['count'] = $this->M_pimpinan->notif_stok('tb_sparepart');
            // $data['num'] = $this->M_pimpinan->notif_stok_jml('tb_sparepart');
            // $data['dataSupir'] = $this->M_pimpinan->numrows('tb_supir');
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Home';
            $this->load->view('pimpinan/index', $data);
        } else {
            $this->load->view('login/login');
        }
        // $this->load->view('welcome_message');
    }

    public function signout()
    {
        session_destroy();
        redirect('login');
    }

}
