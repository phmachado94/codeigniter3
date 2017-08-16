<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('categorias_model', 'modelCategorias');
        $this->categorias = $this->modelCategorias->listar_categorias();

        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index() {
        $this->load->library('table');
        $dados['categorias'] = $this->categorias;

        //Dados a serem enviados para o Cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Categoria';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/categoria');
        $this->load->view('backend/template/html-footer');
    }

    public function inserir() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtCategoria', 'Nome da Categoria', 'required|min_length[3]|is_unique[categoria.titulo]');

        if (!$this->form_validation->run()) {
            $this->index();
        } else {
            $titulo = $this->input->post('txtCategoria');

            if ($this->modelCategorias->adicionar($titulo)) {
                redirect(base_url('admin/categoria'));
                echo "Cadastrada com sucesso!";
            } else {
                echo "Houve um erro ao cadastrar!";
            }
        }
    }

    public function excluir($id) {
        if ($this->modelCategorias->excluir($id)) {
            redirect(base_url('admin/categoria'));
            echo "Excluída com sucesso!";
        } else {
            echo "Houve um erro ao excluir!";
        }
    }

    public function alterar($id) {
        $this->load->library('table');
        $dados['categorias'] = $this->modelCategorias->listar_categoria($id);

        //Dados a serem enviados para o Cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Categoria';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/alterar-categoria');
        $this->load->view('backend/template/html-footer');
    }

    public function salvar_alteracoes() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtCategoria', 'Nome da Categoria', 'required|min_length[3]|is_unique[categoria.titulo]');

        if (!$this->form_validation->run()) {
            $this->index();
        } else {
            $id = $this->input->post('txtId');
            $titulo = $this->input->post('txtCategoria');

            if ($this->modelCategorias->alterar($titulo, $id)) {
                redirect(base_url('admin/categoria'));
                echo "Alterada com sucesso!";
            } else {
                echo "Houve um erro ao alterar!";
            }
        }
    }

}
