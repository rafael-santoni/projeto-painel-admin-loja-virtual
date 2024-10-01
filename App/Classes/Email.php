<?php

namespace App\Classes;

use App\Interfaces\InterfaceTemplateEmail;
use App\Classes\TemplateEmail;

class Email {

    private $email;
    private $quem;
    private $para;
    private $assunto;
    private $mensagem;
    private $template;
    private $copia = [];

    function __construct(){
        $this->email = new \PHPMailer;
    }

    public function setQuem($quem){
        $this->quem = $quem;
    }

    public function setPara($para){
        $this->para = $para;
    }

    public function setAssunto($assunto){
        $this->assunto = $assunto;
    }

    public function setMensagem($mensagem){
        $this->mensagem = $mensagem;
    }

    public function setTemplate(InterfaceTemplateEmail $template){
        $this->template = $template;
    }

    public function setCopia($copia){
        $this->copia = $copia;
    }

    public function enviar(){

        $this->email->CharSet = 'UTF-8';
        $this->email->SMTPSecure = 'ssl';
        // $this->email->SMTPSecure = 'tls';
        $this->email->isSMTP();
        $this->email->Host = '';
        $this->email->Port = 0;
        //$this->email->SMTPAutoTLS = true;
        $this->email->SMTPAuth = true;
        $this->email->Username = '';
        $this->email->Password = '';
        $this->email->isHTML(true);
        $this->email->setFrom('contato@empresa.com.br');
        $this->email->FromName = $this->quem;
        $this->email->addAddress($this->para);

        if(isset($this->copia)){
            foreach ($this->copia as $copia) {
                $this->email->AddAddress($copia);
            }
        }

        $this->email->Subject = $this->assunto;
        $this->email->AltBody = 'Este email contém HTML e não poder ser carrgado.';
        $this->email->MsgHTML($this->template->template($this->mensagem));

        if(!$this->email->send()){
            dump($this->email->ErrorInfo);
            return false;
        }

        return true;

    }

}
