# nostr-nip05-manager
A simple PHP+MySQL NIP-05 address manager for NOSTR protocol

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
- Modify mariadb.config.php.sample and copy it to /app folder.
- Place in your public_html folder

## Usage
- Run index.php with first sql installation.
- Create the admin/user password

### Future ideas
- Composer optional
- Run as private (no registration process)