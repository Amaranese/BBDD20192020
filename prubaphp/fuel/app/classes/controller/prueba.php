<?php 
class Controller_Prueba extends Controller_Rest
{

    public function get_list()
    {
        return $this->response(array(
            'id' => 1,
            'name' => 'tu nombre',
            'email' => 'admin@example.com',
            'password' => 'udkf56,dkf'
        ));
    }
}
