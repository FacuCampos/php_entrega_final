# Proyecto final del curso de PHP
Facundo José Campos

## Descripción
El proyecto consiste en una página donde se pueda buscar distintos libros y obtener una breve descripcion de los mismos. Cada usuario que quiera contribuir se puede registrar y obtener acceso a la creacion y edicion.
Decidí implementar el framework "Laravel".

## Páginas
- **Home:** La página principal del sitio, es la primera que ve el usuario, se puede acceder sin estar logeado.

- **Ingresar:** Un login sencillo, se muestra un formulario con los campos "usuario" y "contraseña". Luego un botón que permite mantener la sesion iniciada. En caso de no tener cuenta, más abajo aparece un link para ir a la página "Regístrate". En caso de ya estar logeado, este enlace no se mostrará en el navbar y si se intenta ingresar a el por la url se redireccionará a la página principal.

- **Regístrate:** Aquí se puede crea run nuevo usuario ingresando un nombre de usuario, email y contraseña. Al igual que en "Ingresar", no se puede acceder a esta página si ya se está logeado.

- **Registro:** En esta página se muestra el registro de los libros almacenados en la base de datos. Si no se está registrado solo se pueden observar aquellos que tienen el estado "Finalizado". Los que estan en desarrollo solo son visibles para los usuarios logeados. También, estos usuarios pueden editar y eliminar aquellos libros que ellos hayan subido.

- **Agregar registro:** Cuando se inicia sesion, en el navbar se agrega el enlace a esta página. En ella se muestra un formulario con todos los campos necesarios para completar con la información del libro que se quiera agregar. Para poder agregarla se debe comletar correctamente un captcha.

- **Editar libro:** Solo se puede ingresar a esta página si el libro que se busca editar fue creado por el usuario. Aquí se muestra un formulario con los campos como a la hora de agregarlo. Al dar en "Editar" se guardará en la base de datos con los nuevos datos.

## Funcionamiento
### Rutas (web.php)
En el archivo *web.php* se establece toda la navegación del sitio. 
Para cada ruta se llama al método **Route::get** o **Route::post**, dependiendo de lo que se necesite. 
En caso de que un controlador maneje varias rutas, se utiliza el método **Route::controller()->group()**, que permite englobar todas las rutas bajo el mismo controlador sin necesidar de escribirlo en cada una.
Dentro de cada método *get* o *post* se establece la url por la cual se accederá seguida de un array con el controlador y el método del mismo al que se quiere acceder. Si se utiilzó *group*, solo se agrega el método en esa sección.
En algunas rutas se pasan variables entre corchetes, estas son enviadas al método como variables del mismo nombre.
Por ultimo se agregan **name()** y/o **middleware()** en caso de ser necesarios.
- **name()**: Define el nombre con el que se hará referencia a la ruta en el resto del proyecto.
- **middleware()**: Se utilizó unicamente *auth* y *guest*. Estos establecen que a la ruta solo se puede acceder si se esta logeado o si no se esta logeado respectivamente. En caso de querer acceder por url a una página exclusiva para usuarios sin estar logeado, *auth* redireccionará al *login*. Y en caso de querer ingresar al *login* o *register* mientras se tiene la sesion iniciada, *guest* redireccionará a *home*.

### Modelos
Al usar el patrón MVC (Modelo-vista-controlador), se utilizaron los modelos para conectarse con las tablas de la base de datos.
- **Libro.php:** Crea una conexión con la tabla "libros". Se utiliza luego el método *casts()* para que al pedir los valores de las columnas *updated_at* y *finalizado* los traiga como tipo *datetime* y *boolean* respectivamente.
- **User:** Este modelo se conecta con la tabla users. Se extiende de la clase **User** con la interfaz **Authenticatable**. Otorga los campos *name*, *email* y *password* como modificables y encripta la contraseña.

### Vistas
Se utilizó el formato de plantillas para crear las vistas con una carpeta de componentes para incluir en en las vistas que sean necesarias.
- **Home:** Contiene un HTML simple a modo ilustrativo de la pagina inicial de del sitio.
#### Components
- **Plantilla:** Se encuentra dentro de componentes. Aquí se ejecuta la base del codigo HTML, con la etiqueta *head* y todas sus etiquetas hijas. Dentro de la etiqueta *title* se incluye la directiva *@yield*, que permite darle contenido variable, y con un valor por defecto en caso de no estar definido. Luego sigue el *body*, donde se incluye el componente *header* y el main que tiene la variable *slot*, que será reemplazada por el contenido de cada vista.
- **Header:** Contiene el título con el nombre del sitio y un navegador. El nombre funciona como enlace hacia la página principal. En el navegador los enlaces que se muestran dependen de si se está logeado o no. Si se ve antes de iniciar sesión, solo mostrará los links de *Ver registro*, que dirije a la ruta */registros*, y de *Iniciar sesión*. En cambio. si se inicia sesión, se agrega el enlace *Agregar registro* y se reemplaza *Iniciar sesión* por *Cerrar sesión*. Esto se logra gracias a las directivas *@auth* y *@guest* de Laravel. En el caso de *Cerrar sesión* se utiliza un form ya que lo que se busca es enviar un formulario de tipo "Post".
- **Card:** Representa el código HTML de las tarjetas que se incluyen al ver el registro. Su vista varia dependiendo de si se está logeado o no. Ya que si se ingresa con un usuario, se agregan los inputs de *Subir libro*/*Volver a desarrollo*, *Editar* y *Eliminar libro*, junto con el estado del mismo. Los vista de los botones de *Subir libro* y *Volver a desarrollo* dependen de si el estado del libro es "finalizado" o no.

#### Libros
- **Index:** La página donde se muestra el registro de los libros. Se utiliza la directiva *@section* para asignar el título del *head*. Luego se muestra la lista de los libros, en caso de no estar logeado, solo se mostrarán los libros con el estado "finalizado". Si se inicia sesión se agrega una sección abajo donde se muestran aquellos libros que siguen en desarrollo. Para listas el registro se utiliza la directiva *@foreach*.

- **Create:** Un formulario que al enviarse crea llama al método *agregar* del controlador *LibrosController*. Utiliza las directivas *@section* para el título del *head*, *@if* para revisar que en la url exista el parámetro "status", y *@switch* para evaluar los posibles valores de "status" y mostrar el mensaje que corresponda.

- **Editar:** Este formulario llama al método *editar* del controlador *LibrosController* al ser enviado. Utiliza las mismas directivas que *Create*. La diferencia no solo esta en que llama a otra función, sino que mediante el controlador *editarPage* recupera la información del libro seleccionado y completa los inputs con los valores correspondientes.

#### Usuario
- **Login:** El formulario de ingreso del sitio. Utiliza las mismas directivas que *Create*. En caso de no tener cuenta hay un enlace que te lleva a la pagina *Register*. Al enviarse llama al método *login* del controlador *UserController*.
- **Register:** Este formulario llama al método *register* del controlador *UserController*. Utiliza la directiva *@section* para el asignar el título del *head*.

### Controladores
#### HomeController
Es el mas simple, unicamente dispone de una funcion **__invoke** que retorna la vista *home*, que referencia a la página principal.

#### UserController
Este controlador engloba todas los métodos relacionados a las vistas *Login* y *Register* y su comunicacion con el modelo *User*.
##### Métodos
###### loginPage
Retorna la vista de la página *Login*.

###### registerPage
Retorna la vista de la página *Regístrate*.

###### register
Este método recibe una variable **request** que representa todos los datos enviados por el formulario. Luego define una variable **usuario** y le asigna una nueva instancia del modelo **User**. Le asigna los valores recuperados de request a los atributos de la instancia correspondinetes. En el caso de *password*, se utiliza **Hash::make** para encriptar la contraseña. Por último se guarda la instancia en la base de datos y se redirige a *Login*.

###### login
Como el método anterior, recibe un **request**. Luego crea dos variables, la primera es **credentials**, que verifica mediante **validate()** que los campos se hayan completado, y la segunda es **remember** que guarda un booleano que representa si se seleccionó el checkbox de mantener sesión iniciada. Luego mediante define un *if* que llama al método **Auth::attempt()** que se encarga de autenticar la sesión. En caso de que se verifique, se regenera la sesión del usuario por seguridad, luego guarda el nombre de usuario en la sesión, y redirecciona a la ruta que se estaba intentando ingresar o en su defecto, a *home*.
En caso de generarse errores en los datos ingresados se llama al método **withMessages** de la instancia **ValidationException**, que establece un mensaje de error para el campo "email".

###### logout
Este método cierra la sesión previamente iniciada. Para ello utiliza el método **logout()** de la instancia **Auth** que proporciona Laravel. Luego invalida la sesión y regenera el token *csrf*. Por último redirige a la página *home*.

#### LibrosController
Este controlador engloba todas los métodos relacionados a las vistas *Ver registro*, *Agregar registro* y *Editar libro* y su comunicacion con el modelo *Libro*.

##### Métodos
###### index
Crea dos variables **finalizados** y **enProceso**, ambas ingresan a la instancia **Libro** y recuperan los registros de la base dependiando del valor de columna "finalizado". Luego devuelve la vista de la página *Ver registro* junto con las dos variables. Se utliza *compact()* para que se les asigne el nombre de la variable a la que es enviada a la vista.

###### create
Este método genera un código aleatorio para el captcha y lo guarda en la sesión. Luego retorna la vista *Agregar registro*.

###### agregar
Es llamado desde el formulario de *Agregar registro* y almacena la información recibida en la variable **request**. Primero verifica que el captcha ingresado coincida con el almacenado en la sesión mediante el método **get** de la instancia **Session**. Si se verifica crea una variable **libro** a la que le asigna una nueva instancia de **Libro**. Luego se le asigna el nombre de la sesión al atributo *usuario* y los datos correspondientes del request a *titulo*, *autor*, *genero* y *descripción*. Para el campo fecha se asigna el valor recibido a una nueva variable, y mediante *explode()*, *implode()* y *arrayreverse()* se crea un nuevo string con el formato de fecha buscado, luego se le asigna el valor al atributo *publicacion*.
Seguidamente se recuperan los valores del "nombre", "tamaño", "tipo" y "nombre temporal" de la imagen enviada, y se establece la ruta de destino de la imagen dentro de la carpeta **public**. Si se decidió ingresar una portada, se comprobará si el tipo de archivo pertenece a uno de los tres tipos permitidos y si el tamaño no exede los 2MB. En caso de que el archivo respeta esas condiciones se asignara un parámetro a la url con el error. Si se cumplen las condiciones, se guardará la imagen en la ruta definida previamente y se le asignara el nombre del archivo al atributo *portada*.
Si no hay errores se guardarán los datos en la base de datos y se agregara un parámetro en la url para indicar que se registró correctamente.

###### editarPage
Este método referencia a la página de edición en caso de querer modificar los datos previamente ingresados de un libro específico.
Primero busca el libro en la base de datos que tenga el mismo id que el recibido por parámertro.
Luego verifica si el nombre del usuario almacenado en la sesión coincide con el usuario que creó ese registro, esto se hace para que ningun usuario pueda alterar los registro de otro. Luego, al igual que en *create*, genera un codigo captcha aleatorio. Para poder pasarle a la vista la fecha en el formato correcto, se utiliza el método **createFromFormat()**. Luego se retorna la vista de *Editar libro* junto con el libro y la fecha formateada.

###### editar
Al enviar el formulario de edición se llama a este método que recibe un **request** y el id del libro.
Busca la instancia del libro que coincida con dicho id y lo almacena en una variable. Al igual que en *agregar* verifica el captcha y devuelve un error si no hay coincidencia. Si el captcha es correcto asigna el valor de false al atributo "finalizado" y repite el proceso explicado en *agregar* solo que en esta ocasión se trabaja sobre una instancia existente en lugar de una nueva.

###### eliminarRegistro
Este método recibe un id por parámetro y busca la instancia de *Libro* que contenga ese id. Luego verifica que quien lo este intentando eliminar sea el creador del registro y caso afirmativo utiliza **delete()** para eliminarlo de la base de datos. Al finalizar redsirecciona a la pagina *Ver registro*.

###### cambiarEstado
Sirve para cambiar el estado de un libro. Si se coincide el usuario con el creador del registro, verifica el valor del estado y lo cambia segun corresponda. Luego guarda el nuevo registro y redirecciona a *Ver registro*.

#### CaptchaController
Este controlador se utiliza para genera la imagen del captcha, solo tiene el método **create**. Primero mediante *header()* define que el formato será un .jpeg, luego crea la imagen con un tamaño específico, le da color al fondo y al texto, para despues generar el texto con el valor del codigo captcha en la sesion.