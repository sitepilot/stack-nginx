# Ansible Playbooks

Ansible playbooks for provisioning optimized web servers for WordPress and Laravel. These playbooks are used by Autopilot (our cloud server control panel) and are perfect for:

* Local development environments.
* High-performance production servers (with caching).
 
## Requirements

* Ansible
* Ubuntu 20.04 LTS (Desktop/Server)

## Playbooks

Playbooks use variables defined in a resource file, add your resources to the `resources` folder and reference the file while running a playbook. You can find resource examples in the [tests](./tests) folder.

Example:
```bash
ansible-playbook -i ./inventory ./ansible/playbooks/server/provision.yml -e @resources/servers/my-servers.yml
```

### Server

```bash
# Provision a server: 
ansible-playbook -i ./inventory ./ansible/playbooks/server/provision.yml -e @resources/servers/<servers-name>.yml
```

### Site

```bash
# Provision a site: 
ansible-playbook -i <inventory-file> ./playbooks/site/provision.yml -e @resources/sites/<site-name>.yml

# Backup a site:
ansible-playbook -i <inventory-file> ./playbooks/site/backup.yml -e @resources/sites/<site-name>.yml

# Restore a site: 
ansible-playbook -i <inventory-file> ./playbooks/site/restore.yml -e @resources/sites/<site-name>.yml

# List backups for a site: 
ansible-playbook -i <inventory-file> ./playbooks/site/list-backups.yml -e @resources/sites/<site-name>.yml

# Destroy a site: 
ansible-playbook -i <inventory-file> ./playbooks/site/destroy.yml -e @resources/sites/<site-name>.yml
```

### Database

```bash
# Provision a database: 
ansible-playbook -i <inventory-file> ./playbooks/database/provision.yml -e @resources/databases/<database-name>.yml

# Backup a database:
ansible-playbook -i <inventory-file> ./playbooks/database/backup.yml -e @resources/databases/<database-name>.yml

# Restore a database: 
ansible-playbook -i <inventory-file> ./playbooks/database/restore.yml -e @resources/databases/<database-name>.yml

# List backups for a database: 
ansible-playbook -i <inventory-file> ./playbooks/database/list-backups.yml -e @resources/databases/<database-name>.yml

# Destroy a database: 
ansible-playbook -i <inventory-file> ./playbooks/database/destroy.yml -e @resources/databases/<database-name>.yml
```

## Web Apps

* phpMyAdmin: `https://{{ site_domain }}/-/phpmyadmin/`
* Mailhog: `https://{{ site_domain }}/-/mailhog/`
* Node Exporter: `https://{{ site_domain }}/-/monitor/`
* Health check: `https://{{ site_domain }}/-/ping/`

## Filesystem

* Vhosts: `/usr/local/openresty/nginx/conf/sites-enabled`
* PHP-FPM pools: `/etc/php/{{ php_version }}/fpm/pool.d`
* MariaDB data: `/opt/sitepilot/services/mariadb/data`

### Site Files

* Public path: `/opt/sitepilot/sites/{{ site_name }}/files`
* Logs path: `/opt/sitepilot/sites/{{ site_name }}/logs`
* Home path: `/opt/sitepilot/sites/{{ site_name }}/home`
* Cache path: `/opt/sitepilot/sites/{{ site_name }}/.cache`
* Config path: `/opt/sitepilot/sites/{{ site_name }}/.config`

## Cache Purge

Send a `PURGE` request to the URL you would like to purge:

```
# Purge site cache
curl -X PURGE https://{{ site_domain }}/

# Purge a single post
curl -X PURGE https://{{ site_domain }}/hello-world/
```

## Author

These playbooks are developed and maintained by [Nick Jansen](https://sitepilot.io/).