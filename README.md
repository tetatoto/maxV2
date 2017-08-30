# Max

## Synopsis

This project is a web application. **Its name is Max** from the name of the Dog in the movie "My friend the animals". The goal of Max is to create a video from a newspaper article. It is **fast, automatic, and configurable**.

## Motivation

This project was developped by me,  **Théophile Debauche**, during an internship at Orange. The goal is to mix technologies in the fields of automation and IA with journalism and fun media content.

## Code Example & Architecture

```PHP
if (empty($paragraphs)) {
    // There is no text available, we will ask the user to try an other url
    $isTextPresent = false;
}
else {
    // There is some text available - so we can search for images
    // We can then search for images : (the second parameter in the call to getPictures is the number of images we want to DL)
    $pictureUrls = runPhantomScript(htmlspecialchars($theme));

    // DOWNLOADING (The following variable is the number of pictures actually downloaded)
    $nbPicturesDl = getPictures($pictureUrls, 20);

    // RESIZING
    $resultResizing = resizePictures(330, 220);
}
```

The Code is organized with the MVC architecture. So you will find:

* All the functions needed to parse the web and to create the video in the **model** directory
* All the calculations using those functions in the **controler** directory, using the parameters choosen by the user
* All the views corresponding to the different pages of the applications in the **view** directory

## Stack & APIs

According to the very nature of this project, it uses a lot of different APIs. The back is written in **PHP 5.6**, and the Front in written in **HTML5, Javascipt, and the framework Bootstrap**. The video generation part uses **bash scripts and phantomJS (Javascript) scripts**.

Here is a list of the tools used in this projetc :

* [**Composer**](https://getcomposer.org/) to install PHP dependencies
* [**YouTube Data API**](https://developers.google.com/youtube/v3/docs/comments/insert) to upload the video created on YouTube (you will therefore need to have a Google Account in order to get an API Key).
* [**mogrify**](https://www.imagemagick.org/script/mogrify.php) to resize images in a shell script - from imagemagick.
* [**FFMPEG**](https://www.ffmpeg.org/) to do the work for us to create the video with only bash scripting
* [**mp3info**](http://ibiblio.org/mp3info/) to get informations about an mp3 file in command line
* [**Voice RSS API**](http://www.voicerss.org/api/documentation.aspx) a free API to do the text to speech part
* [**PhantomJS**](http://phantomjs.org/) to parse a Google images result page and retrieve the urls of the images

NB : The project is up and running in a OVH VPS on Debian 8 with all those tools described before installed. You can read the following part to install all you need to test and run the code on you own linux distribution. 

## Installation

### Apache

Install a web server on Debian 8 (here for a VPS) - [see more here](https://docs.ovh.com/display/public/CRVPS/Installation+d'un+serveur+web+sous+Debian+8)

```bash
apt-get update
apt-get upgrade
apt-get install apache2
```

Now you should have an index.php on the repository /var/www/html/. You can check this by running :

```bash
cat /var/www/html/index.html
```

To restart the apache server you should run :

```bash
/etc/init.d/apache2 restart
```

You can check the logs here :

```bash
ls /var/log/apache2/
access.log  error.log  other_vhosts_access.log
```

### PHP 5.6

Install PHP :

```bash
apt-get install php5
```

(This project is working with PHP 5.6).

### Composer

To install composer with command line you can run : ([more info here](https://getcomposer.org/download/))

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

### FFMPEG

To install FFMPEG on Debian you can do the followings : (you will have to adapt if not on Debian) [more info here](https://superuser.com/questions/286675/how-to-install-ffmpeg-on-debian)

```bash
sudo echo deb http://www.deb-multimedia.org testing main non-free \
                  >>/etc/apt/sources.list
sudo apt-get update
sudo apt-get install deb-multimedia-keyring
sudo apt-get update
sudo apt-get install ffmpeg
```

### MP3INFO

Simply run :

```bash
apt-get install mp3info
```

### PhantomJS

To install phantomJS on Debian, run the followings (found on [This website](https://tecadmin.net/install-phantomjs-on-ubuntu/#))

Install the required packages

```bash
sudo apt-get update
sudo apt-get install build-essential chrpath libssl-dev libxft-dev
sudo apt-get install libfreetype6 libfreetype6-dev libfontconfig1 libfontconfig1-dev
```

Download the latest version of phantom from the [official website](http://phantomjs.org/download.html) 

```bash
wget https://bitbucket.org/ariya/phantomjs/downloads/phantomjs-2.1.1-linux-x86_64.tar.bz2
tar xvjf phantomjs-2.1.1-linux-x86_64.tar.bz2 -C /usr/local/share/
```

Then create a soft link phantomjs binary file to system bin directory

```bash
sudo ln -sf /usr/local/share/phantomjs-2.1.1-linux-x86_64/bin/phantomjs /usr/local/bin
```

Check if it worked by checking the version of phantom :

```bash
phantomjs --version
```

Then you will be able to run the phantomJS command line by simply running :

```bash
phantomjs
```

### Voice RSS

You will find all the informations [here](http://www.voicerss.org/sdk/php.aspx).
You just have to download the Voice RSS PHP SDK in the previous link, and put the PHP file named **voicerss_tts.php** in the repository you want.
(This file is already included in the github code)

NB : You will need to register in order to have an API Key.

### Image Magick

Just follow the instructions [there](https://www.imagemagick.org/script/download.php) .
It seems that this command is enough :

```bash
apt-get install mogrify
```


### YouTube API

This is not easy the first time.
You should watch first [this video tutorial](https://www.grafikart.fr/tutoriels/php/youtube-data-api-295).

* You should create a Google account, start a new project, initiate the youtube DATA API on it.
* Then you will have to get 3 informations : the Developer Key, the client ID and the client Secret.
* You should set with precision the redirect URL (the page that will be called after the authentification by Google on your website).

To install the Google Client Library you will need to use Composer :

```bash
php composer.phar require google/apiclient:^2.0
```

Then if you manage to do the previous steps, you will be able to run a first test (the one from the tutorial is a bit old but step by step, or you can use the one from the youtube documentation [here](https://developers.google.com/youtube/v3/quickstart/php)).

## Tests

I did not write a lot of tests for this project, all the tests I wrote are commented in the code. If you want to test any part, you just have to uncomment those test and run the application.
You can also access the logs of Apache with the following command :

```bash
cat /var/log/apache2/error.log
```

## Contributors

The main developer of this project is Théophile Debauche (tetatoto.142857@gmail.com), under the direction of H.S.
The contributors are F.M. and V.L.

## Acknowledgments

* On the original idea of H.S.

