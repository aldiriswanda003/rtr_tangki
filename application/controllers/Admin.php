<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        $this->load->library('upload');
        $this->load->library('mailer');
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url("login"));
        }
    }

    public function nav()
    {
        $tgl = date('Y-m-d');

        $data['notifOut'] = $this->M_admin->notif_exp_surat('table_surat_tangki', $tgl);
        $data['numOut'] = $this->M_admin->notif_angka_exp('table_surat_tangki', $tgl);
        // $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $this->load->view('admin/template/nav', $data);
    }

    public function index()
    {

        // $bulan = date('m');
        // $tahun = date('Y');

        // $data['notifOut'] = $this->M_data->notif_u_keluar('table_surat_tangki', $tgl);
        // $data['numOut'] = $this->M_data->notif_u_keluarJml('table_surat_tangki', $tgl);

        // $data['count'] = $this->M_admin->notif_stok('tb_sparepart');
        // $data['num'] = $this->M_admin->notif_stok_jml('tb_sparepart');

        $tgl = date('Y-m-d');

        $data['notifOut'] = $this->M_admin->notif_exp_surat('table_surat_tangki', $tgl);
        $data['numOut'] = $this->M_admin->notif_angka_exp('table_surat_tangki', $tgl);


        $data['dataSupir'] = $this->M_admin->numrows('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Home';
        $this->load->view('admin/index', $data);

        // $this->load->view('welcome_message');
    }

    public function signout()
    {
        session_destroy();
        redirect('login');
    }

    public function token_generate()
    {
        return $tokens = md5(uniqid(rand(), true));
    }

    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    ####################################
    //* Users
    ####################################

    public function users()
    {
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['user'] = $this->M_admin->select('tb_user');
        $data['title'] = 'Users';
        $this->load->view('admin/form_user/users', $data);
    }

    public function tambah_users()
    {
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah User';
        $this->load->view('admin/form_user/tambahuser', $data);
    }

    public function proses_tambahuser()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == true) {

            $nama     = $this->input->post('nama', true);
            $username     = $this->input->post('username', true);
            $password     = $this->input->post('password', true);
            $level         = $this->input->post('level', true);

            $data = array(
                'nama'    => $nama,
                'username'    => $username,
                'password'     => $this->hash_password($password),
                'level'         => $level,
            );

            // $dataUpload = array(
            //     'id' => '',
            //     'username_user' => $username,
            //     'nama_file' => 'nopic.png'
            // );

            $this->M_admin->insert('tb_user', $data);
            // $this->M_admin->insert('tb_avatar', $dataUpload);

            $this->session->set_flashdata('msg_sukses', 'User Berhasil Ditambahkan');
            redirect(base_url('admin/users'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar(' tb_avatar', $this->session->userdata('name'));
            $header['title'] = 'Tambah User';
            $this->load->view('admin/form_users/tambahuser', $header);
        }

        // $data['title'] = 'Tambah User';
        // $this->load->view('admin/form_users/tambahuser', $data);
    }

    public function proses_deleteuser()
    {
        $id = $this->uri->segment(3);
        $where = array('id' => $id);
        $this->M_admin->delete('tb_user', $where);
        $this->session->set_flashdata('msg_sukses', 'User Berhasil Di Hapus');
        redirect(base_url('admin/users'));
    }

    public function edit_user()
    {
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $id = $this->uri->segment(3);
        $where = array('id' => $id);
        $data['list_data'] = $this->M_admin->get_data('tb_user', $where);
        $data['title'] = 'Edit User';
        $this->load->view('admin/form_user/edituser', $data);
    }

    public function proses_edituser()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == true) {
            $id    = $this->input->post('id', true);
            $username    = $this->input->post('username', true);
            $nama    = $this->input->post('nama', true);
            $level = $this->input->post('level', true);

            $where = array('id' => $id);
            $data = array(
                'username' => $username,
                'nama' => $nama,
                'level' => $level,
            );
            $this->M_admin->update('tb_user', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data User Berhasil Diubah');
            redirect(base_url('admin/users'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar(' tb_avatar', $this->session->userdata('name'));
            $data['title'] = 'Edit User';
            $this->load->view('admin/form_users/edituser', $data);
        }
    }
    ####################################
    //* End Users
    ####################################

    ####################################
    //* Profile
    ####################################
    public function profile()
    {
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Profile';
        $this->load->view('admin/form_user/profile', $data);
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
            redirect(base_url('admin/profile'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Profile';
            $this->load->view('admin/form_user/profile', $data);
        }
    }

    // public function proses_gambarupload()
    // {
    //     $config = array(
    //         'upload_path' => "./assets/upload/user/",
    //         'allowed_types' => "jpg|png|jpeg",
    //         'ecrypt_name'    => false,
    //         'overwrite'    => true,
    //         // 'file_name'	=> uniqid(),
    //         'max_size' => "5000",
    //         'max_height' => "1024",
    //         'max_width' => "1024"
    //     );
    //     $this->load->library('upload', $config);
    //     $this->upload->initialize($config);

    //     if (!$this->upload->do_upload('userpicture')) {
    //         $this->session->set_flashdata('msg_gambar_error', $this->upload->display_errors());
    //         $data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
    //         $data['title'] = 'Profile';
    //         $this->load->view('admin/form_users/profile', $data);
    //     } else {
    //         $data_upload = array('upload_data' => $this->upload->data());
    //         $nama_file = $data_upload['upload_data']['file_name'];

    //         $where = array(
    //             'username_user' => $this->session->userdata('name')
    //         );
    //         $data = array(
    //             'nama_file' => $nama_file
    //         );

    //         $this->M_admin->update_avatar($where, $data);
    //         $this->session->set_flashdata('msg_gambar_sukses', 'Gambar Berhasil Di Upload');
    //         redirect(base_url('admin/profile'));
    //     }
    // }

    ####################################
    //* End Profile
    ####################################

    ####################################
    //* Supir
    ####################################

    public function tabel_supir()
    {
        $data['supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Supir';
        $this->load->view('admin/form_supir/supir', $data);
    }

    public function upload_gambarsupir()
    {
        $config = array(
            'upload_path' => './assets/upload/supir/foto_supir/',
            'allowed_types' => 'gif|jpg|png',
            'ecrypt_name'    => false,
            'overwrite'    => true,
            // 'file_name'	=> uniqid(),
            'max_size' => 2048,
            'max_height' => 2000,
            'max_width' => 2000
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto_supir')) {
            $error = $this->upload->display_errors();
            return $error;
            // die('gagal diupload');
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $userfile = $data_upload['upload_data']['file_name'];

            return $userfile;
        }
    }

    public function upload_gambarsim()
    {
        $config = array(
            'upload_path' => './assets/upload/supir/foto_sim/',
            'allowed_types' => 'gif|jpg|png',
            'ecrypt_name'    => false,
            'overwrite'    => true,
            // 'file_name'	=> uniqid(),
            'max_size' => 2048,
            'max_height' => 1080,
            'max_width' => 1920
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto_sim')) {
            $error = $this->upload->display_errors();
            return $error;
            // die('gagal diupload');
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $userfile = $data_upload['upload_data']['file_name'];

            return $userfile;
        }
    }


    //UNTUK UPLOAD GAMBAR DATA SUPIR
    public function upload_gambarktp()
    {
        $config = array(
            'upload_path' => './assets/upload/supir/foto_ktp/',
            'allowed_types' => 'gif|jpg|png',
            'ecrypt_name'    => false,
            'overwrite'    => true,
            // 'file_name'	=> uniqid(), 
            'max_size' => 2048, //UKURAN FILE
            'max_height' => 1080,
            'max_width' => 1920
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto_ktp')) {
            $error = $this->upload->display_errors();
            return $error;
            // die('gagal diupload');
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $userfile = $data_upload['upload_data']['file_name'];

            return $userfile;
        }
    }

    public function tambah_supir()
    {
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Data Supir';
        $this->load->view('admin/form_supir/tambahsupir', $data);
    }

    public function proses_tambah_supir()
    {
        $this->form_validation->set_rules('nama_supir', 'Nama Supir', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required');
        $this->form_validation->set_rules('email_supir', 'email_supir', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $foto_supir = $this->upload_gambarsupir();
            $foto_sim = $this->upload_gambarsim();
            $foto_ktp = $this->upload_gambarktp();

            $nama = $this->input->post('nama_supir', TRUE);
            $no_hp = $this->input->post('no_telp', TRUE);
            $email_supir = $this->input->post('email_supir', TRUE);

            $data = array(
                'nama_supir' => $nama,
                'no_telp' => $no_hp,
                'email_supir' => $email_supir,
                'foto_supir' => $foto_supir,
                'foto_sim' => $foto_sim,
                'foto_ktp' => $foto_ktp
            );
            $this->M_admin->insert('tb_supir', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_supir'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Supir';
            $this->load->view('admin/form_supir/tambahsupir', $data);
        }
    }

    public function edit_supir()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_supir' => $uri);
        $data['supir'] = $this->M_admin->get_data('tb_supir', $where);
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Edit Supir';
        $this->load->view('admin/form_supir/editsupir', $data);
    }

    public function proses_edit_supir()
    {
        $this->form_validation->set_rules('nama_supir', 'Nama Supir', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required');
        $this->form_validation->set_rules('email_supir', 'email_supir', 'trim|required');


        if ($this->form_validation->run() === TRUE) {


            $id_supir = $this->input->post('id_supir', true);
            $nama = $this->input->post('nama_supir', TRUE);
            $no_hp = $this->input->post('no_telp', TRUE);
            $foto_supir_old = $this->input->post('foto_supir_old', true);
            $foto_sim_old = $this->input->post('foto_sim_old', true);
            $foto_ktp_old = $this->input->post('foto_ktp_old', true);
            $email_supir = $this->input->post('email_supir', TRUE);


            $foto_supir = $this->upload_gambarsupir();
            $foto_sim = $this->upload_gambarsim();
            $foto_ktp = $this->upload_gambarktp();

            if ($foto_supir == '<p>You did not select a file to upload.</p>') {
                $foto_supir_new = $foto_supir_old;
            } else {
                $foto_supir_new = $foto_supir;
            };
            // 
            if ($foto_sim == '<p>You did not select a file to upload.</p>') {
                $foto_sim_new = $foto_sim_old;
            } else {
                $foto_sim_new = $foto_sim;
            };
            // 
            if ($foto_ktp == '<p>You did not select a file to upload.</p>') {
                $foto_ktp_new = $foto_ktp_old;
            } else {
                $foto_ktp_new = $foto_ktp;
            };

            $where = array('id_supir' => $id_supir);
            $data = array(
                'nama_supir' => $nama,
                'no_telp' => $no_hp,
                'email_supir' => $email_supir,

                'foto_supir' => $foto_supir_new,
                'foto_sim' => $foto_sim_new,
                'foto_ktp' => $foto_ktp_new
            );
            $this->M_admin->update('tb_supir', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Update');
            redirect(base_url('admin/tabel_supir'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Edit Supir';
            $this->load->view('admin/form_supir/editsupir', $data);
        }
    }

    public function hapus_data()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_supir' => $uri);

        $this->M_admin->delete('tb_supir', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
        redirect(base_url('admin/tabel_supir'));
    }

    ####################################
    //* End Supir
    ####################################

    ####################################
    //* Data Tangki
    ####################################

    public function tabel_tangki()
    {
        $data['tangki'] = $this->M_admin->select('tb_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Tangki';
        $this->load->view('admin/form_tangki/tangki', $data);
    }



    public function upload_foto_tangki_depan()
    {
        $config = array(
            'upload_path' => './assets/upload/foto_tangki/',
            'allowed_types' => 'gif|jpg|png',
            'ecrypt_name'    => false,
            'overwrite'    => true,
            // 'file_name'	=> uniqid(),
            'max_size' => 2048,
            'max_height' => 2000,
            'max_width' => 2000
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // if (!$this->upload->do_upload('foto_depan')) {
        if (!$this->upload->do_upload('foto_depan')) {
            $error = $this->upload->display_errors();
            return $error;
            // die('gagal diupload');
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $userfile = $data_upload['upload_data']['file_name'];

            return $userfile;
        }
    }
    public function upload_foto_tangki_belakang()
    {
        $config = array(
            'upload_path' => './assets/upload/foto_tangki/',
            'allowed_types' => 'gif|jpg|png',
            'ecrypt_name'    => false,
            'overwrite'    => true,
            // 'file_name'	=> uniqid(),
            'max_size' => 2048,
            'max_height' => 2000,
            'max_width' => 2000
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // if (!$this->upload->do_upload('foto_depan')) {
        if (!$this->upload->do_upload('foto_belakang')) {
            $error = $this->upload->display_errors();
            return $error;
            // die('gagal diupload');
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $userfile = $data_upload['upload_data']['file_name'];

            return $userfile;
        }
    }
    public function upload_foto_tangki_kiri()
    {
        $config = array(
            'upload_path' => './assets/upload/foto_tangki/',
            'allowed_types' => 'gif|jpg|png',
            'ecrypt_name'    => false,
            'overwrite'    => true,
            // 'file_name'	=> uniqid(),
            'max_size' => 2048,
            'max_height' => 2000,
            'max_width' => 2000
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // if (!$this->upload->do_upload('foto_depan')) {
        if (!$this->upload->do_upload('foto_kiri')) {
            $error = $this->upload->display_errors();
            return $error;
            // die('gagal diupload');
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $userfile = $data_upload['upload_data']['file_name'];

            return $userfile;
        }
    }
    public function upload_foto_tangki_kanan()
    {
        $config = array(
            'upload_path' => './assets/upload/foto_tangki/',
            'allowed_types' => 'gif|jpg|png',
            'ecrypt_name'    => false,
            'overwrite'    => true,
            // 'file_name'	=> uniqid(),
            'max_size' => 2048,
            'max_height' => 2000,
            'max_width' => 2000
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // if (!$this->upload->do_upload('foto_depan')) {
        if (!$this->upload->do_upload('foto_kanan')) {
            $error = $this->upload->display_errors();
            return $error;
            // die('gagal diupload');
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $userfile = $data_upload['upload_data']['file_name'];

            return $userfile;
        }
    }

    public function control_detail_tangki()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_tangki' => $uri);
        $data['tangki'] = $this->M_admin->get_data('tb_tangki', $where);
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Tangki';
        $this->load->view('admin/form_tangki/detail_tangki', $data);
    }




    public function tambah_tangki()
    {
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Data Tangki';
        $this->load->view('admin/form_tangki/tambahtangki', $data);
    }

    public function proses_tambah_tangki()
    {
        $this->form_validation->set_rules('nopol', 'Nopol', 'trim|required');
        $this->form_validation->set_rules('tahun_dibuat', 'Tahun Dibuat', 'trim|required');
        $this->form_validation->set_rules('volume_tangki', 'Volume Tangki', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $foto_depan = $this->upload_foto_tangki_depan();
            $foto_belakang = $this->upload_foto_tangki_belakang();
            $foto_kiri = $this->upload_foto_tangki_kiri();
            $foto_kanan = $this->upload_foto_tangki_kanan();

            $nopol = $this->input->post('nopol', TRUE);
            $tahun_dibuat = $this->input->post('tahun_dibuat', TRUE);
            $volume_tangki = $this->input->post('volume_tangki', TRUE);

            $data = array(
                'nopol' => $nopol,
                'tahun_dibuat' => $tahun_dibuat,
                'foto_depan' => $foto_depan,
                'foto_belakang' => $foto_belakang,
                'foto_kanan' => $foto_kanan,
                'foto_kiri' => $foto_kiri,
                'volume_tangki  ' => $volume_tangki
            );
            $this->M_admin->insert('tb_tangki', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_tangki'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Tangki';
            $this->load->view('admin/form_tangki/tambahtangki', $data);
        }
    }

    public function edit_tangki()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_tangki' => $uri);
        $data['tangki'] = $this->M_admin->get_data('tb_tangki', $where);
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Edit Tangki';
        $this->load->view('admin/form_tangki/edittangki', $data);
    }

    public function proses_edit_tangki()
    {

        $this->form_validation->set_rules('nopol', 'Nopol', 'trim|required');
        $this->form_validation->set_rules('tahun_dibuat', 'Tahun Dibuat', 'trim|required');
        $this->form_validation->set_rules('volume_tangki', 'Volume Tangki', 'trim|required');

        if ($this->form_validation->run() === TRUE) {



            $id = $this->input->post('id_tangki', TRUE);
            $nopol = $this->input->post('nopol', TRUE);
            $tahun_dibuat = $this->input->post('tahun_dibuat', TRUE);
            $volume_tangki = $this->input->post('volume_tangki', TRUE);
            $foto_depan_old = $this->input->post('foto_depan_old', TRUE);
            $foto_belakang_old = $this->input->post('foto_belakang_old', TRUE);
            $foto_kiri_old = $this->input->post('foto_kiri_old', TRUE);
            $foto_kanan_old = $this->input->post('foto_kanan_old', TRUE);

            $foto_depan = $this->upload_foto_tangki_depan();
            $foto_belakang = $this->upload_foto_tangki_belakang();
            $foto_kiri = $this->upload_foto_tangki_kiri();
            $foto_kanan = $this->upload_foto_tangki_kanan();

            if ($foto_depan == '<p>You did not select a file to upload.</p>') {
                $foto_depan_new = $foto_depan_old;
            } else {
                $foto_depan_new = $foto_depan;
            };

            if ($foto_belakang == '<p>You did not select a file to upload.</p>') {
                $foto_belakang_new = $foto_belakang_old;
            } else {
                $foto_belakang_new = $foto_belakang;
            };

            if ($foto_kiri == '<p>You did not select a file to upload.</p>') {
                $foto_kiri_new = $foto_kiri_old;
            } else {
                $foto_kiri_new = $foto_kiri;
            };

            if ($foto_kanan == '<p>You did not select a file to upload.</p>') {
                $foto_kanan_new = $foto_kanan_old;
            } else {
                $foto_kanan_new = $foto_kanan;
            };

            $where = array('id_tangki' => $id);
            $data = array(
                'nopol' => $nopol,
                'tahun_dibuat' => $tahun_dibuat,
                'foto_depan' => $foto_depan_new,
                'foto_belakang' => $foto_belakang_new,
                'foto_kanan' => $foto_kanan_new,
                'foto_kiri' => $foto_kiri_new,
                'volume_tangki' => $volume_tangki
            );
            $this->M_admin->update('tb_tangki', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Update');
            redirect(base_url('admin/tabel_tangki'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
            $data['title'] = 'Edit Tangki';
            $this->load->view('admin/form_tangki/edittangki', $data);
        }
    }

    public function hapus_data_tangki()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_tangki' => $uri);

        $this->M_admin->delete('tb_tangki', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
        redirect(base_url('admin/tabel_tangki'));
    }

    ####################################
    //* End Data Tangki
    ####################################

    ####################################
    //* Data Bengkel
    ####################################

    public function tabel_bengkel()
    {
        $data['bengkel'] = $this->M_admin->select('tb_bengkel');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Data Bengkel';
        $this->load->view('admin/form_bengkel/bengkel', $data);
    }

    public function tambah_bengkel()
    {
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Data Bengkel';
        $this->load->view('admin/form_bengkel/tambahbengkel', $data);
    }

    public function proses_tambah_bengkel()
    {
        $this->form_validation->set_rules('nama_bengkel', 'Nama Bengkel', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat Bengkel', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $nama_bengkel = $this->input->post('nama_bengkel', TRUE);
            $alamat = $this->input->post('alamat', TRUE);
            $no_telp = $this->input->post('no_telp', TRUE);

            $data = array(
                'nama_bengkel' => $nama_bengkel,
                'alamat' => $alamat,
                'no_telp' => $no_telp
            );
            $this->M_admin->insert('tb_bengkel', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Bengkel Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_bengkel'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Bengkel';
            $this->load->view('admin/form_bengkel/tambahbengkel', $data);
        }
    }

    public function edit_bengkel()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_bengkel' => $uri);
        $data['bengkel'] = $this->M_admin->get_data('tb_bengkel', $where);
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Edit Bengkel';
        $this->load->view('admin/form_bengkel/editbengkel', $data);
    }

    public function proses_edit_bengkel()
    {
        $this->form_validation->set_rules('nama_bengkel', 'Nama Bengkel', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat Bengkel', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $id_bengkel = $this->input->post('id_bengkel');
            $nama_bengkel = $this->input->post('nama_bengkel', TRUE);
            $alamat = $this->input->post('alamat', TRUE);
            $no_telp = $this->input->post('no_telp', TRUE);

            $where = array('id_bengkel' => $id_bengkel);
            $data = array(
                'nama_bengkel' => $nama_bengkel,
                'alamat' => $alamat,
                'no_telp' => $no_telp
            );
            $this->M_admin->update('tb_bengkel', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Edit');
            redirect(base_url('admin/tabel_bengkel'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
            $data['title'] = 'Edit Bengkel';
            $this->load->view('admin/form_bengkel/editbengkel', $data);
        }
    }

    public function hapus_data_bengkel()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_bengkel' => $uri);

        $this->M_admin->delete('tb_bengkel', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Bengkel Berhasil Dihapus');
        redirect(base_url('admin/tabel_bengkel'));
    }


    ####################################
    //* End Data Bengkel
    ####################################



    public function tabel_surat_tangki()
    {
        // $tgl = date('Y-m-d');
        // $data['count'] = $this->M_data->notif_stok('tb_sparepa');
        // $data['num'] = $this->M_data->notif_stok_jml('tb_sparepart');

        // $data['lbl'] = $this->M_admin->notif_surat_tangki('table_surat_tangki');


        // $data['lbl'] = $label;

        $data['surat_tangki'] = $this->M_admin->get_surat_tangki('table_surat_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Surat Tangki';
        $this->load->view('admin/form_surat_tangki/surat_tangki', $data);
    }

    public function tambah_surat()
    {
        $data['list_tangki'] = $this->M_admin->select('tb_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Surat Tangki';
        $this->load->view('admin/form_surat_tangki/tambah_surat', $data);
    }

    public function proses_tambah_surat()
    {
        $this->form_validation->set_rules('id_tangki', 'nopol', 'trim|required');
        $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'trim|required');
        $this->form_validation->set_rules('tanggal_expired', 'Tgl Exp', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $foto_surat = $this->upload_surat_tangki();
            $id_tangki = $this->input->post('id_tangki', TRUE);
            $jenis_surat = $this->input->post('jenis_surat', TRUE);
            $tanggal_expired = $this->input->post('tanggal_expired', TRUE);
            $status = $this->input->post('status', TRUE);

            $data = array(
                'id_tangki' => $id_tangki,
                'jenis_surat' => $jenis_surat,
                'foto_surat' => $foto_surat,
                'tanggal_expired' => $tanggal_expired,
                'status' => $status

            );
            $this->M_admin->insert('table_surat_tangki', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_surat_tangki'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Surat';
            $this->load->view('admin/form_surat_tangki/tambah_surat', $data);
        }
    }


    //FOTO SURAT TANGKI
    public function upload_surat_tangki()
    {
        $config = array(
            'upload_path' => './assets/upload/surat_tangki/',
            'allowed_types' => 'gif|jpg|png|pdf',
            'ecrypt_name'    => false,
            'overwrite'    => true,
            // 'file_name'	=> uniqid(), 
            'max_size' => 2048, //UKURAN FILE
            'max_height' => 5000,
            'max_width' => 5000
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto_surat')) {
            $error = $this->upload->display_errors();
            return $error;
            // die('gagal diupload');
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $userfile = $data_upload['upload_data']['file_name'];

            return $userfile;
        }
    }

    public function edit_surat()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_surat' => $uri);
        $data['surat'] = $this->M_admin->get_data('table_surat_tangki', $where);
        $data['tangki'] = $this->M_admin->select('tb_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Edit Surat Tangki';
        $this->load->view('admin/form_surat_tangki/edit_surat', $data);
    }


    //edit surat
    public function proses_edit_surat()
    {
        $this->form_validation->set_rules('id_tangki', 'nopol', 'trim|required');
        $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'trim|required');
        $this->form_validation->set_rules('tanggal_expired', 'Tgl Exp', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        if ($this->form_validation->run() === TRUE) {

            $id_surat = $this->input->post('id_surat', true);
            $foto_surat = $this->upload_surat_tangki();
            $id_tangki = $this->input->post('id_tangki', TRUE);
            $foto_surat_old = $this->input->post('foto_surat_old', true);
            $jenis_surat = $this->input->post('jenis_surat', TRUE);
            $tanggal_expired = $this->input->post('tanggal_expired', TRUE);
            $status = $this->input->post('status', TRUE);

            // 
            if ($foto_surat == '<p>You did not select a file to upload.</p>') {
                $foto_surat_new = $foto_surat_old;
            } else {
                $foto_surat_new = $foto_surat;
            };

            $where = array('id_surat' => $id_surat);
            $data = array(

                'id_tangki' => $id_tangki,
                'jenis_surat' => $jenis_surat,
                'foto_surat' => $foto_surat_new,
                'tanggal_expired' => $tanggal_expired,
                'status' => $status
            );
            $this->M_admin->update('table_surat_tangki', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Update');
            redirect(base_url('admin/tabel_surat_tangki '));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Edit Surat';
            $this->load->view('admin/form_surat/edit_surat', $data);
        }
    }


    // HAPUS SURAT
    public function hapus_surat()
    {
        // segmen adalah alamat yang ada diatas pencarian
        $uri = $this->uri->segment(3);
        $where = array('id_surat' => $uri);

        $this->M_admin->delete('table_surat_tangki', $where);
        $this->session->set_flashdata('msg_sukses', 'Data surat tangki Berhasil Dihapus');
        redirect(base_url('admin/tabel_surat_tangki'));
        // redirect mengarahkan atau mengembalikan ke halaman yang dituju
    }
    ####################################
    //* End Data Surat Tangki
    ####################################

    public function tabel_seri_ban()
    {
        // $data['seri_ban'] = $this->M_admin->select('tb_seri_ban');
        $data['seri_ban'] = $this->M_admin->get_seri_ban('tb_seri_ban');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Seri Ban';
        $this->load->view('admin/form_seri_ban/seri_ban', $data);
    }

    public function tambah_seri_ban()
    {
        $data['list_tangki'] = $this->M_admin->select('tb_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Seri Ban';
        $this->load->view('admin/form_seri_ban/tambah_seri', $data);
    }



    public function proses_tambah_seri()
    {
        $this->form_validation->set_rules('id_tangki', 'nopol', 'trim|required');
        $this->form_validation->set_rules('tanggal_beli', 'Tanggal Beli', 'trim|required');
        $this->form_validation->set_rules('tempat_beli', 'Tempat Beli', 'trim|required');
        $this->form_validation->set_rules('no_seri_ban', 'Nomor Seri', 'trim|required');
        $this->form_validation->set_rules('ukuran_ban', 'Ukuran Ban', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $id_tangki = $this->input->post('id_tangki', TRUE);
            $tanggal_beli = $this->input->post('tanggal_beli', TRUE);
            $tempat_beli = $this->input->post('tempat_beli', TRUE);
            $no_seri_ban = $this->input->post('no_seri_ban', TRUE);
            $ukuran_ban = $this->input->post('ukuran_ban', TRUE);
            $keterangan = $this->input->post('keterangan', TRUE);

            $data = array(
                'id_tangki' => $id_tangki,
                'tanggal_beli' => $tanggal_beli,
                'tempat_beli' => $tempat_beli,
                'no_seri_ban' => $no_seri_ban,
                'ukuran_ban' => $ukuran_ban,
                'keterangan' => $keterangan


            );
            $this->M_admin->insert('tb_seri_ban', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_seri_ban'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Seri ';
            $this->load->view('admin/form_seri_ban/tambah_seri', $data);
        }
    }



    public function edit_seri()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_seri_ban' => $uri);
        $data['seri_ban'] = $this->M_admin->get_data('tb_seri_ban', $where);
        $data['tangki'] = $this->M_admin->select('tb_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Edit Seri Ban';
        $this->load->view('admin/form_seri_ban/edit_seri', $data);
    }

    public function proses_edit_seri()
    {
        $this->form_validation->set_rules('id_tangki', 'nopol', 'trim|required');
        $this->form_validation->set_rules('tanggal_beli', 'Tanggal Beli', 'trim|required');
        $this->form_validation->set_rules('tempat_beli', 'Tempat Beli', 'trim|required');
        $this->form_validation->set_rules('no_seri_ban', 'Nomor Seri', 'trim|required');
        $this->form_validation->set_rules('ukuran_ban', 'Ukuran Ban', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

        if ($this->form_validation->run() === TRUE) {

            $id_seri_ban = $this->input->post('id_seri_ban', TRUE);
            $id_tangki = $this->input->post('id_tangki', TRUE);
            $tanggal_beli = $this->input->post('tanggal_beli', TRUE);
            $tempat_beli = $this->input->post('tempat_beli', TRUE);
            $no_seri_ban = $this->input->post('no_seri_ban', TRUE);
            $ukuran_ban = $this->input->post('ukuran_ban', TRUE);
            $keterangan = $this->input->post('keterangan', TRUE);


            $where = array('id_seri_ban' => $id_seri_ban);
            $data = array(
                'id_tangki' => $id_tangki,
                'tanggal_beli' => $tanggal_beli,
                'tempat_beli' => $tempat_beli,
                'no_seri_ban' => $no_seri_ban,
                'ukuran_ban' => $ukuran_ban,
                'keterangan' => $keterangan


            );
            $this->M_admin->update('tb_seri_ban', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Ubah');
            redirect(base_url('admin/tabel_seri_ban'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Edit Data Seri ';
            $this->load->view('admin/form_seri_ban/edit_seri', $data);
        }
    }
    //hapus seri ban
    public function hapus_seri()
    {
        // segmen adalah alamat yang ada diatas pencarian
        $uri = $this->uri->segment(3);
        $where = array('id_seri_ban' => $uri);

        $this->M_admin->delete('tb_seri_ban', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Seri Ban Berhasil Dihapus');
        redirect(base_url('admin/tabel_seri_ban'));
        // redirect mengarahkan atau mengembalikan ke halaman yang dituju
    }
    ######## END DATA SERI BAN ############
    ######## END DATA SERI BAN ############
    ######## END DATA SERI BAN ############



    // DATA SUPIR DAN TANGKI
    public function tabel_supir_tangki()
    {
        // $data['supir_tangki'] = $this->M_admin->select('tb_supir_tangki');
        $data['supir_tangki'] = $this->M_admin->get_supir_tangki('tb_supir_tangki');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Supir Tangki';
        $this->load->view('admin/form_supir_tangki/supir_tangki', $data);
    }

    public function tambah_supir_tangki()
    {
        $data['list_tangki'] = $this->M_admin->select('tb_tangki');
        $data['list_supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Supir Tangki';
        $this->load->view('admin/form_supir_tangki/tambah_supir_tangki', $data);
    }

    public function proses_tambah_supir_tangki()
    {

        $this->form_validation->set_rules('id_supir', 'Nama Supir', 'trim|required');
        $this->form_validation->set_rules('id_tangki', 'Nopol', 'trim|required');
        $this->form_validation->set_rules('tanggal_update', 'Tanggal Update', 'trim|required');


        if ($this->form_validation->run() === TRUE) {
            $id_supir = $this->input->post('id_supir', TRUE);
            $id_tangki = $this->input->post('id_tangki', TRUE);
            $tanggal_update = $this->input->post('tanggal_update', TRUE);


            $data = array(
                'id_supir' => $id_supir,
                'id_tangki' => $id_tangki,
                'tanggal_update' => $tanggal_update

            );
            $this->M_admin->insert('tb_supir_tangki', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_supir_tangki'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Supir & Tangki ';
            $this->load->view('admin/form_seri_ban/tambah_supir_tangki', $data);
        }
    }


    public function edit_supir_tangki()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_supir_tangki' => $uri);

        $data['list_supir_tangki'] = $this->M_admin->get_data('tb_supir_tangki', $where);
        $data['list_tangki'] = $this->M_admin->select('tb_tangki');
        $data['list_supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Edit Supir Tangki';
        $this->load->view('admin/form_supir_tangki/edit_supir_tangki', $data);
    }

    public function proses_edit_supir_tangki()
    {

        $this->form_validation->set_rules('id_supir', 'Nama Supir', 'trim|required');
        $this->form_validation->set_rules('id_tangki', 'Nopol', 'trim|required');
        $this->form_validation->set_rules('tanggal_update', 'Tanggal Update', 'trim|required');


        if ($this->form_validation->run() === TRUE) {

            $id_supir_tangki = $this->input->post('id_supir_tangki', TRUE);
            $id_supir = $this->input->post('id_supir', TRUE);
            $id_tangki = $this->input->post('id_tangki', TRUE);
            $tanggal_update = $this->input->post('tanggal_update', TRUE);

            $where = array('id_supir_tangki' => $id_supir_tangki);

            $data = array(
                'id_supir' => $id_supir,
                'id_tangki' => $id_tangki,
                'tanggal_update' => $tanggal_update

            );
            $this->M_admin->update('tb_supir_tangki', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_supir_tangki'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Edit Data Supir Tangki ';
            $this->load->view('admin/form_seri_ban/tambah_supir_tangki', $data);
        }
    }

    public function hapus_supir_tangki()
    {
        // segmen adalah alamat yang ada diatas pencarian
        $uri = $this->uri->segment(3);
        $where = array('id_supir_tangki' => $uri);

        $this->M_admin->delete('tb_supir_tangki', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Supir Tangki Berhasil Dihapus');
        redirect(base_url('admin/tabel_supir_tangki'));
        // redirect mengarahkan atau mengembalikan ke halaman yang dituju
    }

    ######## END SUPIR TANGKI ########
    ######## END SUPIR TANGKI ########
    ######## END SUPIR TANGKI ########

    public function tabel_service_masuk()
    {
        $data['service_masuk'] = $this->M_admin->select_service_masuk('tb_service_masuk');

        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Service masuk';
        $this->load->view('admin/form_service_masuk/service_masuk', $data);
    }


    public function tambah_service_masuk()
    {

        $data['list_supir_tangki'] = $this->M_admin->get_supir_tangki('tb_supir_tangki');
        $data['list_bengkel'] = $this->M_admin->select('tb_bengkel');
        $data['list_supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Supir Tangki';
        $this->load->view('admin/form_service_masuk/tambah_service_masuk', $data);
    }

    public function proses_tambah_service_masuk()
    {

        $this->form_validation->set_rules('id_supir_tangki', 'Nama Supir dan Truk Tangki', 'trim|required');
        $this->form_validation->set_rules('id_bengkel', 'Nama Bengkel', 'trim|required');
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk Perbaikan', 'trim|required');
        $this->form_validation->set_rules('keluhan', 'keluhan', 'trim|required');
        $this->form_validation->set_rules('biaya', 'biaya nya bujur kah', 'trim|required');
        // $this->form_validation->set_rules('foto_nota', 'FOTO nya bujur kah', 'trim|required');
        $this->form_validation->set_rules('status', 'status perbaikan', 'trim|required');


        if ($this->form_validation->run() === TRUE) {
            $id_supir_tangki = $this->input->post('id_supir_tangki', TRUE);
            $id_bengkel = $this->input->post('id_bengkel', TRUE);
            $tgl_masuk = $this->input->post('tgl_masuk', TRUE);
            $keluhan = $this->input->post('keluhan', TRUE);
            $biaya = $this->input->post('biaya', TRUE);
            // $foto_nota = $this->input->post('foto_nota', TRUE);
            $status = $this->input->post('status', TRUE);


            $data = array(
                'id_supir_tangki' => $id_supir_tangki,
                'id_bengkel' => $id_bengkel,
                'tgl_masuk' => $tgl_masuk,
                'keluhan' => $keluhan,
                'biaya' => $biaya,
                // 'foto_nota' => $foto_nota,
                'status' => $status

            );
            $this->M_admin->insert('tb_service_masuk', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_service_masuk'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Service Masuk ';
            $this->load->view('admin/form_service_masuk/tambah_service_masuk', $data);
        }
    }

    public function edit_service_masuk()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_service_masuk' => $uri);


        $data['list_service_masuk'] = $this->M_admin->get_data('tb_service_masuk', $where);
        $data['list_supir_tangki'] = $this->M_admin->get_supir_tangki('tb_supir_tangki');
        $data['list_bengkel'] = $this->M_admin->select('tb_bengkel');
        $data['list_supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Edit Supir Tangki';
        $this->load->view('admin/form_service_masuk/edit_service_masuk', $data);
    }


    public function proses_edit_service_masuk()
    {

        $this->form_validation->set_rules('id_supir_tangki', 'Nama Supir dan Truk Tangki', 'trim|required');
        $this->form_validation->set_rules('id_bengkel', 'Nama Bengkel', 'trim|required');
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk Perbaikan', 'trim|required');
        $this->form_validation->set_rules('keluhan', 'keluhan', 'trim|required');
        $this->form_validation->set_rules('biaya', 'biaya nya bujur kah', 'trim|required');
        // $this->form_validation->set_rules('foto_nota', 'Foto nya bujur kah', 'trim|required');
        $this->form_validation->set_rules('status', 'status perbaikan', 'trim|required');


        if ($this->form_validation->run() === TRUE) {

            $id_service_masuk = $this->input->post('id_service_masuk', TRUE);
            $id_supir_tangki = $this->input->post('id_supir_tangki', TRUE);
            $id_bengkel = $this->input->post('id_bengkel', TRUE);
            $tgl_masuk = $this->input->post('tgl_masuk', TRUE);
            $keluhan = $this->input->post('keluhan', TRUE);
            $biaya = $this->input->post('biaya', TRUE);
            // $foto_nota = $this->input->post('foto_nota', TRUE);
            $status = $this->input->post('status', TRUE);

            $where = array('id_service_masuk' => $id_service_masuk);

            $data = array(
                'id_supir_tangki' => $id_supir_tangki,
                'id_bengkel' => $id_bengkel,
                'tgl_masuk' => $tgl_masuk,
                'keluhan' => $keluhan,
                'biaya' => $biaya,
                // 'foto_nota' => $foto_nota,
                'status' => $status

            );

            $this->M_admin->update('tb_service_masuk', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Ubah');
            redirect(base_url('admin/tabel_service_masuk'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Supir & Tangki ';
            $this->load->view('admin/form_service_masuk/edit_service_masuk', $data);
        }
    }

    public function hapus_service_masuk()
    {
        // segmen adalah alamat yang ada diatas pencarian
        $uri = $this->uri->segment(3);
        $where = array('id_service_masuk' => $uri);

        $this->M_admin->delete('tb_service_masuk', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Service Masuk Berhasil Dihapus');
        redirect(base_url('admin/tabel_service_masuk'));
        // redirect mengarahkan atau mengembalikan ke halaman yang dituju
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
        $this->load->view('admin/form_service_masuk/info_service_unit', $data);
    }




    //END SERVICE MASUK



    //REPORT KADA MELIHAT KAH MATA
    public function report()
    {

        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'LAPORAN';
        $this->load->view('admin/report/laporan', $data);
    }



    //PENGELUARAN LAIN LAIN JAR 
    public function tabel_pengeluaran()
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
        $this->load->view('admin/form_pengeluaran/pengeluaran', $data);
    }


    public function tambah_pengeluaran()
    {

        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Pengeluaran';
        $this->load->view('admin/form_pengeluaran/tambah_pengeluaran', $data);
    }

    public function proses_tambah_pengeluaran()
    {

        $this->form_validation->set_rules('tanggal', 'Tanggal Pengeluaran', 'trim|required');
        $this->form_validation->set_rules('nama_pengeluaran', 'Keterangan Pengeluaran', 'trim|required');
        $this->form_validation->set_rules('biaya_pengeluaran', 'biaya nya bujur kah', 'trim|required');


        if ($this->form_validation->run() === TRUE) {
            $tanggal = $this->input->post('tanggal', TRUE);
            $nama_pengeluaran = $this->input->post('nama_pengeluaran', TRUE);
            $biaya_pengeluaran = $this->input->post('biaya_pengeluaran', TRUE);



            $data = array(
                'tanggal' => $tanggal,
                'nama_pengeluaran' => $nama_pengeluaran,
                'biaya_pengeluaran' => $biaya_pengeluaran


            );
            $this->M_admin->insert('tb_pengeluaran', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_pengeluaran'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Pengeluaran';
            $this->load->view('admin/form_pengeluaran/tambah_pengeluaran', $data);
        }
    }

    public function edit_pengeluaran()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_pengeluaran' => $uri);

        $data['pengeluaran'] = $this->M_admin->get_data('tb_pengeluaran', $where);

        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Edit Pengeluaran';
        $this->load->view('admin/form_pengeluaran/edit_pengeluaran', $data);
    }

    public function proses_edit_pengeluaran()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal Pengeluaran', 'trim|required');
        $this->form_validation->set_rules('nama_pengeluaran', 'Keterangan Pengeluaran', 'trim|required');
        $this->form_validation->set_rules('biaya_pengeluaran', 'biaya nya bujur kah', 'trim|required');


        if ($this->form_validation->run() === TRUE) {
            $id_pengeluaran = $this->input->post('id_pengeluaran');
            $tanggal = $this->input->post('tanggal');
            $nama_pengeluaran = $this->input->post('nama_pengeluaran', TRUE);
            $biaya_pengeluaran = $this->input->post('biaya_pengeluaran', TRUE);


            $where = array('id_pengeluaran' => $id_pengeluaran);
            $data = array(

                'tanggal' => $tanggal,
                'nama_pengeluaran' => $nama_pengeluaran,
                'biaya_pengeluaran' => $biaya_pengeluaran
            );
            $this->M_admin->update('tb_pengeluaran', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Edit jarrr');
            redirect(base_url('admin/tabel_pengeluaran'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
            $data['title'] = 'Edit Pengeluaran Lain - lain';
            $this->load->view('admin/form_pengeluaran/edit_pengeluaran', $data);
        }
    }

    public function hapus_data_pengeluaran()
    {
        // segmen adalah alamat yang ada diatas pencarian
        $uri = $this->uri->segment(3);
        $where = array('id_pengeluaran' => $uri);

        $this->M_admin->delete('tb_pengeluaran', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Pengeluaran Berhasil Dihapus');
        redirect(base_url('admin/tabel_pengeluaran'));
        // redirect mengarahkan atau mengembalikan ke halaman yang dituju
    }

    ################# END SERVICE MASUK ###########################
    ################# END SERVICE MASUK ###########################
    ################# END SERVICE MASUK ###########################

    public function tabel_perbaikan()
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
        $this->load->view('admin/form_perbaikan/perbaikan', $data);
    }



    public function upload_foto_nota()
    {
        $config = array(
            'upload_path' => './assets/upload/perbaikan/foto_nota/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'ecrypt_name'    => false,
            'overwrite'    => true,
            // 'file_name'	=> uniqid(),
            'max_size' => 2048,
            'max_height' => 2000,
            'max_width' => 2000
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto_nota')) {
            $error = $this->upload->display_errors();
            return $error;
            // die('gagal diupload');
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            $userfile = $data_upload['upload_data']['file_name'];

            return $userfile;
        }
    }


    public function tambah_perbaikan()
    {

        $data['list_service_masuk'] = $this->M_admin->get_perbaikan('tb_service_masuk');
        $data['list_supir_tangki'] = $this->M_admin->select('tb_supir_tangki');
        $data['list_bengkel'] = $this->M_admin->select('tb_bengkel');
        $data['list_supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Perbaikan';
        $this->load->view('admin/form_perbaikan/tambah_perbaikan', $data);
    }

    public function proses_tambah_perbaikan()
    {

        $this->form_validation->set_rules('id_service_masuk', 'service masuk', 'trim|required');
        // $this->form_validation->set_rules('id_supir_tangki', 'Nama Supir dan Truk Tangki', 'trim|required');
        // $this->form_validation->set_rules('id_bengkel', 'Nama Bengkel', 'trim|required');
        $this->form_validation->set_rules('tgl_perbaikan', 'Tanggal Perbaikan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        // $this->form_validation->set_rules('foto_nota', 'foto_nota', 'trim|required');
        $this->form_validation->set_rules('biaya_perbaikan', 'biaya nya bujur kah', 'trim|required');
        // $this->form_validation->set_rules('status', 'status perbaikan', 'trim|required');


        if ($this->form_validation->run() === TRUE) {

            $foto_nota = $this->upload_foto_nota();


            $id_service_masuk = $this->input->post('id_service_masuk', TRUE);
            // $id_supir_tangki = $this->input->post('id_supir_tangki', TRUE);
            // $id_bengkel = $this->input->post('id_bengkel', TRUE);
            $tgl_perbaikan = $this->input->post('tgl_perbaikan', TRUE);
            $keterangan = $this->input->post('keterangan', TRUE);
            $biaya_perbaikan = $this->input->post('biaya_perbaikan', TRUE);
            // $status = $this->input->post('status', TRUE);


            $data = array(
                'id_service_masuk' => $id_service_masuk,
                // 'id_supir_tangki' => $id_supir_tangki,
                // 'id_bengkel' => $id_bengkel,
                'tgl_perbaikan' => $tgl_perbaikan,
                'keterangan' => $keterangan,
                'foto_nota' => $foto_nota,
                'biaya_perbaikan' => $biaya_perbaikan,


            );
            $this->M_admin->insert('tb_perbaikan', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_perbaikan'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Perbaikan Disetujui ';
            $this->load->view('admin/form_perbaikan/tambah_perbaikan', $data);
        }
    }


    public function edit_perbaikan()
    {

        $uri = $this->uri->segment(3);
        $where = array('id_perbaikan' => $uri);

        $data['list_perbaikan'] = $this->M_admin->get_data('tb_perbaikan', $where);
        $data['list_service_masuk'] = $this->M_admin->get_perbaikan('tb_service_masuk');
        $data['list_supir_tangki'] = $this->M_admin->select('tb_supir_tangki');
        $data['list_bengkel'] = $this->M_admin->select('tb_bengkel');
        $data['list_supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Perbaikan';
        $this->load->view('admin/form_perbaikan/edit_perbaikan', $data);
    }

    public function proses_edit_perbaikan()
    {

        $this->form_validation->set_rules('id_service_masuk', 'service masuk', 'trim|required');
        // $this->form_validation->set_rules('id_supir_tangki', 'Nama Supir dan Truk Tangki', 'trim|required');
        // $this->form_validation->set_rules('id_bengkel', 'Nama Bengkel', 'trim|required');
        $this->form_validation->set_rules('tgl_perbaikan', 'Tanggal Masuk Perbaikan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        // $this->form_validation->set_rules('foto_nota', 'FOTO NOTA', 'trim|required');
        $this->form_validation->set_rules('biaya_perbaikan', 'biaya nya bujur kah', 'trim|required');
        // $this->form_validation->set_rules('status', 'status perbaikan', 'trim|required');


        if ($this->form_validation->run() === TRUE) {
            $id_perbaikan = $this->input->post('id_perbaikan', TRUE);
            $id_service_masuk = $this->input->post('id_service_masuk', TRUE);
            // $id_supir_tangki = $this->input->post('id_supir_tangki', TRUE);
            // $id_bengkel = $this->input->post('id_bengkel', TRUE);
            $tgl_perbaikan = $this->input->post('tgl_perbaikan', TRUE);
            $keterangan = $this->input->post('keterangan', TRUE);
            $biaya_perbaikan = $this->input->post('biaya_perbaikan', TRUE);
            // $status = $this->input->post('status', TRUE);
            $foto_nota_old = $this->input->post('foto_nota_old', TRUE);

            $foto_nota = $this->upload_foto_nota();

            if ($foto_nota == '<p>You did not select a file to upload.</p>') {
                $foto_nota_new = $foto_nota_old;
            } else {
                $foto_nota_new = $foto_nota;
            };


            $where = array('id_perbaikan' => $id_perbaikan);
            $data = array(

                'id_service_masuk' => $id_service_masuk,
                // 'id_supir_tangki' => $id_supir_tangki,
                // 'id_bengkel' => $id_bengkel,
                'tgl_perbaikan' => $tgl_perbaikan,
                'keterangan' => $keterangan,
                'foto_nota' => $foto_nota_new,
                'biaya_perbaikan' => $biaya_perbaikan
            );
            $this->M_admin->update('tb_perbaikan', $data, $where); //kalo di proses edit andaki where
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_perbaikan'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Edit Data Perbaikan Disetujui ';
            $this->load->view('admin/form_perbaikan/edit_perbaikan', $data);
        }
    }

    public function hapus_data_perbaikan()
    {
        // segmen adalah alamat yang ada diatas pencarian
        $uri = $this->uri->segment(3);
        $where = array('id_perbaikan' => $uri);

        $this->M_admin->delete('tb_perbaikan', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Perbaikan Berhasil Dihapus');
        redirect(base_url('admin/tabel_perbaikan'));
        // redirect mengarahkan atau mengembalikan ke halaman yang dituju
    }
    ####### END DATA PERBAIKAN MASUK #######
    ####### END DATA PERBAIKAN MASUK #######
    ####### END DATA PERBAIKAN MASUK #######

    public function tabel_exp_surat()
    {
        $data['exp_surat'] = $this->M_admin->tabel_exp_surat('tb_exp_surat');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Exp Surat Tangki';
        $this->load->view('admin/form_exp_surat/exp_surat', $data);
    }

    public function tambah_exp_surat()
    {

        $data['list_surat_tangki'] = $this->M_admin->get_exp_surat('table_surat_tangki');
        // $data['list_tangki'] = $this->M_admin->select('tb_tangki');


        // $data['list_supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Expired Surat';
        $this->load->view('admin/form_exp_surat/tambah_exp_surat', $data);
    }

    public function proses_tambah_exp_surat()
    {

        $this->form_validation->set_rules('id_surat', 'Surat Tangki', 'trim|required');
        $this->form_validation->set_rules('perkiraan_biaya', 'perkiraan biaya', 'trim|required');
        // $this->form_validation->set_rules('id_supir_tangki', 'Nama Supir dan Truk Tangki', 'trim|required');
        // $this->form_validation->set_rules('id_bengkel', 'Nama Bengkel', 'trim|required');
        // $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'trim|required');
        // $this->form_validation->set_rules('tanggal_expired', 'Tanggal Habis Masa berlaku', 'trim|required');
        // $this->form_validation->set_rules('status', 'Status', 'trim|required');
        // $this->form_validation->set_rules('biaya_perbaikan', 'biaya nya bujur kah', 'trim|required');
        // $this->form_validation->set_rules('status', 'status perbaikan', 'trim|required');


        if ($this->form_validation->run() === TRUE) {
            // $id_exp_surat = $this->input->post('id_exp_surat', TRUE);
            $id_surat = $this->input->post('id_surat', TRUE);
            $perkiraan_biaya = $this->input->post('perkiraan_biaya', TRUE);
            // $id_tangki = $this->input->post('id_tangki', TRUE);
            // $id_supir_tangki = $this->input->post('id_supir_tangki', TRUE);
            // $id_bengkel = $this->input->post('id_bengkel', TRUE);
            // $jenis_surat = $this->input->post('jenis_surat', TRUE);
            // $tanggal_expired = $this->input->post('tanggal_expired', TRUE);
            // $status = $this->input->post('status', TRUE);
            // $biaya_perbaikan = $this->input->post('biaya_perbaikan', TRUE);


            $data = array(

                // 'id_exp_surat' => $id_exp_surat,
                'id_surat' => $id_surat,
                'perkiraan_biaya' => $perkiraan_biaya,
                // 'id_tangki' => $id_tangki,
                // 'id_supir_tangki' => $id_supir_tangki,
                // 'id_bengkel' => $id_bengkel,
                // 'jenis_surat' => $jenis_surat,
                // 'tanggal_expired' => $tanggal_expired,
                // 'status' => $status 


            );
            $this->M_admin->insert('tb_exp_surat', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_exp_surat'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Pengajuan Exp Surat Tangki Disetujui ';
            $this->load->view('admin/form_exp_surat/tambah_exp_surat', $data);
        }
    }

    public function edit_exp_surat()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_exp_surat' => $uri);

        $data['list_exp_surat'] = $this->M_admin->ambil_exp_surat('tb_exp_surat', $where);
        $data['list_surat_tangki'] = $this->M_admin->get_exp_surat('table_surat_tangki');

        // $data['list_surat'] = $this->M_admin->select('table_surat_tangki');
        // $data['list_tangki'] = $this->M_admin->select('tb_tangki');


        // $data['list_supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Expired Surat';
        $this->load->view('admin/form_exp_surat/edit_exp_surat', $data);
    }


    public function proses_edit_exp_surat()
    {

        $this->form_validation->set_rules('id_surat', 'Surat Tangki', 'trim|required');
        $this->form_validation->set_rules('perkiraan_biaya', 'perkiraan biaya', 'trim|required');
        // $this->form_validation->set_rules('id_supir_tangki', 'Nama Supir dan Truk Tangki', 'trim|required');
        // $this->form_validation->set_rules('id_bengkel', 'Nama Bengkel', 'trim|required');
        // $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'trim|required');
        // $this->form_validation->set_rules('tanggal_expired', 'Tanggal Habis Masa berlaku', 'trim|required');
        // $this->form_validation->set_rules('status', 'Status', 'trim|required');
        // $this->form_validation->set_rules('biaya_perbaikan', 'biaya nya bujur kah', 'trim|required');
        // $this->form_validation->set_rules('status', 'status perbaikan', 'trim|required');


        if ($this->form_validation->run() === TRUE) {
            // $id_exp_surat = $this->input->post('id_exp_surat', TRUE);
            $id_surat = $this->input->post('id_surat', TRUE);
            $perkiraan_biaya = $this->input->post('perkiraan_biaya', TRUE);
            // $id_tangki = $this->input->post('id_tangki', TRUE);
            // $id_supir_tangki = $this->input->post('id_supir_tangki', TRUE);
            // $id_bengkel = $this->input->post('id_bengkel', TRUE);
            // $jenis_surat = $this->input->post('jenis_surat', TRUE);
            // $tanggal_expired = $this->input->post('tanggal_expired', TRUE);
            // $status = $this->input->post('status', TRUE);
            // $biaya_perbaikan = $this->input->post('biaya_perbaikan', TRUE);
            $id_exp_surat = $this->input->post('id_exp_surat', TRUE);

            $where = array('id_exp_surat' => $id_exp_surat);
            $data = array(

                // 'id_exp_surat' => $id_exp_surat,
                'id_surat' => $id_surat,
                'perkiraan_biaya' => $perkiraan_biaya,
                // 'id_tangki' => $id_tangki,
                // 'id_supir_tangki' => $id_supir_tangki,
                // 'id_bengkel' => $id_bengkel,
                // 'jenis_surat' => $jenis_surat,
                // 'tanggal_expired' => $tanggal_expired,
                // 'status' => $status 


            );
            $this->M_admin->update('tb_exp_surat', $data, $where);
            //mun edit tulisan update mun tambah tulisannya insert
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_exp_surat'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Pengajuan Exp Surat Tangki Disetujui ';
            $this->load->view('admin/form_exp_surat/edit_exp_surat', $data);
        }
    }


    public function hapus_exp_surat()
    {
        // segmen adalah alamat yang ada diatas pencarian
        $uri = $this->uri->segment(3);
        $where = array('id_exp_surat' => $uri);

        $this->M_admin->delete('tb_exp_surat', $where);
        $this->session->set_flashdata('msg_sukses', 'Data  Berhasil Dihapus');
        redirect(base_url('admin/tabel_exp_surat'));
        // redirect mengarahkan atau mengembalikan ke halaman yang dituju
    }

    public function tabel_tujuan()
    {
        // $tgl = date('Y-m-d');
        // $data['count'] = $this->M_data->notif_stok('tb_sparepa');
        // $data['num'] = $this->M_data->notif_stok_jml('tb_sparepart');

        // $data['lbl'] = $this->M_admin->notif_surat_tangki('table_surat_tangki');


        // $data['lbl'] = $label;

        $data['tujuan'] = $this->M_admin->select('tb_tujuan');
        // $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tujuan';
        $this->load->view('admin/form_tujuan/tujuan', $data);
    }

    public function tambah_tujuan()
    {
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Data Tujuan';
        $this->load->view('admin/form_tujuan/tambah_tujuan', $data);
    }

    public function proses_tambah_tujuan()
    {
        $this->form_validation->set_rules('nama_tujuan', 'Nama Tujuan jarrrr', 'trim|required');
        $this->form_validation->set_rules('kilometer_pp', 'Jarak Pulang Pergi jarrr', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $nama_tujuan = $this->input->post('nama_tujuan', TRUE);
            $kilometer_pp = $this->input->post('kilometer_pp', TRUE);

            $data = array(
                'nama_tujuan' => $nama_tujuan,
                'kilometer_pp' => $kilometer_pp
            );
            $this->M_admin->insert('tb_tujuan', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_tujuan'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
            $data['title'] = 'Tambah Data Tujuan';
            $this->load->view('admin/form_tujuan/tambah_tujuan', $data);
        }
    }

    public function edit_data_tujuan()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_tujuan' => $uri);

        $data['tujuan'] = $this->M_admin->get_data('tb_tujuan', $where);
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Edit Tujuan';
        $this->load->view('admin/form_tujuan/edit_tujuan', $data);
    }

    public function proses_edit_tujuan()
    {
        $this->form_validation->set_rules('nama_tujuan', 'Nama Tujuan jarrrr', 'trim|required');
        $this->form_validation->set_rules('kilometer_pp', 'Jarak Pulang Pergi jarrr', 'trim|required');

        if ($this->form_validation->run() === TRUE) {


            $id_tujuan = $this->input->post('id_tujuan', true);
            $nama_tujuan = $this->input->post('nama_tujuan', true);
            $kilometer_pp = $this->input->post('kilometer_pp', TRUE);



            $where = array('id_tujuan' => $id_tujuan);
            $data = array(
                'nama_tujuan' => $nama_tujuan,
                'kilometer_pp' => $kilometer_pp
            );
            $this->M_admin->update('tb_tujuan', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Update');
            redirect(base_url('admin/tabel_tujuan'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Edit Tujuan';
            $this->load->view('admin/form_tujuan/edit_tujuan', $data);
        }
    }

    public function hapus_tujuan()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_tujuan' => $uri);

        $this->M_admin->delete('tb_tujuan', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Tujuan Berhasil Dihapus');
        redirect(base_url('admin/tabel_tujuan'));
    }

    ##### END TUJUAN #####
    ##### END TUJUAN #####
    ##### END TUJUAN #####

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
        $this->load->view('admin/form_angkutan/angkutan', $data);
    }

    public function tambah_angkutan()
    {

        $data['angkutan'] = $this->M_admin->get_angkutan('tb_angkutan');
        $data['list_supirtangki'] = $this->M_admin->get_supir_tangki('tb_supir_tangki');
        $data['tujuan'] = $this->M_admin->select('tb_tujuan');


        // $data['list_supir'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Tambah Angkutan';
        $this->load->view('admin/form_angkutan/tambah_angkutan', $data);
    }

    public function proses_tambah_angkutan()
    {

        $this->form_validation->set_rules('id_supir_tangki', 'Nama Supir dan Truk Tangki', 'trim|required');
        $this->form_validation->set_rules('id_tujuan', 'Tujuan dan Jarak', 'trim|required');
        $this->form_validation->set_rules('tgl_berangkat', 'Tanggal Habis Masa berlaku', 'trim|required');


        if ($this->form_validation->run() === TRUE) {
            $id_supir_tangki = $this->input->post('id_supir_tangki', TRUE);
            $id_tujuan = $this->input->post('id_tujuan', TRUE);
            $tgl_berangkat = $this->input->post('tgl_berangkat', TRUE);


            $data = array(

                // 'id_exp_surat' => $id_exp_surat,
                'id_supir_tangki' => $id_supir_tangki,
                'id_tujuan' => $id_tujuan,
                // 'id_tangki' => $id_tangki,
                'tgl_berangkat' => $tgl_berangkat,
                // 'nama_tujuan' => $nama_tujuan,
                // 'kilometer_pp' => $kilometer_pp,

                // 'id_bengkel' => $id_bengkel,
                // 'jenis_surat' => $jenis_surat,
                // 'tanggal_expired' => $tanggal_expired,
                // 'status' => $status 


            );
            $this->M_admin->insert('tb_angkutan', $data);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
            redirect(base_url('admin/tabel_angkutan'));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Tambah Angkutan ';
            $this->load->view('admin/form_angkutan/tambah_angkutan', $data);
        }
    }

    public function edit_angkutan()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_angkutan' => $uri);

        $data['angkutan'] = $this->M_admin->get_data('tb_angkutan', $where);
        $data['list_supirtangki'] = $this->M_admin->get_supir_tangki('tb_supir_tangki');
        $data['tujuan'] = $this->M_admin->select('tb_tujuan');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'Edit Supir Tangki';
        $this->load->view('admin/form_angkutan/edit_angkutan', $data);
    }


    public function proses_edit_angkutan()
    {
        $this->form_validation->set_rules('id_supir_tangki', 'Nama Supir dan Truk Tangki', 'trim|required');
        $this->form_validation->set_rules('id_tujuan', 'Tujuan dan Jarak', 'trim|required');
        $this->form_validation->set_rules('tgl_berangkat', 'Tanggal Habis Masa berlaku', 'trim|required');


        // 
        if ($this->form_validation->run() === TRUE) {
            $id_angkutan = $this->input->post('id_angkutan', TRUE);
            $id_supir_tangki = $this->input->post('id_supir_tangki', TRUE);
            $id_tujuan = $this->input->post('id_tujuan', TRUE);
            $tgl_berangkat = $this->input->post('tgl_berangkat', TRUE);

            $where = array('id_angkutan' => $id_angkutan);
            $data = array(

                'id_supir_tangki' => $id_supir_tangki,
                'id_tujuan' => $id_tujuan,
                'tgl_berangkat' => $tgl_berangkat,
                // 'kilometer_pp' => $ki


            );

            $this->M_admin->update('tb_angkutan', $data, $where);
            $this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Update');
            redirect(base_url('admin/tabel_angkutan '));
        } else {
            $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
            $data['title'] = 'Edit Angkutan';
            $this->load->view('admin/form_angkutan/edit_angkutan', $data);
        }
    }

    public function hapus_angkutan()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_angkutan' => $uri);

        $this->M_admin->delete('tb_angkutan', $where);
        $this->session->set_flashdata('msg_sukses', 'Data Angkutan Berhasil Dihapus');
        redirect(base_url('admin/tabel_angkutan'));
    }

    ####################################
    // test email 
    ####################################

    public function email()
    {
        $data['list_email'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'email';
        $this->load->view('admin/email/email', $data);
    }

    public function kirim()
    {
        $email_penerima = $this->input->post('email_penerima');
        $subjek = $this->input->post('subjek');
        $pesan = $this->input->post('pesan');
        $attachment = $_FILES['attachment'];
        $content = $this->load->view('admin/email/content', array('pesan' => $pesan), true); // Ambil isi file content.php dan masukan ke variabel $content
        $sendmail = array(
            'email_penerima' => $email_penerima,
            'subjek' => $subjek,
            'content' => $content,
            'attachment' => $attachment
        );
        if (empty($attachment['name'])) {
            $send = $this->mailer->send($sendmail);
        } else {
            $send = $this->mailer->send_with_attachment($sendmail);
        }

        echo "<b>" . $send['status'] . "</b><br />";
        echo $send['message'];

        // $data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
        // $data['title'] = 'email';
        // $this->load->view('admin/email/v_email', $data);

        // redirect(base_url('admin/email'));
        echo "<br /><a href='" . base_url("admin/email") . "'>Kembali ke Form</a>";
    }



    //////////////////////////
    //////EMAIL NOTIF SURAT//////
    /////////////////////////


    public function proses_email_surat()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_surat' => $uri);

        $tgl = date('Y-m-d');
        $data['notifOut'] = $this->M_admin->notif_exp_surat1('table_surat_tangki', $tgl, $where);
        $data['list_email'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'email';
        $this->load->view('admin/email/email_surattangki', $data);
    }

    public function kirim_email_surat()
    {


        $email_penerima = $this->input->post('email_penerima');
        $subjek = $this->input->post('subjek');
        $pesan = $this->input->post('pesan');
        $attachment = $_FILES['attachment'];
        $content = $this->load->view('admin/email/content', array('pesan' => $pesan), true); // Ambil isi file content.php dan masukan ke variabel $content
        $sendmail = array(
            'email_penerima' => $email_penerima,
            'subjek' => $subjek,
            'content' => $content,
            'attachment' => $attachment
        );
        if (empty($attachment['name'])) {
            $send = $this->mailer->send($sendmail);
        } else {
            $send = $this->mailer->send_with_attachment($sendmail);
        }

        echo "<b>" . $send['status'] . "</b><br />";
        echo $send['message'];

        // $data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
        // $data['title'] = 'email';
        // $this->load->view('admin/email/v_email', $data);

        // redirect(base_url('admin/email'));
        echo "<br /><a href='" . base_url("admin/email") . "'>Kembali ke Form</a>";
    }


    /////////////////////
    /// NOTIF STATUS
    /////////////////////

    public function proses_email_statusperbaikan()
    {
        $uri = $this->uri->segment(3);
        $where = array('id_service_masuk' => $uri);

        // $tgl = date('Y-m-d');
        $data['notifOut'] = $this->M_admin->get_service_masuk('tb_service_masuk', $where);
        $data['list_email'] = $this->M_admin->select('tb_supir');
        $data['avatar'] = $this->M_admin->get_data_avatar('tb_user', $this->session->userdata('name'));
        $data['title'] = 'email';
        $this->load->view('admin/email/email_statusperbaikan', $data);
    }

    public function kirim_email_statusperbaikan()
    {


        $email_penerima = $this->input->post('email_penerima');
        $subjek = $this->input->post('subjek');
        $pesan = $this->input->post('pesan');
        $attachment = $_FILES['attachment'];
        $content = $this->load->view('admin/email/content', array('pesan' => $pesan), true); // Ambil isi file content.php dan masukan ke variabel $content
        $sendmail = array(
            'email_penerima' => $email_penerima,
            'subjek' => $subjek,
            'content' => $content,
            'attachment' => $attachment
        );
        if (empty($attachment['name'])) {
            $send = $this->mailer->send($sendmail);
        } else {
            $send = $this->mailer->send_with_attachment($sendmail);
        }

        echo "<b>" . $send['status'] . "</b><br />";
        echo $send['message'];

        // $data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
        // $data['title'] = 'email';
        // $this->load->view('admin/email/v_email', $data);

        // redirect(base_url('admin/email'));
        echo "<br /><a href='" . base_url("admin/email") . "'>Kembali ke Form</a>";
    }
}
