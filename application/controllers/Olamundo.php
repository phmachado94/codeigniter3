<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Olamundo extends CI_Controller {

    public function index() {
        $dados['mensagem'] = 'Olá Mundo!';
        $this->load->view('olamundo', $dados);
    }

    public function teste() {
        $dados['mensagem'] = 'Testando...';
        $this->load->view('olamundo', $dados);
    }

    public function testeDB() {
        $dados['mensagem'] = $this->db->get('postagens')->result();
        echo "<pre>";
        print_r($dados);
        echo "</pre>";
    }

}