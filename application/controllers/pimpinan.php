<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pimpinan extends CI_Controller
{

    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }


    public function profile()
    {
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Profile';
        $this->load->view('pimpinan/form_user/profile', $data);
        // $this->load->view('admin/profile', $data);
    }

    public function proses_newpassword()
    {
        // $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required');
        $this->form_validation->set_rules('confirm_new_password', 'Konfirmasi Password Baru', 'matches[new_password]');

        if ($this->form_validation->run() == true) {

            $username = $this->input->post('username');
            $nama = $this->input->post('nama');
            $new_password = $this->input->post('new_password');

            $data = array(
                'nama' => $nama,
                'password' => $this->hash_password($new_password)
            );
            $where = array(
                'id' => $this->session->userdata('id')
            );
            $this->M_admin->update_password('tb_user', $where, $data);
            $this->session->set_flashdata('msg_sukses', 'Password Berhasil Diganti, Silahkan Sign Out dan Login Kembali');
            redirect(base_url('pimpinan/profile'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Profile';
            $this->load->view('pimpinan/form_user/profile', $data);
        }
    }

    #########
    
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

    public function tabel_supir()
    {
        $data['supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Supir';
        $this->load->view('pimpinan/form_supir/supir', $data);
    }

    public function info_service_unit()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_service_masuk' => $uri);


        $data['list_service_masuk'] = $this->M_admin->get_service_masuk('tb_service_masuk', $where);
        // $data['list_supir_tangki'] = $this->M_admin->get_supir_tangki('tb_supir_tangki');
        // $data['list_bengkel'] = $this->M_admin->select('tb_bengkel');
        // $data['list_supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Info Service Per Unit';
        $this->load->view('pimpinan/report/form_service_masuk/info_service_unit', $data);
    }

}
