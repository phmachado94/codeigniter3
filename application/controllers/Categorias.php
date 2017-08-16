<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('categorias_model', 'modelCategorias');
        $this->categorias = $this->modelCategorias->listar_categorias();
    }

    public function index($id, $slug = null) {
        $dados['categorias'] = $this->categorias;
        
        $this->load->model('publicacoes_model', 'modelPublicacoes');
        $dados['postagem'] = $this->modelPublicacoes->categoria_pub($id);
        
        
        //Dados a serem enviados para o Cabeçalho
        $dados['titulo'] = 'Categorias';
        $dados['subtitulo'] = '';
        $dados['subtituloDB'] = $this->modelCategorias->listar_titulo($id);
        
        $this->load->view('frontend/template/html-header', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/categoria');        
        $this->load->view('frontend/template/aside');        
        $this->load->view('frontend/template/footer');        
        $this->load->view('frontend/template/html-footer');
        
    }

    

}