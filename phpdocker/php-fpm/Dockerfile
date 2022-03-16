FROM phpdockerio/php74-fpm:latest
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php7.4-gd \
        php7.4-mysql \
        cron \
        locales \
    && apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Set the locale timezone to America/Fortaleza
RUN touch /etc/locale.gen
RUN sed -i '/pt_BR.UTF-8/s/^# //g' /etc/locale.gen
RUN locale-gen
ENV LANG pt_BR.UTF-8
ENV LC_ALL pt_BR.UTF-8
ENV TZ=America/Fortaleza
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Add crontab file in the cron directory
ADD crontab /etc/cron.d/hello-cron

# Give execution rights on the cron job
#RUN chmod 0644 /etc/cron.d/hello-cron
RUN chmod 0744 /etc/cron.d/hello-cron

# Create the log file to be able to run tail
RUN touch /var/log/cron.log
