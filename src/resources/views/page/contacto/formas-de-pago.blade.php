<?php
   /*********************************************
	 *  Sitio web infrasoft
	 * Autor: Ariel Marcelo Diaz
	 * https://infrasoft.com.ar/
	 * Tel: +5493872204925
	 * Salta Capital
	 * Derechos reservados
	 **********************************************/
?>
@extends('layouts.site')

@section('container')

<div class="container-fluid">
<h1>Formas de pago</h1>
                    <p>Para su comodidad disponemos de los siguientes medios de Pago:</p>
            <h2 class="bg-primary text-center">Argentina</h2>
            
            <p><b>1- DEPOSITO BANCARIO: </b> Banco Patagonia - Banco Macro</p>
            <div class="text-center">
            	<img src='./media/img/contacto/patagonia.gif'  alt='banco patagonia' class="img-reponsive"/>
            	<img src='./media/img/contacto/macro.gif'  alt='banco macro' class="img-reponsive"/>
            </div>
            
            <p><b>2- Sistema de Pago Online: </b>Rapipago - Pago Facil - Todo Pago - Mercado Pago</p>            
             <div class="text-center">
            	<img src="./media/img/contacto/rapipago_pagofacil.png"  alt="Rapipago Pago facil" class="img-reponsive"/>
			</div>
			
            <p><b>3- Giro postal: </b>Correo Argentino </p>
            <div class="text-center">
            	<img src="./media/img/contacto/el-correo-argentino.png" alt="Correo Argentino" class="img-reponsive" />
            </div>
            
            <p><b>4- Tarjetas de credito: </b> Visa - Mastercard</p>
            <div class="text-center">
            	<img src='./media/img/contacto/tarjetas.png'  alt='Tarjetas de credito' class="img-reponsive"/>
            </div>
            <br />
            <h2 class="bg-primary text-center">Resto del Mundo</h2>
            
 		<ul class="list-inline">
 			<li> 				
 					<img src="./media/img/contacto/western-union-logo.png" alt="Western Union" class="img-reponsive"/> 				
 			</li>
 			<li>
 				<img src="./media/img/contacto/cuentadigital.png"  alt="Cuenta Digital"  class="img-reponsive"/>
 			</li>
 			<li>Pay Pal</li>
 			<li>Bit Coin</li>
 		</ul>
 </div>
 @endsection