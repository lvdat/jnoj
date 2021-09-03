Environment setup
--------

You can choose to install LNMP or LAMP. Just choose one. It is recommended to install LNMP.

## LNMP pack

> Linux、Nginx、MySQL、PHP

> This setup is tested for Ubuntu server, orther Linux distro do the same。

#### Nginx

1. Get the latest resource pack
    ```bash
    sudo apt-get update 
    ```
2. Install Nginx
    ```bash
    sudo apt install nginx -y
    ```

#### Database

Install MySQL server (recommended 8.0)（You can use MariaDB）

```bash
sudo apt install mysql-server mysql-client
```

After install MySQL (or MariaDB), run `mysql_secure_installation` to set `root` user password。

#### PHP

> Require: PHP 7.0 or higher (Recommend 7.2)

Example to install PHP7.2 on Ubuntu 18.04:
~~~
sudo install php7.2
~~~
Install PHP extension:
```bash
sudo apt install php-fpm php-mysql php-common php-gd php-zip php-mbstring php-xml
```
