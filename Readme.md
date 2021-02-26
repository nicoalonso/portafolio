## Portafolio

Antes de levantar los contenedores des-comentar del `docker-compose` las lineas que corresponde con el servidor web `nginx`. Yo ya dispongo de un `nginx` en mi máquina que uso como servidor proxy inverso por lo que no lo necesito.

Levantar contenedores con el docker compose:

```bash
cd docker
docker-compose -p portafolio -f docker-compose.yml up -d
```

Acceder al contenedor `php-fpm` e instalar los `vendors`:

```bash
docker exec -it portafolio_php_fpm_1 bash
php -d memory_limit=-1 /usr/local/bin/composer install
```

