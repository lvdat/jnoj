Requirements
------------

Only Linux server, can't run under Windows server。

Set up LNMP (or LAMP) include：PHP 7.x、MySQL、Nginx / Apache2

This tutorial is divided into **One-Click installation script** and **Manual installation process**. Choose one of these two processes.

If you need to add the evaluation machine to automatically start after booting, please check after installation [Startup](./autostart.md)

One-click installation script
-----------

> This method is recommend for newly installed systems or systems that do not run Web (nginx, mysql) related services

**Notice! ! ! This method is currently only tested in Ubuntu 18.04, Ubuntu 16.04, Centos 7.2+. Other Linux systems have not been tested yet. **

Execute the following command：
```
wget https://raw.githubusercontent.com/lvdat/jnoj/master/docs/install.sh && sudo bash install.sh
```

This script will installs OJ in the `/home/judge/jnoj` directory.

Admin account after installation: `admin`, password: `123456`.

**Please login and change password**。


Manual installation
------------

Set up environment：[Environment](environment.md)。

1. Download latest `jnoj` source。
    Run command：
    ~~~
    git clone https://github.com/lvdat/jnoj.git
    ~~~

2. Web config
    1. Config database:
        
        Create a database for jnoj.
        
        Edit file `jnoj/config/db.php` correct to database you created (`username`, `password`, `dbname`)。Example：
        
        ```php
        return [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=jnoj',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ];
        ``` 

    2. Execute installation command:
    
        In `jnoj` root directory, run:
        ~~~
        ./yii install
        ~~~
        This script will be insert data to DB. And you need to enter the account password of the OJ administrator according to the prompt。
    
    3. Modify `/etc/nginx/sites-enabled/default`, example：
        ```
        server {
                listen 80 default_server;
                listen [::]:80 default_server;

                # Change root server to your jnoj/web directory
                root /home/judge/jnoj/web;

                index index.php;

                server_name _;

                location / {
                        try_files $uri $uri/ /index.php?$args;
                }

                location ~ \.php$ {
                        include snippets/fastcgi-php.conf;
                        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
                }
        }
        ```
        After modify, reload Nginx server:
        ~~~
        sudo nginx -s reload`
        ~~~
    After above steps, you can access to Web server by：
    
    ~~~
    http://<IP address>
    (Localhost address)  http://127.0.0.1
    ~~~
    
    After install the web server, you need to config the judge server。
    
3. Config the Judge server
    1. Install compile language environment：
        ~~~
        sudo apt install libmysqlclient-dev libmysql++-dev python python-dev python3-dev make
        ~~~
    2. Create an user for question judging：
        ~~~
        sudo useradd -m -u 1536 judge
        ~~~
    4. In `jnoj/judge` directory，run `make`
    5. Run
         ~~~
         sudo ./dispatcher`
         ~~~

4. Config Polygon system:
    
    1. In `jnoj/polygon` directory，run `make`
    2. Run: 
        ~~~
        sudo ./polygon
        ~~~

##### Installation quick step

在以下命令中，`#` 字符及之后的字符为注释，不用输入
~~~
$ git clone https://github.com/lvdat/jnoj.git && cd jnoj
$ vim config/db.php
$ ./yii install
$ sudo useradd -m -u 1536 judge
$ cd judge
$ sudo apt install libmysqlclient-dev libmysql++-dev python python-dev python3-dev make
$ make
$ sudo ./dispatcher
$ cd ../polygon
$ make
$ sudo ./polygon
~~~
