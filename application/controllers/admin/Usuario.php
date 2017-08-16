<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $this->load->library('table');

        $this->load->model('usuarios_model', 'modelUsuarios');
        $dados['usuarios'] = $this->modelUsuarios->listar_autores();

        //Dados a serem enviados para o Cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Usuários';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/usuario');
        $this->load->view('backend/template/html-footer');
    }

    public function inserir() {
        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $this->load->model('usuarios_model', 'modelUsuarios');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtNome', 'Nome dp Usuário', 'required|min_length[3]');
        $this->form_validation->set_rules('txtEmail', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('txtHistorico', 'Histórico', 'required|min_length[20]');
        $this->form_validation->set_rules('txtUser', 'User', 'required|min_length[3]|is_unique[usuario.user]');
        $this->form_validation->set_rules('txtSenha', 'Senha', 'required|min_length[3]');
        $this->form_validation->set_rules('txtConfirmarSenha', 'Confirmar Senha', 'required|min_length[3]|matches[txtSenha]');

        if (!$this->form_validation->run()) {
            $this->index();
        } else {
            $nome = $this->input->post('txtNome');
            $email = $this->input->post('txtEmail');
            $historico = $this->input->post('txtHistorico');
            $user = $this->input->post('txtUser');
            $senha = $this->input->post('txtSenha');

            if ($this->modelUsuarios->adicionar($nome, $email, $historico, $user, $senha)) {
                redirect(base_url('admin/usuario'));
                echo "Cadastrado com sucesso!";
            } else {
                echo "Houve um erro ao cadastrar!";
            }
        }
    }

    public function excluir($id) {
        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }
        $this->load->model('usuarios_model', 'modelUsuarios');
        if ($this->modelUsuarios->excluir($id)) {
            redirect(base_url('admin/usuario'));
            echo "Excluído com sucesso!";
        } else {
            echo "Houve um erro ao excluir!";
        }
    }

    public function alterar($id) {
        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $this->load->model('usuarios_model', 'modelUsuarios');
        $dados['usuarios'] = $this->modelUsuarios->listar_usuario($id);

        //Dados a serem enviados para o Cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Usuário';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/alterar-usuario');
        $this->load->view('backend/template/html-footer');
    }

    public function salvar_alteracoes() {
        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $this->load->model('usuarios_model', 'modelUsuarios');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtNome', 'Nome dp Usuário', 'required|min_length[3]');
        $this->form_validation->set_rules('txtEmail', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('txtHistorico', 'Histórico', 'required|min_length[20]');
        $this->form_validation->set_rules('txtUser', 'User', 'required|min_length[3]|is_unique[usuario.user]');
        $this->form_validation->set_rules('txtSenha', 'Senha', 'required|min_length[3]');
        $this->form_validation->set_rules('txtConfirmarSenha', 'Confirmar Senha', 'required|min_length[3]|matches[txtSenha]');

        if (!$this->form_validation->run()) {
            $this->index();
        } else {
            $id = $this->input->post('txtId');
            $nome = $this->input->post('txtNome');
            $email = $this->input->post('txtEmail');
            $historico = $this->input->post('txtHistorico');
            $user = $this->input->post('txtUser');
            $senha = $this->input->post('txtSenha');

            if ($this->modelUsuarios->alterar($id, $nome, $email, $historico, $user, $senha)) {
                redirect(base_url('admin/usuario'));
                echo "Alterado com sucesso!";
            } else {
                echo "Houve um erro ao alterar!";
            }
        }
    }

    public function nova_foto() {
        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $this->load->model('usuarios_model', 'modelUsuarios');
        $id = $this->input->post('id');

        $config['upload_path'] = './assets/frontend/img/usuarios';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = $id . '.jpg';
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {
            //$config['image_library'] = 'gd2';
            $config['source_image'] = './assets/frontend/img/usuarios/' . $id . '.jpg';
            $config['create_thumb'] = FALSE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);

            if ($this->image_lib->resize()) {
                
                if ($this->modelUsuarios->alterar_img($id)) {
                    redirect(base_url('admin/usuario/alterar/' . $id));
                    echo "Imagem alterada com sucesso!";
                } else {
                    echo "Houve um erro ao alterar imagem!";
                }
                
            } else {
                echo $this->image_lib->display_errors();
            }
        }
    }

    public function page_login() {
        //Dados a serem enviados para o Cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Entrar no Sistema';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/login');
        $this->load->view('backend/template/html-footer');
    }

    public function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtUser', 'Usuário', 'required|min_length[3]');
        $this->form_validation->set_rules('txtSenha', 'Usuário', 'required|min_length[3]');

        if (!$this->form_validation->run()) {
            $this->page_login();
        } else {
            $usuario = $this->input->post('txtUser');
            $senha = $this->input->post('txtSenha');

            $this->db->where('user', $usuario);
            $this->db->where('senha', md5($senha));

            $userLogado = $this->db->get('usuario')->result();

            if (count($userLogado) === 1) {
                $dadosSessao['userLogado'] = $userLogado[0];
                $dadosSessao['logado'] = TRUE;

                $this->session->set_userdata($dadosSessao);

                redirect(base_url('admin'));
            } else {
                $dadosSessao['userLogado'] = NULL;
                $dadosSessao['logado'] = FALSE;

                $this->session->set_userdata($dadosSessao);

                redirect(base_url('admin/login'));
            }
        }
    }

    public function logout() {
        $dadosSessao['userLogado'] = NULL;
        $dadosSessao['logado'] = FALSE;

        $this->session->set_userdata($dadosSessao);

        redirect(base_url('admin/login'));
    }

}
