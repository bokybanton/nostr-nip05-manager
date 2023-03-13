# nostr-nip05-manager
A simple PHP+MySQL [NIP-05](https://nips.be/5/) address manager for [NOSTR](https://github.com/nostr-protocol/nostr) protocol

## Introduction
This is a PHP&MariaDB nip-05 manager for nostr protocol. This means you can manage name@domain.com addresses attached to 32 bytes hex-encoded public keys from nostr protocol.

## Prerequisites
- PHP 7 or >
- Composer
    - Bootstrap
    - Captcha
- MariaDB
- Apache2
    -  mod_headers

## Instalation 
- Clone this git
- Modify [mariadb.config.php](app/mariadb.class.php).sample and copy it to /app folder.
- Place in your public_html folder


## Usage with every step I use
- Cheap domain (you know where to buy) with dynamic dns (ddclient or similar)
- Point the dmoain to your machine
- Install apache2, php (with mod headers), php composer, mariadb, run sql secure install, install certbot and run a https certificate.
- Configure your apache2 to point your host (or Virtualhost) to your nip-05-manager public_html folder
- Then you need to install composer dependencies like bootstrap5, bootstrap-icons and captcha.
- Allow HTTP CORS on aopache2 conf for your nip05-manager/.well-known/ folder. (it contains the main file of thie project)
- In this first commit, You need to install the SQL tables manually, you can see in /app/classes/nip05_manager_tables.sql
- Navigate to your website and Sign up for a new user, 
- You can checkl your database if user is created. (password is hased)
- Now try to add a name to your new user
- Attach a relay.
- test if yourname.com/.well-known/nostr.json?name=yourNameAdded is working
- Let me know issues in this repo
- Contribute developing.

### Contributing
- This is amateur project
- I accept all kind of contributions but you should add little code edits and with the modular approach I am using
- If you consider this code is totally wrong, please let me know and we can start another project with the new ideas, I want this prokect to be simple as posible and its use could help people to learn how to develop this tools.

### Future ideas

- [ ] Composer optional
- [ ] Run as private (no registration process)

