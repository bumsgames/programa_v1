<?php

use Illuminate\Database\Seeder;

class TutorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tutorial')->insert([
        	'titulo' => '¿Como registrar un articulo en BumsGames?',
        	'texto' => '<center><h2>¿Como registrar un articulo en BumsGames?</h2></center>
            <br>
            <ol><li>El duenno es obligatorio.</li>
            
            <li>Cada articulo debe tener minimo un duenno y el porcentaje significa en que porcion la persona es duenno de ese articulo, ejemplo: Si hay un duenno con una accion de 50% en caso de venta, si se vende en 10 $ un articulo, esa persona se llevaria un 5$. </li>
            
            <li>La descripcion no es obligatoria por los momentos. </li>
            
            <li>Recuerden colocar la categoria correcta, ya que cada articulo registrado aparecera en la Pagina Web. </li>
            
            <li>Si un articulo se le marca "Si" en la parte de oferta en la Pagina Web saldra en oferta. </li>
            
            <li>El precio del articulo es en $ y la forma de calcularlo, lo marca el duenno del articulo, si no se sabe el precio del articulo en $, colocarlo en 0. </li>
            
            <li>Correo, Password, nicname y boton reseteo, solo se marca si es un Articulo digital de tipo Cuenta, el boton de reseteo solo aplica para Ps3 Cuenta Digital, Ps4 Primario y Secundario. Si no se sabe la fecha de reseteo, no rellenarlo. 
            </li>
            <li> Cada articulo tiene una parte nota en caso de querer avisar algo, no es necesario rellenarlo. 
            </li>
            <li>La foto de portada y foto de fondo son las fotos del articulo, ese disenno se puede apreciar mejor en la parte Web, cual foto es de cada cosa. Al no rellenarlo se le colocaran unas imagenes predeterminadas por el sistema. 
            </li>
            </ol>
            <hr>
            <center><h4>Cualquier duda generar un Reporte, en el modulo reporte. 
            Recuerde que cada articulo registrado y que la cantidad sea mayor a 1, sera publicado en la Pagina Web.</h4></center>',
        ]);
        DB::table('tutorial')->insert([
        	'titulo' => '¿Como realizar una venta?',
        	'texto' => '<center><h2>¿Como realizar una venta? </h2>
            </center><hr>
            <ol>
            <li>Darle click en vender. 
            </li>
            <li>Colocar el nombre, apellido y datos del cliente si es su primera venta. Si no es su primera venta al comenzar a escribir en los campos de texto de nombre y apellido, le saldran las coincidencias de la base de datos, al reconocer al cliente existente, darle click en Seleccionar. 
            </li>
            <li>Colocar la cantidad vendida de ese articulo. 
            </li>
            <li>La entidad significa el Banco Emisor desde donde se realiza el pago. 
            </li>
            <li> La referencia es opcional 
            </li>
            <li>Colocar el monto pagado y en que moneda se realizo el pago, si la moneda no existe, generar un reporte para que coloquen la nueva moneda. 
            </li>
            <li> Las notas son opcionales 
            </li>
            <li>Si el articulo se debe enviar clickear en la pantalla "Incluye envio." y rellenar los datos. 
            </li>
            <li> Clickear en "Realizar Venta" y entregar el articulo o pautar la entrega. Recuerde colocar los datos correctos cuando termine en caso de ser cuenta digital. 
            </li>
            </ol>
            <hr>
            <center><h4>Usted puede ver sus movimientos desde la seccion de Ventas o desde la Seccion Movimientos.
            </h4>
            <h4>Cualquier duda generar un reporte.
            </h4></center>',
        ]);
        DB::table('tutorial')->insert([
        	'titulo' => 'Tutoriales de descarga',
        	'texto' => '<h1>Tutoriales de descarga
            </h1><h3>PlayStation 4 Primario</h3>
            Crear usuario 》ingresar correo y clave que le daré 》omitir todo 》ir biblioteca 》comprado <br>INSTRUCCIONES: VIDEOTUTORIAL: https://www.youtube.com/watch?v=fzHBj8vPZ3s&t=36s USUARIO PRINCIPAL IMPORTANTE 1.-El juego tendra garantía en todo momento. Cualquier inconveniente avisenos para solventarle lo antes posible 2.-No debe modificar la cuenta ni correo ni clave 3.-No debe jugar con el usuario que le di dado que usted es usuario principal por ende debe jugar con su usuario personal u otro 
            <br>
            <br>
            <h3>Pasos para descargar en PS4 SECUNDARIO
            </h3>Crear usuario 》iniciar sesion (ingresar correo y clave que le daré) 》¿Cambiar a esta PS4 principal? NO CAMBIAR 》ir biblioteca 》comprado 
            <br>
            Tutorial: https://www.youtube.com/watch?v=5vXs4Gnxxi0 
            USUARIO SECUNDARIO IMPORTANTE <br>
            <ol><li>El juego tendra garantía en todo momento. Cualquier inconveniente avisenos para solventarle lo antes posible </li>
            <li>No debe modificar la cuenta ni correo ni clave </li>
            <li>Debe jugar con el usuario que le di dado que usted es usuario secundario 
            </li><li>No debe ponerse como usuario principal </li>
            <li>Para jugar debera tener OBLIGATORIAMENTE conexion a internet en su ps4 la falta de alguno de estos items acarrea la perdida del juego ¿COMO JUGAR UN JUEGO SECUNDARIO CON NUESTRO USUARIO PERSONAL? (solo aplica para algunos juegos) </li></ol>
            Debe abrir el juego con el usuario que descargó (el que le dimos) > inmediatamente despues de iniciado debe cambiar a su usuario personal para el comienzo del juego 
            https://www.youtube.com/watch?v=X0Ha1McuIto',
        ]);
        DB::table('tutorial')->insert([
        	'titulo' => 'Mensajes de entrega',
        	'texto' => '<center><h3>Pasos de descarga PlayStation 4 Primario</h3>
            <br>
            *VIDEOTUTORIAL PARA DESCARGAR:* https://www.youtube.com/watch?v=fzHBj8vPZ3s&t=36s 
            <br>
            *RECORDATORIO:* Usted cuenta con garantia de por vida, siempre y cuando cumpla las normativas y tambien puede utilizar este producto como PARTE DE PAGO por otros articulos de nosotros. 
            <br>
            *REGLAS (OBLIGATORIO):* No utilizar el usuario una vez puesto a descargar, no cambiar o modificar datos de la CUENTA. (Hay sanciones en caso de que no se cumplan las mismas) 
            <br>
            Cualquier duda realizarla a su vendedor, gracias por su compra. 
            <br>
            Echale un vistazo a nuestro Instagram: https://www.instagram.com/bumsgames/ 
            <br>
            *Aqui nuestra pagina web, visitala ya: www.bumsgames.com.ve*
            <br>
            <br>
            <br>
            <h3>Pasos de descarga PlayStation 4 Secundario
            </h3><br>
            <br>
            *VIDEOTUTORIAL PARA DESCARGAR:* https://www.youtube.com/watch?v=5vXs4Gnxxi0&t=12s 
            <br>
            *VIDEOTUTORIAL para jugar:* https://www.youtube.com/watch?v=lD2_neiQM0c 
            <br>
            *VIDEOTUTORIAL fallo (muy poco frecuente):* https://www.youtube.com/watch?v=2RcHgtIshzQ 
            <br>
            Sabia que algunos juegos secundario de PlayStation 4 se puede jugar desde cualquier usuario, mira este tutorial e intentalo a ver si puedes jugar desde tu usuario personal. 
            *VIDEOTUTORIAL para jugar desde nuestro usuario:* https://www.youtube.com/watch?v=X0Ha1McuIto 
            <br>
            RECORDATORIO: Usted cuenta con garantia de por vida, siempre y cuando cumpla las normativas y tambien puede utilizar este producto como PARTE DE PAGO por otros articulos de nosotros. 
            <br>
            *REGLAS (OBLIGATORIO):* No activarse como PRIMARIO por ninguna razon, no cambiar o modificar datos de la CUENTA. (Hay sanciones en caso de que no se cumplan las mismas) 
            <br>
            Cualquier duda realizarla a su vendedor, gracias por su compra. 
            <br>
            Echale un vistazo a nuestro Instagram: https://www.instagram.com/bumsgames/ 
            *Aqui nuestra pagina web, visitala ya:* www.bumsgames.com.ve
            <br>
            <br>
            <br>
            <h3>Pasos de descarga PlayStation 3 Digital
            </h3><br>
            <br>
            *VIDEOTUTORIAL PARA DESCARGAR:* https://www.youtube.com/watch?v=YZzDS5CJJ4s 
            <br>
            *MUY IMPORTANTE: *Al momento de la descarga recuerdo colocar varias descargas en segundo plano o descargas de respaldo, ya que si por algun motivo su descarga se llegara dannar podria correr el riesgo de quedarse sin el juego. 
            <br>
            *REGLAS (OBLIGATORIO):* Esta descarga solo es valida para una consola, no cambiar datos de la CUENTA, recuerde que usted tiene cierto limite de tiempo para realizar la descarga. (Hay sanciones en caso de que no se cumplan las mismas). No borrar el perfil creado para realizar la descarga, recuerde que si lo borra, desactivara su juego y no se le podra enviar de nuevo.</center>',
        ]);



    }
}
