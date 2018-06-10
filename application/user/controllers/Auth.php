<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('user_agent');
    }

    public function index()
    {
        redirect('auth/login');

    }

    public function forgot()
    {
        // validation
        $validation = array(

            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required|valid_email',
            )
        );

        $this->form_validation->set_rules($validation);
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('Forgot', $this->data);
        } else {
            $this->forgot_post();
        }

    }

    public function register()
    {
        // validation
        $validation = array(
            array(
                'field' => 'nama',
                'label' => 'Nama Lengkap',
                'rules' => 'required'
            ),

            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required|valid_email|is_unique[pengguna.p_email]'
            ),
            array(
                'field' => 'notelp',
                'label' => 'No. Telp',
                'rules' => 'required|integer|is_unique[pengguna.p_telp]'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[15]'
            ),

        );

        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('Register', $this->data);
        } else {
            $this->register_post();
        }

    }

    private function forgot_post()
    {
        $this->data->email = $this->input->post('email');

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.fashiongrosir-ind.com',
            'smtp_port' => 465,
            'smtp_user' => 'dont-reply@fashiongrosir-ind.com',
            'smtp_pass' => 'p1nacate88',
            'smtp_timeout' => '4',
            'mailtype' => 'html',
            'newline' => "\r\n",
            'charset' => 'utf-8',
            'validation' => TRUE
        );
        $this->email->initialize($config);
        $this->email->from('dont-reply@fashiongrosir-ind.com', 'Fashion Grosir');
        $this->email->to($this->data->email);
        $this->email->subject('Testing');

//        $body = $this->load->view('email/template', $this->data);

        $this->email->message('Testing');

        $this->email->send();

    }

    private function register_post()
    {
        $this->data->nama = $this->input->post('nama');
        $this->data->email = $this->input->post('email');
        $this->data->telp = $this->input->post('notelp');
        $this->data->pass = $this->input->post('password');
        $this->data->guid = $this->pengguna->guid();
        $this->data->token = $this->pengguna->guid();

        $register = $this->pengguna->insert(array(
            'p_kode' => $this->data->guid,
            'p_username' => $this->data->email,
            'p_nama' => $this->data->nama,
            'p_email' => $this->data->email,
            'p_password' => $this->data->pass,
            'p_tipe' => 2,
            'p_telp' => $this->data->telp,
            'p_token' => $this->data->token
        ));

        if ($register) {
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://mail.fashiongrosir-ind.com',
                'smtp_port' => 465,
                'smtp_user' => 'dont-reply@fashiongrosir-ind.com',
                'smtp_pass' => 'p1nacate88',
                'smtp_timeout' => '4',
                'mailtype' => 'html',
                'newline' => "\r\n",
                'charset' => 'utf-8',
                'validation' => TRUE
            );
            $this->email->initialize($config);
            $this->email->from('dont-reply@fashiongrosir-ind.com', 'Fashion Grosir');
            $this->email->to($this->data->email);
            $this->email->subject('Aktivasi Akun Pengguna Fashion Grosir');

            $body = $this->load->view('email/template', $this->data, TRUE);

            $this->email->message($body);

            $this->email->send();
            $this->data->berhasil = 'Silahkan cek email untuk aktivasi akun anda.';
            $this->session->set_flashdata('berhasil', $this->data->berhasil);

            redirect('register');
        }

    }

    public function login()
    {
        // buat validation
        $validation = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s tidak boleh kosong'
                )
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s tidak boleh kosong'
                )
            )
        );

        // set validation
        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('Login', $this->data);
        } else {
            // get post
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // get database
            $user = $this->pengguna->where(array(
                'p_email' => $email,
                'p_password' => $password
            ))->get();

            if ($user) {
                // Update IP Address
                $this->pengguna->where(array(
                    'p_email' => $email,
                ))->update(array(
                    'p_ipaddr' => $_SERVER['REMOTE_ADDR'],
                    'p_login_terakhir' => date('Y-m-d H:i:s')
                ));

                $sessiondata = array(
                    'id' => $user->p_kode,
                    'nama' => $user->p_nama,
                    'email' => $user->p_email,
                    'tipe' => $user->p_tipe,
                    'isonline' => true
                );
                $this->session->set_userdata($sessiondata);


                redirect('/');
            } else {
                $this->data->log = 'Username atau Password salah.';
                $this->load->view('Login', $this->data);
            }
        }

    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('tipe');
        $this->session->unset_userdata('isonline');
        redirect('/');
    }

    public function aktivasi_akun($id, $token)
    {
        $pengguna = $this->pengguna->where(array(
            'p_kode' => $id,
            'p_token' => $token
        ))->get();

        if ($pengguna) {
            if ($pengguna->p_isaktif == 0) {
                $this->pengguna->where('p_kode', $id)->update(array(
                    'p_isaktif' => 1,
                    'p_token' => $this->pengguna->guid
                ));
                $this->data->berhasil = 'Akun anda sudah aktif, Silahkan login untuk melakukan transaksi.';
                $this->session->set_flashdata('berhasil', $this->data->berhasil);
            } else {
                $this->data->gagal = 'Akun ini sudah aktif.';
                $this->session->set_flashdata('gagal', $this->data->gagal);
            }
        } else {
            $this->data->gagal = 'Akun tidak ada atau token sudah kadaluarsa.';
            $this->session->set_flashdata('gagal', $this->data->gagal);
        }

        redirect('login');
    }
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */