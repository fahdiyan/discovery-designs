# Discovery Designs
This is internal project, only accredited user who can access this application.

## Installation

- Clone / Copy this project under the Web root
- Now you should be able to access the application through the following URL, assuming `discovery-designs` is the directory directly under the Web root.
```
http://localhost/basic/web/
```

- As alternative, you can setup your virtual host to make you easier for accesing this project using your own domain, for nginx you just need to add file {domain}.conf under `etc/nginx/servers`. for example, if the domain name is `discovery.designs`, add new file `discovery.designs.conf` under `etc/nginx/servers` and copy this config inside that file:
```
server{
    listen 80;
    server_name discovery.designs;

    root {WEB_ROOT_DIRECTORY}/discovery.designs/web/;
    index index.php;

    location / {
        try_files $uri /index.php$is_args$args;
    }

    location ~ ^/assets/.*\.php$ {
        deny all;
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_read_timeout 600;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
        internal;
    }

    location ~* /\. {
        deny all;
    }

    error_log /usr/local/var/log/nginx/bds.test.error.log;
    access_log /usr/local/var/log/nginx/bds.test.access.log;
}
```
- After that don't forget to add domain name under file `/etc/hosts`
```
127.0.0.1       discovery.designs
```
- After that, you need to setup your database, you can set it on file `config/db.php` under this project
- When you have finished setup DB connection, then you need to run database migration in this project with running this command
```
./yii migrate
```
- Now you should be able to access the application through the following URL
```
discovery.designs
```
