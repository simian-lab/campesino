# Aplicación Concurso Ventures
Este es el repositorio para el sitio de Cyberlunes (http://www.cyberlunes.com.co/). En este README se puede ver la documentación básica del proyecto.

## ¿Cómo empezar?

### Instalar la aplicación
Esta aplicación usa Vagrant para definir el entorno de desarrollo. Una vez instalado Vagrant en la máquina, se debe correr:

```
touch /etc/exports
vagrant up
```

Esto inicializará la máquina con todas las dependencias necesarias para el proyecto. El comando tarda un poco corriendo la primera vez, puesto que baja la máquina virtual y todos los paquetes que usa el sistema; por favor ten paciencia.

#### Nota
No es necesario usar Vagrant, pero es muy recomendable que lo hagas. Si aún así prefieres no usarlo, verifica la configuración que debes realizar con el líder técnico.

### Iniciar la aplicación
Para inicializar la aplicación es necesario ingresar a la máquina Vagrant usando:

```
vagrant ssh
```

Una vez estés en la máquina, es necesario verificar que apache y mysql están corriendo. Puedes correr estos comandos para validar que están arriba los servicios:

```
sudo service apache2 status
sudo service mysqld status
```

Si alguno de los dos está detenido puedes subirlo con `sudo service SERVICIO start`.

Si todo ha salido bien, debes poder acceder la aplicación en http://192.168.100.116.

### Deteniendo y reiniciando el entorno de trabajo

Cada vez que detengas la máquina virtual de Vagrant –bien sea porque reiniciaste tu computador o porque paraste la máquina con `vagrant halt`– debes recordar que al reiniciar es conveniente actualizar el repositorio a la última versión

#### Definir dominio de trabajo
Debes agregar a tu archivo de hosts (`/etc/hosts`) una línea al final que mapee la IP definida en el Vagrantfile (es decir, 192.168.100.116) el dominio de trabajo, es decir:

```
192.168.100.116 	cyberlunes.local
```

De esta manera, puedes acceder a tu entorno en la dirección `http://cyberlunes.local`

## Dependencias
Por favor, documenta aquí las dependencias que se creen para el sitio.