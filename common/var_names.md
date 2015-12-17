# Variables

Para mantener un espacio de nombres de variables comunes a todas las páginas PHP, en la siguiente tabla se mostrarán nombres de variables, su uso y un ejemplo que lo aclare.

** Variables únicas a esa página como `$nif` no se deberán añadir. **

| Variable | Uso | Ejemplo |
| --- | --- | ----|
| `$config` | Variable array para guardar configuración | `$config['dbName'] = ausias;` |
| `$conn` | Variable para la conexión | `$conn = new mysqli('dbHost', 'dbUser', 'dbPass', 'dbName');` |
| `$sql` | Variable para guardar la consulta | ``$sql = SELECT * FROM `table`; `` |
| `$result` | Variable para guardar el resultado de una consulta | `$result=$conn->query($sql);` |
| `$row` | Variable para guardar los datos obtenidos de una consulta | `$row=$result->fetch_assoc();` |

Se seguirán añadiendo más conforme se encuentren.
