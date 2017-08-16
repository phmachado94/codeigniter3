<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('categorias_model', 'modelCategorias');
        $this->categorias = $this->modelCategorias->listar_categorias();
    }

    public function index() {
        $dados['categorias'] = $this->categorias;
        
        $this->load->model('publicacoes_model', 'modelPublicacoes');
        $dados['postagem'] = $this->modelPublicacoes->destaques_home();
        
        
        //Dados a serem enviados para o Cabeçalho
        $dados['titulo'] = 'Página Inicial';
        $dados['subtitulo'] = 'Postagens Recentes';
        
        $this->load->view('frontend/template/html-header', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/home');        
        $this->load->view('frontend/template/aside');        
        $this->load->view('frontend/template/footer');        
        $this->load->view('frontend/template/html-footer');
        
    }

    

}