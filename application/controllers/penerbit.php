<?php

class penerbit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_penerbit');
    }

    public function index()
    {
        $isi['content'] = 'penerbit/v_penerbit';
        $isi['judul'] = 'Daftar Data Penerbit';
        $isi['data'] = $this->db->get('penerbit')->result();
        $this->load->view('v_dashboard', $isi);
    }
    public function tambah_penerbit()
    {
        $isi['content'] = 'penerbit/form_penerbit';
        $isi['judul'] = 'Form  Tambah Penerbit';
        $this->load->view('v_dashboard', $isi);
    }
    public function simpan()
    {
        $data['nama_penerbit'] = $this->input->post('nama_penerbit');
        $query = $this->db->insert('penerbit', $data);
        if ($query = true) {
            $this->session->set_flashdata('info', 'Data Berhasil Di Simpan');
            redirect('penerbit');
        }
    }
    public function edit($id)
    {
        $isi['content'] = 'penerbit/edit_penerbit';
        $isi['judul'] = 'Form Edit Penerbit';
        $isi['data'] = $this->m_penerbit->edit($id);
        $this->load->view('v_dashboard', $isi);
    }
    public function update()
    {
        $id_penerbit            = $this->input->post('id_penerbit');
        $data['nama_penerbit'] = $this->input->post('nama_penerbit');
        $query = $this->m_penerbit->update($id_penerbit, $data);
        if ($query = true) {
            $this->session->set_flashdata('info', 'Data Berhasil Di Update');
            redirect('penerbit');
        }
    }
    public function delete($id)
    {
        $query = $this->m_penerbit->delete($id);
        $this->session->set_flashdata('info', 'data berhasil dihapus');
        redirect('penerbit');
    }
}
