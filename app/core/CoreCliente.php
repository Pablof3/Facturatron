<?php
namespace Core
{
    class Cliente
    {
        /**
         * @var string
         * @required
         * @length(11)
         */
        public $id_cliente;
        /**
         * @var string 
         * @required
         * @length(20)
         */
        public $razon;
        /**
         * @var string
         * @required
         * @length(10)
         */
        public $nit;
        /**
         * @var string
         * @required
         * @length(25)
         */
        public $nombre;
        /**
         * @var string
         * @required
         * @length(35)
         */
        public $apellidos;
    }
    
}
?>