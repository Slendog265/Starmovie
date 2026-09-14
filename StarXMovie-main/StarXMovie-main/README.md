# STARXMOVIE

---

![Logo](https://github.com/Kmolinag/StarXMovie/assets/139181471/6abd1ae0-cba3-4468-9839-e7934b6aa4d3)

## Tabla de Contenido
1. [Resumen](#resumen)
2. [Inicio Rápido](#inicio-rápido)
3. [Ramas](#ramas)
4. [Archivos Auxiliares](#archivos-auxiliares)
5. [Base de Datos](#base-de-datos)
6. [Plantillas](#plantillas)
7. [Static](#static)
8. [Rutas](#rutas)


## Resumen

### [Video Demo](https://youtu.be/MUtySphmv2Y)

StarXMovie es una plataforma interactiva de reseñas de películas donde los usuarios pueden descubrir, calificar y comentar sobre sus películas favoritas. Con una interfaz moderna y funcionalidades intuitivas, StarXMovie ofrece una experiencia cinematográfica única.

Explora una amplia variedad de películas, consulta las calificaciones de la comunidad, y comparte tus propias opiniones. ¡Sumérgete en el mundo del cine con StarXMovie!


## Inicio Rápido

1. **Instalar XAMPP:**
   - Descarga e instala [XAMPP](https://www.apachefriends.org/index.html) según las instrucciones proporcionadas en su sitio web oficial.

2. **Instalar Visual Studio Code (VSC):**
   - Descarga e instala [Visual Studio Code](https://code.visualstudio.com/download), un editor de código fuente liviano y potente.

3. **Instalar PHP Server:**
   - Abre Visual Studio Code.
   - Instala la extensión "PHP Server" desde el mercado de extensiones.

4. **Configurar el Proyecto:**
   - Clona el repositorio de StarXMovie desde [GitHub](https://github.com/tu-usuario/StarXMovie.git) o utiliza la URL proporcionada.

   ```bash
   git clone https://github.com/tu-usuario/StarXMovie.git

- Navega al directorio del proyecto:
   ```bash
   cd StarXMovie
- Asegúrate de que XAMPP esté iniciado y ejecuta el servidor PHP desde Visual Studio Code. Utiliza la opción "Serve project" para iniciar el servidor.

1. **Restaurar la Base de Datos:**
   - Desde PHPMyAdmin (accesible a través de XAMPP), crea una nueva base de datos llamada "starxmovie".
   - Importa la estructura de la base de datos desde el archivo SQL ubicado en la carpeta "sql" del proyecto.

2. **Ejecutar el Proyecto:**
   - Una vez que el servidor esté en funcionamiento y la base de datos esté configurada, abre tu navegador web y accede a http://localhost:8080 (o el puerto que esté utilizando).


## Ramas

StarXMovie utiliza un modelo de ramificación que facilita el desarrollo y la colaboración. A continuación, se describen las ramas principales del proyecto:

- **main:**
  La rama principal es donde se encuentra el código de producción estable. El código en esta rama siempre debería estar listo para implementarse en un entorno de producción.

- **develop:**
  La rama de desarrollo es donde se fusionan las características y correcciones de errores antes de pasar a la rama principal. Es una rama de integración continua y se considera más inestable que la rama principal.

- **feature/[nombre-feature]:**
  Para el desarrollo de nuevas características, se crean ramas de características específicas. Estas ramas se derivan de la rama de desarrollo y, una vez completadas, se fusionan nuevamente en la rama de desarrollo.

- **bugfix/[nombre-bug]:**
  Similar a las ramas de características, se crean ramas específicas para corregir errores. Estas se derivan de la rama de desarrollo y se fusionan nuevamente en la misma después de la corrección.

- **hotfix/[nombre-hotfix]:**
  En caso de errores críticos que requieren una corrección inmediata en producción, se crean ramas de hotfix. Estas se derivan de la rama principal y se fusionan tanto en la rama principal como en la de desarrollo después de la corrección.

Para contribuir al proyecto, se recomienda crear ramas específicas para las características o correcciones que estás implementando y solicitar una fusión (pull request) una vez que tu trabajo esté completo.


## Archivos Auxiliares

- **config.php:**
  Archivo de configuración principal del proyecto.

- **script.sql:**
  Script SQL para la creación de la base de datos.

- **backend/php/dol/person.php:**
  Clase PHP que maneja la lógica de interacción con los usuarios.

- **frontend/css/:**
  Carpeta que contiene archivos CSS para el estilo del proyecto.

- **frontend/js/:**
  Carpeta que contiene archivos JavaScript utilizados en el proyecto.

- **.gitignore:**
  Archivo de configuración para ignorar archivos y directorios en el control de versiones.

- **.editorconfig:**
  Archivo de configuración para mantener un estilo de codificación consistente.

- **README.md:**
  Documentación del proyecto.


## Base de Datos

El proyecto utiliza una base de datos MySQL para almacenar información esencial. A continuación, se describen detalles clave sobre la configuración y estructura de la base de datos:

### Configuración

- **Nombre de la base de datos:** `starxmovie`
- **Usuario:** `tu_usuario_mysql`
- **Contraseña:** `tu_contraseña_mysql`

Asegúrate de configurar correctamente estos parámetros en el archivo `config.php` para permitir una conexión exitosa a la base de datos.

### Estructura de la Base de Datos

La base de datos `starxmovie` consta de varias tablas que almacenan información vital para el funcionamiento del proyecto. A continuación, se presenta una descripción de algunas tablas clave:

1. **usuarios:**
   - Almacena información sobre los usuarios registrados en el sistema, como nombres, apellidos, direcciones de correo electrónico y datos de autenticación.

2. **peliculas:**
   - Contiene detalles sobre las películas disponibles, como títulos, descripciones y otros datos relacionados.

3. **calificaciones:**
   - Registra las calificaciones que los usuarios asignan a las películas, junto con cualquier comentario asociado.

La estructura completa de la base de datos se establece mediante el archivo `script.sql`. Asegúrate de ejecutar este script en tu servidor MySQL para crear la base de datos y sus tablas.

**Nota:** Si tienes algún problema con la configuración de la base de datos, revisa el archivo `config.php` y asegúrate de que los detalles de conexión sean correctos.

Para realizar consultas y gestionar la base de datos, se recomienda el uso de herramientas como **phpMyAdmin** o cualquier interfaz de MySQL de tu elección.


## Plantillas

Las plantillas en este proyecto están organizadas de manera estructurada para facilitar la comprensión y modificación. A continuación, se presenta una breve descripción de las principales plantillas utilizadas:

1. **Inicio de Sesión (`login.html`):**
   - Proporciona la interfaz para que los usuarios inicien sesión en el sistema.

2. **Registro (`sign up.php`):**
   - Contiene el formulario de registro para que los nuevos usuarios creen cuentas en el sistema.

3. **Recuperar Contraseña (`recuperar_contraseña.html`):**
   - Permite a los usuarios solicitar la recuperación de sus contraseñas proporcionando su correo electrónico y nombre de usuario.

4. **Perfil de Usuario (`perfil.php`):**
   - Muestra la información del usuario y proporciona opciones para editar el perfil y ver las calificaciones y reseñas anteriores.

5. **Página Principal (`pagina_principal.php`):**
   - Exhibe una lista de películas populares y ofrece acceso a detalles individuales de películas.

6. **Detalle de Película (`detalle_pelicula.php`):**
   - Muestra información detallada sobre una película específica, como sinopsis, puntuación y comentarios de usuarios.

7. **Respuesta de Recuperación (`respuesta.php`):**
   - Permite a los usuarios responder preguntas de seguridad para completar el proceso de recuperación de contraseña.

Estas plantillas están diseñadas utilizando HTML, CSS y, en algunos casos, incorporan scripts PHP para la lógica del servidor. Al realizar modificaciones, ten en cuenta la coherencia del diseño y la experiencia del usuario en todas las páginas.


## Static

El directorio `static` contiene archivos estáticos esenciales para el proyecto. Aquí se describen los principales subdirectorios y su propósito:

1. **CSS (`static/css/`):**
   - Contiene archivos CSS utilizados para dar estilo a las páginas HTML del proyecto. Cada archivo CSS está asociado a una plantilla específica.

2. **JS (`static/js/`):**
   - Incluye archivos JavaScript utilizados para agregar interactividad y funcionalidades a las páginas HTML. Al igual que los archivos CSS, cada archivo JS se relaciona con una plantilla específica.

3. **Imágenes (`static/img/`):**
   - Guarda imágenes y gráficos utilizados en diversas partes del proyecto. Las imágenes están organizadas de manera lógica según su uso en las plantillas.

4. **Videos (`static/video/`):**
   - Almacena archivos de video utilizados en el proyecto. Esto puede incluir trailers de películas, presentaciones u otros elementos multimedia.

Es crucial mantener la estructura de directorios para asegurar que los archivos estáticos sean referenciados correctamente desde las plantillas. Al agregar nuevos recursos estáticos, colócalos en los directorios correspondientes para facilitar la gestión y referencia en el código.


## Rutas

El proyecto utiliza un enrutador para gestionar las rutas y dirigir las solicitudes a las controladores adecuados. A continuación, se proporciona una visión general de algunas rutas clave en el proyecto:

1. **Inicio (`/`):**
   - La página de inicio del proyecto que muestra las películas populares y otras secciones destacadas.

2. **Perfil de Usuario (`/perfil`):**
   - Permite a los usuarios ver y editar su perfil, incluidos detalles personales y ajustes de cuenta.

3. **Detalle de Película (`/pelicula/{id}`):**
   - Muestra información detallada sobre una película específica identificada por su ID.

4. **Inicio de Sesión (`/login`):**
   - Proporciona un formulario para que los usuarios inicien sesión en sus cuentas existentes.

5. **Registro (`/registro`):**
   - Permite a los usuarios crear nuevas cuentas proporcionando la información necesaria.

6. **Recuperar Contraseña (`/recuperar-contrasena`):**
   - Ofrece un proceso para que los usuarios recuperen sus contraseñas mediante la respuesta a una pregunta de seguridad.

Estas son solo algunas de las rutas principales, y el enrutador puede gestionar muchas más. La lógica detrás de cada ruta se implementa en los controladores correspondientes. Asegúrate de revisar y entender el archivo de enrutamiento (`routes.php`) para obtener información detallada sobre todas las rutas disponibles en el proyecto.

