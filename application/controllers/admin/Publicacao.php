<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacao extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('categorias_model', 'modelCategorias');
        $this->load->model('publicacoes_model', 'modelPublicacoes');
        $this->categorias = $this->modelCategorias->listar_categorias();
    }

    public function index() {
        $this->load->library('table');
        $dados['categorias'] = $this->categorias;
        $dados['publicacoes'] = $this->modelPublicacoes->listar_publicacao();

        //Dados a serem enviados para o Cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Publicação';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/publicacao');
        $this->load->view('backend/template/html-footer');
    }

    public function inserir() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtTitulo', 'Título', 'required|min_length[3]');
        $this->form_validation->set_rules('txtSubTitulo', 'Sub Título', 'required|min_length[3]');
        $this->form_validation->set_rules('txtConteudo', 'Conteúdo', 'required|min_length[20]');

        if (!$this->form_validation->run()) {
            $this->index();
        } else {
            $categoria = $this->input->post('selectCat');
            $titulo = $this->input->post('txtTitulo');
            $subTitulo = $this->input->post('txtSubTitulo');
            $conteudo = $this->input->post('txtConteudo');
            $dataPub = $this->input->post('txtData');
            $userPub = $this->input->post('txtUsuario');

            if ($this->modelPublicacoes->adicionar($categoria, $titulo, $subTitulo, $conteudo, $dataPub, $userPub)) {
                redirect(base_url('admin/publicacao'));
                echo "Cadastrada com sucesso!";
            } else {
                echo "Houve um erro ao cadastrar!";
            }
        }
    }

    public function excluir($id) {
        if ($this->modelPublicacoes->excluir($id)) {
            redirect(base_url('admin/publicacao'));
            echo "Excluída com sucesso!";
        } else {
            echo "Houve um erro ao excluir!";
        }
    }

    public function alterar($id) {
        $this->load->library('table');
        $dados['categorias'] = $this->modelCategorias->listar_categorias();
        $dados['publicacoes'] = $this->modelPublicacoes->listar_publicacoes($id);

        //Dados a serem enviados para o Cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Publicação';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/alterar-publicacao');
        $this->load->view('backend/template/html-footer');
    }

    public function salvar_alteracoes($idCript) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtTitulo', 'Título', 'required|min_length[3]');
        $this->form_validation->set_rules('txtSubTitulo', 'Sub Título', 'required|min_length[3]');
        $this->form_validation->set_rules('txtConteudo', 'Conteúdo', 'required|min_length[20]');

        if (!$this->form_validation->run()) {
            $this->alterar($idCript);
        } else {
            $categoria = $this->input->post('selectCat');
            $titulo = $this->input->post('txtTitulo');
            $subTitulo = $this->input->post('txtSubTitulo');
            $conteudo = $this->input->post('txtConteudo');
            $dataPub = $this->input->post('txtData');
            $id = $this->input->post('txtId');
            
            if ($this->modelPublicacoes->alterar($categoria, $titulo, $subTitulo, $conteudo, $dataPub, $id)) {
                redirect(base_url('admin/publicacao'));
                echo "Alterada com sucesso!";
            } else {
                echo "Houve um erro ao alterar!";
            }
        }
    }
    
    public function nova_foto() {
        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }
        
        $id = $this->input->post('id');

        $config['upload_path'] = './assets/frontend/img/publicacoes';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = $id . '.jpg';
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {
            //$config['image_library'] = 'gd2';
            $config['source_image'] = './assets/frontend/img/publicacoes/' . $id . '.jpg';
            $config['create_thumb'] = FALSE;
            $config['width'] = 900;
            $config['height'] = 300;

            $this->load->library('image_lib', $config);

            if ($this->image_lib->resize()) {
                
                if ($this->modelPublicacoes->alterar_img($id)) {
                    redirect(base_url('admin/publicacao/alterar/' . $id));
                    echo "Imagem alterada com sucesso!";
                } else {
                    echo "Houve um erro ao alterar imagem!";
                }
                
            } else {
                echo $this->image_lib->display_errors();
            }
        }
    }

}
