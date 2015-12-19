# Common files for melol

Indice:

- **melol.css**: En la carpeta css encontrareis un fichero melol.css
- **./config.php**: Fichero de configuración al que iremos añadiendo variables. 
  - Incluir con: require_once('config.php') al principio de todos los programas
  - Para configurar nuestros propios valores sin afectar a otros equipos, se ha previsto
    la posibilidad de sobreescribir valores desde un fichero llamado 'config.local.php'
    si existe, se leerá al final lo que permite sobreescribir cualquier variable (ojo: no subir config.local a github!!!)
- **var_names.md**: Fichero que contendrá los nombres de variables a usar en la mayoria de las páginas PHP.

Ejemplos:
- **clasificacion.html**: Ejemplo de una tabla para MeLoL 

