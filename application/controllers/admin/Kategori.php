<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class Kategori extends CI_Controller {
    
    //load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_Model');
        //proteksi halaman
        // $this->simple_login->cek_login();
    }

    //data kategori
    public function index()
    {
        $kategori = $this->Kategori_Model->listing();

        $data = array(   'card_title'   =>  'Data Kategori Destinasi',
                         'kategori'    =>  $kategori,
                         'isi'     =>  'admin/kategori/list'
                         );

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    //tambah kategori
    public function tambah()
    {
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_kategori','Nama Kategori','required|is_unique[tb_kategori.nama_kategori]',
            array(  'required'      => '%s harus diisi',
                    'is_unique'     => '%s sudah ada. Buat Kategori Baru!' ));

        if($valid->run()===FALSE) {
        //end validasi

        $data = array(   'card_title'   =>  'Tambah Kategori Destinasi',
                         'isi'     =>  'admin/kategori/tambah'
                         );

        $this->load->view('admin/layout/wrapper', $data, FALSE);

        //masuk database
        }else{

            $i = $this->input;
            $slug_kategori    =url_title($this->input->post('nama_kategori'), 'dash', TRUE);

            $data = array(  'slug_kategori'          =>$slug_kategori,
                            'nama_kategori'          =>$i->post('nama_kategori')

            );

            $this->Kategori_Model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data telah ditambah');
            redirect(base_url('admin/kategori'),'refresh');

        }
        //end masuk database
    }

    //edit kategori
    public function edit($id_kategori)
    {
        $kategori   =   $this->Kategori_Model->detail($id_kategori);

        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_kategori','Nama Kategori','required',
            array(  'required'      => '%s harus diisi'));

        if($valid->run()===FALSE) {
        //end validasi

        $data = array(   'card_title'   =>  'Edit Kategori Destinasi',
                        'kategori' =>   $kategori,
                         'isi'     =>  'admin/kategori/edit'
                         );

        $this->load->view('admin/layout/wrapper', $data, FALSE);

        //masuk database
        }else{

            $i = $this->input;
            $slug_kategori    =url_title($this->input->post('nama_kategori'), 'dash', TRUE);

            $data = array(  'id_kategori'            =>$id_kategori,
                            'slug_kategori'          =>$slug_kategori,
                            'nama_kategori'          =>$i->post('nama_kategori')

            );

            $this->Kategori_Model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diedit');
            redirect(base_url('admin/kategori'),'refresh');

        }
        //end masuk database
    }

    public function delete($id_kategori)
    {
        $data   =   array('id_kategori' => $id_kategori);
        $this->Kategori_Model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah Dihapus.');
        redirect(base_url('admin/kategori'),'refresh');
    }
}