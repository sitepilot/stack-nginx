FROM ubuntu:20.04

LABEL maintainer="Sitepilot"

# Copy filesystem
COPY filesystem /

# Install packages
RUN /opt/runtime/bin/install-packages \
    sudo python3-apt systemd systemd-sysv openssh-server software-properties-common \
    ca-certificates build-essential curl python3 python3-pip python3-setuptools zip \
    unzip acl zsh ncdu gnupg cron nano ntpdate rsyslog

# Allow running systemd in container
RUN cd /lib/systemd/system/sysinit.target.wants/ \
    && ls | grep -v systemd-tmpfiles-setup | xargs rm -f $1

RUN rm -rf /lib/systemd/system/multi-user.target.wants/* \
    /etc/systemd/system/*.wants/* \
    /lib/systemd/system/local-fs.target.wants/* \
    /lib/systemd/system/sockets.target.wants/*udev* \
    /lib/systemd/system/sockets.target.wants/*initctl* \
    /lib/systemd/system/basic.target.wants/* \
    /lib/systemd/system/anaconda.target.wants/* \
    /lib/systemd/system/plymouth* \
    /lib/systemd/system/systemd-update-utmp* \
    /var/lib/dpkg/lock-frontend \
    /var/lib/dpkg/lock

RUN systemctl enable ssh

VOLUME ["/sys/fs/cgroup"]

ENTRYPOINT ["/opt/runtime/bin/entrypoint"]

CMD ["/lib/systemd/systemd"]
