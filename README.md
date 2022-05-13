# Ansible Playbooks

Ansible playbooks for provisioning optimized web servers for WordPress and Laravel. These playbooks are used by Autopilot (our cloud server control panel) and are perfect for:

* Local development environments.
* High-performance production servers (with caching).
 
## Requirements

* Ansible
* Ubuntu 20.04 LTS (Desktop/Server)

## Inventory

Before you can provision a [resource](#resources) you've to provision a server first. Add your inventory to the [hosts](./hosts) folder and provision a server or group using the following command:

Example:
```bash
# Provision a server (or group)
ansible-playbook server.yml -e host=<server>
```

## Resources

Resource playbooks use variables defined in a resource file, add your resources to the [resources](./resources) folder and reference the file while running a playbook. You can find resource examples in the [tests](./tests) folder.

```bash
# Example
ansible-playbook site.yml -e @resources/sites/my-site.yml
```

Available resource variables are defined in the `defaults` folder of a resource [role](./roles) and validated in the first `assert` task of each tasks file.

* Site variables: [./roles/site/defaults/main.yml](./roles/site/defaults/main.yml)
* User variables: [./roles/user/defaults/main.yml](./roles/user/defaults/main.yml)
* Database variables: [./roles/database/defaults/main.yml](./roles/database/defaults/main.yml)

### Site

```bash
# Provision a site
ansible-playbook site.yml -e @resources/sites/my-site.yml

# Backup a site
ansible-playbook site.yml -e @resources/sites/my-site.yml -t backup

# List site backups
ansible-playbook site.yml -e @resources/sites/my-site.yml -t backup/list

# Restore site backup
ansible-playbook site.yml -e @resources/sites/my-site.yml -t backup/restore

# Destroy site backup
ansible-playbook site.yml -e @resources/sites/my-site.yml -t backup/destroy

# Destroy a site
ansible-playbook site.yml -e @resources/sites/my-site.yml -t destroy
```

### Database

```bash
# Provision a database
ansible-playbook database.yml -e @resources/databases/my-database.yml

# Backup a database
ansible-playbook database.yml -e @resources/databases/my-database.yml -t backup

# List database backups
ansible-playbook database.yml -e @resources/databases/my-database.yml -t backup/list

# Restore database backup
ansible-playbook database.yml -e @resources/databases/my-database.yml -t backup/restore

# Destroy database backup
ansible-playbook database.yml -e @resources/databases/my-database.yml -t backup/destroy

# Destroy a database
ansible-playbook database.yml -e @resources/databases/my-database.yml -t destroy
```

### User

```bash
# Provision a user
ansible-playbook user.yml -e @resources/users/my-user.yml

# Destroy a user
ansible-playbook user.yml -e @resources/users/my-user.yml -t destroy
```

## Web Apps

* phpMyAdmin: `https://{{ site_domain }}/-/phpmyadmin/`
* Mailhog: `https://{{ site_domain }}/-/mailhog/`
* Node Exporter: `https://{{ site_domain }}/-/monitor/`

## Filesystem

* Vhosts: `/usr/local/lsws/conf/vhosts`
* MariaDB data: `/opt/sitepilot/stack/mariadb/data`

### Site Files

* Public path: `/opt/sitepilot/sites/{{ site_name }}/files`
* Logs path: `/opt/sitepilot/sites/{{ site_name }}/logs`
* Config path: `/opt/sitepilot/sites/{{ site_name }}/.config`
* User home path: `/opt/sitepilot/sites/{{ site_name }}/home`

## Author

These playbooks are developed and maintained by [Nick Jansen](https://sitepilot.io/).