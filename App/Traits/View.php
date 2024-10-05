<?php

namespace App\Traits;

trait View {

    public function view(array $dados, $view){

        $view  = str_replace('.', '/', $view);

        $template = $this->twig->load($view.'.html');
        echo $template->render($dados);

    }

}
